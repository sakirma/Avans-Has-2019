<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex xs1 ma-3>
                <map-page-header></map-page-header>
            </v-flex>

            <v-flex>
                <l-map ref="map"
                       :zoom="zoom"
                       :center="center"
                       style="height:100%;">
                    <v-layout align-start justify-start row fill-height mt-0>
                        <!--TODO: Make a component from this-->
                        <!--Leaflet map's z-index is 1000-->
                        <v-flex style="z-index: 1001" xs12 md3 lg2
                                :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-5': $vuetify.breakpoint.lgAndUp}">

                            <drop-down-button title="IK WIL MEER ZIEN!"></drop-down-button>
                        </v-flex>

                        <!--Leaflet map's z-index is 1000-->
                        <v-flex style="z-index: 1001" xs12 md3 lg2
                                :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-3': $vuetify.breakpoint.lgAndUp}">
                            <drop-down-button title="IK WIL RECREËEREN!"></drop-down-button>
                        </v-flex>
                        <v-spacer></v-spacer>

                        <!--Leaflet map's z-index is 1000-->
                        <v-flex style="z-index: 1001" shrink pt-1>
                            <v-text-field
                                class="mx-3"
                                solo
                                prepend-inner-icon="search"
                            ></v-text-field>
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
    import DropDownButton from "./mapPageButton/DropDownButton"

    export default {
        name: 'MapPage',
        components: {
            MapPageHeader,
            LMap,
            LTileLayer,
            LMarker,
            DropDownButton,
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(47.413220, -1.219482),
                buttonImage: "img/MapPage/button.png"
            }
        },
        methods: {},
        mounted() {
            this.$refs.map.mapObject.zoomControl.remove();
            this.$refs.map.mapObject.scrollWheelZoom.disable();
        }
    }
</script>

<style scoped>

</style>
