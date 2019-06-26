<template>
    <div style="height: 100vh;  background-color: #89a226;">
        <v-layout column fill-height>
            <v-flex shrink d-flex ma-3>
                <project-page-header :name="name"></project-page-header>
            </v-flex>

            <v-flex grow d-flex v-if="!$vuetify.breakpoint.xsOnly">
                <!--- Bigger Screen ---->
                <v-container ma-0 pl-0 fluid grid-list-md style="background-color: white; "
                >
                    <v-layout row fill-height>
                        <v-flex>
                            <v-layout column align-start fill-height>
                                <v-flex d-flex xs6
                                        :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]">
                                    <v-layout row style="background-color: #A0B550;">

                                        <v-flex xs10>
                                            <v-card flat
                                                    style=" background-color: transparent; position:relative; overflow-y: hidden; height: 100%;"
                                                    v-bar>
                                                <v-card-text style="position: absolute;" class="white--text">
                                                    {{ information }}
                                                    <br>
                                                    <!-- {{ comments }} -->
                                                </v-card-text>
                                            </v-card>
                                        </v-flex>

                                        <v-flex xs2 pa-0 v-bar>
                                            <div>
                                                <v-layout column justify-start align-start ma-0 fill-height>
                                                    <div class="text-xs-center"
                                                         style="background-color: rgba(255,255,255,0.3); width: 100%"
                                                         v-resize-text="{ratio:1, minFontSize: '10px', maxFontSize: '30px'}">
                                                        Meer zoals dit
                                                    </div>
                                                    <v-flex xs2 v-for="(suggestion, i) in suggestions" :key="i" style="width: 100%;" pa-0>
                                                        <v-card flat class="text-xs-center"
                                                                style="height: 100%; cursor: pointer; position:relative; overflow: hidden; background-color: rgb(209,218,172);"
                                                                @click="init(suggestion.id)" >
                                                            <div>
                                                                <b>{{suggestion.name}}</b>
                                                            </div>
                                                        </v-card>
                                                        <v-divider></v-divider>
                                                    </v-flex>
                                                </v-layout>
                                            </div>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                                <v-flex d-flex xs6
                                        :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                                        align-self-end>
                                    <v-carousel v-if="images.length > 0" height="100%">
                                        <v-carousel-item
                                                v-for="(image,i) in images"
                                                :key="i"
                                                :src="image"
                                        ></v-carousel-item>
                                    </v-carousel>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                        <v-flex lg4>
                            <v-card height="100%">
                                <map-component ref="mapComponent"></map-component>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>


            <!-- SMALLER SCREEN -->
            <v-container ma-0 pa-0 pt-1 fluid grid-list-md style="background-color: white; " v-else>
                <v-layout column fill-height>

                    <v-flex d-flex xs6 :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]">
                        <v-card flat style="background-color: #A0B550; position:relative; overflow-y: hidden;"
                                v-bar>
                            <v-card-text style="position: absolute;">
                                {{ information }}
                                <br>
                                <!--{{ comments }} -->
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex d-flex xs6 :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                            align-self-end>
                        <v-carousel v-if="images.length > 0" height="100%">
                            <v-carousel-item
                                    v-for="(image,i) in images"
                                    :key="i"
                                    :src="image"
                            ></v-carousel-item>
                        </v-carousel>
                    </v-flex>

                    <v-flex lg4>
                        <v-card height="100%">
                            <map-component ref="mapComponent"></map-component>
                        </v-card>
                    </v-flex>

                </v-layout>
            </v-container>

            <v-flex xs1 d-flex>
                <v-card height="100%" color="rgb(137, 162, 38, 1)">
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import ProjectPageHeader from './ProjectPageHeader';
    import MapComponent from './MapComponent';

    export default {
        name: "ProjectPage",
        data() {
            return {
                information: "",
                images: [],
                comments: [],
                mapPage: undefined,
                mapObjects: [],
                name: '',

                suggestions: [],
            }
        },
        props: {
            onProjectOpened: {
                type: Function,
            },
            parent: {
                type: Object,
                required: true
            }
        },
        methods: {
            init(pid) {

                this.images = [];
                this.suggestions = [];

                let id = pid;
                if (!id) {
                    id = this.$parent.selectedProjectPage.projectId;
                }

                let linkOne = "/getProjectPoint/";
                let linkTwo = "/getMediaFromProjectPoint/";
                if (this.$parent.selectedProjectPage.project) {
                    linkOne = "/getProject/";
                    linkTwo = "/getMediaFromProject/";
                }
                axios.get(linkOne + id).then(({data}) => {
                    this.information = data.information;
                    this.comments = data.comments;
                    this.name = data.name;
                    this.zoomToPoint(data.area, this.$parent.selectedProjectPage.project);

                    if (this.$parent.selectedProjectPage.project) {
                        this.findRecommendationsProjects(data, this);
                    } else {
                        this.findRecommendationsInterestPoint(data, this);
                    }


                });

                axios.get(linkTwo + id).then(({data}) => {
                    for (let i = 0; i < data.length; i++)
                        this.images.push("getmedia/" + data[i]);
                });

            },
            zoomToPoint(area, isProject) {
                let geom = area.geometries[0].coordinates;
                console.log(geom);

                let lat = 0, lng = 0;
                if (isProject) {

                    let geomLength = geom[0].length;
                    for (let i = 0; i < geomLength; i++) {
                        lat += geom[i][0]; // longitude
                        lng += geom[i][1]; // latitude'
                        return
                    }
                    lat /= geomLength;
                    lng /= geomLength;
                } else {
                    lat = geom[1];
                    lng = geom[0];
                }
                return;

                this.zoom = 12;
                // this.$refs.mapComponent.setZoom(this.zoom);
                console.log(L.LatLng(lat, lng));
                this.$refs.mapComponent.setCenter(L.latLng(lat, lng))
            },
            findRecommendationsInterestPoint(d, t) {
                axios.post('/projectpoints/similarIntrestPoint', {
                    id: d.id,
                    category: d.category,
                }).then(function (response) {
                    let projectPoints = response.data[0];
                    let images = response.data[1];


                    for (let i = 0; i < projectPoints.length; i++) {

                        let suggestion = {
                            id: projectPoints[i].id,
                            name: projectPoints[i].name,
                            information: projectPoints[i].information,
                            category: projectPoints[i].category,
                            path: ''
                        };

                        for (let j = 0; j < images.length; j++) {
                            if (images[j].id === suggestion.id) {
                                suggestion.path = images[j].location;
                                break;
                            }
                        }
                        t.suggestions.push(suggestion);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
            ,
            findRecommendationsProjects(d, t) {
                axios.post('/projectpoints/similarProject', {
                    id: d.id,
                    category: d.category,
                }).then(function (response) {
                    let projects = response.data[0];
                    let images = response.data[1];

                    for (let i = 0; i < projects.length; i++) {

                        let suggestion = {
                            id: projects[i].id,
                            name: projects[i].name,
                            information: projects[i].information,
                            category: projects[i].category,
                            path: ''
                        };

                        for (let j = 0; j < images.length; j++) {
                            if (images[j].id === suggestion.id) {
                                suggestion.path = "getmedia/" + images[j].location;
                                break;
                            }
                        }
                        t.suggestions.push(suggestion);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.$vuetify.goTo('#projectPage');
            this.mapPage = this.parent.getMapPage();
            this.$refs.mapComponent.assignParentPage(this);

            axios.get("/getAllMapObjects")
                .then(({data}) => {
                    for (let i = 0; i < data.length; i++) {
                        this.mapObjects.push(data[i]);
                        this.$refs.mapComponent.loadMapObjects(this.mapObjects);
                    }
                });
        }
        ,
        components: {
            ProjectPageHeader,
            MapComponent
        }
    }
</script>

<style>

</style>
