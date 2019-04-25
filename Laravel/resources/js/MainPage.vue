<template>
    <div v-resize="UpdateScreen">
        <first-page id="firstPage"></first-page>
        <map-page id="mapPage" :onProjectOpened="OpenProjectPage"></map-page>
        <!-- TODO: DEBUGGING Replace false with true.  -->
        <project-page id="projectPage" v-if="selectedProjectPage.isSelected === true"></project-page>
    </div>
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
            }
        },
        methods: {
            OpenProjectPage(projectId) {
                this.selectedProjectPage = {
                    isSelected: true,
                    projectId: projectId
                };

                // Debugging purpose
                if (document.getElementById('projectPage') && this.selectedProjectPage.projectId === projectId) {
                    this.$vuetify.goTo("#projectPage");
                }

                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.projectPage);
            },

            UpdateScreen() {
                let currentPageState = this.$store.getters.getCurrentPageState;
                let pageStates = this.$store.getters.pageStates;

                switch (currentPageState) {
                    case pageStates.startPage:
                        this.GoToSection('#firstPage');
                        break;
                    case pageStates.mapPage:
                        this.GoToSection('#mapPage');
                        break;
                    case pageStates.projectPage:
                        this.GoToSection('#projectPage');
                        break;
                }
            },
            GoToSection(id) {
                this.$vuetify.goTo(id, { duration: 500 } );
            },
        },
        mounted() {
            this.UpdateScreen();
        }
    }
</script>

<style scoped>

</style>
