<template>
    <div class="projectEditSection" v-bar>
        <div>
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Route</v-card-title>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green">close</v-icon>
                </v-btn>
            </v-layout>
            <v-layout column>
                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Naam:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field :label="selectedRoute.name"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>


                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Kies een categorie:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Beschrijving</v-card-title>
                        </v-flex>
                        <v-flex xs4>
                            <v-textarea box></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row align-start>
                        <v-card-title style="padding-top: 0 !important;" class="title">Punten toevoegen:</v-card-title>
                        <project-selection-list ref="selectionList"></project-selection-list>
                    </v-layout>
                </v-flex>

                <v-flex xs1 pt-5>
                    <v-layout row>
                        <v-card-title class="title">Uitgerekende kilometers:</v-card-title>
                    </v-layout>
                </v-flex>
                <v-flex xs1>
                    <v-layout row>
                        <v-card-title class="title">Uitgerekende duur:</v-card-title>
                    </v-layout>
                </v-flex>

                <v-flex xs1 pr-5>
                    <v-layout reverse row xs1>
                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text">
                                Aanpassing toepassen
                            </v-card>
                        </v-btn>

                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text">
                                Route verijderen
                            </v-card>
                        </v-btn>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>
    </div>
</template>

<script>
    import draggable from "vuedraggable";
    import ProjectSelectionList from "./ProjectSelectionList";

    import {LMap, LTileLayer, LMarker, LControl, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import Options from "vue2-leaflet/src/mixins/Options";

    import axios from 'axios';
    let leaflet_create = require('../../../leaflet_create');

    export default {
        name: "ProjectsEdit",
        components: {
            Options,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LControl,
        },
        data() {
            return {
                selectedRoute: {
                    id: '', // ID is used to get data from database, as an example, to retrieve which image and youtube url is being used.
                    name: '',
                    categorie: '',
                    beschrijving: '',
                },

                point: [],
                selectedPoints[],

                map: null,
                routingControl: null,
            }
        },

        props: {
            parent: {
                type: Object,
                required: true,
            }
        },

        methods: {
            loadProjectPoints(id){
                console.log(id);
                axios.post('/admin/route/points', {
                    routeId: id,
                }).then(response => {
                        console.log(response);
                        response.data
                    });
            },
            loadRouteFromDataBase: function(id){

                let t = this;
                t.routingControl.getPlan().setWaypoints([]);

                leaflet_create.default.showRoute(id)
                    .then( function (response) {
                        console.log(response);
                        for(let i=0; i< response.length; i++){

                        }
                    });
            },
            placePoint: function(point){

                let markers = leaflet_create.default.placeMarker( point );
                let waypoints = leaflet_create.default.createWaypoints( markers );

                if(markers.length < 2) return;

                console.log(this.routingControl);
                this.routingControl.setWaypoints( waypoints );
            },

            projectEditSection(product, map) {
                this.selectedRoute = product;
                this.map = map;
                this.routingControl = leaflet_create.default.setVariables(map);
                this.loadProjectPoints(product.projectId);
            },
            close() {
                this.parent.enableViewMode();
            },
        },
        components: {
            draggable,
            ProjectSelectionList,
        }
    }
</script>

<style>
    .roundedCorners.v-input .v-input__control .v-input__slot {
        border-radius: 15px;
        background-color: rgba(137, 163, 36, 0.6);
    }

    .routeButton {
        border-style: solid;
        border-color: rgba(137, 163, 36, 0.6);
        border-width: 2px;
    }

    .routeDrag {
        cursor: grab;
    }

    .projectEditSection {
        height: 100%;
        border-radius: 20px;
        border-style: solid;
        border-width: 2px;
        border-color: #89a226;
    }

    .testingCSS::-webkit-scrollbar {
        display: none;
    }

    .projectTable .v-datatable .v-datatable__actions .v-datatable__actions__select {
        display: none;
    }

    .projectTable .v-table__overflow {
        overflow-y: hidden;
        padding-right: 15px;
    }

    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0, 0, 0, 0);
        transform: rotate3d(0, 0, 0, 0);
        -webkit-transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        background-color: rgba(38, 38, 38, 0.1);
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.3);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
    }
</style>
