<?php
namespace App\Http\Controllers\API;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Validator;

trait BlogPostTrait {
    public function apiResponse($data = [] , $status = null , $headers = null)
    {
        $array = [
            'data' => $data,
            'status' => $status,
            'msg'=> $headers,
        ];
        return response($array);
    }

    public function validation($request)
    {
        $validate = Validator::make($request->all(), [
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|min:4',
            'content' => 'required|min:8',
        ]);
        if ($validate->fails())
            return $this->apiResponse($validate->errors(),400,'Validation Error');
        return true;
    }


}
