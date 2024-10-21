<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function home()
    {
        echo 'pagina inicial';
    }
    public function generate_exercises(Request $request)
    {
        echo 'gerar exercicios';
    }
    public function print_exercises()
    {
        echo 'imprimir exercicios';
    }
    public function export_exercises()
    {
        echo 'exportar exercicios';
    }
}
