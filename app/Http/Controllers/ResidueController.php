<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residue;

class ResidueController extends Controller
{
    
    // List All Residues
    public function getAllResidues() {

        $residues = Residue::get()->toJson(JSON_PRETTY_PRINT);
        return response($residues, 200);

    }


    // Insert from Excel/CSV file
    public function newResidue(Request $request) {

        $file = $request->file('file'); // From JSON Request data

        // Start reading each line from excel/CSV
        $posicao = 0;
        while (!feof($file)) {
            $linha = fgets($file,256);
            $posicao++;

            // Reading each data from 1 line and saving it
            $linha = explode(";", $linha);

            $residue = new Residue;
            $residue->common_name = $linha[1];
            $residue->type = $linha[2];
            $residue->category = $linha[3];
            $residue->treatment_technology = $linha[4];
            $residue->class = $linha[5];
            $residue->measurement_unit = $linha[6];
            $residue->weight = $linha[7];
            $residue->save();
        }

        return response()->json([
            "message" => "Resíduos Cadastrados com Sucesso!"
        ], 200);

    }


    // Delete residue by ID
    public function deleteResidue($id){
        if(Residue::where('id', $id)->exists()) {
            $residue = Residue::find($id);
            $residue->delete();

            return response()->json([
              "message" => "Resíduo deletado com sucesso!"
            ], 200);
          } else {
            return response()->json([
              "message" => "Resíduo não encontrado."
            ], 404);
          }
    }


    // Update residue by ID
    public function updateResidue(Request $request, $id) {
        if (Residue::where('id', $id)->exists()) {
            $residue = Residue::find($id);

            // Check fields for update (if not null)
            $residue->common_name = is_null($request->common_name) ? $residue->common_name : $request->common_name;
            $residue->type = is_null($request->type) ? $residue->type : $request->type;
            $residue->category = is_null($request->category) ? $residue->category : $request->category;
            $residue->treatment_technology = is_null($request->treatment_technology) ? $residue->treatment_technology : $request->treatment_technology;
            $residue->class = is_null($request->class) ? $residue->class : $request->class;
            $residue->measurement_unit = is_null($request->measurement_unit) ? $residue->measurement_unit : $request->measurement_unit;
            $residue->weight = is_null($request->weight) ? $residue->weight : $request->weight;
            $residue->save();

            return response()->json([
                "message" => "Resíduo Atualizado com Sucesso!"
            ], 200);
        } else {
            return response()->json([
                "message" => "Resíduo não encontrado."
            ], 404);

        }
    }
}
