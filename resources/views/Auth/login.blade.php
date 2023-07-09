@extends('Auth.layout')


@section('content')
    {{-- <div class="container w-50">
        @if (session()->has('message'))
        <p class="alert alert-danger">
            {{session()->get('message')}}
        </p>
        @endif


        <h1 class="text-center mt-5">login Form</h1>
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <!-- Email input -->
            @if ($errors->any())
            @foreach ($errors->all() as $error)
               <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" name="email" id="form2Example1" class="form-control" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                <input type="password" name="password" id="form2Example2" class="form-control" />
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">

                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>


    </div>
    </form> --}}
    <div class="login-box">
        <h2>Login</h2>
        <form action="{{ url('login') }}" method="POST">
            @csrf
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
            @endif
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>Email address</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <button class="bg-transparent" >
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>
        </form>
    </div>
@endsection
