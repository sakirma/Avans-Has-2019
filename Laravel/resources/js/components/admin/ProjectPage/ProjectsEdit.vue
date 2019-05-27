<template>
    <div class="projectEditSection">
        <v-layout align-center justify-space-between row>
            <v-card-title  class="display-1">Nieuw Project</v-card-title>
            <v-btn fab flat>
                <v-icon x-large color="green"> close </v-icon>
            </v-btn>
        </v-layout>
        <v-layout column fill-height>

        </v-layout>
    </div>
</template>

<script>
    export default {
        name: "ProjectsEdit"
    }
</script>

<style scoped>
.projectEditSection {
    height: 100%;
    border-radius: 20px;
    border-style: solid;
    border-width: 2px;
    border-color: #89a226;
}
</style>