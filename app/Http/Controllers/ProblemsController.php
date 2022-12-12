<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    public function solveFirst()
    {
        $head = [1, 2, 3, 4, 5, 6];
        $length = count($head);

        if ($length % 2 !== 0) {
            $middle = floor($length / 2);
            $results = [];
            for ($i = $middle; $i < $length; $i++) {
                $results[] .= $head[$i];
            }
            return $results;
        }
        $middle = $length / 2;
        $results = [];
        for ($i = $middle; $i < $length; $i++) {
            $results[] .= $head[$i];
        }
        return $results;
    }
}
