<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
   


    
    public  function regitrousuario(Request $request){
       


            $validacion=\Validator::make($request->all(),[

                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',

            ]);

            if($validacion->fails()){
                $data=array(
                    'status'=>'error',
                    'code'=>404,
                    'message'=>'El usuario no se ha creado',
                    'errors'=>'required',


                );
            }

            else{

                
                $pwd=hash('sha256',$request->password);

                $usuario=new User();
                $usuario->name=$request->name;
                $usuario->email=$request->email;
                $usuario->password=$pwd;
            
                $usuario->save();

                $data=array(
                    'status'=>'success',
                    'code'=>200,
                    'message'=>'El usuario  ha creado con satisfación',
                    
                );
              
            }


    
        
    
            return response()->json($data);


    }

    public function login(Request $request){

        $jwtAuth=new \JwtAuth();

        $json=$request->input('json',null);
        // dd($json);
        $parametro=json_decode($json);
        // dd($parametro);
        $parametro_array=json_decode($json,true);

        // dd($parametro_array);

        $validacion=\Validator::make($parametro_array,[
            
            'email'=>'required|email',
            'password'=>'required',

        ]);

        // dd($validacion);

        if($validacion->fails()){

            $signup=array(
                'status'=>'error',
                'code'=>404,
                'message'=>'El usuario no sea podido autenticar',
                'errors'=>$validacion->errors()
            );


        }
        else{

            // $pwd=password_hash($parametro->password,PASSWORD_BCRYPT,['cost'=>4]);
            $pwd=hash('sha256',$parametro->password);

            $sigup= $jwtAuth->sigup($parametro->email,$pwd);


          if(!empty($parametro->gettoken)){

            $sigup= $jwtAuth->sigup($parametro->email,$pwd,true);


          }

           
        }



        return response()->json($sigup,200);
        // return $jwtAuth->sigup($email,$pwd);
        // return "login";


    }


}
