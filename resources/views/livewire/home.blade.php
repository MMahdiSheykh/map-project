<div>
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
        map.setMapType("standard-night");

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
        const allEvents = @json($events);

        allEvents.forEach(function (e) {
            var marker = L.marker([e.lat, e.lng], {icon: eventsIcon}).addTo(map);
        })

        // const successCallback = (position) => {
        //     console.log(position);
        // };
        //
        // const errorCallback = (error) => {
        //     console.log(error);
        // };
        //
        // navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

        var latLong;
        $.getJSON("http://ipinfo.io", function(ipinfo){
            console.log("Found location ["+ipinfo.loc+"] by ipinfo.io");
            latLong = ipinfo.loc.split(",");
        });
    </script>
</div>
