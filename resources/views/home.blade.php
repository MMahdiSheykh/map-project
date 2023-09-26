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

    <style>
        body {
            height: 100vh;
            width: 100vw;
            margin: 0;
        }

        #map {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="map"></div>
<script>
    // map setting
    const map = new L.Map("map", {
        key: "{{ env('NESHAN_API_KEY') }}",
        maptype: "neshan",
        poi: false,
        traffic: false,
        center: [35.699756, 51.338076],
        zoom: 11.5,
    });

    // set icons
    var eventsIcon = L.icon({
        iconUrl: '/storage/marker-icon-2x-red.png',
        iconSize: [40, 60],
        iconAnchor: [25, 58],
        popupAnchor: [-3, -76],
        shadowUrl: '/storage/marker-shadow.png',
        shadowSize: [68, 95],
        shadowAnchor: [22, 94]
    });

    // show all events with their explanations
    const allEvents = @json(\App\Models\Event::where('is_confirmed', true)->get());

    allEvents.forEach(function (e) {
        var marker = L.marker([e.lat, e.lng], {icon: eventsIcon}).addTo(map);
    })

    // setting the map position with the user location
    navigator.geolocation.getCurrentPosition(
        (position) => {
            map.setView([position.coords.latitude, position.coords.longitude], 16)
        }, (error) => {
            console.error(error);
        }
    );

</script>

<div id="auth-buttons" class="mt-5">
    <button id="btn-login" type="button" class="btn btn-primary">Login</button>
    <button id="btn-register" type="button" class="btn btn-secondary">Register</button>
</div>


<div id="map-theme" class="mt-5">
    <button id="toggle" type="button" class="btn btn-secondary">toggle map theme</button>
</div>

<script>
    // login and register buttons
    L.Control.Custom = L.Control.extend({
        onAdd: function() {
            return L.DomUtil.get('auth-buttons');
        }
    });

    L.control.custom = function(opts) {
        return new L.Control.Custom(opts);
    }

    L.control.custom({ position: 'topright' }).addTo(map);

    document.getElementById('btn-login').addEventListener('click', function() {
        window.location.href = '/login';
    });

    document.getElementById('btn-register').addEventListener('click', function() {
        window.location.href = '/register';
    });

    // toggle map theme
    L.Control.Custom = L.Control.extend({
        onAdd: function() {
            return L.DomUtil.get('map-theme');
        }
    });

    L.control.custom = function(opts) {
        return new L.Control.Custom(opts);
    }

    L.control.custom({ position: 'bottomright' }).addTo(map);

    let isDark = false;
    map.setMapType("neshan");

    document.getElementById('toggle').addEventListener('click', function() {
        if (isDark) {
            map.setMapType("neshan");
            isDark = false;
        } else {
            map.setMapType("standard-night");
            isDark = true;
        }
    });

</script>
</body>
</html>
