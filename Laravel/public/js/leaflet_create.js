let projectMarkers = L.featureGroup().addTo(map);
let routingControl;
let newMarkers = [];

addEventListener('core_finished', function (e) {
    console.log('Leaflet core is finished loading');

    routingControl = L.Routing.control({
        router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig'),
        waypoints: [null],
        routeWhileDragging: false,
        createMarker: function() { return null; }
    }).on('routesfound', updateMarkersToRoute).addTo(map);

    map.doubleClickZoom.disable();
});

function mousePlaceMarker(e) {

    L.marker(e.latlng,{
        draggable: true,
        riseOnHover:true
    }).on('dragend', calculateRoute).addTo(projectMarkers);

    if (projectMarkers.getLayers().length > 1) {
        console.log(projectMarkers);
        calculateRoute();
    }
}

function mouseRemoveMarker(e) {
    projectMarkers.removeLayer(e.layer);

    let routes = routingControl.getWaypoints();
    let newRoutes = [];

    for (let i = 0; i < routes.length; i++) {

        if((routes[i].latLng !== e.latlng) && (routes[i].latLng !== null)) {
            newRoutes.push(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng));
        }
    }
    routingControl.setWaypoints(newRoutes);
    resetCheckbox(e.layer.options.id);
}

function uploadPlacedMarkers(){
    let layers = projectMarkers.getLayers();
    let placedMarkers = {
        latlng: [],
        name: [],
    };

    for (i=0; i<layers.length; i++){
        placedMarkers.latlng.push(layers[i].getLatLng());
        placedMarkers.name.push("Testname1");
    }

    /*let xhttp = new XMLHttpRequest();
    let token =  document.getElementsByName('csrf-token')[0].getAttribute('content');
    let jmarkers = JSON.stringify(placedMarkers);
    console.log(jmarkers);

    xhttp.open('POST', '/admin/create');
    xhttp.setRequestHeader('X-CSRF-Token', token);
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.send(jmarkers);*/
}
//TODO if ID null add it to project_point in database.
function uploadRoute(){

    let routeName = document.getElementById("routename").value;

    let layers = projectMarkers.getLayers();
    let distance = layers[0].options.distance;

    let route = {name: routeName, latlngs: [], ids: [], distance: distance};


    for (i=0; i<layers.length; i++){
        route.latlngs.push(layers[i].getLatLng());
        route.ids.push(layers[i].options.id);
    }

    let xhttp = new XMLHttpRequest();
    let token =  document.getElementsByName('csrf-token')[0].getAttribute('content');
    let jroute = JSON.stringify(route);

    xhttp.open('POST', '/admin/create');
    xhttp.setRequestHeader('X-CSRF-Token', token);
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.send(jroute);
}

function placeMarker(latlng, id){

    L.marker(latlng,{
        draggable: true,
        riseOnHover:true,
        id: id
    }).on('dragend', calculateRoute).addTo(projectMarkers);

    if (projectMarkers.getLayers().length > 1) { calculateRoute(id); }
}

//TODO if marker is removed with mouse set checkmark on false
//TODO (Maybe) let the user change the order of the points

function removeMarker(latling, id){

    let routes = routingControl.getWaypoints();
    let layers = projectMarkers.getLayers();
    let newRoutes = [];

    //Update leaflet layer
    for (let i = 0; i < layers.length; i++) {
       if(layers[i].options.id === id) {projectMarkers.removeLayer(layers[i]);}
    }
    //Update routing machine
    for (let i = 0; i < routes.length; i++) {
        if((routes[i].latLng !== null) && (!routes[i].latLng.equals(latling))){
            newRoutes.push(L.routing.waypoint(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng), routes[i].name, routes[i].name));
        }
    }
    routingControl.setWaypoints(newRoutes);
}

function onCheckbox(location, id){

    let checkbox = document.getElementById("button-"+id).checked;
    let spliced = location.split(" ");
    let latlng = L.latLng(parseFloat(spliced[1]), parseFloat(spliced[0]));

    if(checkbox) { placeMarker(latlng, id); }
    else { removeMarker(latlng, id); }
}

function resetCheckbox(id){
    let checkbox = document.getElementById('button-'+id);
    if ( checkbox === null ) return;

    checkbox.checked = false;
}

function updateMarkersToRoute(e) {
    projectMarkers.clearLayers();

    for (let i = 0; i < e.waypoints.length; i++) {
        let mId = e.waypoints[i].name;

        if(mId === undefined){ mId = Math.random().toString(36).substring(7); }

        L.marker(e.waypoints[i].latLng, {
            draggable: true,
            riseOnHover:true,
            id: mId,
            distance: e.routes[0].summary.totalDistance,
            travelTime: e.routes[0].summary.totalTime
        }).on('dragend', calculateRoute)
            .bindPopup( '<p>' + e.waypoints[i].latLng.lat + ' , ' + e.waypoints[i].latLng.lng + '</p>' +
                        'Naam: <input type="text" name="mName"><br>' +
                        'Info: <textarea style="border: solid gray;"> </textarea>' +
                        '<button onclick="saveMarker(`'+ mId +'`)">Click me</button>'
            ).addTo(projectMarkers);
    }
}

function saveMarker(id){
    let layers = projectMarkers.getLayers();
    for(i=0; i<layers.length; i++){
        if(layers[i].options.id === id){
            let content = layers[i].getPopup().getContent();
            console.log(content);
        }
    }
}

function calculateRoute(id) {

    let layers = projectMarkers.getLayers();
    let waypoints = [];

    for (let i = 0; i < layers.length; i++) {
        waypoints.push(L.routing.waypoint(L.latLng(layers[i].getLatLng().lat, layers[i].getLatLng().lng), layers[i].options.id, layers[i].options.id));
    }
    routingControl.setWaypoints(waypoints);
}

function deleteRoute(){
    let sRoute = document.getElementById("selectedRoute");
    let route = sRoute.options[sRoute.selectedIndex].value;
    if(route){
        let xhttp = new XMLHttpRequest();
        let token =  document.getElementsByName('csrf-token')[0].getAttribute('content');
    
        xhttp.open('POST', '/admin/remove/route');
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && xhttp.status == 200){
                alert(xhttp.response);
                location.reload();
            }
        }
        xhttp.setRequestHeader('X-CSRF-Token', token);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("routeID=" + route);
    }else{
        alert("You need to specify the route you want to delete");
    }
}

map.on('dblclick', mousePlaceMarker);
projectMarkers.on('dblclick', mouseRemoveMarker);
