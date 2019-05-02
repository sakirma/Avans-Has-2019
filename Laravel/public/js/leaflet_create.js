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

function mousePlaceMarker(e) {

    L.marker(e.latlng,{
        draggable: true,
        riseOnHover:true
    }).on('dragend', calculateRoute).addTo(placedMarkers);

    if (placedMarkers.getLayers().length > 1) {
        console.log(placedMarkers);
        calculateRoute();
    }
}

function placeMarker(latlng){

    L.marker(latlng,{
        draggable: true,
        riseOnHover:true
    }).on('dragend', calculateRoute).addTo(placedMarkers);

    if (placedMarkers.getLayers().length > 1) { calculateRoute(); }
}

//TODO if marker is removed with mouse set checkmark on false
//TODO (Maybe) let the user change the order of the points

function removeMarker(latling){

    let routes = routingControl.getWaypoints();
    let layers = placedMarkers.getLayers();
    let newRoutes = [];

    console.log(placedMarkers);

    for (let i = 0; i < layers.length; i++) {
       let l = layers[i].getLatLng();
        if(l.equals(latling)) {
            placedMarkers.removeLayer(layers[i]);
        }
    }

    for (let i = 0; i < routes.length; i++) {

        if((!routes[i].latLng.equals(latling)) && (routes[i].latLng !== null)) {
            newRoutes.push(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng));
        }
    }
    routingControl.setWaypoints(newRoutes);
}

function onCheckbox(location, buttonId){

    console.log(location);
    console.log(buttonId);

    let checkbox = document.getElementById("button-"+buttonId).checked;
    let splited = location.split(" ");
    let latlng = L.latLng(parseFloat(splited[1]), parseFloat(splited[0]));

    if(checkbox) { placeMarker(latlng); }
    else { removeMarker(latlng); }
}

function updateMarkersToRoute(e) {
    placedMarkers.clearLayers();
    for (let i = 0; i < e.waypoints.length; i++) {
        L.marker(e.waypoints[i].latLng, {
            draggable: true,
            riseOnHover:true
        }).on('dragend', calculateRoute)
            .bindPopup( '<p>' + e.waypoints[i].latLng.lat + ' , ' + e.waypoints[i].latLng.lng + '</p>' +
                        'Naam: <input type="text" name="mName">' +
                        '<button onclick="validateForm()">Click me</button>'
            ).addTo(placedMarkers);
    }
}

function validateForm(latlng){
    /*let form = document.forms["MarkerInfo"];
    let name = form["mName"].value;*/
    console.log(latlng);
}

function mouseRemoveMarker(e) {
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

map.on('dblclick', mousePlaceMarker);
placedMarkers.on('dblclick', mouseRemoveMarker);
