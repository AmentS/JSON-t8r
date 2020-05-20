@extends('layouts.app')

{{--@extends('layouts.ulogovan')--}}

@section('content')
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <title>JSON-t8R</title>

</head>
<body>
<div id="app">
    @include('layouts.pocetna')

    <section class="section">
        <div class="container">
            <router-view>

            </router-view>
        </div>
    </section>




</div>

<script src='/js/app.js'></script>

</body>
</html>
@endsection

