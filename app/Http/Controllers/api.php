<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\cliente_usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Models\Paciente;
use App\Models\PacienteDatoGeneral;
use App\Models\AntecedentePatologicoHeredoFamiliar;
use App\Models\AntecedentePatologicoPersonal;
use App\Models\AntecedentePersonalNoPatologico;
use App\Models\Tratamiento;
use App\Models\CitasPaciente;
use App\Models\odontograma;
use App\Models\endodoncia;
use App\Models\suscripciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class api extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function get_clientes(Request $request){
        try {
            $clientes = Cliente::with('suscripciones')->get();

            return response()->json([
                'code' => 200,
                'clientes' => $clientes
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function save_cliente(Request $request){
        try {
            DB::beginTransaction();
            if($request->id == ''){
                $cliente = new Cliente();
    
                $cliente->nombre = $request->nombre;
                $cliente->segundoNombre = $request->segundoNombre;
                $cliente->apellidoPaterno = $request->apellidoPaterno;
                $cliente->apellidoMaterno = $request->apellidoMaterno;
                $cliente->telefono = $request->telefono;
                $cliente->email = $request->email;
        
                $cliente->save();

                // Crear suscripción por default (1 mes, por ejemplo)
                $suscripcion = new suscripciones();
                $suscripcion->cliente_id = $cliente->id;
                $suscripcion->fecha_inicio = now();
                $suscripcion->fecha_fin = now()->addMonth();
                $suscripcion->paquete = 'basico';
                $suscripcion->estado = 'activa';
                $suscripcion->save();

                DB::commit();

                return response()->json([
                    'code' => 200,
                    'message' => 'Cliente creado exitosamente.',
                    'data' => $cliente
                ], 200);
            }else{
                $dataUpdate = request()->except(['_token', '_method']);
    
                Cliente::where('id', '=', $request->id)->update($dataUpdate);

                // Desactivar suscripciones activas del cliente
                suscripciones::where('cliente_id', $request->id)
                ->where('estado', 'activa')
                ->update(['estado' => 'suspendida']);

                DB::commit();

                return response()->json([
                    'code' => 200,
                    'message' => 'Cliente actualizado exitosamente.',
                    'data' => $dataUpdate
                ], 200);
            }

            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'message' => 'Ocurrió un error al guardar el cliente.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function cambiar_status_cliente(Request $request){
        try {
            $id = $request->id;
            $status = $request->status;
    
            $cliente = Cliente::findOrFail($id);
    
            $cliente->activo=$status;
            $cliente->save();
    
            return response()->json([
                'code' => 200,
                'message' => 'Cliente actualizado exitosamente.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'Ocurrio un error al actualizar el cliente.',
                'error' => $th->getMessage()
            ], 500);
        }
       
    }

    public function get_cliente(Request $request){
        $id = $request->id;

        $cliente = Cliente::findOrFail($id);

        return $cliente;
    }

    public function get_usuarios_cliente(Request $request){
        $id = $request->id;

        $usuarios_clientes = cliente_usuario::where("cliente_id" , "=", $id)
        ->join('users', 'users.id' , '=', 'cliente_usuarios.cliente_user_id')
        ->select('users.*', 'cliente_usuarios.activo')
        ->get();

        return $usuarios_clientes;
    }

    public function save_usuario_cliente(Request $request){
        try{
            $user = User::create([
                'name' => $request->nombres,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol' => 'cliente'
            ]);
    
            $data = User::latest()->first()->id;
    
            $usuario_cliente = new cliente_usuario;
            $usuario_cliente->user_id = $request->idUsuario;
            $usuario_cliente->cliente_id = $request->idCliente;
            $usuario_cliente->cliente_user_id = $data;
            $usuario_cliente->save();

            return response()->json(['user' => $user]);
        }catch (QueryException $ex) {
            if ($ex->errorInfo[1] == 1062) {
                return response()->json(['error' => 'El correo electrónico ya está registrado'], 409);
            } else {
                // En caso contrario, lanza la excepción para que se maneje en otra parte del código
                throw $ex;
            }
        }
    }

    public function cambia_status_usuario_cliente(Request $request){
        $id = $request->id;
        $activo = $request->status;

        $cliente = cliente_usuario::where('cliente_user_id', '=', $id)->first();

        $cliente->activo=$activo;
        $cliente->save();
    }

    public function get_pacientes(Request $request){
        $id = $request->id;

        $pacientes = Paciente::where('cliente_id', '=', $id)->get();

        return $pacientes;
    }

    public function save_paciente(Request $request){

        $paciente = new Paciente;

        $paciente->nombre = $request->nombre;
        $paciente->segundo_nombre = $request->segundo_nombre ? $request->segundo_nombre : '';
        $paciente->paterno = $request->paterno;
        $paciente->materno = $request->materno ? $request->materno : '';
        $paciente->telefono = $request->telefono;
        $paciente->email = $request->email;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->cliente_id = $request->cliente_id;
        $paciente->user_id = $request->user_id;
        $paciente->sexo = $request->sexo;
        $paciente->foto = "";

        $paciente->save();
    }

    public function get_info_paciente(Request $request){
        $id = $request->id;

        $paciente = Paciente::findOrFail($id);

        return $paciente;
    }

    public function get_paciente_info_general(Request $request){
        $idPaciente = $request->idPaciente;
        $idUsuario = $request->idUsuario;

        $paciente = PacienteDatoGeneral::select('*')->where('paciente_id', '=', $idPaciente)->get();
        //si no tiene el registro entonces lo genera
        if(!count($paciente)){
            $paciente = new PacienteDatoGeneral;
            $paciente->direccion = '';
            $paciente->ocupacion = '';
            $paciente->escolaridad = '';
            $paciente->estado_civil = '';
            $paciente->lugar_nacimiento = '';
            $paciente->religion = '';
            $paciente->tutor = '';
            $paciente->motivo_consulta = '';
            $paciente->paciente_id = $idPaciente;
            $paciente->user_id = $idUsuario;

            $paciente->save();

            $paciente = PacienteDatoGeneral::select('*')->where('paciente_id', '=', $idPaciente)->get();

        }

        return $paciente[0];
    }

    public function update_paciente(Request $request){
        $paciente = request()->except(['_token', '_method']);
        $paciente['segundo_nombre'] = $paciente['segundo_nombre'] ? $paciente['segundo_nombre'] : '';
        $paciente['materno'] = $paciente['materno'] ? $paciente['materno'] : '';
        Paciente::where('id', '=', $request->id)->update($paciente);

    }

    public function save_info_general_paciente(Request $request){
        $info_general = request()->except(['_token', '_method']);
        $info_general['tutor'] = $info_general['tutor'] ? $info_general['tutor'] : '';
        PacienteDatoGeneral::where('id', '=', $request->id)->update($info_general);
    }

    public function get_antecedente_patologico_heredofamiliares(Request $request){
        $idPaciente = $request->idPaciente;
        $idUsuario = $request->idUsuario;

        $paciente = AntecedentePatologicoHeredoFamiliar::select('*')->where('paciente_id', '=', $idPaciente)->get();
        //si no tiene el registro entonces lo genera
        if(!count($paciente)){
            $paciente = new AntecedentePatologicoHeredoFamiliar;

            $paciente->paciente_id = $idPaciente;
            $paciente->user_id = $idUsuario;
            $paciente->diabetes = null;
            $paciente->diabetes_familiar = null;
            $paciente->hipertension = null;
            $paciente->hipertension_familiar = null;
            $paciente->cardiopatias = null;
            $paciente->cardiopatias_familiar = null;
            $paciente->cancer = null;
            $paciente->cancer_familiar = null;
            $paciente->asma = null;
            $paciente->asma_familiar = null;
            $paciente->renal = null;
            $paciente->renal_familiar = null;
            $paciente->hemofilia = null;
            $paciente->hemofilia_familiar = null;
            $paciente->hipotension = null;
            $paciente->hipotension_familiar = null;
            $paciente->convulsiones = null;
            $paciente->convulsiones_familiar = null;
            $paciente->vih = null;
            $paciente->vih_familiar = null;
            $paciente->anemia = null;
            $paciente->anemia_familiar = null;
            $paciente->neoplasias = null;
            $paciente->neoplasias_familiar = null;
            $paciente->observaciones = null;

            $paciente->save();

            $paciente = AntecedentePatologicoHeredoFamiliar::select('*')->where('paciente_id', '=', $idPaciente)->get();

        }

        return $paciente[0];
    }

    public function save_heredofamiliar(Request $request){
        $info = request()->except(['_token', '_method']);
        AntecedentePatologicoHeredoFamiliar::where('id', '=', $request->id)->update($info);
    }

    public function get_antecedente_patologico_personales(Request $request){
        $idPaciente = $request->idPaciente;
        $idUsuario = $request->idUsuario;

        $paciente = AntecedentePatologicoPersonal::select('*')->where('paciente_id', '=', $idPaciente)->get();
        //si no tiene el registro entonces lo genera
        if(!count($paciente)){
            $paciente = new AntecedentePatologicoPersonal;

            $paciente->paciente_id = $idPaciente;
            $paciente->user_id = $idUsuario;
            $paciente->diabetes = null;
            $paciente->hipertension = null;
            $paciente->hipotension = null;
            $paciente->cardiopatias = null;
            $paciente->cancer = null;
            $paciente->hemofilia = null;
            $paciente->hepatitis = null;
            $paciente->amigdalitis = null;
            $paciente->vih = null;
            $paciente->convulsiones = null;
            $paciente->asma = null;
            $paciente->anemia = null;
            $paciente->tosferina = null;
            $paciente->artritis = null;
            $paciente->varicela = null;
            $paciente->rubeola = null;
            $paciente->sarampion = null;
            $paciente->fiebre = null;
            $paciente->tuberculosis = null;
            $paciente->observaciones = null;

            $paciente->save();

            $paciente = AntecedentePatologicoPersonal::select('*')->where('paciente_id', '=', $idPaciente)->get();

        }

        return $paciente[0];
    }

    public function save_personal(Request $request){
        $info = request()->except(['_token', '_method']);
        AntecedentePatologicoPersonal::where('id', '=', $request->id)->update($info);
    }

    public function get_antecedente_personal_no_patologico(Request $request){
        $idPaciente = $request->idPaciente;
        $idUsuario = $request->idUsuario;

        $paciente = AntecedentePersonalNoPatologico::select('*')->where('paciente_id', '=', $idPaciente)->get();
        //si no tiene el registro entonces lo genera
        if(!count($paciente)){
            $paciente = new AntecedentePersonalNoPatologico;

            $paciente->paciente_id = $idPaciente;
            $paciente->user_id = $idUsuario;
            $paciente->frecuencia_cepillado = null;
            $paciente->hilo_dental = null;
            $paciente->medicamento = null;
            $paciente->medicamento_descripcion = null;
            $paciente->tratamiento_medico = null;
            $paciente->operacion = null;
            $paciente->operacion_descripcion = null;
            $paciente->transferencia_sangre = null;
            $paciente->consumo_drogas = null;
            $paciente->tabaquismo = null;
            $paciente->alcoholismo = null;
            $paciente->tatuajes = null;
            $paciente->embarazo = null;
            $paciente->embarazo_meses = null;
            $paciente->alergias = null;
            $paciente->alergias_descripcion = null;
            $paciente->vacunas = null;
            $paciente->vacunas_faltantes = null;
            $paciente->alergias_anestesico = null;

            $paciente->save();

            $paciente = AntecedentePersonalNoPatologico::select('*')->where('paciente_id', '=', $idPaciente)->get();

        }

        return $paciente[0];
    }

    public function save_personal_no_patologico(Request $request){
        $info = request()->except(['_token', '_method']);
        AntecedentePersonalNoPatologico::where('id', '=', $request->id)->update($info);
    }

    public function get_tratamientos(Request $request){
        $id = $request->id;

        $tratamientos = Tratamiento::where("tratamientos.paciente_id" , "=", $id)
        ->join('users', "tratamientos.user_id", "=", "users.id")
        ->select('tratamientos.*', 'users.name')
        ->get();

        return $tratamientos;
    }
    
    public function save_tratamiento(Request $request){
        $tratamientoM = new Tratamiento;

        $tratamientoM->fecha = $request->fecha;
        $tratamientoM->tratamiento = $request->tratamiento;
        $tratamientoM->costo = $request->costo;
        $tratamientoM->abono = $request->abono;
        $tratamientoM->pago = $request->pago;
        $tratamientoM->firma = "";
        $tratamientoM->paciente_id = $request->idPaciente;
        $tratamientoM->user_id = $request->idUsuario;

        $tratamientoM->save();

    }

    public function actualiza_firma(Request $request){
        $id = $request->id_tratamiento;
        $firma = $request->firma;

        Tratamiento::where('id', $id)->update(['firma' => $firma]);
    }

    public function genera_cita(Request $request){
        $cita = new CitasPaciente;
        $cita->paciente_id = $request->paciente_id;
        $cita->user_id = $request->user_id;
        $cita->fecha = $request->fecha;
        $cita->motivo = $request->motivo;
        $cita->cliente_id = $request->cliente_id;

        $cita->save();
    }

    public function consulta_citas(Request $request){
        $paciente_id = $request->paciente_id;

        $citas = CitasPaciente::where("paciente_id", "=", "$paciente_id")->orderBy('fecha')->get();

        $result = [];
        $i = 0;
        foreach ($citas as $cita) {
            switch($cita->estatus){
                case "GENERADA":
                    $class="bg-primary text-white";
                break;

                case "CONCRETADA":
                    $class="bg-success text-white";
                break;

                case "CANCELADA":
                    $class="bg-danger text-white";
                break;

                case "POSPUESTA":
                    $class="bg-warning";
                break;

                default:
                    $class="bg-info";
                break;
            }

            $item = [
                'key' => $i,
                'customData' => [
                    'title' => date("h:i A", strtotime($cita->fecha)) . " " . $cita->motivo,
                    'class' => $class,
                    'id' => $cita->id,
                    'fecha' => date("Y-m-d H:i:00", strtotime($cita->fecha)),
                    'motivo' => $cita->motivo,
                    "estatus" => $cita->estatus
                ],
                'dates' => $cita->fecha,
            ];

            array_push($result, $item);
            $i++;
        }

        return $result;
    }

    public function guarda_odontograma(Request $request){
        $match_these = [
            'diente' => $request->diente, 
            'cuadrante' => $request->cuadrante,
            'paciente_id' => $request->paciente_id
        ];

        $odontograma_existe = odontograma::where($match_these)->get();

        if(!$odontograma_existe->count()){
            $odontograma = new odontograma;
        
            $odontograma->cuadrante = $request->cuadrante;
            $odontograma->diente = $request->diente;
            $odontograma->paciente_id = $request->paciente_id;
            $odontograma->user_id = $request->user_id;

            $odontograma->save();
            
            $result["status"] = "success";
            $result["msg"] = "";
        }else{
            $result["status"] = "error";
            $result["msg"] = "El diente $request->diente en el cuadrante $request->cuadrante ya existe";
        }
        
        echo json_encode($result);
    }

    public function get_odontograma(Request $request){
        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 1
        ];

        $odontograma_1 = odontograma::where($match_these)->orderByDesc('diente')->get();

        $odontograma_general['odontograma_1'] = $odontograma_1;

        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 4
        ];

        $odontograma_4 = odontograma::where($match_these)->orderByDesc('diente')->get();

        $odontograma_general['odontograma_4'] = $odontograma_4;

        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 2
        ];

        $odontograma_2 = odontograma::where($match_these)->orderBy('diente')->get();

        $odontograma_general['odontograma_2'] = $odontograma_2;

        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 3
        ];

        $odontograma_3 = odontograma::where($match_these)->orderBy('diente')->get();

        $odontograma_general['odontograma_3'] = $odontograma_3;


        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 5
        ];

        $odontograma_5 = odontograma::where($match_these)->orderByDesc('diente')->get();

        $odontograma_general['odontograma_5'] = $odontograma_5;

        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 8
        ];

        $odontograma_8 = odontograma::where($match_these)->orderByDesc('diente')->get();

        $odontograma_general['odontograma_8'] = $odontograma_8;

        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 6
        ];

        $odontograma_6 = odontograma::where($match_these)->orderBy('diente')->get();

        $odontograma_general['odontograma_6'] = $odontograma_6;

        $match_these = [
            "paciente_id" => $request->paciente_id,
            "cuadrante" => 7
        ];

        $odontograma_7 = odontograma::where($match_these)->orderBy('diente')->get();

        $odontograma_general['odontograma_7'] = $odontograma_7;

        return $odontograma_general;
    }

    public function cambia_color(Request $request){
        $id = $request->id;
        $num = $request->num;
        $color = $request->color;

        if($color != 'NULL')
            odontograma::where('id', $id)->update(['codigo_'.$num => $color]);
        else
            odontograma::where('id', $id)->update(['codigo_'.$num => null]);
    }

    public function save_endodoncia(Request $request){
        $endodoncia = new endodoncia;

        $endodoncia->conducto = $request->conducto;
        $endodoncia->mm = $request->mm;
        $endodoncia->referencia = $request->referencia;
        $endodoncia->fo = $request->fo;
        $endodoncia->gates = $request->gates;
        $endodoncia->retroceso = $request->retroceso;
        $endodoncia->paciente_id = $request->idPaciente;
        $endodoncia->user_id = $request->idUsuario;
        $endodoncia->lima_maestra = $request->lima_maestra;

        $endodoncia->save();
    }

    public function get_endodoncias(Request $request){
        $id = $request->id;

        $tratamientos = endodoncia::where("endodoncias.paciente_id" , "=", $id)
        ->join('users', "endodoncias.user_id", "=", "users.id")
        ->select('endodoncias.*', 'users.name')
        ->get();

        return $tratamientos;
    }

    public function eliminar_endodoncia(Request $request){
        $id = $request->id;

        endodoncia::destroy($id);
    }

    public function actualiza_cita(Request $request){
        

        $cita = request()->except(['_token', '_method']);

        CitasPaciente::where('id', '=', $request->id)->update($cita);
    }

    public function consulta_citas_general(Request $request){
        $cliente_id = $request->cliente_id;

        $citas = CitasPaciente::join('pacientes', 'citas_pacientes.paciente_id', '=', 'pacientes.id')
        ->orderBy('citas_pacientes.fecha')
        ->select('citas_pacientes.*', 
            DB::raw("CONCAT_WS(' ', pacientes.nombre, pacientes.segundo_nombre, pacientes.paterno, pacientes.materno) as nombre_completo")
        )
        ->where('citas_pacientes.cliente_id', '=', $cliente_id)
        ->get();

        $result = [];
        $i = 0;
        foreach ($citas as $cita) {
            switch($cita->estatus){
                case "GENERADA":
                    $class="bg-primary text-white";
                break;

                case "CONCRETADA":
                    $class="bg-success text-white";
                break;

                case "CANCELADA":
                    $class="bg-danger text-white";
                break;

                case "POSPUESTA":
                    $class="bg-warning";
                break;

                default:
                    $class="bg-info";
                break;
            }

            $item = [
                'key' => $i,
                'customData' => [
                    'title' => date("h:i A", strtotime($cita->fecha)) . " " . $cita->motivo,
                    'class' => $class,
                    'id' => $cita->id,
                    'fecha' => date("Y-m-d H:i:00", strtotime($cita->fecha)),
                    'motivo' => $cita->motivo,
                    "estatus" => $cita->estatus,
                    'nombre_completo' => $cita->nombre_completo
                ],
                'dates' => $cita->fecha,
            ];

            array_push($result, $item);
            $i++;
        }

        return $result;
    }
}
