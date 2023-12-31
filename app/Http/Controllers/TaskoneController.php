<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskoneController extends Controller
{
    public function problemOne(){

        $product = 900900;
        $result = [];

        for ($i = 1; $i <= sqrt($product); $i++) {
            if ($product % $i == 0) {
                $pair1 = $i;
                $pair2 = $product / $i;

                if ($pair1 < $pair2) {
                    $result[] = [$pair1, $pair2];
                }
            }
        }

        return view('tasks.one')->with('result', $result);

    }




    // Write a program that allows a user to enter an integer and tells them if it is a deficient, perfect or
    // abundant number.

    public function problemtwo(){

        return view('tasks.two');
    }



    public function problemTwoform(Request $request)
    {
        $num = $request->input('number');

        if ($num < 1) {
            return "Please enter a value  greater than zero.";
        }

        $sum = 0;

        for ($i = 1; $i < $num; $i++) {
            if ($num % $i == 0) {
                $sum += $i;
            }
        }

        if ($sum < $num) {
            return "$num is a deficient number.";
        } elseif ($sum == $num) {
            return "$num is a perfect number.";
        } else {
            return "$num is an abundant number.";
        }
    }

    // Write a program that allows a user to enter an integer and tells them if it is a Harshad number (base
    // 10)
    public function problemThree(){

        return view('tasks.three');
    }


    public function problemThreeform(Request $request)
    {
        $num = $request->input('number');

    if ($num < 1) {
        return "Please enter a value  greater than zero.";
    }

    $sum = 0;

    // Calculate the sum of digits
    $returnNum = $num; 
    while ($num > 0) {
        $sum += $num % 10; // Add the last digit to the sum
        $num = (int)($num / 10); // Remove the last digit
    }

    if ($returnNum > 0 && $returnNum % $sum == 0) {
        return "$returnNum is a Harshad number in base 10.";
    } else {
        return "$returnNum is not a Harshad number in base 10.";
    }
    }
}
