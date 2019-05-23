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
                    <v-layout :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-5': $vuetify.breakpoint.lgAndUp}"  column fill-height>
                        <v-layout align-start justify-start row mt-0>
                            <!--Leaflet map's z-index is 1000-->
                            <v-flex style="z-index: 701" xs12 md3 lg2>
                                <drop-down-button buttonTitle="IK WIL MEER ZIEN!"
                                                  title="NATUURLIEFHEBER, DIT HEBBEN WE VOOR JE"
                                                  :items="LeftDropDownButton"></drop-down-button>
                            </v-flex>

                            <!--Leaflet map's z-index is 1000-->
                            <v-flex style="z-index: 701" xs12 md3 lg2
                                    :class="{'ml-0': $vuetify.breakpoint.smAndDown, 'ml-3': $vuetify.breakpoint.lgAndUp}">
                                <drop-down-button buttonTitle="IK WIL RECREËEREN!"
                                                  title="GENIET VAN HET LEVEN DOORMIDDEL VAN"
                                                  :items="RightDropDownButton"></drop-down-button>
                            </v-flex>
                            <v-spacer></v-spacer>

                            <!--Leaflet map's z-index is 1000-->
                            <v-flex style="z-index: 701" shrink pt-1 v-if="$vuetify.breakpoint.smAndUp">
                                <v-text-field
                                        class="mx-3"
                                        solo
                                        prepend-inner-icon="search"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>

                        <v-layout align-end justify-start row>
                            <v-flex xs12 md3 lg2>
                                <v-btn style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" @click="OpenRoutePagePressed">
                                    <v-layout column>
                                        <v-flex class="white--text font-weight-bold">
                                            ROUTES MAKEN
                                        </v-flex>
                                    </v-layout>
                                </v-btn>
                            </v-flex>

                            <v-flex xs12 md3 lg2 v-if="$vuetify.breakpoint.xsOnly">
                                <v-card style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)">
                                    <v-layout column>
                                        <v-flex class="white--text font-weight-bold">
                                            <v-text-field
                                                    class="mx-3"
                                                    style="padding-top: 8px;"
                                                    prepend-inner-icon="search"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-layout>


                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

                    <template v-for="(marker, index) in markers">
                        <l-marker :lat-lng="marker">
                            <l-popup>
                                <v-btn @click="OpenProjectPagePressed(1)"> To Project Page</v-btn>
                            </l-popup>
                        </l-marker>
                    </template>

                    <template v-for="(polygon, index) in polygons">
                        <l-polygon :lat-lngs="polygon">
                        </l-polygon>
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
    import {LMap, LTileLayer, LMarker, LPolygon, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

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
            LPolygon,
            LPopup
        },
        props: {
            onProjectOpened: {
                type: Function,
            },
            onRoutePageOpened: {
                type: Function,
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [],
                polygons: [],
                buttonImage: "img/MapPage/button.png",
                LeftDropDownButton: ['Projectnaam A', 'Projectnaam B', 'Projectnaam C'],
                RightDropDownButton: ['Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks'],

                popupContent: ' <button href="javascript:;" @click="console.log("wow")">terms</button>',
            }
        },
        methods: {
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId) {
                this.onProjectOpened(projectId);
            },
            OpenRoutePagePressed: function () {
                this.onRoutePageOpened();
            },
            loadMapObjects: function () {
                axios.get('/getAllProjectPoints').then(({ data }) => {
                    console.log(data);
                    for(let i = 0; i < data.length; i++){
                        if(data[i].type == "Point"){
                            this.markers.push(L.latLng(data[i].coordinates[1], data[i].coordinates[0]));
                        }else if(data[i].type == "GeometryCollection"){
                            for(let j = 0; j < data[i].geometries.length; j++){
                                if(data[i].geometries[j].type == "Polygon"){
                                    let points = [];
                                    console.log("length of polygon coordinates: " + data[i].geometries[j].coordinates[0].length);
                                    for(let k = 0; k < data[i].geometries[j].coordinates[0].length; k++){
                                        points.push(L.latLng(data[i].geometries[j].coordinates[0][k][1], data[i].geometries[j].coordinates[0][k][0]));
                                    }
                                    this.polygons.push(points);
                                }else if(data[i].geometries[j].type == "Point"){
                                    this.markers.push(L.latLng(data[i].geometries[j].coordinates[1], data[i].geometries[j].coordinates[0]));
                                }
                            }
                        }
                    }
                    console.log(this.polygons);
                });
            }
        },
        mounted() {
            this.loadMapObjects();
        }
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 10px 10px 0px 0px;
        height: 50px;
        width: 100%;
    }
</style>
