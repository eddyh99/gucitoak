<script>
    let ids = [];
    async function getLocation() {
        const salesId = $("#sales").val();
        const tgl = $("#tgl").val();
        try {
            const response = await $.get("<?= BASE_URL ?>location/getrecord_locations", {
                sales: salesId,
                tanggal: tgl
            });
            const loc = JSON.parse(response);
            ids = loc.map(item => item.id);
            renderMap(loc);
        } catch (error) {
            renderMap(null);
            console.error('Gagal mengambil data lokasi:', error);
        }
    }


    function renderMap(locations) {
        const mapContainer = document.getElementById('map');
        const tableBody = document.getElementById('location-table-body');

        if (!locations || locations.length === 0) {
            mapContainer.style.display = 'none';
            tableBody.innerHTML = `<tr><td class="text-center" colspan="3">Data Tidak Ditemukan</td></tr>`;
            return;
        }

        mapContainer.style.display = 'block';
        const map = new google.maps.Map(mapContainer, {
            zoom: 12,
            center: {
                lat: locations[0].latitude,
                lng: locations[0].longitude
            },
            mapId: 'YOUR_MAP_ID'
        });

        const bounds = new google.maps.LatLngBounds();
        tableBody.innerHTML = "";

        // Display markers
        locations.forEach((loc, index) => {
            const latLng = new google.maps.LatLng(loc.latitude, loc.longitude);

            const label = document.createElement('div');
            label.style.padding = '4px 8px';
            label.style.background = '#4285F4';
            label.style.color = 'white';
            label.style.borderRadius = '4px';
            label.style.fontWeight = 'bold';
            label.style.fontSize = '12px';
            label.textContent = `${index + 1}`;

            new google.maps.marker.AdvancedMarkerElement({
                map,
                position: latLng,
                content: label,
                title: 'agus'
            });

            bounds.extend(latLng);

            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${loc.latitude}</td>
                    <td>${loc.longitude}</td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', row);
        });

        map.fitBounds(bounds);

        // Directions API
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map
        });

        const waypoints = locations.slice(1, -1).map(loc => ({
            location: {
                lat: loc.latitude,
                lng: loc.longitude
            },
            stopover: true
        }));

        directionsService.route({
            origin: {
                lat: locations[0].latitude,
                lng: locations[0].longitude
            },
            destination: {
                lat: locations[locations.length - 1].latitude,
                lng: locations[locations.length - 1].longitude
            },
            waypoints: waypoints,
            travelMode: google.maps.TravelMode.DRIVING
        }, (response, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });
    }
    window.initMap = async function() {
        await getLocation();
    }

    $('#tgl').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        startDate: moment(), // default ke hari ini
        locale: {
            format: 'YYYY-MM-DD' // format yang kamu inginkan
        }
    });


    $("#lihat").on('click', () => getLocation());

</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNaShEjYlpXdcJmxJaHUFDD2QYlbU3PRw&libraries=marker&callback=initMap">
</script>