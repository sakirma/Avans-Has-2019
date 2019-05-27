<template>
    <div style="height: 100vh; background-color: #89a324">
        <v-container fluid fill-height py-0 px-0>
            <v-layout column>
                <v-flex xs2 d-flex mx-5 my-3 style="max-height: 100px;">
                    <c-r-u-d-page-header></c-r-u-d-page-header>
                </v-flex>
                <v-flex d-flex style="background-color: white;">
                    <project-page></project-page>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import CRUDPageHeader from './CRUDPageHeader';
    import ProjectPage from './ProjectPage/ProjectPage';

    export default {
        name: "MainCrudPage",
        components: {
            CRUDPageHeader,
            ProjectPage
        },
        data() {
            return {
                crudPageState: { 'Projecten': 0, 'Interessepunten': 1, 'Routes': 2, 'Statistieken': 3 },
                currentCrudPageState: 3,
            }
        }
    }
</script>

<style>
    .search-bar.v-input .v-input__control .v-input__slot {
        border-radius: 20px;
        border-style: solid;
        border-width: 2px;
        border-color: rgba(174, 195, 207, 0.21);
    }
</style>
