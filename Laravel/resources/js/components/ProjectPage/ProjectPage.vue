<template>
    <div style="height: 100vh;  background-color: #89a226;">
        <v-layout column fill-height>
            <v-flex xs1 ma-3>
                <project-page-header></project-page-header>
            </v-flex>

            <v-container ml-0 pl-0 fluid grid-list-md style="background-color: white; "
                         v-if="!$vuetify.breakpoint.xsOnly">
                <v-layout row fill-height>
                    <v-layout column fill-height>
                        <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]">
                            <v-card flat style="background-color: #A0B550; position:relative; overflow-y: hidden;"
                                    v-bar>
                                <v-card-text style="position: absolute;">
                                    {{ Wows }}
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                                align-self-end>
                            <v-card flat class="primary" style="position:relative; overflow-y: hidden;" v-bar>
                                <v-card-text style="position: absolute;">
                                    {{ Wows }}
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>

                    <v-flex lg4>
                        <v-card height="100%">
                            <l-map ref="map"
                                   :zoom="zoom"
                                   :center="center"
                                   style="height:100%;">

                                <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

                                <template v-for="(marker, index) in markers">
                                    <l-marker :lat-lng="marker">
                                        <l-popup>
                                            <v-btn @click="OpenProjectPagePressed(1)"> To Project Page</v-btn>
                                        </l-popup>
                                    </l-marker>
                                </template>
                            </l-map>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>

            <!-- SMALLER SCREEN -->
            <v-container ma-0 pa-0 pt-1 fluid grid-list-md style="background-color: white; " v-else>
                <v-layout column fill-height>

                    <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]">
                        <v-card flat style="background-color: #A0B550; position:relative; overflow-y: hidden;"
                                v-bar>
                            <v-card-text style="position: absolute;">
                                {{ Wows }}
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                            align-self-end>
                        <v-card flat class="primary" style="position:relative; overflow-y: hidden;" v-bar>
                            <v-card-text style="position: absolute;">
                                {{ Wows }}
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex lg4>
                        <v-card height="100%">
                            <l-map ref="map"
                                   :zoom="zoom"
                                   :center="center"
                                   style="height:100%;">

                                <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

                                <template v-for="(marker, index) in markers">
                                    <l-marker :lat-lng="marker">
                                        <l-popup>
                                            <v-btn @click="OpenProjectPagePressed(1)"> To Project Page</v-btn>
                                        </l-popup>
                                    </l-marker>
                                </template>
                            </l-map>
                        </v-card>
                    </v-flex>

                </v-layout>
            </v-container>

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
    import ProjectPageHeader from './ProjectPageHeader';

    export default {
        name: "ProjectPage",
        data() {
            return {
                Wows: "WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW",
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [L.latLng(51.7142669290121, 5.3173828125), L.latLng(51.7142669290121, 5.3153828125), L.latLng(51.7142669290121, 5.33828125)],
            }

        },
        mounted() {
            this.$vuetify.goTo('#projectPage');
        },
        components: {
            ProjectPageHeader,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
        }
    }
</script>

<style>

</style>
