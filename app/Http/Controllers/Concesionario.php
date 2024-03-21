<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coche;
use App\Models\Furgoneta;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;

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
    
            // Comienza una transacción
            DB::beginTransaction();

            try {
                // Primero: registro en vehiculos
                $vehiculo = new Vehiculo();
                foreach ($data as $key => $value) {
                    $vehiculo->{$key} = $value;
                }
                $vehiculo->save();
                
                // Obtener el ID del vehiculo recién creado
                $id_vehiculo = $vehiculo->id;

                // Segundo: registro en coche o furgoneta
                // Furgoneta
                if ($tipo === "furgoneta") {
                    $furgoneta = new Furgoneta();
                    // Almacenar datos: 
                    $furgoneta->matricula = $data['matricula'];
                    $furgoneta->tipo = $data['tipo'];
                    $furgoneta->marca = $data['marca'];
                    $furgoneta->modelo = $data['modelo'];
                    $furgoneta->anio = $data['anio'];
                    $furgoneta->color = $data['color'];
                    $furgoneta->km = $data['km'];
                    $furgoneta->precio = $data['precio'];
                    $furgoneta->combustible = $data['combustible'];
                    $furgoneta->volumen_carga_m3 = $data['volumen_carga_m3'];
                    $furgoneta->tamanio = $data['tamanio'];
                    $furgoneta->ID_VEHICULO = $id_vehiculo;
                    // Guardar la furgoneta
                    $furgoneta->save();
                // Coche
                } elseif ($tipo === "coche") {
                    $coche = new Coche();
                    // Almacenar datos: 
                    $coche->matricula = $data['matricula'];
                    $coche->tipo = $data['tipo'];
                    $coche->marca = $data['marca'];
                    $coche->modelo = $data['modelo'];
                    $coche->anio = $data['anio'];
                    $coche->color = $data['color'];
                    $coche->km = $data['km'];
                    $coche->precio = $data['precio'];
                    $coche->combustible = $data['combustible'];
                    $coche->categoria = $data['categoria'];
                    $coche->ID_VEHICULO = $id_vehiculo;
                    // Guardar el coche
                    $coche->save();
                }
                // Confirmar transacción
                DB::commit();
                // Mostrar vehiculo creado
                return response()->json($vehiculo);

            } catch (\Exception $e) {
                // Error: revertir la transacción
                DB::rollback();
                    
                // Mostrar respuesta de error
                return response()->json(['message' => 'Error en la creación del vehículo', 'error' => $e->getMessage()], 500);
                
            }
        }
    }
}
