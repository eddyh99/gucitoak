<script>
    let ids = [];
    async function getLocation() {
        const salesId = $("#sales").val();
        const tgl = $("#tgl").val();
        try {
            const response = await $.get("<?= BASE_URL ?>location/getsales_locations", {
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

        const routePath = new google.maps.Polyline({
            path: loc.map(l => ({
                lat: parseFloat(l.latitude),
                lng: parseFloat(l.longitude)
            })),
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        routePath.setMap(map);
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

    $("#save").on('click', async function() {
        try {
            const response = await handleAction(ids.toString(), 'location/saverecord');
            alertSwal(response, 'success');

        } catch (err) {
            alertSwal(err, 'error');
        }
    });

    $("#del").on('click', async function() {
        try {
            const response = await handleAction(ids.toString(), 'location/delete');
            alertSwal(response, 'success');
            $("#lihat").click();
        } catch (err) {
            alertSwal(err, 'error');
        }
    });

    async function handleAction(id, url) {
        return new Promise((resolve, reject) => {
            if (!ids || ids.length === 0) {
                return reject('Lokasi tidak valid!');
            }

            $.ajax({
                url: "<?= BASE_URL ?>" + url,
                type: "GET",
                data: {
                    ids: id
                },
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });

    }

    function alertSwal(message, status) {
        Swal.fire({
            title: "Notifikasi",
            text: message,
            icon: status,
            showConfirmButton: false,
            customClass: {
                popup: 'btn-primary'
            }
        });
        setTimeout(() => {
            $(".swal2-container").css("z-index", "9999");
        }, 100);
    }
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNaShEjYlpXdcJmxJaHUFDD2QYlbU3PRw&libraries=marker&callback=initMap">
</script>