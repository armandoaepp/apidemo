<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


use App\Marca;

class MarcaController extends Controller
{


	public function __construct(JWTAuth $auth)
    {
        $this->middleware('jwt.auth');
    }

	public function getMarca()
	{
        // $user = \Auth::user();
        // $per_id_padre = $user->per_id_padre ;

        $data = Marca::where('estado', 1)
                    // ->where('per_id_padre',$per_id_padre)
                    ->get() ;


        return \Response::json([
							'message'  => 'Operación Correcta',
							'error' => false,
							'errors' => '' ,
							'data'   => $data,
	                    ]);
	}

	public function save(Request $request)
    {

        $user = \Auth::user();
        // $per_id_padre = $user->per_id_padre ;

		$descripcion = $request->input('descripcion') ;
		$glosa       = $request->input('glosa') ;

        $rules = [
                'descripcion'      => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(),  $rules);

            if ($validator->fails())
            {
                $errors = (array)$validator->errors()->toArray();

                return \Response::json([
                    'message'  => 'Operación Fallida',
                    'error' => true,
                    'errors' => $errors ,
                    'data'   => "",
                ]);
            }

            $marca = Marca::where(['descripcion' => $descripcion])->first();

            if (!$marca)
            {
                $marca               = new Marca() ;
                // $marca->per_id_padre = $per_id_padre ;
                $marca->descripcion  = $descripcion ;
                $marca->glosa        = $glosa ;
                $marca->save() ;
            }
            else
            {
                $marca->estado = 1 ;
                $marca->save() ;
            }

            return \Response::json([
                            'message'  => 'Operación Correcta',
                            'error' => false,
							'errors' => '' ,
							'data'   => "OK",
	                    ]);

        } catch (Exception $e)
        {
            // \Log::info('Error creating user: '.$e);
            return \Response::json([
	            				'message'  => 'Operación Exception',
								'error' => true,
								'errors' => array('message'=> $e->getMessage()) ,
								'data'   => "OK",
							], 500);
        }
    }

    public function update(Request $request)
    {

        $id          = $request->input('id') ;
        $descripcion = $request->input('descripcion') ;
        $glosa       = $request->input('glosa') ;

        $marca = Marca::find($id) ;

        $marca->descripcion = $descripcion ;
        $marca->glosa  = $glosa ;
        $marca->save();

        $data =  Marca::find($id) ;

        return response()->json([
                    'message'  => 'Operación Correcta',
                    'error' => false,
                    'errors' => '' ,
                    'data'  => $data,
                ]);
    }

    public function updateEstado(Request $request)
    {

        $id     = $request->input('id') ;
        $estado = $request->input('estado') ;

        $marca =  Marca::find($id) ;
        $marca->estado = $estado ;
        $marca->save() ;

        return response()->json([
                    'message'  => 'Operación Correcta',
                    'error' => false,
                    'errors' => '' ,
                    'data'  => $estado,
                ]);
    }

}
