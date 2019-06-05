<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex sm1 xs2 >
                <map-page-header :parent="this"></map-page-header>
            </v-flex>

            <v-flex style="position: relative">
                <map-component :parentPage="this">
                </map-component>
                <v-layout :class="{'ml-5': $vuetify.breakpoint.mdAndUp}"  align-end justify-start row style="position: absolute; bottom: 0; width: 100%;">
                    <v-flex xs12 md3 lg2>
                        <v-btn style="z-index: 1005;" depressed class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" @click="OpenRoutePagePressed">
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
                buttonImage: "img/MapPage/button.png",

                pressedImages: { activiteit: false, "eten en drinken": false, bezienswaardigheid: false, natuurgebied: false }
            }
        },
        methods: {
            filter(key){
                this.pressedImages[key] = !this.pressedImages[key];
            },
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId) {
                this.onProjectOpened(projectId);
            },
            OpenRoutePagePressed: function () {
                this.onRoutePageOpened();
            }
        },
        mounted() {
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
