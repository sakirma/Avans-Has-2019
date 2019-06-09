<template>
    <div id="mapPage" style="height: 100vh;">
        <v-layout column fill-height style="background-color: #89a226">
            <v-flex sm1 xs2 >
                <map-page-header :parent="this"></map-page-header>
            </v-flex>

            <v-flex style="position: relative">
                <map-component ref="mapComponent">
                </map-component>
                <v-layout :class="{'ml-5': $vuetify.breakpoint.mdAndUp}" align-end justify-start row
                          style="position: absolute; bottom: 0; width: 100%;">
                    <v-flex xs12 md3 lg2>
                        <v-btn style="z-index: 1005;" depressed class="rounded-bottom-card" color="rgb(160, 181, 80, 1)"
                               @click="OpenRoutePagePressed">
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

                <v-layout column justify-start class="searchBarAboveMap" :fill-height="searchFieldIsFocused === true"
                          :class="{'backgroundOnFieldFocused': searchFieldIsFocused === true}">
                    <v-flex d-flex>
                        <v-layout row align-center justify-center>
                            <v-text-field
                                    hide-details
                                    class="mx-3 py-2"
                                    ref="field"
                                    prepend-inner-icon="search"
                                    solo
                                    v-model="searchInput"
                            >  </v-text-field>
                            <v-btn fab v-if="searchFieldIsFocused === true" @click="() => {this.searchFieldIsFocused = false}"> <v-icon large>close</v-icon> </v-btn>
                        </v-layout>
                    </v-flex>
                    <div v-bar>
                        <div>
                            <v-flex id="testing" class="removeScrollbar" xs12 v-if="searchFieldIsFocused === true">
                                <v-layout fill-height align-start justify-start>
                                    <v-list style="background-color: transparent; width: 100%; padding: 0;"
                                            class="white--text" two-line
                                            pt-0>
                                        <template v-for="(item, index) in filteredItems">
                                            <v-list-tile
                                                    :key="item.name"
                                                    avatar
                                                    ripple
                                                    style="background-color: rgba(137, 163, 36, 0.9);"
                                            >
                                                <v-list-tile-content>
                                                    <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                                                    <v-list-tile-sub-title class="white--text">{{ item.information }}
                                                    </v-list-tile-sub-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-divider
                                                    v-if="index + 1 < items.length"
                                                    :key="index"
                                            ></v-divider>
                                        </template>
                                    </v-list>
                                </v-layout>
                            </v-flex>
                        </div>
                    </div>
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

                pressedImages: { activiteit: false, "eten en drinken": false, bezienswaardigheid: false, natuurgebied: false },

                searchFieldIsFocused: false,
                searchInput: '',
                items: [],
                filteredItems: []
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
            },
            GetItems: function () {
                return this.items;
            }
        },
        watch: {
            searchInput: function(n, o){
                this.filteredItems = this.items.filter(item => {
                    return item.name.toLowerCase().includes(n.toLowerCase());
                });
            }
        },
        mounted() {
            this.$refs.mapComponent.assignParentPage(this);
            axios.get("/getAllMapObjects")
                .then(({ data }) => {
                    for(let i = 0; i < data.length; i++) {
                        this.items.push(data[i]);
                    }
                    console.log(this.items);
                    this.$refs.mapComponent.loadMapObjects(this.items);
                });

            this.$watch(
                () => {
                    return this.$refs.field.isFocused
                },
                (val) => {
                    if (val === true)
                        this.searchFieldIsFocused = true;
                }
            );
        }
    }
</script>

<style>
    .searchBarAboveMap .flex .v-input__control .v-input__slot {
        border-radius: 10px;
        border-style: solid;
        border-width: 1px;
        border-color: #b4c9cf;
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

<style scoped>
    .removeScrollbar::-webkit-scrollbar {
        display: none;
    }

    .backgroundOnFieldFocused {
        background-color: rgba(137, 163, 36, 0.58);
    }

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
