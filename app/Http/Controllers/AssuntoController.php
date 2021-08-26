<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{   
    protected $assunto;

    function __construct(Assunto $assunto)
    {   
        $this->assunto = $assunto;
    }

    public function getAssuntos($old = '')
    {   
        $assuntos = $this->assunto->all();
        $html = view('ouvidoria.partials.tipo_assunto')->with(compact('assuntos', 'old'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
}
