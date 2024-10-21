<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function home(): View
    {
       return view('home');
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
