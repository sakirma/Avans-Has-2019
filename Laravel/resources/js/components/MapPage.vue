<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex sm1 xs2 >
                <map-page-header></map-page-header>
            </v-flex>

            <v-flex style="position: relative">
                <map-component :parentPage="this">
                </map-component>
                <v-layout :class="{'ml-5': $vuetify.breakpoint.mdAndUp}"  align-end justify-start row style="position: absolute; bottom: 0; width: 100%;">
                    <v-flex xs12 md3 lg2>
                        <v-btn style="z-index: 1005;" depressed class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" @click="OpenRoutePagePressed">
                            <v-layout column>
                                <v-flex class="white--text font-weight-bold">
                                    EEN ROUTE VOLGEN
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
                <v-layout row justify-start class="searchBarAboveMap">
                    <v-flex xs12>
                        <v-text-field
                            class="mx-3"
                            style="padding-top: 8px;"
                            prepend-inner-icon="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-flex>

            <v-flex xs1>
                <v-card height="100%" color="rgb(137, 162, 38, 1)">
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import MapPageHeader from "./map-page-header";
    import DropDownButton from "./mapPageButton/DropDownButton"
    import MapComponent from './ProjectPage/MapComponent';

    export default {
        name: 'MapPage',
        components: {
            MapPageHeader,
            DropDownButton,
            MapComponent
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
                polylines: [],
                rectangles: [],
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
            createPolygon: function (id, coordinates) {
                let points = [];
                for (let k = 0; k < coordinates[0].length; k++) {
                    points.push(L.latLng(coordinates[0][k][1], coordinates[0][k][0]));
                }
                this.polygons.push({"id": id, "latlng": points});
            },
            createPoint: function (id, coordinates) {
                this.markers.push({"id": id, "latlng": L.latLng(coordinates[1], coordinates[0])});
            },
            loadMapObjects: function () {
                axios.get('/getAllProjectPoints').then(({data}) => {
                    for (let i = 0; i < data.length; i++) {
                        if (data[i].info.type == "Point") {
                            this.createPoint(data[i].id, data[i].info.coordinates);
                        } else if (data[i].info.type == "GeometryCollection") {
                            for (let j = 0; j < data[i].info.geometries.length; j++) {
                                if (data[i].info.geometries[j].type == "Point") {
                                    this.createPoint(data[i].id, data[i].info.geometries[j].coordinates);
                                } else if (data[i].info.geometries[j].type == "Polygon") {
                                    this.createPolygon(data[i].id, data[i].info.geometries[j].coordinates);
                                } else {
                                    let points = [];
                                    for (let k = 0; k < data[i].info.geometries[j].coordinates.length; k++) {
                                        points.push(L.latLng(data[i].info.geometries[j].coordinates[k][1], data[i].info.geometries[j].coordinates[k][0]));
                                    }
                                    if (data[i].info.geometries[j].type == "LineString") this.polylines.push({
                                        "id": data[i].id,
                                        "latlng": points
                                    });
                                    else if (data[i].info.geometries[j].type == "Rectangle") this.rectangles.push({
                                        "id": [data[i].id],
                                        "latlng": points
                                    });
                                }
                            }
                        }
                    }
                });
            }
        },
        mounted() {
            this.loadMapObjects();

            let toRoutePageComponent = {
                // language=HTML
                template: `
                    <v-layout align-end justify-start row>
                        <v-flex xs12 md3 lg2>
                            <v-btn style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)"
                                   @click="OpenRoutePagePressed">
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
                `,
            }


        }
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0;
        border-radius: 10px 10px 0 0;
        height: 50px;
        width: 100%;
    }

    .searchBarAboveMap {
        position: absolute;
        z-index: 1000;
        bottom: 0;
        right: 0;
        width: 25%;
    }
</style>
