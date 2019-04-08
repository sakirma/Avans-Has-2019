var mymap = L.map('leaflet').setView([52.143438, 6.215206], 7.5);
var markerGroup = [];



$(document).ready(function () {
    


    // TODO: This has to be done through the database. Retrieve the GeoJSON data and convert it using json_encode().
    L.geoJSON(example).addTo(mymap).on('click', () => { window.open("/project"); });;

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

    console.log(example);
});


function changeToCategory(cat){

    mymap.removeLayer(markerGroup);

    if(cat == "categorie 1"){
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.758065435566195, 5.3166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.718055435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.758045435566195, 5.1166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.708035435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }
    if(cat == "categorie 2"){
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.458065435566195, 5.3166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.418055435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.458045435566195, 5.1166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.408035435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }
    if(cat == "categorie 3"){
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.758065435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.718055435566195, 5.3166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.758045435566195, 5.4166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.608035435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }
    if(cat == "categorie 4"){
        markerGroup = L.layerGroup().addTo(mymap);
        new L.marker([51.358065435566195, 5.2166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.718055435566195, 5.4166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.258045435566195, 5.5166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
        new L.marker([51.808035435566195, 5.1166961669921875]).addTo(markerGroup).bindPopup('Dit is een marker. <a href="details/9">Lees meer</a>');
    }

}
