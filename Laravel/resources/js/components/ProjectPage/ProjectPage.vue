<template>
    <div style="height: 100vh;  background-color: #89a226;">
        <v-layout column fill-height>
            <v-flex xs1 ma-3>
                <project-page-header :name="name"></project-page-header>
            </v-flex>

            <v-container ml-0 pl-0 fluid grid-list-md style="background-color: white; "
                         v-if="!$vuetify.breakpoint.xsOnly">
                <v-layout row fill-height>
                    <v-layout column fill-height>
                        <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]">
                            <v-layout row fill-height style="background-color: #A0B550;">

                                <v-flex xs8>
                                    <v-card flat
                                            style=" background-color: transparent; position:relative; overflow-y: hidden; height: 100%;"
                                            v-bar>
                                        <v-card-text style="position: absolute;">
                                            {{ information }}
                                            <br>
                                            <!-- {{ comments }} -->
                                        </v-card-text>
                                    </v-card>
                                </v-flex>

                                <v-flex xs4>
                                    <v-layout column fill-height>
                                        <v-card v-for="(suggestion, i) in suggestions"
                                                :key="i"
                                                flat
                                                style="cursor: pointer; background-color: #acb581;; position:relative; overflow-y: hidden;"
                                                @click="init(suggestion.id)"
                                        >
                                            <v-img :src="suggestion.path"></v-img>
                                            <v-card-text>
                                                {{suggestion.name}} <br>
                                                {{suggestion.category}}
                                            </v-card-text>
                                        </v-card>
                                    </v-layout>
                                </v-flex>

                            </v-layout>
                        </v-flex>
                        <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                                align-self-end>
                            <v-card flat class="primary" style="position:relative; overflow-y: hidden;" v-bar>
                                <v-card-text style="position: absolute;">
                                    <v-carousel v-if="images.length > 0">
                                        <v-carousel-item
                                                v-for="(image,i) in images"
                                                :key="i"
                                                :src="image"
                                        ></v-carousel-item>
                                    </v-carousel>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>

                    <v-flex lg4>
                        <v-card height="100%">
                            <map-component ref="mapComponent"></map-component>
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
                                {{ information }}
                                <br>
                                <!--{{ comments }} -->
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex d-flex :style="[$vuetify.breakpoint.mdAndDown ? {'width': '100%'} : {'width': '75%'}]"
                            align-self-end>
                        <v-card flat class="primary" style="position:relative; overflow-y: hidden;" v-bar>
                            <v-card-text style="position: absolute;">
                                <v-carousel v-if="images.length > 0">
                                    <v-carousel-item
                                            v-for="(image,i) in images"
                                            :key="i"
                                            :src="image"
                                    ></v-carousel-item>
                                </v-carousel>
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex lg4>
                        <v-card height="100%">
                            <map-component ref="mapComponent"></map-component>
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

                    //this.findRecommendationsInterestPoint(data, this);
                    this.findRecommendationsProjects(data, this);
                });

                axios.get(linkTwo + id).then(({data}) => {
                    for (let i = 0; i < data.length; i++)
                        this.images.push("getmedia/" + data[i]);
                });
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
            },
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
            this.$refs.mapComponent.assignParentPage(this.mapPage);

            axios.get("/getAllMapObjects")
                .then(({data}) => {
                    for (let i = 0; i < data.length; i++) {
                        this.mapObjects.push(data[i]);
                    }
                    this.$refs.mapComponent.loadMapObjects(this.mapObjects);
                });
        },
        components: {
            ProjectPageHeader,
            MapComponent
        }
    }
</script>

<style>

</style>
