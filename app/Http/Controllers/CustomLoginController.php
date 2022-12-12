<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CustomLoginController extends Controller
{

    public function showRegisterForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:authors,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|regex:/(01)[0-9]{9}/',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:30000'
        ]);
        if ($validator->fails())
            return redirect('register/now')->withErrors($validator)->withInput();
        $user = Author::create($request->except(['image']));
        $user->password = bcrypt($user->password);
        $user->save();
        if ($request->has('image')) {
            $image_name = time() . '.' . $request->file('image')->guessExtension();
            $name = $request->file('image')->storeAs('profiles', $image_name);
            $user->image()->create([
                'src' => $name,
                'type' => 'avatar',
            ]);

            return redirect()->route('login');
        }

    }

    public function login(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails())
            return redirect('login')->withErrors($validator)->withInput();
        if (Auth::guard('author')->attempt($this->credentials($request))) {
            return view('home');
        }
        $email = Author::where('email', $request->email)->first();
        if ($email)
            return redirect()->back()->withErrors([
                'errors' => 'Password Is Incorrect!',
            ]);
        return redirect()->back()->withErrors([
            'errors' => 'Email does not exist. sign up now!',
        ]);

    }

    public function credentials($request)
    {
        return $request->only($this->username(), 'password');
    }

    public function username(): string
    {
        return 'email';
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('author')->logout();
//        $user->logout();
//        $author->logout();
        return redirect()->route('login');

    }

}
