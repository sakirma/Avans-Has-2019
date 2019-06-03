<template>
    <v-container fluid fill-height pt-3 pb-5>
        <v-layout row fill-height justify-space-around>
            <v-flex xs6 class="ml-5">
                <interest-point-view :parent="this" :headers="headers" :project_points="project_points"
                                     v-if="currentPageState === ProjectPageStates.viewMode"></interest-point-view>
                <interest-point-new  v-on:close="clearmap" :parent="this" :projects="projects" :projectNames="projectNames" :projectIds="projectIds" :marker="marker"
                                    v-else-if="currentPageState === ProjectPageStates.newMode"></interest-point-new>
                <interest-point-edit :parent="this" ref="projectEditSection" :projects="projects" :projectNames="projectNames" :projectIds="projectIds"
                                     v-show="currentPageState === ProjectPageStates.editMode"></interest-point-edit>
            </v-flex>
            <v-flex d-flex xs5>
                <map-section  ref="mapSection" :parent="this" v-on:childToParent="onChildClick" :markers="marker"></map-section>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import MapSection from './InterestPointMap';
    import InterestPointView from './InterestPointView';
    import InterestPointNew from './InterestPointNew';
    import InterestPointEdit from './InterestPointEdit'

    export default {
        name: "InterestPointPage",
        components: {
            MapSection,
            InterestPointView,
            InterestPointNew,
            InterestPointEdit
        },
        data() {
            return {
                ProjectPageStates: {'viewMode': 0, 'editMode': 1, 'newMode': 2},
                currentPageState: 0,
                project_points: [],
                projects: [],
                projectNames: [],
                projectIds: [],
                categories: [],
                marker:[],

                headers: [
                    {
                        text: 'Naam',
                        align: 'left',
                        value: 'name',
                    },
                    {
                        text: 'Categorie',
                        align: 'left',
                        value: 'category',
                    },
                    {
                        text: 'Project',
                        align: 'left',
                        value: 'projectId',
                    },
                    {
                        text: 'Beschrijving',
                        align: 'left',
                        value: 'text'
                    },
                ],
            }
        },
        methods: {
            clearmap(){
                console.log("helloooo");
              this.marker = null;
            },
            onChildClick (value) {
                this.marker = value

            },
            newProjectButtonPressed() {
                this.currentPageState = this.ProjectPageStates.newMode;
                this.$refs.mapSection.setdrawMode(true);
            },
             loadPoints(){
                axios.get("/getProjectPoints").then(response => {this.project_points = response.data})
                    .catch(function (error) {
                    console.log(error);
                });
            },
            enableViewMode() {
                this.currentPageState = this.ProjectPageStates.viewMode;
                this.$refs.mapSection.setdrawMode(false);

            },
            editAProject(product) {
                this.currentPageState = this.ProjectPageStates.editMode;
                this.$refs.projectEditSection.projectEditSection(product);
            }
        },
        mounted() {

            this.loadPoints();

            // Get all project
            window.axios.get('/getProjects').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.projects.push({id: temp[i].id.toString(), name: temp[i].name.toString()});
                    this.projectNames.push( temp[i].name.toString());
                    this.projectIds.push( temp[i].id.toString());
                }
            }).catch(function (error) {
                console.log(error);
            });

        }
    }
</script>

<style scoped>

</style>