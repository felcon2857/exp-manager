<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />

    <title>Expenses Manager</title>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ url('css/custom/style.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ url('css/boxicons/css/boxicons.min.css') }}" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ url('images/logo-original.png') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <index></index>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script>
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        const sideNavToogle = document.body.querySelector("#sidebar-id")

        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            if (sideNavToogle.classList.contains("sidebar-mobile")) {
                sideNavToogle.classList.remove('sidebar-mobile')
            } else {
                sideNavToogle.classList.add('sidebar-mobile')
            }
        });
    </script>
</body>

</html>