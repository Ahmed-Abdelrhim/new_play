@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
{{--            <div class="d-flex flex-column col-6">--}}
{{--                <img src="{{$image}}" class="img-thumbnail" style="width: 200px; height: 200px; border-radius: 50%;" alt="not-found"/>--}}
{{--                <h3 class="h3" style="width: 200px; margin-left: 37px;">User Profile</h3>--}}
{{--                <p class="mt-3" style="max-width: 100%;"> {{$image}} </p>--}}
{{--            </div>--}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header h4 text-center">Update Profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.profile.data') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Success Message --}}
                            @if (Session::has('success'))
                                <script>
                                    swal({
                                        text: " {!! Session::get('success') !!}",
                                        icon: "success",
                                    })
                                </script>
                            @endif

                            {{--<div class="row mr-2 ml-2">--}}
                            {{--<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"--}}
                            {{--id="type-error">{{Session::get('success')}}--}}
                            {{--</button>--}}
                            {{--</div>--}}

                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" placeholder="full name"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $user->name }}" required
                                           autocomplete="email" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback mb-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" placeholder="email address"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email }}" required
                                           autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback mb-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-end">Phone</label>
                                <div class="col-md-6">
                                    <input type="tel" id="phone" placeholder="phone number"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           autocomplete="current-password"
                                           @if($user->phone != null)
                                               value="{{ $user->phone }}"
                                        @endif>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="lang"
                                       class="col-md-4 col-form-label text-md-end">language</label>
                                <div class="col-8">
                                    <select id="lang" name="locale" class="custom-select" style="width: 73%">
                                        @foreach(\App\Models\Author::LOCALES as $locale => $lang)
                                            <option
                                                value="{{$locale}}" {{ $user->locale != $locale ?: 'selected'}}>
                                                {{$lang}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">Image</label>
                                <div class="col-md-6">
                                    <input id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                           autocomplete="current-password">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
