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
                                    {{ information }}
                                    <br>
                                    <!-- {{ comments }} -->
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
            init() {
                this.images = [];
                let id = this.$parent.selectedProjectPage.projectId;
                axios.get("/getProjectPoint/"+id).then(({ data }) => {
                    this.information = data.information;
                    this.comments = data.comments;
                });

                axios.get("/getMediaFromProjectPoint/"+id).then(({ data }) => {
                    for(let i = 0; i < data.length; i++)
                        this.images.push("getmedia/" + data[i]);
                });
            }
        },
        mounted() {
            this.$vuetify.goTo('#projectPage');
            this.$refs.mapComponent.assignParentPage(this.mapPage);
            this.mapPage = this.parent.getMapPage();
        },
        components: {
            ProjectPageHeader,
            MapComponent
        }
    }
</script>

<style>

</style>
