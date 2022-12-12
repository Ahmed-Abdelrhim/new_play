<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use mysqli;
use RealRashid\SweetAlert\Facades\Alert;

class ImagesController extends Controller
{
    public function uploadForm(): View
    {
        return view('files.images');
    }

    public function sweet()
    {
        session()->flash('success', "Welcome ");
        Alert::info('Info Title', 'Info Message');
        toast(session('success'), 'success');
        // return back();
    }

    public function uploadMultipleImages(Request $request)
    {
//        return uniqid('',false);
//        $images = [];

//
//        foreach($request->images as $image  ) {
//            $image_name = uniqid('',);
//
//            $images[] .= $image;
//        }
//        return $images;
    }

    public function connect()
    {
        $servername = '';
        $username = '';
        $dbname = '';
        $password = '';
        $conn  = new mysqli($servername,$username,$dbname,$password);
        if ($conn->connect_error) {
            return 'Connection Failed';
        }

//        $sql = 'INSERT INTO  EMPS (name,email) VALUES ("") ';
    }

}
