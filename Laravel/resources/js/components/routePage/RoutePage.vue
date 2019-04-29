<template>
    <div style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex xs1 ma-3>
                <map-page-header></map-page-header>
            </v-flex>

            <v-flex>
                <l-map ref="map"
                       :zoom="zoom"
                       :center="center"
                       style="height:100%;">
                    <v-layout :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-5': $vuetify.breakpoint.lgAndUp}"  column fill-height>
                        <v-layout align-start justify-start row mt-0>
                            <!--Leaflet map's z-index is 1000-->
                            <v-flex style="z-index: 701" xs12 md3 lg2>

                            </v-flex>

                            <!--Leaflet map's z-index is 1000-->
                            <v-flex style="z-index: 701" xs12 md3 lg2
                                    :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-3': $vuetify.breakpoint.lgAndUp}">

                            </v-flex>
                            <v-spacer></v-spacer>

                            <!--Leaflet map's z-index is 1000-->
                            <v-flex style="z-index: 701" shrink pt-1>
                                <v-text-field
                                        class="mx-3"
                                        solo
                                        prepend-inner-icon="search"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-layout>


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

    import MapPageHeader from "./map-page-header";
    import DropDownButton from "./mapPageButton/DropDownButton"

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
            MapPageHeader,
            DropDownButton,
            LMap,
            LTileLayer,
            LMarker,
            LPopup
        }
    }
</script>

<style scoped>

</style>