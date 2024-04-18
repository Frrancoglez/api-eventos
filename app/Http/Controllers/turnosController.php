<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Empleado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class turnosController extends Controller
{
    public function getTurnos()
    {
        //Recupero todos los turnos
        $turnos = Turno::all();

        //Validar si la tabla de turnos esta vacia
        if ($turnos->isEmpty())
        {
            $data = [
                'mesagge'=>'No se encontraron turnos',
                'status'=>404
            ];
            return response()->json($data, 404);
        }

        //Retornar lista de turnos
        return response()->json($turnos);
    }

    //Crear un nuevo turno
    public function postTurnos(Request $request)
    {
        //Validar los datos recibidos de la request
        $validator = Validator::make($request->all(), [
            'fecha'=>'required|date|date_format:d-m-Y',
            'idEmpleado'=> 'required|exists:empleados,id'
        ]);

        if($validator->fails())
        {
            $date = [
                'Message'=> 'Error 400',
                'Error'=> $validator->errors(),
                'Status'=>400
            ];
            return response()->json($date, 400);
        }

        //Recupero los datos de la tabla empleados que coincidan con el id entregado
        $empleado = Empleado::findOrFail($request->idEmpleado);
        $rutEmpleado = $empleado->rut;
        $nombreEmpleado = $empleado->nombre;
        $apellidoEmpleado = $empleado->apellido;

        //Creo el nuevo turno y le asigno los datos del empleado encontrado
        $turno = Turno::create([
            'fecha' => $request->fecha,
            'idEmpleado' => $request->idEmpleado,
            'rutEmpleado' => $rutEmpleado,
            'nombreEmpleado' => $nombreEmpleado,
            'apellidoEmpleado' => $apellidoEmpleado
        ]);

        //Si hay algun error devuelve status 500
        if(!$turno)
        {
            $data = [
                'message' => 'Error 500',
                'status' => 500
            ];
        }
        $data = [
            'turno' => $turno,
            'message' => 'Turno creado',
            'status' => 201
        ];

        //Retorna el turno creado y el status 201
        return response()->json($turno, 201);
    }

    
}
