<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Train;
use App\Models\Bus;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with('bookable')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('bookings.index', compact('bookings'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'booking_type' => 'required|in:flight,train,bus,hotel',
            'bookable_id' => 'required|integer',
            'travel_date' => 'required|date',
            'class_type' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'passenger_details' => 'required|array',
            'passenger_details.*.name' => 'required|string',
            'passenger_details.*.id_number' => 'required|string',
            'passenger_details.*.phone' => 'required|string',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Get the bookable model
            $bookableModel = $this->getBookableModel($request->booking_type);
            $bookable = $bookableModel::findOrFail($request->bookable_id);
            
            // Calculate total price
            $totalPrice = $this->calculatePrice($bookable, $request);
            
            // Check availability
            if (!$this->checkAvailability($bookable, $request)) {
                throw new \Exception('Kursi/kamar tidak tersedia.');
            }
            
            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'booking_type' => $request->booking_type,
                'bookable_id' => $request->bookable_id,
                'bookable_type' => get_class($bookable),
                'passenger_details' => $request->passenger_details,
                'travel_date' => $request->travel_date,
                'return_date' => $request->return_date,
                'class_type' => $request->class_type,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
            ]);
            
            // Update availability
            $this->updateAvailability($bookable, $request);
            
            DB::commit();
            
            return redirect()->route('bookings.show', $booking->id)
                ->with('success', 'Booking berhasil dibuat! Kode booking: ' . $booking->booking_code);
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        $booking->load('bookable');
        return view('bookings.show', compact('booking'));
    }
    
    private function getBookableModel($type)
    {
        return match($type) {
            'flight' => Flight::class,
            'train' => Train::class,
            'bus' => Bus::class,
            'hotel' => Hotel::class,
            default => throw new \InvalidArgumentException('Invalid booking type')
        };
    }
    
    private function calculatePrice($bookable, $request)
    {
        if ($bookable instanceof Flight) {
            $priceField = 'price_' . $request->class_type;
            return $bookable->$priceField * $request->quantity;
        }
        
        if ($bookable instanceof Train) {
            $priceField = 'price_' . $request->class_type;
            return $bookable->$priceField * $request->quantity;
        }
        
        if ($bookable instanceof Bus) {
            return $bookable->price * $request->quantity;
        }
        
        // For hotels, price calculation would be different (per night)
        return 0;
    }
    
    private function checkAvailability($bookable, $request)
    {
        if ($bookable instanceof Flight || $bookable instanceof Train) {
            $availableField = 'available_' . $request->class_type;
            return $bookable->$availableField >= $request->quantity;
        }
        
        if ($bookable instanceof Bus) {
            return $bookable->available_seats >= $request->quantity;
        }
        
        return true; // For hotels
    }
    
    private function updateAvailability($bookable, $request)
    {
        if ($bookable instanceof Flight || $bookable instanceof Train) {
            $availableField = 'available_' . $request->class_type;
            $bookable->decrement($availableField, $request->quantity);
        }
        
        if ($bookable instanceof Bus) {
            $bookable->decrement('available_seats', $request->quantity);
        }
    }
}
