<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coche;
use App\Models\Furgoneta;
use App\Models\Vehiculo;

class Concesionario extends Controller
{
    // ---------- Metodos del CRUD ---------- 
    // GET
    // Get all
    public function getAllVehicles() {
        $vehicles = Vehiculo::all();
        
        // Conversión automática array->json de Laravel
        return response()->json($vehicles);
    }

    // Get por id
    public function getVehicleById($id) {
        $vehicle = Vehiculo::where('ID_VEHICULO', $id)->first();
        
        return response()->json($vehicle);
    }

    // POST
    public function createVehicle(Request $request) {
        // Datos del body de la petición
        $data = $request->json()->all();
        
        // Verifica el tipo de vehiculo
        if (isset($data['tipo'])) {
            $tipo = $data['tipo'];
            
            // Coches
            if ($tipo === "coche") {
                $vehicle = Coche::create($data);

            // Furgonetas
            } elseif ($tipo === "furgoneta") {
                $vehicle = Furgoneta::create($data);
            } 
        }
    }

    // 
}
