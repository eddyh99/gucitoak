<script>
    const locations = <?= $locationsJson ?>;

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: { lat: locations[0].latitude, lng: locations[0].longitude },
            mapId: 'YOUR_MAP_ID' // Optional but recommended
        });

        const bounds = new google.maps.LatLngBounds();
        const tableBody = document.getElementById('location-table-body');

        locations.forEach((loc, index) => {
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

    window.initMap = initMap;
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNaShEjYlpXdcJmxJaHUFDD2QYlbU3PRw&libraries=marker&callback=initMap">
</script>
