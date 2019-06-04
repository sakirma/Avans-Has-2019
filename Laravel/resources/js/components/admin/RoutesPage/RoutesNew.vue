<template>
    <div class="projectEditSection" v-bar>
        <div class="pr-2">
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
                            <v-text-field  v-model="newRoute.name"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>


                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Kies een categorie:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="newRoute.category"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title v-model="newRoute.info" class="title">Beschrijving</v-card-title>
                        </v-flex>
                        <v-flex xs4>
                            <v-textarea box></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row align-start>
                        <v-card-title style="padding-top: 0 !important;" class="title">Punten toevoegen:</v-card-title>
                        <v-flex xs7 sm8 lg6 xl4>
                            <v-responsive max-height="250px">
                                <draggable
                                        tag="ul"
                                        v-model="routeList"
                                        v-bind="dragOptions"
                                        @start="drag=true"
                                        @end="drag=false"
                                >
                                    <template v-for="(route, index) in routeList">
                                        <div :key="index">
                                            <v-layout align-center justify-space-between row fill-height>
                                                <div style="width: 100%;" class="my-1 routeDrag" flat>
                                                    <v-layout align-center justify-center row fill-height
                                                              class="routeButton">
                                                        <v-card-text class="py-0 headline "
                                                                     style="color: rgba(137,163,36,0.75)">
                                                            {{route.name}}
                                                        </v-card-text>
                                                        <v-icon color="#89a324" class="mr-1">
                                                            list
                                                        </v-icon>
                                                    </v-layout>
                                                </div>
                                                <v-btn icon>
                                                    <v-icon large color="rgba(137,163,36,0.75)">
                                                        close
                                                    </v-icon>
                                                </v-btn>
                                            </v-layout>
                                        </div>
                                    </template>
                                </draggable>
                            </v-responsive>
                            <project-selection-list ref="selectionList"></project-selection-list>
                        </v-flex>
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

                <v-flex xs1>
                    <v-layout reverse row xs1>
                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text"
                                    @click="saveRouteToDatabase"
                            >
                                Route toevoegen
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

    import "leaflet/dist/leaflet.css";

    let leaflet_create = require('../../../leaflet_create');

    export default {
        name: "ProjectsEdit",
        components: {
            draggable,
            ProjectSelectionList,
        },
        props: {
            parent: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                newRoute: {},
                routeList: [],
            }
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        },
        methods: {
            createNewRouteButtonPressed(map, points) {
                console.log("Hij is hier!");
                this.map = map;
                this.routingControl = leaflet_create.default.setVariables(map);

                this.$refs.selectionList.addInterestPoints(points);

                let markers = leaflet_create.default.getProjectMarkers();
                markers.on('dblclick', this.removeFromView);
            },
            placePoint: function (point) {

                let markers = leaflet_create.default.placeMarker(point);
                let waypoints = leaflet_create.default.createWaypoints(markers);

                if (markers.length < 2) return;

                this.routingControl.setWaypoints(waypoints);
            },
            removePoint: function (point) {
                leaflet_create.default.removeMarker(point);
            },
            removeFromView(e) {
                let id = e.layer.options.id;
                this.$refs.selectionList.removeElementById(id);
            },
            saveRouteToDatabase(){
                leaflet_create.default.uploadRoute(this.newRoute.name)
            },
            close() {
                this.parent.enableViewMode();
            }
        },
    }
</script>

<style>
    .routeButton {
        border-style: solid;
        border-color: #89a324;
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
