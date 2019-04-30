let placedMarkers = L.featureGroup().addTo(map);
let routingControl;

addEventListener('core_finished', function (e) {
    console.log('Leaflet core is finished loading');

    routingControl = L.Routing.control({
        router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig'),
        waypoints: [null],
        routeWhileDragging: true,
        createMarker: function() { return null; }
    }).on('routesfound', updateMarkersToRoute).addTo(map);

    map.doubleClickZoom.disable();
});

function placeMarker(e) {

    L.marker(e.latlng,{
        draggable: true,
        riseOnHover:true
    }).on('dragend', calculateRoute).addTo(placedMarkers);

    if (placedMarkers.getLayers().length > 1) {
        console.log(placedMarkers);
        calculateRoute();
    }
}

function updateMarkersToRoute(e) {
    placedMarkers.clearLayers();
    for (let i = 0; i < e.waypoints.length; i++) {
        L.marker(e.waypoints[i].latLng, {
            draggable: true,
            riseOnHover:true
        }).on('dragend', calculateRoute).addTo(placedMarkers);
    }
}

function removeMarker(e) {
    placedMarkers.removeLayer(e.layer);

    let routes = routingControl.getWaypoints();
    let newRoutes = [];

    for (let i = 0; i < routes.length; i++) {

        if((routes[i].latLng !== e.latlng) && (routes[i].latLng !== null)) {
            newRoutes.push(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng));
        }
    }
    routingControl.setWaypoints(newRoutes);
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