<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiCommentsLoginRequest;
use App\Http\Requests\ApiCommentsRegisterRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\CommentsResource;
class CommentsController
{
    public function register(ApiCommentsRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->create($request->all());
        if($user)
        {
            return response()->json(['msg' => 'user created successfully' ,'status' => 200 ]);
        }
        return response()->json(['msg' => 'failed' , 'status' => 400]);
    }

    public function login(ApiCommentsLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->where('email',$request->get('email'))->first();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['msg' => 'success' , 'status' => 200 , 'token' => $token]);
    }

    public function index()
    {

        return CommentsResource::Collection(Comment::query()->paginate(2));
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
