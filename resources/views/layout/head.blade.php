<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrfToken" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{!! asset('images/favicon.ico') !!}">

  <title>Gl0b!l @yield('title')</title>

  <!-- Bulma -->
  <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- BootstrapFormHelpers -->
  <link rel="stylesheet" href="{{ asset('BootstrapFormHelpers/dist/css/bootstrap-formhelpers.min.css') }}">
  <!-- Font Awesome -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- TOASTR -->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  
<style type="text/css">   @yield('styles') </style>

  <!-- App CSS -->
  <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('sass/main.css') }}">


  <script>
    window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]) ?>
  </script>

<!-- TOASTR -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</head>