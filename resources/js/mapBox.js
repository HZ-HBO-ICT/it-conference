import mapboxgl from 'mapbox-gl';

mapboxgl.accessToken = import.meta.env.VITE_MAPBOX_API_KEY;

const map = new mapboxgl.Map({
    container: 'map',
    center: [3.609426676346345, 51.49491334862108],
    zoom: 16,
    style: 'mapbox://styles/mapbox/streets-v12'
});

let marker = new mapboxgl.Marker().setLngLat([3.609426676346345, 51.49491334862108]).addTo(map);

