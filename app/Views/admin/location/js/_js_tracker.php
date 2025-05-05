<style>
  #map {
    height: 80vh;
    width: 100%;
  }
</style>

<div id="map"></div>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNaShEjYlpXdcJmxJaHUFDD2QYlbU3PRw&libraries=marker&callback=initMap"></script>

<script>
  let map;
  let markers = {};

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: { lat: -8.634125, lng: 115.2099721 },
      zoom: 12,
      mapId: 'e696547befb8751d'
    });

    fetchAndUpdateMarkers(); // Initial load
    setInterval(fetchAndUpdateMarkers, 10000); // Every 10 seconds
  }

  function fetchAndUpdateMarkers() {
    fetch('<?= BASE_URL ?>/location/get_realtime')
      .then(response => response.json())
      .then(locations => {
        for (const id in markers) {
          if (!locations.find(loc => loc.user_id == id)) {
            markers[id].map = null;
            delete markers[id];
          }
        }

        locations.forEach(loc => {
          const lat = parseFloat(loc.latitude);
          const lng = parseFloat(loc.longitude);
          if (isNaN(lat) || isNaN(lng)) return;

          const position = new google.maps.LatLng(lat, lng);

          if (markers[loc.user_id]) {
            markers[loc.user_id].position = position;
          } else {
            const label = document.createElement('div');
            label.style.padding = '4px 8px';
            label.style.background = '#1a73e8';
            label.style.color = 'white';
            label.style.borderRadius = '4px';
            label.style.fontSize = '12px';
            label.style.fontWeight = 'bold';
            label.textContent = loc.username;

            const marker = new google.maps.marker.AdvancedMarkerElement({
              map,
              position,
              content: label,
              title: loc.username
            });

            markers[loc.user_id] = marker;
          }
        });
      })
      .catch(err => console.error('Fetch failed:', err));
  }
</script>
