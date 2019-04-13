var mymap = L.map('leaflet').setView([52.143438, 6.215206], 7.5);
var markerGroup = [];


$(document).ready(function () {
    initMap();
});

function initMap(){

    // TODO: This has to be done through the database. Retrieve the GeoJSON data and convert it using json_encode().
    /*L.geoJSON(example).addTo(mymap).on('click', () => {
        window.open("/priject");
    });
    */
    L.Routing.control({
        router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig'),
        waypoints: [
            L.latLng(51.738713, 5.392532),
            L.latLng(51.738288, 5.428931)
        ],
    }).addTo(mymap);

    // Call when pressed on a direction.
    L.tileLayer('https://api.mapbox.com/styles/v1/sakirma/cjsj37dym6e401gqi2zcu2aph/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'sakirma.cjsj37dym6e401gqi2zcu2aph',
        accessToken: 'pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig' // AccessToken has only read permission.
    }).addTo(mymap);

    mymap.locate({setView: true, maxZoom: 16});
}

mymap.on('locationfound',onLocationFound);
mymap.on('locationerror', onLocationError);

function onLocationError(e) {
    alert(e.message);
}

function onLocationFound(e) {
    let radius = e.accuracy / 2;
    let greenIcon = new L.icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    L.marker(e.latlng, {icon: greenIcon}).addTo(mymap)
        .bindPopup("You are within " + radius + " meters from this point").openPopup();

    L.circle(e.latlng, radius).addTo(mymap);
    console.log(e);

   getNearbyPoints(e);
}

function getNearbyPoints(e){
    let lat = e.latitude;
    let long = e.longitude;
    let latlng = e.latlng;

    var dummyArray = [
        [51.758065435566195, 5.3166961669921875],
        [51.718055435566195, 5.2166961669921875],
        [51.758045435566195, 5.1166961669921875],
        [51.708035435566195, 5.5166961669921875],
    ];

    $.ajax({
        method: 'POST',
        url: '/location',
        data: { 'lat': lat, 'long': long},
        dataType: 'json',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function( response ){
            for(var i=0; i < dummyArray.length; i++){
                let distance = calculateDistance(latlng, dummyArray[i]);
                console.log('Total: ' + distance);

                if (distance < 7) {

                    console.log('Accepted: ' + distance);

                    mymap.removeLayer(markerGroup);
                    markerGroup = L.layerGroup().addTo(mymap);
                    new L.marker(dummyArray[i]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
                }
            }
        },
    });
}

function calculateDistance(p1, p2){
    let lat1 = p1['lat'];
    let lon1 = p1['lng'];

    let lat2 = p2[0];
    let lon2 = p2[1];

    var R = 6371; // km (change this constant to get miles)
    var dLat = (lat2-lat1) * Math.PI / 180;
    var dLon = (lon2-lon1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
        Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    if (d>1) return Math.round(d);
    else if (d<=1) return Math.round(d*1000);
    return d; //Word terug gegeven in km
    //TODO Vul database
}

function changeToCategory(cat) {

    mymap.removeLayer(markerGroup);

    if (cat == "categorie 1") {
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.758065435566195, 5.3166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.718055435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.758045435566195, 5.1166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.708035435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }
    if (cat == "categorie 2") {
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.458065435566195, 5.3166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.418055435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.458045435566195, 5.1166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.408035435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }
    if (cat == "categorie 3") {
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.758065435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.718055435566195, 5.3166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.758045435566195, 5.4166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.608035435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }
    if (cat == "categorie 4") {
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.358065435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.718055435566195, 5.4166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.258045435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.808035435566195, 5.1166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }

}
