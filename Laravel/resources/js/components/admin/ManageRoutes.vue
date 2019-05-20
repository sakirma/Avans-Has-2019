<template>
    <div style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex>
                <l-map ref="map"
                       :zoom="zoom"
                       :center="center"
                       style="height:100%;">

                    <l-tile-layer :attribution="attribution" :url="url"></l-tile-layer>

                </l-map>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>

    import {LMap, LTileLayer, LMarker, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import 'leaflet-routing-machine/dist/leaflet-routing-machine.css';

    let leaflet_create = require('../../leaflet_create');

    export default {

        name: "ManageRoutes",

        components: {
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LControl,
        },

        mounted() {
            let routingControl = leaflet_create.default.init(this.$refs.map.mapObject);
            console.log(routingControl);
        },

        data(){
            return{
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                routingControl: null,
                map: null,
            }
        },
        method: {
            initialize: function() {

            },
        }
    }


</script>

<style>

</style>