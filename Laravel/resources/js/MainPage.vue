<template>
    <v-app>
        <first-page></first-page>
        <map-page id="mapPage" :onProjectOpened="OpenProjectPage"></map-page>
        <!-- TODO: DEBUGGING Replace false with true.  -->
        <project-page id="projectPage" v-if="selectedProjectPage.isSelected === false"></project-page>
    </v-app>
</template>

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
            }
        },
        methods: {
            OpenProjectPage(projectId) {
                this.selectedProjectPage = {
                    isSelected: true,
                    projectId: projectId
                };

                // Debugging purpose
                if (this.selectedProjectPage.projectId === projectId)
                {
                    this.$vuetify.goTo("#projectPage");
                }
            }
        }
    }
</script>

<style scoped>
</style>