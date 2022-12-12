<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BlogPost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class LearnController extends Controller
{
    public function playWithExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Name');
        $writer = new Xlsx($spreadsheet);
        $writer->save('users.xlsx');

    }

    public function showDataTablesIndex(): View
    {
//        return $posts = BlogPost::with(['author' => function ($q) {
//            $q->select('id','name');
//        }])
//            ->get();
        return view('datatables');
    }

    public function getDataTablesIndex()
    {
//        $posts = BlogPost::with(['author' => function ($query) {
//            return $query->select('id','name');
//        }])->get();

        $posts = BlogPost::query()->get();

        // return $posts = BlogPost::with('author')->all();
        //return  DataTables::of($posts)->addIndexColumn()->make(true);

        return DataTables::of($posts)->addIndexColumn()
            ->setRowClass(function ($row) {
                return $row->id % 2 == 0 ? 'alert-primary' : 'alert-warning ' . $row->id;
            })
//            ->setRowAttr([
//                'style'=> function ($row) {
//                return $row->id %2 == 0 ? 'color:white' :  'color:red';
//                },
//            ])
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->addColumn('action', function ($row) {
                return $btn = '
                <a href="' . Route('update.post', $row->id) . '" class="btn btn-primary">Update</a>
                <a href="' . Route('delete.post', $row->id) . '" class="btn btn-danger mt-2">Delete</a>
                ';
            })
            ->addColumn('author', function (BlogPost $author) {
                return $author->author->name;
            })
            ->editColumn('created_at' , function(BlogPost $post) {
                return $post->created_at->diffForHumans();
            })
            ->rawColumns(['action'])
            ->make(true);
        // dd($users);
    }

    public function play()
    {
        return 'Authenticated';
    }
}
