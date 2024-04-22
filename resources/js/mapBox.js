import mapboxgl from 'mapbox-gl';

mapboxgl.accessToken = import.meta.env.VITE_MAPBOX_API_KEY;

const map = new mapboxgl.Map({
    container: 'map',
    center: [],
    style: 'mapbox://styles/mapbox/streets-v11'
});

