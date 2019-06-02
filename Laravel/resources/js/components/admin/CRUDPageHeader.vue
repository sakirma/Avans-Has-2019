<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal">
            <v-layout align-center justify-center fill-height>
                <v-img class="mt-2 roadleafPhoto"
                       src="img/RoadLeaf-Logo.png"
                       height="100%"
                       max-height="100px"
                       contain
                       width="150px"
                       @click="openStatisticsPage"/>
            </v-layout>
        </v-flex>
        <v-btn class="button-page-title title" flat @click="openEditProjectPage"> Projecten</v-btn>
        <v-btn class="button-page-title title" flat @click="openEditRoutesPage"> Interessepunten</v-btn>
        <v-btn class="button-page-title title" flat @click="routesPage"> Routes</v-btn>
        <v-spacer></v-spacer>
        <v-btn class="button-page-title title" icon flat color="white">
            <v-icon large color="#032C4A"> web</v-icon>
        </v-btn>
        <v-btn class="button-page-title title" icon flat color="white">
            <v-icon large color="#032C4A"> exit_to_app</v-icon>
        </v-btn>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectPageHeader",
        props: {
            parent: {
                type: Object,
                required: true,
            }
        },
        methods: {
            openEditProjectPage() {
                this.parent.openEditProjectPage();
            },
            openStatisticsPage() {
                this.parent.openStatisticsPage();
            },
            openProjectPointPage() {
                window.location.href = '/admin/projectpoints';
            },
            openEditRoutesPage() {
                this.parent.openInterestPointPage();
            },
            routesPage() {
                this.parent.openRoutesPage();
            },
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

    .roadleafPhoto {
        filter: brightness(0) invert(1);
        cursor: pointer;
        transition: 0.2s;
    }

    .roadleafPhoto:hover {
        filter: brightness(0) invert(0);
    }
</style>
