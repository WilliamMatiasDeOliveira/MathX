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

            $operation = $operations[array_rand($operations)];
            $number1 = rand($min, $max);
            $number2 = rand($min, $max);

            $exercise = '';
            $solution = '';

            switch($operation){
                case 'sum':
                    $exercise = "$number1 + $number2";
                    $solution = $number1 + $number2;
                    break;
                case 'subtraction':
                    $exercise = "$number1 - $number2";
                    $solution = $number1 - $number2;
                    break;
                case 'multiplication':
                    $exercise = "$number1 x $number2";
                    $solution = $number1 * $number2;
                    break;
                case 'division':
                    // avoid division by zero
                    if($number2 == 0){
                        $number2 = 1;
                    }
                    $exercise = "$number1 : $number2";
                    $solution = $number1 / $number2;
                    break;
            }

            // check if float
            if(is_float($solution)){
                $solution = round($solution, 2);
            }
            $exercises[] = [
                'operation'=>$operation,
                'exercise_number'=> $i,
                'exercise'=>$exercise.' = ',
                'solution'=>"$exercise = $solution"
            ];

        }

        return view('operations', ['exercises'=>$exercises]);
    }

    public function print_exercises()
    {
        echo 'imprimir exercicios';
    }

    public function export_exercises()
    {
        echo 'exportar exercicios';
    }

    public function operations(){
        return view('operations');
    }
}
