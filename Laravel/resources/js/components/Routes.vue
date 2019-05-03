<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex xs1 ma-3>
            </v-flex>

            <v-flex>
                <l-map ref="map"
                       :zoom="zoom"
                       :center="center"
                       style="height:100%;">

        <v-container ma-0 pa-0 fluid grid-list-md>
                        <v-layout align-start justify-end row fill-height>
                            <list-routes></list-routes>
                        </v-layout>
                    </v-container>

                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

                    <template v-for="(marker, index) in markers">
                        <l-marker :lat-lng="marker">
                            <l-popup>
                                <v-btn @click="OpenProjectPagePressed(1)"> To Project Page</v-btn>
                            </l-popup>
                        </l-marker>
                    </template>
                </l-map>
            </v-flex>

            <v-flex xs1>
                <v-card height="100%" color="rgb(137, 162, 38, 1)">
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import ListRoutes from "./routePage/list-routes";

    import MapPageHeader from "./map-page-header";
    import DropDownButton from "./mapPageButton/DropDownButton"

    export default {
        name: 'MapPage',
        components: {
            MapPageHeader,
            DropDownButton,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            ListRoutes
        },
    
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [L.latLng(51.7142669290121, 5.3173828125), L.latLng(51.7142669290121, 5.3153828125), L.latLng(51.7142669290121, 5.33828125)],


            }
        },
        methods: {
            OpenProjectPagePressed: function (projectId) {
                this.onProjectOpened(projectId);
            }
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
