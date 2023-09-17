<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /** API Resources es una forma de controlar las respuestas de tipo JSON */
    public function index() {
        /** 1ra forma */
        // return response()->json(['categorias' => Categoria::all()]);

        /** 2da forma */
        // CategoriaCollection retorna la respuesta en tipo JSON (en vez de colocar response()->json(), etc. Y el archivo de CategoriaCollection usualmente no lo vamos a utilizar, sino dejarlo así por defecto.)
        return new CategoriaCollection(Categoria::all());
    }
}
