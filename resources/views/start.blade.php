<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrapcss') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('img/order-food.png') }}" alt="" width="300" height="auto" class="img-fluid">
            </div>
            <div class="col-6">
                <h1>Welcome to HayOrder</h1>
                <p>Your one-stop solution for ordering hay online.</p>
                <p>Please use the navigation menu to explore our services.</p>
            </div>
        </div>
    </div>

    <a href="{{ route('login') }}" class="btn btn-primary">login tes</a>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
