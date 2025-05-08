<script>
    async function getLocation() {
        const salesId = $("#sales").val();
        const tgl = $("#tgl").val();
        try {
            const response = await $.get("<?= BASE_URL ?>location/getsales_locations", {
                sales: salesId,
                tanggal: tgl
            });
            const loc = JSON.parse(response);
            renderMap(loc);
        } catch (error) {
            renderMap(null);
            console.error('Gagal mengambil data lokasi:', error);
        }
    }

    function renderMap(loc) {
        const tableBody = document.getElementById('location-table-body');
        const mapContainer = document.getElementById('map');

        if (!loc || loc.length === 0) {
            mapContainer.style.display = 'none';
            tableBody.innerHTML = `<tr><td class="text-center" colspan="3">Data Tidak Ditemukan</td></tr>`;
            return;
        }

        mapContainer.style.display = 'block';
        const map = new google.maps.Map(mapContainer, {
            zoom: 12,
            center: {
                lat: loc[0].latitude,
                lng: loc[0].longitude
            },
            mapId: 'YOUR_MAP_ID' // Optional but recommended
        });

        const bounds = new google.maps.LatLngBounds();

        tableBody.innerHTML = "";
        loc.forEach((loc, index) => {
            const latLng = new google.maps.LatLng(
                parseFloat(loc.latitude),
                parseFloat(loc.longitude)
            );

            // Create a custom label element for AdvancedMarker
            const label = document.createElement('div');
            label.style.padding = '4px 8px';
            label.style.background = '#4285F4';
            label.style.color = 'white';
            label.style.borderRadius = '4px';
            label.style.fontWeight = 'bold';
            label.style.fontSize = '12px';
            label.textContent = `${index + 1}`;

            // Use AdvancedMarkerElement instead of Marker
            const marker = new google.maps.marker.AdvancedMarkerElement({
                map,
                position: latLng,
                content: label,
                title: loc.username
            });

            bounds.extend(latLng);

            // Append to table
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