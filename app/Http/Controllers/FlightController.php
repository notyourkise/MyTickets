<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index()
    {
        return view('flights.index');
    }
    
    public function search(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after:departure_date',
            'passengers' => 'required|integer|min:1|max:9',
            'class' => 'required|in:economy,business,first'
        ]);
        
        $flights = Flight::active()
            ->search($request->origin, $request->destination, $request->departure_date)
            ->orderBy('departure_time')
            ->get();
            
        return view('flights.search', compact('flights', 'request'));
    }
    
    public function show(Flight $flight)
    {
        return view('flights.show', compact('flight'));
    }
    
    public function book(Request $request, Flight $flight)
    {
        $request->validate([
            'class_type' => 'required|in:economy,business,first',
            'passengers' => 'required|integer|min:1',
            'travel_date' => 'required|date'
        ]);
        
        // Check availability
        $availableSeats = $flight->{'available_' . $request->class_type};
        if ($availableSeats < $request->passengers) {
            return back()->with('error', 'Kursi tidak tersedia untuk kelas yang dipilih.');
        }
        
        return view('flights.book', compact('flight', 'request'));
    }
}
