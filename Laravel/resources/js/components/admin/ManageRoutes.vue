<template>
    <div style="height: 100vh;">
        <div style="height: 80vh;">
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
        <div style="height: 100%">
            <v-layout column fill-height style="background-color: #89a226">
                <v-layout v-for="(point, index) in points" v-bind:key="point.id">

                    <div :key="(point, index)">
                        <h3>{{ point.name }}</h3>
                        <P>location: {{ point.location.coordinates[0] }}, {{ point.location.coordinates[1] }}</P>
                        <p>information: {{ point.information }} </p>
                        <input type="checkbox" :id="point.id"  v-on:click="toggleCheckbox(point, $event)">
                    </div>

                </v-layout>
            </v-layout>
        </div>
    </div>

</template>

<script>

    import {LMap, LTileLayer, LMarker, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    import axios from 'axios';

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

        data(){
            return{

                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

                points: [],
                routes: [],
                routeHasPoints: [],

                routingControl: null,
            }
        },
        mounted() {
            this.routingControl = leaflet_create.default.setVariables(this.$refs.map.mapObject);
            this.initialize();
        },

        methods: {
            initialize: function() {

                axios.post('/admin/route/data')
                    .then(response => {
                        this.points = response.data.points.slice(0);
                        this.routes = response.data.routes.slice(0);
                        this.routeHasPoints = response.data.routeHasPoints.slice(0);
                    })
                .catch(e => {
                    console.log(e);
                });
            },

            toggleCheckbox: function(point, event){
                if(event.target.checked) { this.placePoint(point); }
                else { this.removePoint(point); }
            },

            placePoint: function(point){

                let markers = leaflet_create.default.placeMarker( point );
                let waypoints = leaflet_create.default.createWaypoints( markers );

                if(markers.length < 2) return;

                console.log(this.routingControl);
                this.routingControl.setWaypoints( waypoints );
            },

            removePoint: function(point){
                leaflet_create.default.removeMarker( point );
            },

            resetCheckbox: function(id){
                let checkbox = document.getElementById(id);
                if (checkbox === null) return;

                checkbox.checked = true;
            }
        }
    }


</script>

<style>

</style>