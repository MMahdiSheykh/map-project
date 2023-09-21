<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Map</title>

    <!-- neshan dependencies -->
    <link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.7/index.css"/>
    <script src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.7/index.js"></script>

    <!-- bootstrap dependencies -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

    <!-- The sidebar -->
    <div class="sidebar">
        {{ $sidebar ?? '' }}
    </div>

    <!-- Page content -->
    <div class="content">

        {{ $slot }}
    </div>

</body>
</html>
