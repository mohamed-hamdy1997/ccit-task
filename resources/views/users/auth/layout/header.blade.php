<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}?v=2">
    <title>CCIT</title>

    <!-- page css -->
    <link href="{{asset('assets/css/login-register-lock.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.min.css')}}" rel="stylesheet">

    <style>
        .form-material .form-control,
        .form-material .form-control.focus,
        .form-material .form-control:focus {
            background-image: linear-gradient(#fb9678, #fb9678), linear-gradient(#e9ecef, #e9ecef) !important;
        }

        .form-material .form-control {
            background-color: rgba(0, 0, 0, 0) !important;
        }

        .form-control {
            color: #212529 !important;
            padding: 0.375rem 0.75rem !important;
            background-color: #fff !important;
            border: 1px solid #e9ecef !important;
            border-radius: 0.25rem !important;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        }

        .disabled {
            pointer-events: none;
            cursor: default;
        }

        .invalid-input {
           border: 1px solid #F00 !important;
        }
    </style>
</head>

<body class="skin-default card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">CCIT</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            @if ($errors->any())
                <div class="alert alert-danger" id="alertError">
                    <span class="float-right pointer" onclick="$('#alertError').hide()">X</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger" id="alertError2">
                    <span class="float-right pointer" onclick="$('#alertError2').hide()">X</span>

                    <ul>
                        <li> {{ session()->get('error') }}</li>
                    </ul>

                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert" id="alertSuccess">
                    {{ session('success') }}
                    <span class="float-right pointer" onclick="$('#alertSuccess').hide()">X</span>
                </div>
            @endif

        <div class="login-box card">
            <div class="card-body">

