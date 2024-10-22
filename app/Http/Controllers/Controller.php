<?php

namespace App\Http\Controllers;

abstract class Controller
{

    public function gerator_exercises($i, $operations, $min,$max): array
    {

        $operation = $operations[array_rand($operations)];
        $number1 = rand($min, $max);
        $number2 = rand($min, $max);

        $exercise = '';
        $solution = '';

        switch ($operation) {
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
                if ($number2 == 0) {
                    $number2 = 1;
                }
                $exercise = "$number1 : $number2";
                $solution = $number1 / $number2;
                break;
        }

        // check if float
        if (is_float($solution)) {
            $solution = round($solution, 2);
        }
        return [
            'operation' => $operation,
            'exercise_number' => $i,
            'exercise' => $exercise . ' = ',
            'solution' => "$exercise = $solution"
        ];
    }
}
