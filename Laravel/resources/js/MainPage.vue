<template style="overflow-y: hidden">
    <div>
        <first-page></first-page>
        <map-page id="mapPage" :onProjectOpened="OpenProjectPage"></map-page>
        <project-page id="projectPage" v-if="selectedProjectPage.isSelected === true"></project-page>
    </div>
</template>

<script>
    import MapPage from './components/MapPage';
    import FirstPage from './components/FirstPage';
    import ProjectPage from './components/ProjectPage';

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
            }
        }
    }
</script>

<style>
    html {
        overflow: hidden;
    }
</style>