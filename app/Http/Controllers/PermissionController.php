<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DB;


class PermissionController extends Controller
{
    // public function index()
    // {         
    //     $profile = DB::table('profile')
    //                  ->select('profile.name','profile.permission','profile.id')                                 
    //                  ->get();
    //     // dd($profile);
    //     return view('permission',["profileData" => $profile]);
    // }


    public function getDadosUser($id=null) 
    {
        //Redireciona um novo usuário interno a atualizar a senha
        $default_password = substr(Auth::user()->cpf ,0,-6);
 
        $user = Auth::user();
        $profile = (Object) [
            "id"  => null,
            "name" => null,
           
        ];
        $permissionUser = null;
        $editing = false;
        // $aux = [(Object) [
        //     "path"  => null,
        //     "title" => null,
           
        // ]]; 
        if (isset($_GET['editing'])) {
            $editing = true;
        }
       
        if ($id) {

            $profile = DB::table('profile')
                         ->select('profile.name','profile.permission','profile.id')                     
                         ->where('id',$id)
                         ->first();

            $profile->permission = json_decode($profile->permission);

            if ($profile) {
                $permissionUser = $profile->permission;
            }
            $editing = true;
           

        }
        else if (!$editing) {
            $profile = DB::table('profile')
                         ->select('profile.name','profile.permission','profile.id')                                                    
                         ->get();
            for ($i=0; $i < count($profile) ; $i++) { 
                $profile[$i]->permission = json_decode($profile[$i]->permission);
            }

        }
       

        $permission = DB::table('permissions')
                        ->select('path','title')                          
                        ->get();


        $permissionGeral = $permission;
            
        
        for ($i=0; $i < count($permissionGeral); $i++) { 
            $aux[$i] = json_decode($permissionGeral[$i]->path);                    
        }

        // for ($i=0; $i < count($aux); $i++) { 
        //     $aux[$i]->path = json_decode($aux[$i]->path);                 
        // }

        //$permissionTitle = $aux;
    
        if ($permissionUser) {         
            // dd($permissionUser,$aux);
            $aux = array_filter($aux, function ($item) use ($permissionUser) {              
                return !in_array($item->tag, array_column($permissionUser, 'tag'));
            });      
            
            $permissionArray = array_merge($permissionUser,$aux);

        }
        else {
            $permissionArray = $aux;
        }

        // for ($i=0; $i < count($permissionArray) ; $i++) { 
   
        //     $permissionArray[$i]->title = $permissionTitle[$i]->title;                    
            
                           
        // }

        // for ($i=0; $i < count($permissionArray) ; $i++) { 

        // while ($permissionArray[$i]->tag != $permissionTitle[$i]->path->tag) {
        //     $permissionArray[$i]->title = $permissionTitle[$i]->title;                    

        // }
        // }

        // dd($permissionTitle);

    
      
        return view('permission',["user" => $user, "profileData" => $profile, "permissoes" => $permissionArray, "editing" => $editing]);
    }


    public function postPermission(request $request,$id=null) {
        $request->all();
        $dados = $request->all();
        $editing = false;

        $processo = (Object) [
            "tag" => 'processo', 
            "remove" => $dados['processo-remove'],
            "edit" => $dados['processo-edit'],
            "create" => $dados['processo-create'],
            "list" => $dados['processo-list'],
            "title" => 'Análise de Processos'
        ];

        $permissoes = (Object) [
            "tag"  => 'permissoes',
            "remove" => $dados['permissoes-remove'],
            "edit" => $dados['permissoes-edit'],
            "create" => $dados['permissoes-create'],
            "list" => $dados['permissoes-list'],
            "title" => 'Permissões'
        ];

    
        $usuarios = (Object) [
            "tag"  => 'usuarios',
            "remove" => $dados['usuarios-remove'],
            "edit" => $dados['usuarios-edit'],
            "create" => $dados['usuarios-create'],
            "list" => $dados['usuarios-list'],
            "title" => 'Usuários'
        ];
        // $licenciar = (Object) [
        //     "tag"  => 'Licenciar',
        //     "remove" => $dados['licenciar-remove'],
        //     "edit" => $dados['licenciar-edit'],
        //     "create" => $dados['licenciar-create'],
        //     "list" => $dados['licenciar-list']
        // ];

    
        $atendimento = (Object) [
            "tag" => 'atendimento', 
            "remove" => $dados['atendimento-remove'],
            "edit" => $dados['atendimento-edit'],
            "create" => $dados['atendimento-create'],
            "list" => $dados['atendimento-list'],
            "title" => 'Atend. Virtual'     
        ];


        $horario = (Object) [
            "tag"  => 'horario',
            "remove" => $dados['horario-remove'],
            "edit" => $dados['horario-edit'],
            "create" => $dados['horario-create'],
            "list" => $dados['horario-list'],
            "title" => 'Horários Atend. Virtual'
        ];


 
        $relatorios = (Object) [
            "tag" => 'relatorios', 
            "remove" => $dados['relatorios-remove'],
            "edit" => $dados['relatorios-edit'],
            "create" => $dados['relatorios-create'],
            "list" => $dados['relatorios-list'],
            "title" => 'Relatórios'
        ];

        $faleConosco = (Object) [
            "tag" => 'fale-conosco', 
            "remove" => $dados['fale-conosco-remove'],
            "edit" => $dados['fale-conosco-edit'],
            "create" => $dados['fale-conosco-create'],
            "list" => $dados['fale-conosco-list'],
            "title" => 'Fale Conosco'
        ];

        // $teste = (Object) [
        //     "tag"  => 'teste',
        //     "remove" => $dados['teste-remove'],
        //     "edit" => $dados['teste-edit'],
        //     "create" => $dados['teste-create'],
        //     "list" => $dados['teste-list']
        // ];

        $permissions = array(); 
        $permissions[] = $processo;
        $permissions[] = $permissoes;
        $permissions[] = $usuarios;
        $permissions[] = $atendimento;
        $permissions[] = $horario;
        $permissions[] = $relatorios;
        $permissions[] = $faleConosco;


        // dd( $dados,$permissions);
        if ($id) {
            DB::table("profile")->where("profile.id",$id)->update(['name' => $dados['name'] ,'permission' => json_encode($permissions)]);
        }
        else {
            DB::table("profile")->insert(['name' => $dados['name'] ,'permission' => json_encode($permissions)]);
        }

        $profile = DB::table('profile')
                     ->select('profile.name','profile.permission','profile.id')                                 
                     ->get();

        // return $this->getDadosUser($id);

        for ($i=0; $i < count($profile) ; $i++) { 
            $profile[$i]->permission = json_decode($profile[$i]->permission);
        }
        
        if ($id) {
            return redirect()->route('getDadosUser')->with("record_added", 'Perfil com id #' . $id .  ' alterado!');
        } 
        else {
            return redirect()->route('getDadosUser')->with("record_added", 'Perfil cadastrado!');
        }

    }

    public function deletePermission($id) {
        $editing = false;
        DB::table('profile')->where('id',$id)->delete();

        $profile = DB::table('profile')
                     ->select('profile.name','profile.permission','profile.id')                                 
                     ->get();
    

        for ($i=0; $i < count($profile) ; $i++) { 
            $profile[$i]->permission = json_decode($profile[$i]->permission);
        }

        return redirect()->route('getDadosUser')->with("record_added", 'Perfil com id #' . $id . ' removido!');
    }
   
}
