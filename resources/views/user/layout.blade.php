<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Session;
$total = 0;
if (Session::has('user')) {
    $total = AdminController::cartItem();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/media.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <title>salma store</title>
</head>

<body>
@include('user.navbar')



@yield('body')



@include('user.footer')
