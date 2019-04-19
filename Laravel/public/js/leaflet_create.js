let placedMarkers = L.featureGroup().addTo(map);
let routingControl;

addEventListener('core_finished', function (e) {
    console.log('Leaflet core is finished loading');

    routingControl = L.Routing.control({
        router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig'),
        waypoints: [null],
        routeWhileDragging: true
    }).addTo(map);

    map.doubleClickZoom.disable();
});

function placeMarker(e) {
    L.marker(e.latlng).addTo(placedMarkers);
    if (placedMarkers.getLayers().length > 1) {
        calculateRoute();
    }
}

//TODO rmove the maker
//TODO fix bug where markers move back to initial position when moved.
function removeMarker(e) {
    map.removeLayer(e.layer);
}

function calculateRoute() {

    let layers = placedMarkers.getLayers();
    let latlngs = [];

    for (let i = 0; i < layers.length; i++) {
        latlngs.push(L.latLng(layers[i].getLatLng().lat, layers[i].getLatLng().lng));
    }

    routingControl.setWaypoints(latlngs);
}

map.on('dblclick', placeMarker);
placedMarkers.on('dblclick', removeMarker);