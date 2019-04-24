<template>
 <v-app>
        <first-page></first-page>
        <map-page id="mapPage" :onProjectOpened="OpenProjectPage"></map-page>
        <!-- TODO: DEBUGGING Replace false with true.  -->
        <project-page id="projectPage" v-if="selectedProjectPage.isSelected === true"></project-page>
         <h1>hi</h1>
    </v-app>
   
</template>


<script>

import MapPage from './MapPage';

    export default {
        name: "RoutesComponent"
    }
</script>

<style scoped>
</style>