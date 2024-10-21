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

        // checkbox validation if they are all null
        if (!$request->hasAny(['check_sum', 'check_subtraction', 'check_multiplication', 'check_division'])) {
            return back()->withErrors('error')->withInput();
        }

        // form validations
        $request->validate([

            // validation portion minimum maximum
            'number_one'=>'required|integer|min:0|max:999',
            'number_two'=>'required|integer|min:0|max:999',

            // validation number exercises
            'number_exercises'=>'required|integer|min:5|max:50'
        ]);
        dd($request->all());
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
