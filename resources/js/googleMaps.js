let map;

async function initMap() {
    const position = { lat: 51.495195664366655, lng: 3.6095815923977623 };

    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    map = new Map(document.getElementById("map"), {
        zoom: 4,
        center: position,
        mapId: "LOCATION_MAP_HZ",
    });

    const marker = new AdvancedMarkerElement({
        map: map,
        position: position,
        title: "HZ University of Applied Sciences",
    });
}

initMap();
