<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('page.title', config('app.name'))</title>


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">



    <style>
        .required:after { content: '*'; color: red; }
        .left-aligned-text {
            display: block;
            text-align: left;
        }

    </style>



</head>

<body>

<div class="d-flex flex-column justify-content-between min-vh-100">

    @include('includes.alert')

    @include('includes.header')

    <main class="flex-grow-1 py-3 content">
      @yield('content')
    </main>

    @include('includes.footer')

</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>
</html>
