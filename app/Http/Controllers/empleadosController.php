<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class empleadosController extends Controller
{
    public function getEmpleados()
    {
        //Recuperar empleados
        $empleados = Empleado::all();

        //Validar si la tabla de empleados esta vacia
        if ($empleados->isEmpty())
        {
            $data = [
                'mesagge'=>'No se encontraron empleados',
                'status'=>404
            ];
            return response()->json($data, 404);
        }

        //Retornar lista de empleados
        return response()->json($empleados);
    }

    public function postEmpleados(Request $request)
    {
        //Validar los datos recibidos de la request
        $validator = Validator::make($request->all(), [
            'rut'=>'required|string|unique:empleados,rut',
            'nombre'=>'required|string',
            'apellido'=>'required|string' 
        ]);

        if($validator->fails())
        {
            $data = [
                'Error'=>'Error 400',
                'Message'=> $validator->errors(),
                'Status'=> 400
            ];
            //Si existe un error retornar el error y status 400
            return response()->json($data, 400);
        }

        //Crea el nuevo empleado
        $newEmpleado = Empleado::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido
        ]);

        //Retornar el nuevo empleado
        return response()->json($newEmpleado);
    }

    //Recuperar los empleados en turno de llamada
    public function onCall()
    {
        //Recupero todos los empleados
        $empleados = Empleado::all();
        $turnos = Turno::pluck('idEmpleado');
        $sinTurno = $empleados->whereNotIn('id', $turnos);
        $onCall = Empleado::whereNotIn('id', $turnos)->get();
    

        return $onCall;

    }




    public function getEmpleadosMes()
    {
        //Recuperar mes actual
        $mesActual = Carbon::now()->month;

        //Recuperar las fechas de los turnos
        $turnos = Turno::pluck('fecha');

        $fechasMes = [];

        //Recorrer el array de las fechas recuperadas
        foreach ($turnos as $fecha)
        {
            //Formatear las fechas
            $fechaFormat = Carbon::createFromFormat('d-m-Y', $fecha);
            
            //Validar si coinciden con el mes
            if ($fechaFormat->month == $mesActual) 
            {
                // Almacenar la fecha sin modificar
                $fechasMes[] = $fecha;
            }
        }

        //Recuperar turnos que contengan fechas
        $turnosMes = Turno::whereIn('fecha', $fechasMes)->get();

        //Recuperar ids de empleados que estan en turno
        $idEmpleados = $turnosMes->pluck('idEmpleado');

        //Recuperar empleados segun el id
        $empleadosMes = Empleado::whereIn('id', $idEmpleados)->get();

        return $empleadosMes;

    }
}
    
