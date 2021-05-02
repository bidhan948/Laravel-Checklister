<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
</head>

<body class="c-app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then CoreUI JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
</body>

</html>