<template>
    <v-layout align-center justify-center row fill-height ml-3>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal">
            <v-layout align-center justify-center fill-height>
                <v-img src="img/RoadLeaf-Logo.png"
                       height="100%"
                       max-height="100px"
                       contain
                       style="filter: brightness(0) invert(1);"
                       width="150px"/>
            </v-layout>
        </v-flex>
        <v-flex pl-3>
            <v-btn @click="openEditProjectPage"> Projecten </v-btn>
        </v-flex>
        <v-flex>
            <v-btn @click="openEditRoutesPage"> Routes </v-btn>
        </v-flex>
        <v-flex>
            <v-btn @click="openCommentsPage"> Comments </v-btn>
        </v-flex>
        <v-flex grow>

        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectPageHeader",
        methods: {
            openEditProjectPage() {
                window.location.href = '/beheer/projecten';
            },
            openEditRoutesPage() {
                window.location.href = '/admin/route';
            },
            openCommentsPage() {
                window.location.href = '/admin/comments';
            }
        }
    }
</script>

<style scoped>

</style>