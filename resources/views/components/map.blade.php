<div id="map" class="w-full h-full rounded-tr-2xl rounded-br-2xl bg-[#1a1f2e] relative overflow-hidden">
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([51.4937, 3.6146], 18);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add marker
        var marker = L.marker([51.4937, 3.6146]).addTo(map);

        // Apply dark mode styling
        document.querySelector('.leaflet-tile-pane').style.filter = 'invert(90%) hue-rotate(180deg)';
        document.querySelector('.leaflet-marker-pane').style.filter = 'invert(90%) hue-rotate(180deg)';
    });
</script>

