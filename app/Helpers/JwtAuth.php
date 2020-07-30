<?php


namespace App\Helpers;

use Firebase\JWT\JWT;
use  Illuminate\Support\Facades\DB;
use App\User;

class JwtAuth{

    public $key;

    public function __construct (){
        $this->key='Contraseña_secreta_950125';

    }

    public function sigup($email, $password, $getToken=null){

        $usuario=User::where([
            'email'=>$email,
            'password'=>$password
        ])->first();

        // dd($usuario);

        $sigup=false;

        if(is_object($usuario)){
            $sigup=true;
        }

        if($sigup){

            $token=array(
                'sub'=>$usuario->id,
                'email'=>$usuario->email,
                'name'=>$usuario->name,
                'iat'=>time(),
                'exp'=>time()+(7*24*60*60)
            );

            // dd($this->key);
            $jwt=JWT::encode($token,$this->key,'HS256');
            $jwtdecode=JWT::decode($jwt,$this->key,['HS256']);

                if(is_null($getToken)){
                    $data= $jwt;
                }
                else{

                    $data=$jwtdecode;
                }

        }else{

            $data=array(
                'status'=>'error',
                'message'=>'Login Incorrecto'
            );
            

        }
        return $data;

    }

    public function checkToken($jwt,$geIdentity=false){
        $auth=false;
        try{
         $jwt=str_replace('"','',$jwt);
        $decode=JWT::decode($jwt,$this->key,['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth=false;
        }catch(\DomainException $e){
            $auth=false;
        }

        if(!empty($decode)&& is_object($decode)&& isset($decode->sub)){
            $auth=true;
        }else{
            $auth=false;
        }

        if($geIdentity){
            return $decode;
        }

        return $auth;


    }



}

