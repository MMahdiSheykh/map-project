<div>
    <div id="map"></div>
    <script>
        const map = new L.Map("map", {
            key: "{{ env('NESHAN_API_KEY') }}",
            maptype: "neshan",
            poi: false,
            traffic: false,
            center: [35.699756, 51.338076],
            zoom: 14,
        });
        map.setMapType("standard-night");


        // add a marker to the map
        var confirmedIcon = L.icon({ // customizing the marker from this function
            iconUrl: '/storage/marker-icon-2x-green.png',
            iconSize: [40, 60],
            iconAnchor: [25, 58],
            popupAnchor: [-3, -76],
            shadowUrl: '/storage/marker-shadow.png',
            shadowSize: [68, 95],
            shadowAnchor: [22, 94]
        });

        var notConfirmedIcon = L.icon({ // customizing the marker from this function
            iconUrl: '/storage/marker-icon-2x-red.png',
            iconSize: [40, 60],
            iconAnchor: [25, 58],
            popupAnchor: [-3, -76],
            shadowUrl: '/storage/marker-shadow.png',
            shadowSize: [68, 95],
            shadowAnchor: [22, 94]
        });

        const allEvents = @json($events);
        allEvents.forEach(function (e) {
            var icon = (e.is_confirmed === 0) ? notConfirmedIcon : confirmedIcon;
            var marker = L.marker([e.lat, e.lng], {icon}).addTo(map);

            var confirmButton = (e.is_confirmed !== 1) ? `<button wire:click="confirmEvent(${e.id})" class='btn btn-sm btn-outline-info'>تایید</button>` : '';

            var popupContent = `
        <b>نام :${e.name}</b><br>
           آدرس : ${e.address}}<br>
           توضیحات : ${e.description}
                <br><br>
        ${confirmButton}
        <button wire:click="deleteEvent(${e.id})" class='btn btn-sm btn-outline-danger'>حذف</button>
    `;
            marker.bindPopup(popupContent);
        });

        document.addEventListener('livewire:initialized', () => {
            @this.on('show-event', (event) => {
                map.setView([event[0].lat, event[0].lng]);
            });
        })
    </script>
</div>

