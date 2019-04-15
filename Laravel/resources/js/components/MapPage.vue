<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex xs1 ma-3 >
                <map-page-header></map-page-header>
            </v-flex>

            <v-flex>
                <l-map ref="map"
                       :zoom="zoom"
                       :center="center"
                       style="height:100%;">
                    <v-layout align-start justify-start row fill-height mt-0>
                        <!--Leaflet map's z-index is 1000-->
                        <v-flex style="z-index: 1001" shrink pl-4 pr-3>
                            <v-img v-bind:src="buttonImage"
                                   max-height="100px"
                                   contain
                                   width="200px">

                            </v-img>
                        </v-flex>

                        <!--Leaflet map's z-index is 1000-->
                        <v-flex style="z-index: 1001">
                            <v-img v-bind:src="buttonImage"
                                   max-height="100px"
                                   contain
                                   width="200px"/>
                        </v-flex>
                    </v-layout>


                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker :lat-lng="marker"></l-marker>
                </l-map>
            </v-flex>

            <v-flex xs1>
                <v-card height="100%" color="rgb(137, 162, 38, 1)">
                    sadasdasdasd
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import MapPageHeader from "./map-page-header";

    export default {
        name: 'MapPage',
        components: {
            MapPageHeader,
            LMap,
            LTileLayer,
            LMarker
        },
        data() {
            return {
                zoom: 13,
                center: L.latLng(47.413220, -1.219482),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(47.413220, -1.219482),
                buttonImage: "img/MapPage/button.png"
            }
        },
        methods: {
            mounted() {
                setTimeout(function () {
                    window.dispatchEvent(new Event('resize'))
                }, 250);
            }
        },
        mounted() {
            this.$refs.map.mapObject.zoomControl.remove();
            this.$refs.map.mapObject.scrollWheelZoom.disable();
        }
    }
</script>

<style scoped>
</style>
