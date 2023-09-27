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

        // set icons
        var iconForCurrentUserEvents = L.icon({
            iconUrl: '/storage/marker-icon-2x-red.png',
            iconSize: [40, 60],
            iconAnchor: [25, 58],
            popupAnchor: [-3, -76],
            shadowUrl: '/storage/marker-shadow.png',
            shadowSize: [68, 95],
            shadowAnchor: [22, 94]
        });

        var iconForOtherUsersEvents = L.icon({
            iconUrl: '/storage/marker-icon-2x-blue.png',
            iconSize: [40, 60],
            iconAnchor: [25, 58],
            popupAnchor: [-3, -76],
            shadowUrl: '/storage/marker-shadow.png',
            shadowSize: [68, 95],
            shadowAnchor: [22, 94]
        });

        // show all events with their explanations
        const allEvents = @json($events);
        const userId = {{ auth()->user()->id }};

        allEvents.forEach(function (e) {
            var icon = e.user_id === userId ? iconForCurrentUserEvents : iconForOtherUsersEvents;
            var marker = L.marker([e.lat, e.lng], {icon: icon}).addTo(map);

            if (e.user_id === userId) {
                marker.bindPopup("نام: " + e.name + "<br><br>توضیحات: " + e.description + `<button wire:click="confirmDelete(${e.id})" class="btn btn-sm btn-dark mt-4 ml-2">حذف رویداد</button>`);
            } else {
                marker.bindPopup("نام: " + e.name + "<br><br>توضیحات: " + e.description);
            }
        })
    </script>

    <div> {{-- select the location for creating the new event and delete it when user closed the popup --}}
        <div id="new-event-popup">
            <script>

                // get lat and lng of new event
                var popup = L.popup();

                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent("رویداد شما در این نقطه ایجاد می شود")
                        .openOn(map);

                    dispatchEvent(new Event('close-popup'));

                    @this.dispatch('setLatlng', {latlng: e.latlng});
                }

                map.on('click', onMapClick);
            </script>
        </div>

        <script>

            addEventListener('close-popup', function () {
                var link = document.querySelector('.leaflet-popup-close-button');

                link.addEventListener('click', function () {
                    @this.dispatch('setLatlng', {latlng: null});
                });
            })
        </script>
    </div>

    <script>
        // confirm delete alert
        document.addEventListener('livewire:initialized', () => {
            @this.on('confirm-delete', (event) => {
                var is_confirmed = confirm("آیا از حذف این رویداد اطمینان دارید؟");

                if (is_confirmed) {
                    @this.dispatch('delete-event', {id: event});
                }
            });
        });
    </script>

    {{-- add toggle map theme feature --}}
    <div id="map-theme" class="mt-5">
        <button id="toggle" type="button" class="btn btn-secondary">toggle map theme</button>
    </div>

    <script>
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

        document.getElementById('toggle').addEventListener('click', function(event) {
            event.stopPropagation();
            if (isDark) {
                map.setMapType("neshan");
                isDark = false;
            } else {
                map.setMapType("standard-night");
                isDark = true;
            }
        });

    </script>
</div>
