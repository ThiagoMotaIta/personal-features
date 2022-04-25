<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Oportunity;

class ApiController extends Controller
{
    public function getAllUsers() {

        $users = User::get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);

    }


    public function getAllClients() {

        $users = User::where('type','C')->get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);

    }

    public function getAllSailers() {

        $users = User::where('type','V')->get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);

    }


    public function getAllProducts() {

        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);

    }


    public function newProduct(Request $request) {

        // Can not add same product
        $productInDb = Product::where('product',$request->product)->first();

        if ($productInDb == NULL){
            $product = new Product;
            $product->product = $request->product;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->save();

            return response()->json([
                "message" => "Produdo Cadastrado com Sucesso!"
            ], 201);
        } else {
            return response()->json([
                "message" => "Jã existe um produto com este nome!"
            ], 201);
        }

    }


    public function deleteProduct($id){
        if(Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
              "message" => "Produto deletado com sucesso!"
            ], 202);
          } else {
            return response()->json([
              "message" => "Produto não encontrado"
            ], 404);
          }
    }


    public function getAllOportunities() {

        $oportunities = Oportunity::get();

        if ($oportunities->count() > 0){

            foreach ($oportunities as $op){
                $client = User::where('id',$op->id_client)->first();
                $sailer = User::where('id',$op->id_sailer)->first();
                $product = Product::where('id',$op->id_product)->first();

                if ($op->status == 'A'){
                    $status = 'Aprovada';
                }
                if ($op->status == 'V'){
                    $status = 'Vencida';
                }
                if ($op->status == 'P'){
                    $status = 'Perdida';
                }
                if ($op->status == 'R'){
                    $status = 'Reprovada';
                }

                $array[] = ['id'=>$op->id, 'status'=>$status, 'cliente'=>$client->name, 'produto'=>$product->product, 'vendedor'=>$sailer->name];

            }

            return $array;

        } else {
            $oportunitiesNull = Oportunity::get()->toJson(JSON_PRETTY_PRINT);
            return response($oportunitiesNull, 200);
        }


    }


    public function newOportunity(Request $request) {

        $client = User::where('id',$request->client)->first();
        $sailer = User::where('id',$request->sailer)->first();
        $product = Product::where('id',$request->product)->first();

        $oportunity = new Oportunity;
        $oportunity->status = 'A';
        $oportunity->id_product = $product->id;
        $oportunity->id_client = $client->id;
        $oportunity->id_sailer = $sailer->id;
        $oportunity->save();

        return response()->json([
            "message" => "Oportunidade Cadastrada com Sucesso!"
        ], 201);

    }


    public function deleteOportunity($id){
        if(Oportunity::where('id', $id)->exists()) {
            $oportunity = Oportunity::find($id);
            $oportunity->delete();

            return response()->json([
              "message" => "Oportunidade deletada com sucesso!"
            ], 202);
          } else {
            return response()->json([
              "message" => "Oportunidade não encontrado"
            ], 404);
          }
    }



    public function updateOportunity(Request $request, $id) {
        if (Oportunity::where('id', $id)->exists()) {
            $oportunity = Oportunity::find($id);
            $oportunity->status = is_null($request->status) ? $oportunity->status : $request->status;
            $oportunity->save();

            return response()->json([
                "message" => "Oportunidade Atualizada com Sucesso!"
            ], 200);
        } else {
            return response()->json([
                "message" => "Oportunidade não encontrada."
            ], 404);

        }
    }

}
