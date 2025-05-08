<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <!-- Title Page-->
    <title>DayDispatch Rates</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" 
    async defer></script>

    <style>
        .modal#statusSuccessModal .modal-content, 
    .modal#statusErrorsModal .modal-content {
        border-radius: 30px;
    }
    .modal#statusSuccessModal .modal-content svg, 
    .modal#statusErrorsModal .modal-content svg {
        width: 100px; 
        display: block; 
        margin: 0 auto;
    }
    .modal#statusSuccessModal .modal-content .path, 
    .modal#statusErrorsModal .modal-content .path {
        stroke-dasharray: 1000; 
        stroke-dashoffset: 0;
    }
    .modal#statusSuccessModal .modal-content .path.circle, 
    .modal#statusErrorsModal .modal-content .path.circle {
        -webkit-animation: dash 0.9s ease-in-out; 
        animation: dash 0.9s ease-in-out;
    }
    .modal#statusSuccessModal .modal-content .path.line, 
    .modal#statusErrorsModal .modal-content .path.line {
        stroke-dashoffset: 1000; 
        -webkit-animation: dash 0.95s 0.35s ease-in-out forwards; 
        animation: dash 0.95s 0.35s ease-in-out forwards;
    }
    .modal#statusSuccessModal .modal-content .path.check, 
    .modal#statusErrorsModal .modal-content .path.check {
        stroke-dashoffset: -100; 
        -webkit-animation: dash-check 0.95s 0.35s ease-in-out forwards; 
        animation: dash-check 0.95s 0.35s ease-in-out forwards;
    }
     
    @-webkit-keyframes dash { 
        0% {
            stroke-dashoffset: 1000;
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
    @keyframes dash { 
        0% {
            stroke-dashoffset: 1000;
        }
        100%{
            stroke-dashoffset: 0;
        }
    }
    @-webkit-keyframes dash { 
        0% {
            stroke-dashoffset: 1000;
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
    @keyframes dash { 
        0% {
            stroke-dashoffset: 1000;}
        100% {
            stroke-dashoffset: 0;
        }
    }
    @-webkit-keyframes dash-check { 
        0% {
            stroke-dashoffset: -100;
        }
        100% {
            stroke-dashoffset: 900;
        }
    }
    @keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }
        100% {
            stroke-dashoffset: 900;
        }
    }
    .box00{
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
    </style>
</head>