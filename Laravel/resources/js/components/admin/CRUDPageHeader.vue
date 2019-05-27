<template>
    <v-layout align-center justify-center row fill-height >
        <v-flex shrink class="hidden-sm-and-down v-card--reveal">
            <v-layout align-center justify-center fill-height>
                <v-img class="mt-2"
                        src="img/RoadLeaf-Logo.png"
                       height="100%"
                       max-height="100px"
                       contain
                       style="filter: brightness(0) invert(1);"
                       width="150px"/>
            </v-layout>
        </v-flex>
        <v-btn class="button-page-title title" flat @click="openEditProjectPage"> Projecten</v-btn>
        <v-btn class="button-page-title title" flat @click="openEditRoutesPage"> Interessepunten</v-btn>
        <v-btn class="button-page-title title" flat @click="openMediaPage"> Routes</v-btn>
        <v-spacer></v-spacer>
        <v-btn class="button-page-title title" icon flat color="white">
            <v-icon large> web</v-icon>
        </v-btn>
        <v-btn class="button-page-title title" icon flat color="white">
            <v-icon large> exit_to_app</v-icon>
        </v-btn>
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
            openMediaPage() {
                window.location.href = '/media';
            }
        }
    }
</script>

<style scoped>
    .button-page-title {
        color: white;
    }

    .button-page-title:hover {
        color: black;
    }

    .button-page-title:hover:before {
        background-color: transparent;
        color: black;
    }
</style>
