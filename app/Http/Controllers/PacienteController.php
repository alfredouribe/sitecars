<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\cliente_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente_usuario = cliente_usuario::select('*')->where("cliente_user_id", "=", Auth::user()->id)->get();
        return view("back.pacientes.index", compact('cliente_usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        //
    }

    public function paciente(Request $request){
        $idPaciente = $request->id;
        $paciente = Paciente::select('*')->where('id', '=', '1')->get();

        return view('back.pacientes.paciente', compact('paciente'));
    }

    public function carga_imagen_paciente(Request $request){
        $id = $request->id;

        $imageName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('images/pacientes'), $imageName);

        $paciente = Paciente::findOrFail($id);

        if($paciente->foto){
            $ruta_archivo = public_path('images/pacientes/' . $paciente->foto);
            if(file_exists($ruta_archivo)){
                unlink($ruta_archivo);
            }
        }

        $paciente->foto = $imageName;

        $paciente->save();

    	return response()->json(['success'=>'Se ha cargado la foto', 'foto' => $imageName]);
    }
}
