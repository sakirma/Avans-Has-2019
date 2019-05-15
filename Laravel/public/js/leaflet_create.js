import * as leaflet_core from './leaflet_core';

let leaflet_route_create = (function() {

    let projectMarkers = L.featureGroup().addTo(map);
    let routingControl;
    let newMarkers = [];

    console.log(leaflet_core);

    addEventListener('core_finished', function (e) {
        console.log('Leaflet core is finished loading');

        routingControl = L.Routing.control({
            router: L.Routing.mapbox('pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig'),
            waypoints: [null],
            routeWhileDragging: false,
            addWaypoints: false,
            createMarker: function () {
                return null;
            }
        }).on('routesfound', updateMarkersToRoute).addTo(map);

        map.doubleClickZoom.disable();
    });

    projectMarkers.on('dblclick', mouseRemoveMarker);

    return {

        /*function mousePlaceMarker(e) {

            L.marker(e.latlng,{
                draggable: true,
                riseOnHover:true
            }).on('dragend', calculateRoute).addTo(projectMarkers);

            if (projectMarkers.getLayers().length > 1) {
                console.log(projectMarkers);
                calculateRoute();
            }
        }*/

        mouseRemoveMarker: function (e) {
            projectMarkers.removeLayer(e.layer);

            let routes = routingControl.getWaypoints();
            let newRoutes = [];

            for (let i = 0; i < routes.length; i++) {

                if ((routes[i].latLng !== e.latlng) && (routes[i].latLng !== null)) {
                    newRoutes.push(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng));
                }
            }
            routingControl.setWaypoints(newRoutes);
            this.resetCheckbox(e.layer.options.id);
        },

        uploadRoute: function () {

            let routeName = document.getElementById("routename").value;

            let layers = projectMarkers.getLayers();

            if (layers.length < 1) return window.alert("Creëer eerst een route!");

            let distance = layers[0].options.distance;

            let route = {name: routeName, latlngs: [], ids: [], distance: distance};


            for (i = 0; i < layers.length; i++) {
                route.latlngs.push(layers[i].getLatLng());
                route.ids.push(layers[i].options.id);
            }

            let xhttp = new XMLHttpRequest();
            let token = document.getElementsByName('csrf-token')[0].getAttribute('content');
            let jroute = JSON.stringify(route);

            xhttp.open('POST', '/admin/create/route');
            xhttp.setRequestHeader('X-CSRF-Token', token);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp.send(jroute);

            window.alert("Route aangemaakt!");
            window.location = '/admin/route';
        },

        placeMarker: async function (latlng, id) {

            let projectInfo = await getProjectInfo(id);
            let marker = L.marker(latlng, {
                draggable: false,
                riseOnHover: true,
                id: id,
                info: projectInfo
            }).bindPopup(
                '<p>' + latlng + '</p>' +
                '<p> Naam: ' + projectInfo[0].name + '</p>' +
                '<p> Informatie: ' + projectInfo[0].information + '</p>'
            )
                .addTo(projectMarkers);
            // .on('dragend', calculateRoute)
            console.log(marker);

            if (projectMarkers.getLayers().length > 1) {
                this.calculateRoute(id);
            }
        },

        getProjectInfo: function (id) {

            let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

            return fetch('/admin/get/project', {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                    'X-CSRF-Token': token,
                },
                body: 'id=' + id,
            })
                .then(function (res) {
                    return res.json();
                })
                .catch(function (err) {
                    console.log(err)
                });
        },

        removeMarker: function (latling, id) {

            let routes = routingControl.getWaypoints();
            let layers = projectMarkers.getLayers();
            let newRoutes = [];

            //Update leaflet layer
            for (let i = 0; i < layers.length; i++) {
                //TODO (bug) options.id is sometimes int sometimes string (temp workaround)
                if (layers[i].options.id == id) {
                    projectMarkers.removeLayer(layers[i]);
                }
            }
            //Update routing machine
            for (let i = 0; i < routes.length; i++) {
                if ((routes[i].latLng !== null) && (!routes[i].latLng.equals(latling))) {
                    newRoutes.push(L.routing.waypoint(L.latLng(routes[i].latLng.lat, routes[i].latLng.lng), routes[i].name, {
                        name: routes[i].name,
                        info: routes[i].options.info
                    }));
                }
            }
            routingControl.setWaypoints(newRoutes);
        },

    //TODO refactor for vue
        onCheckbox: function (location, id) {

            let checkbox = document.getElementById("button-" + id).checked;
            let spliced = location.split(" ");
            let latlng = L.latLng(parseFloat(spliced[1]), parseFloat(spliced[0]));

            if (checkbox) {
                this.placeMarker(latlng, id);
            } else {
                this.removeMarker(latlng, id);
            }
        },

        resetCheckbox: function (id) {
            let checkbox = document.getElementById('button-' + id);
            if (checkbox === null) return;

            checkbox.checked = false;
        },

        checkCheckbox: function (id) {
            let checkbox = document.getElementById('button-' + id);
            if (checkbox === null) return;

            checkbox.checked = true;
        },

        updateMarkersToRoute: function (e) {
            projectMarkers.clearLayers();

            for (let i = 0; i < e.waypoints.length; i++) {

                let elem = document.getElementById("travel-info");
                let mId = e.waypoints[i].name;
                let projectInfo = e.waypoints[i].options.info;

                if (mId === undefined) {
                    mId = Math.random().toString(36).substring(7);
                }

                L.marker(e.waypoints[i].latLng, {
                    draggable: false,
                    riseOnHover: true,
                    id: mId,
                    info: projectInfo,
                    distance: e.routes[0].summary.totalDistance,
                    travelTime: e.routes[0].summary.totalTime
                })
                    .bindPopup(
                        '<p>' + e.waypoints[i].latLng.lat + ' , ' + e.waypoints[i].latLng.lng + '</p>' +
                        '<p> Naam: ' + projectInfo[0].name + '</p>' +
                        '<p> Informatie: ' + projectInfo[0].information + '</p>'
                    ).addTo(projectMarkers);
                //.on('dragend', calculateRoute)

                let c = elem.childNodes;
                c[1].innerHTML = "Totale km: " + Math.round((e.routes[0].summary.totalDistance / 1000) * 100) / 100;
                c[3].innerHTML = "Totale reistijd: " + (timeConvert(e.routes[0].summary.totalTime));
            }
        },

        timeConvert: function (n) {
            let num = n;
            let min = (num / 60);
            let rmin = Math.floor(min);
            let hours = (rmin / 60);
            let rhours = Math.floor(hours);
            let minutes = (hours - rhours) * 60;
            let rminutes = Math.round(minutes);
            return rhours + " uur(en) en " + rminutes + " minuut(en).";
        },

        saveMarker: function (id) {
            let layers = projectMarkers.getLayers();

            for (i = 0; i < layers.length; i++) {
                if (layers[i].options.id === id) {
                    let content = layers[i].getPopup().getContent();
                    console.log(content);
                }
            }
        },

        calculateRoute: function () {

            let layers = projectMarkers.getLayers();
            let waypoints = [];

            for (let i = 0; i < layers.length; i++) {
                waypoints.push(L.routing.waypoint(L.latLng(layers[i].getLatLng().lat, layers[i].getLatLng().lng), layers[i].options.id, {
                    id: layers[i].options.id,
                    info: layers[i].options.info
                }));
            }
            routingControl.setWaypoints(waypoints);
        },

        showRoute: function () {

            projectMarkers.clearLayers();

            let sRoute = document.getElementById("selectedRoute");
            let route = sRoute.options[sRoute.selectedIndex].value;

            let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

            fetch('/admin/get/points', {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
                    'X-CSRF-Token': token,
                },
                body: 'routeId=' + route,

            })
                .then(function (res) {
                    return res.json();
                })
                .then(function (data) {

                    let points = JSON.parse(JSON.stringify(data));
                    for (let i = 0; i < points.length; i++) {

                        let id = points[i][0];
                        let location = points[i][1];
                        let latlng = L.latLng(location.coordinates[1], location.coordinates[0]);

                        console.log(id);

                        this.placeMarker(latlng, id);
                        this.checkCheckbox(id);
                    }
                })
                .catch(function (error) {
                    console.log('Request failed', error);
                });
        },

        deleteRoute: function () {
            let sRoute = document.getElementById("selectedRoute");
            let route = sRoute.options[sRoute.selectedIndex].value;
            if (route) {
                let xhttp = new XMLHttpRequest();
                let token = document.getElementsByName('csrf-token')[0].getAttribute('content');

                xhttp.open('POST', '/admin/remove/route');
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        alert(xhttp.response);
                        location.reload();
                    }
                }
                xhttp.setRequestHeader('X-CSRF-Token', token);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.send("routeID=" + route);
            } else {
                alert("You need to specify the route you want to delete");
            }
        },

    //map.on('dblclick', mousePlaceMarker);
    }

})();

