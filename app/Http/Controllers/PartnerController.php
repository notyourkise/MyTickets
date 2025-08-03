<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function getPartnerLogos()
    {
        return [
            ["name" => "Garuda Indonesia", "path" => "image/garuda_indonesia.png", "alt" => "Logo Garuda Indonesia"],
            ["name" => "Citilink", "path" => "image/citilink.png", "alt" => "Logo Citilink"],
            ["name" => "Lion Air", "path" => "image/lion_air.png", "alt" => "Logo Lion Air"],
            ["name" => "Batik Air", "path" => "image/batik_air.png", "alt" => "Logo Batik Air"],
            ["name" => "Sriwijaya Air", "path" => "image/sriwijaya_air.png", "alt" => "Logo Sriwijaya Air"],
            ["name" => "TransNusa", "path" => "image/transnusa.png", "alt" => "Logo TransNusa"],
            ["name" => "Pelita Air", "path" => "image/pelita_air.png", "alt" => "Logo Pelita Air"],
            ["name" => "Super Air Jet", "path" => "image/super_air_jet.png", "alt" => "Logo Super Air Jet"],
            ["name" => "Singapore Airlines", "path" => "image/singapore_airlines.png", "alt" => "Logo Singapore Airlines"],
            ["name" => "Qatar Airways", "path" => "image/qatar_airways.png", "alt" => "Logo Qatar Airways"],
            ["name" => "Emirates", "path" => "image/emirates.png", "alt" => "Logo Emirates"],
            // Travel Platforms
            ["name" => "Traveloka", "path" => "image/traveloka.png", "alt" => "Logo Traveloka"],
            ["name" => "Agoda", "path" => "image/agoda.png", "alt" => "Logo Agoda"],
            ["name" => "OYO Rooms", "path" => "image/oyo_rooms.png", "alt" => "Logo OYO Rooms"],
            ["name" => "RedDoorz", "path" => "image/reddoorz.png", "alt" => "Logo RedDoorz"],
            // Bus Companies
            ["name" => "Rosalia Indah", "path" => "image/rosalia_indah.png", "alt" => "Logo Rosalia Indah"],
            ["name" => "Sinar Jaya", "path" => "image/sinar_jaya.png", "alt" => "Logo Sinar Jaya"],
            ["name" => "Qatar Airways", "path" => "image/qatar_airways.png", "alt" => "Logo Qatar Airways"],
            ["name" => "PO Rosalia Indah", "path" => "image/rosalia_indah.png", "alt" => "Logo PO Rosalia Indah"],
            ["name" => "PO Sinar Jaya", "path" => "image/sinar_jaya.png", "alt" => "Logo PO Sinar Jaya"],
            ["name" => "RedDoorz", "path" => "image/reddoorz.png", "alt" => "Logo RedDoorz"],
            ["name" => "OYO Rooms", "path" => "image/oyo_rooms.png", "alt" => "Logo OYO Rooms"],
            ["name" => "Traveloka", "path" => "image/traveloka.png", "alt" => "Logo Traveloka"],
            ["name" => "Agoda", "path" => "image/agoda.png", "alt" => "Logo Agoda"]
        ];
    }
}
