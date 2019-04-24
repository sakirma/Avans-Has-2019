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
                            <v-btn class="rounded-bottom-card" color="rgb(160, 181, 80, 1)">
                                <v-layout xs3 column>
                                    <v-flex class="white--text font-weight-bold">
                                        IK WIL MEER ZIEN!
                                    </v-flex>
                                    <v-icon style="height: 10px;" large color="white">
                                        expand_more
                                    </v-icon>
                                </v-layout>
                            </v-btn>
                        </v-flex>

                        <!--Leaflet map's z-index is 1000-->
                        <v-flex style="z-index: 1001" xs12 md3 lg2
                                :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-3': $vuetify.breakpoint.lgAndUp}">
                            <v-btn class="rounded-bottom-card" color="rgb(160, 181, 80, 1)">
                                <v-layout xs3 column>
                                    <v-flex class="white--text font-weight-bold">
                                        IK WIL RECREËREN!
                                    </v-flex>
                                    <v-icon style="height: 10px;" large color="white">
                                        expand_more
                                    </v-icon>
                                </v-layout>
                            </v-btn>

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
                    <l-marker v-for="marker, index in markers" :key=index :lat-lng="marker"></l-marker>
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
    import {LMap, LTileLayer, LMarker, LControl} from 'vue2-leaflet';
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
                buttonImage: "img/MapPage/button.png",
                markers: [
        L.latLng(51.758065435566195, 5.3166961669921875), L.latLng(51.76065435566195, 5.3166961669921875)
      ]

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
        }
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 0px 0px 10px 10px;
        height: 50px;
        width: 100%;
    }
</style>
