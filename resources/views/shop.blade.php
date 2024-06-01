<!DOCTYPE html>
<html lang="en">
<head>
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body class="d-flex flex-column min-vh-100 content">

@include('includes.header')

<div class="container mt-5">
    <h2 class="mb-3">Корзина</h2>
</div>

<div class="container mt-4 flex-grow-1">
    @yield('content')
</div>

@include('includes.footer')

@yield('scripts')

</body>


</html>
