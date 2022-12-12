<?php

namespace App\Http\Controllers;

use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public $postRepo;

    public function __construct(BlogPostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        return $this->postRepo->index();
    }

    public function show($id)
    {
        return $this->postRepo->show($id);
    }

    public function update($id, Request $request)
    {
        return $this->postRepo->update($id, $request);
    }

    public function problemSolving()
    {
        $arr = [1, 3, 5, 7, 9];
        $result = array_unique($arr);
        return print_r($result);
//        return print_r( array_count_values($arr));
//        if(array_count_values($arr) > 1)
//            return 'repeated';
//        $target = 2;
//        $shouldReturnIndex = 0;
//
//        if (in_array($target, $arr))
//            return array_search($target, $arr);
//        foreach ($arr as $key => $value) {
//            if ($value < $target)
//                $shouldReturnIndex = $key + 1;
//        }

        return 'Not repeated';
    }

    public function isValidSudoku()
    {
        $sudoku =
            [["5", "3", ".", ".", "7", ".", ".", ".", "."]
                , ["6", ".", ".", "1", "9", "5", ".", ".", "."]
                , [".", "9", "8", ".", ".", ".", ".", "6", "."]
                , ["8", ".", ".", ".", "6", ".", ".", ".", "3"]
                , ["4", ".", ".", "8", ".", "3", ".", ".", "1"]
                , ["7", ".", ".", ".", "2", ".", ".", ".", "6"]
                , [".", "6", ".", ".", ".", ".", "2", "8", "."]
                , [".", ".", ".", "4", "1", "9", ".", ".", "5"]
                , [".", ".", ".", ".", "8", ".", ".", "7", "9"]];

        for ($i = 0 ; $i < count($sudoku) ; $i++) {
            //searching in rows
            for ($j =  0 ; $j < $sudoku[$i] ; $j++) {
                if ( $sudoku[$i][$j]) {
                    $result = array_count_values($sudoku[$i]);
//                    if($result[])
                }
            }
        }

    }

}

