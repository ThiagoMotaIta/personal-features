<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ProtocoloVirtual;
use App\Models\AttachDocuments;
use App\Models\TipoLicenca;
use App\Models\Documents;
use App\Models\User;
use Auth;
use DB;


class AttachDocumentController extends Controller
{

        public function show($id=null) {
            
            $user = Auth::user();
            $tmpArray = [];

            $editing = false;
            if (isset($_GET['editing'])) {
                $editing = true;
            }
        
            $protocoloVirtuais = ProtocoloVirtual::where('id',$id)->first();
            $attachDocuments = AttachDocuments::join('documents','attach_documents.documents_id','=','documents.id')->where('attach_documents.protocolo_id',$id)->get()->toArray();
            $documents = Documents::where('licenca_id',$protocoloVirtuais->tipo_licenca_id)->get()->toArray();
            // $historyProtocol = DB::table('historico_protocolo')->where("protocolo_id",$id)->get();

            // dd($historyProtocol);

            if (count($attachDocuments)) {     
                $documents = array_filter($documents, function ($item) use ($attachDocuments) {
                    return !in_array($item['id'], array_column($attachDocuments, 'documents_id'));
                });

                $protocoloVirtuais->documents =  array_merge($attachDocuments,$documents);  
            }
            else {
                $protocoloVirtuais->documents = Documents::where('licenca_id',$protocoloVirtuais->tipo_licenca_id)->get();
            } 

            for ($i=0; $i < count($protocoloVirtuais->documents); $i++) {          
                $tmpArray[$i] = $protocoloVirtuais->documents[$i];
                // $historyProtocol = DB::table('historico_protocolo')->where("document_id",$protocoloVirtuais->documents[$i]['id'])->where('approved_document',2)->where('protocolo_id',$id)->first();
                $historyProtocol = DB::table('relato_protocolo')->where("document_id",$protocoloVirtuais->documents[$i]['id'])->where('approved_document',2)->where('protocolo_id',$id)->first();
                if ($historyProtocol) {              
                    $tmpArray[$i]['mensagem'] = $historyProtocol->note_document; 
                    $tmpArray[$i]['repproved'] = true; 
                    // $protocoloVirtuais->documents[$i]->mensagem = $historyProtocol->note_document; 
                }
                if (@$protocoloVirtuais->documents[$i]->extension) {

                
                    if (strpos($protocoloVirtuais->documents[$i]->extension,'/')) {
                        $extension = explode('/',$protocoloVirtuais->documents[$i]->extension); 
                        $protocoloVirtuais->documents[$i]->extension = implode(' ,.',$extension);          
                    }
                }
                else {

                }
            }

            
            if (!empty($tmpArray)) {
                $protocoloVirtuais->documents = $tmpArray;
            }
            
            // dd($protocoloVirtuais);
            return view('attach-documents',["documents" => $protocoloVirtuais, "editing" => $editing]);
        }


        public function store(request $request,$id=null) {

            $dados = $request->all();
            $message = null;

            unset($dados['_token']);
            
        

            foreach ($dados as $key => $value) {
        
                // $fileName = basename($_FILES["$key"]["name"]);
                // $targetDir = "D:\\Dev\\BlockChain One\\htdocs\\licenciamento-caucaia1\\public\img\\";
                // $targetFilePath = $targetDir . $fileName;

                
                // move_uploaded_file($_FILES["$key"]["tmp_name"], $targetFilePath);
                $destinationPath = "public/documentos/$id/$key";         
                $imagem = $request->file("$key");
                // $imagem_urn = $imagem->putFileAs('documentos', 'public');
                // $imagem_urn = $imagem->putFileAs('documentos', 'public', "photo.pdf");
                // Storage::putFileAs('photos', 'app/public/documents', 'photo.jpg');
                // Storage::putFileAs("public/documentos/$id/$key", $imagem, $_FILES["$key"]["name"]);
                $imageName = $imagem->getClientOriginalName();
                // dd($destinationPath, $imageName);
                $path = $request->file("$key")->storeAs($destinationPath,$imageName);
            
                // Storage::public_path("public/documentos/$id/$key", $imagem, $_FILES["$key"]["name"]);
                // $path = Storage::putFile('photos', $imagem);
                // dd($path);

                $hasDocuments = DB::table('attach_documents')->where("protocolo_id",$id)->where('documents_id',$key)->first();

                if ($hasDocuments) {
                    DB::table('attach_documents')->where("protocolo_id",$id)->where('documents_id',$key)->update(["file" => $_FILES["$key"]["name"]]);

                }
                else {
                    DB::table('attach_documents')->insert(["protocolo_id" => $id, "documents_id" => $key, "file" => $_FILES["$key"]["name"]]);

                }     

                // $hasHistoryProtocol = DB::table('historico_protocolo')->where("protocolo_id",$id)->where('document_id',$key)->first();
                $hasHistoryProtocol = DB::table('relato_protocolo')->where("protocolo_id",$id)->where('document_id',$key)->first();
                
                if ($hasHistoryProtocol) {
                    // DB::table('historico_protocolo')->where('protocolo_id',$id)->where('document_id',$key)->delete();
                    DB::table('relato_protocolo')->where('protocolo_id',$id)->where('document_id',$key)->delete();
                }

            }

            
            ProtocoloVirtual::where('id',$id)->update(['status_protocolo_id' => 7]);
            ProtocoloVirtual::where('id',$id)->update(['status_id' => 2]);


            
            // unset($dados['_token']);
            // unset($dados['markall']);
            // dd($_FILES["1"]["name"]);
            // $fileName = basename($_FILES["1"]["name"]);
            // // $fileName = time().'_'.basename($_FILES["file"]["name"]);
            // $targetDir = "D:\\Dev\\BlockChain One\\htdocs\\licenciamento-caucaia1\\public\img\\";
            // // $fileName = basename($_FILES["file"]["name"]);
            // $targetFilePath = $targetDir . $fileName;

            // // $request->file->move(public_path('uploads'), $fileName);
            // move_uploaded_file($_FILES["1"]["tmp_name"], $targetFilePath);

            

            // // $fileName = time().'.'.$request->file->extension();  
    
            // // $request->file->move(public_path('uploads'), $fileName);

            // // dd($dados);


            // $pegaId = [];
            // $pegaResult = [];
            // if ($id == count($dados)) {
            //     for ($i=0; $i < count($dados) ; $i++) { 
            //         $pegaId[$i] = explode('-', $dados[$i]);
        
            //         if ($pegaId[$i][1] == 'true') {
            //             ProtocoloVirtual::where('id',$pegaId[$i][0])->update(['status_confirmacao_id' => 1]);
            //         }
            //         else {
            //             ProtocoloVirtual::where('id',$pegaId[$i][0])->update(['status_confirmacao_id' => 2]);
            //         }
        
            //     }            
            // }
            // else {
            //     $message = "Você não marcou todos os protocolos!";
            // }
        
            // $protocoloVirtuais = ProtocoloVirtual::where('status_confirmacao_id',0)->paginate(10);
            
            $protocoloVirtuais = ProtocoloVirtual::where('id',$id)->first();


            return redirect()->route('protocolo-virtual.index')->with("record_added", 'Documentos enviados!');

        }
   
   
}
