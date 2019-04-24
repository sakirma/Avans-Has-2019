<template>
    <v-app>
        <first-page></first-page>
        <map-page id="mapPage" :onProjectOpened="OpenProjectPage"></map-page>
        <!-- TODO: DEBUGGING Replace false with true.  -->
        <project-page id="projectPage" v-if="selectedProjectPage.isSelected === true"></project-page>
    </v-app>
</template>

<!-- TODO: Scroll back to project page when the window is re-sized. -->
<script>
    import MapPage from './components/MapPage';
    import FirstPage from './components/FirstPage';
    import ProjectPage from './components/ProjectPage/ProjectPage';

    export default {
        name: "MainPage",
        components: {
            MapPage,
            FirstPage,
            ProjectPage,
        },
        data() {
            return {
                selectedProjectPage: {
                    isSelected: false,
                    projectId: undefined
                },

                pageState: { "startPage":1, "mapPage":2, "projectPage":3, },
                currentPageState: undefined,
            }
        },
        methods: {
            OpenProjectPage(projectId) {
                this.selectedProjectPage = {
                    isSelected: true,
                    projectId: projectId
                };

                this.currentPageState = this.pageState.projectPage;
                // Debugging purpose
                if (document.getElementById('projectPage') && this.selectedProjectPage.projectId === projectId) {
                    this.$vuetify.goTo("#projectPage");
                }
            },

            UpdateScreen()
            {

            }
        },
        mounted() {
            this.currentPageState = this.pageState.startPage;
        }
    }
</script>

<style scoped>
</style>
