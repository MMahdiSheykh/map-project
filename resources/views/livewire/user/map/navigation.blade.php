<div>
    <div wire:ignore id="map"></div>
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


        // create a red polyline from an array of LatLng points
        let latlngs = [];
        let steps = @json($steps);

        for (let i = 0; i < steps.length; i++) {
            let tempArray = [steps[i]['start_location'][1], steps[i]['start_location'][0]];
            latlngs.push(tempArray)
        }

        let polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
        map.fitBounds(polyline.getBounds());
    </script>
</div>
