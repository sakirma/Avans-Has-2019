<template>
    <div style="height: 100vh; background-color: #89a324">
        <v-container fluid fill-height py-0 px-0>
            <v-layout column>
                <v-flex xs2 d-flex mx-5 my-3 style="max-height: 100px;">
                    <c-r-u-d-page-header :parent="this"></c-r-u-d-page-header>
                </v-flex>
                <v-flex d-flex style="background-color: white;">
                    <project-page v-if="currentCrudPageState === crudPageState.Projects"></project-page>
                    <statistics-page v-else-if="currentCrudPageState === crudPageState.Statistics"></statistics-page>
                    <interest-point-page v-else-if="currentCrudPageState === crudPageState.InterestPoints" ></interest-point-page>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import CRUDPageHeader from './CRUDPageHeader';
    import ProjectPage from './ProjectPage/ProjectPage';
    import StatisticsPage from './StatisticsPage';
    import InterestPointPage from './InterestPoint/InterestPointPage'

    export default {
        name: "MainCrudPage",
        components: {
            CRUDPageHeader,
            ProjectPage,
            StatisticsPage,
            InterestPointPage
        },
        data() {
            return {
                crudPageState: { 'Projects': 0, 'InterestPoints': 1, 'Routes': 2, 'Statistics': 3 },
                currentCrudPageState: 3,
            }
        },
        methods: {
            openEditProjectPage() {
                this.currentCrudPageState = this.crudPageState.Projects;
            },
            openStatisticsPage() {
                this.currentCrudPageState = this.crudPageState.Statistics;
            },
            openInterestPointPage() {
                this.currentCrudPageState = this.crudPageState.InterestPoints;
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
