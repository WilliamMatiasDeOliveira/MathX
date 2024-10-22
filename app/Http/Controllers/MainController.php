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
            return back()->withErrors('fail')->withInput();
        }

        // form validations
        $request->validate(
            // rules
            [
                // validation portion minimum maximum
                'number_one' => 'required|integer|min:0|max:999|lte:number_two',
                'number_two' => 'required|integer|min:0|max:999',

                // validation number exercises
                'number_exercises' => 'required|integer|min:5|max:50'
            ],
            // messages
            [
                'number_one.lte' => 'O minimo não pode ser maior que o maximo'
            ]

        );

        // get checked operation
        $operations = [];

        if ($request->check_sum) {
            $operations[] = 'sum';
        }
        if ($request->check_subtraction) {
            $operations[] = 'subtraction';
        }
        if ($request->check_multiplication) {
            $operations[] = 'multiplication';
        }
        if ($request->check_division) {
            $operations[] = 'division';
        }

        // get number min and max
        $min = $request->number_one;
        $max = $request->number_two;

        // get number of exercises
        $number_exercises = $request->number_exercises;

        // generate exercises
        $exercises = [];
        for ($i = 1; $i <= $number_exercises; $i++) {
            $exercises[] = $this->gerator_exercises($i, $operations, $min, $max);
        }

        // put exercises in the session
        session(['exercises'=>$exercises]);

        return view('operations', ['exercises'=>$exercises]);
    }

    public function print_exercises()
    {
        // check if exercises in session
        if(!session('exercises')){
            return redirect()->route('home');
        }

        $exercises = session('exercises');

        // exercises
        echo '<pre>';
        echo "<h1>Exercicios Matemáticos ". env('APP_NAME')."</h1>";
        echo '<hr>';
        foreach ($exercises as $exercise) {
            echo '<h2><small>'.str_pad($exercise['exercise_number'], 2, '0', STR_PAD_LEFT)." -> ".'</small>'.$exercise['exercise'].'</h2>';
        }

        // solutions
        echo '<hr>';
        echo '<small>Soluções</small>';
        foreach ($exercises as $exercise) {
            echo '<br><small>'.str_pad($exercise['exercise_number'], 2, '0', STR_PAD_LEFT)." -> ".$exercise['solution'].'</small>';
        }


    }

    public function export_exercises()
    {
        echo 'exportar exercicios';
    }

    public function operations(){
        return view('operations');
    }
}
