<template>
    <div style="height: 100vh;">
        <v-layout column fill-height style="background-color: #C3D091">
            <v-flex xs1>
                <route-page-header></route-page-header>
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
    import {LMap, LTileLayer, LMarker, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    import RoutePageHeader from "./route-page-header";
    import ListRoutes from "./list-routes";

    export default {
        name: "RoutePage",
        mounted() {
            this.$vuetify.goTo('#routePage');
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [L.latLng(51.7142669290121, 5.3173828125), L.latLng(51.7142669290121, 5.3153828125), L.latLng(51.7142669290121, 5.33828125)],
                buttonImage: "img/MapPage/button.png",
                LeftDropDownButton: ['Projectnaam A', 'Projectnaam B', 'Projectnaam C'],
                RightDropDownButton: ['Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks'],

                popupContent: ' <button href="javascript:;" @click="console.log("wow")">terms</button>',
            }
        },
        components: {
            RoutePageHeader,
            ListRoutes,
            LMap,
            LTileLayer,
            LMarker,
            LPopup
        }
    }
</script>

<style scoped>

</style>