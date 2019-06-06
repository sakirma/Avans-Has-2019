<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #C3D091">
            <v-flex xs1>
                <route-page-header></route-page-header>
            </v-flex>

            <v-flex>
                <l-map :center="center" :zoom="zoom" id="map" ref="map" style="height:100%;">
                    <v-container fluid grid-list-md ma-0 pa-0>
                        <v-layout align-start fill-height justify-end row>
                            <list-routes :routesParent="this"></list-routes>
                        </v-layout>
                        <v-layout justify-end>
                            <v-btn class="putOnTop" v-on:click="exportToGoogle">Bekijk de route in Google Maps</v-btn>
                        </v-layout>
                    </v-container>

                    <l-tile-layer :attribution="attribution" :url="url"></l-tile-layer>

                    <template v-for="(marker, index) in markers">
                        <l-marker :key="index" :lat-lng="marker.latlng">
                            <l-popup>
                                <v-btn @click="OpenProjectPagePressed(1)">To Project Page</v-btn>
                            </l-popup>
                        </l-marker>
                    </template>

                </l-map>
            </v-flex>

            <v-flex xs1>
                <v-card height="100%" color="rgb(137, 162, 38, 1)"></v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import MapPage from "../MapPage";
    import {LMap, LTileLayer, LMarker, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    import RoutePageHeader from "./route-page-header";
    import ListRoutes from "./list-routes";

    import routing from "leaflet-routing-machine";
    import * as routeList from "../routelist.js";

    export default {
        name: "RoutePage",
        mounted() {
            this.$vuetify.goTo('#routePage');
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [],
                projectPoints: [],
                routingControl: null,
                map: null,
            };
        },
        components: {
            RoutePageHeader,
            ListRoutes,
            LMap,
            LTileLayer,
            LMarker,
            LPopup
        },
        methods: {
            GoToMapPage() {
                this.$parent.OpenMapPage();
            },
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId) {
                this.$root.onProjectOpened(projectId);
            },
            drawPoints: function ($arr) {
                this.markers = [];
                this.projectPoints = [];
                for (let i = 0; i < $arr.length; i++) {
                    this.projectPoints.push({location: $arr[i].location});
                    var pointId = this.projectPoints[i].id;
                    var lat = this.projectPoints[i].location.coordinates[1];
                    var lng = this.projectPoints[i].location.coordinates[0];
                    this.markers.push({
                        id: pointId,
                        latlng: L.latLng(parseFloat(lat), parseFloat(lng)),
                        content: ""
                    });
                }
                routeList.routeClicked(this.$refs.map.mapObject, this.projectPoints);
            },
            exportToGoogle: function () {
                if (this.projectPoints.length > 0) {
                    let url = "https://www.google.com/maps/dir/";
                    for (let i = 0; i < this.projectPoints.length; i++) {
                        url = url.toString() + this.projectPoints[i].location.coordinates[1].toString() + "," + this.projectPoints[i].location.coordinates[0].toString() + "/";
                    }
                    window.open(url, "_blank");
                }
            },
        }
    }
</script>

<style>
    .leaflet-top.leaflet-right {
        display: none;
    }

    .putOnTop {
        z-index: 1000;
    }
</style>