<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Subcategoria;

use Illuminate\Http\Request;

class NombreDelControlador extends Controller
{
    public function getAPIC(Request $req)
    {
        $todo = Categoria::find($req->id);
        return response()->json($todo);
    }

    public function listAPIC()
    {
        $todo = Categoria::all();
        return response()->json($todo);
    }
    public function getAPIS(Request $req)
    {
        $todo = Subcategoria::find($req->id);
        return response()->json($todo);
    }

    public function listAPIS()
    {
        $todo = Subcategoria::all();
        return response()->json($todo);
    }
}
