<template>
    <div style="height: 100vh; background-color: #89a324">
        <v-container fluid fill-height py-0 px-0>
            <v-layout column>
                <v-flex xs1 d-flex mx-5 my-3>
                    <c-r-u-d-page-header></c-r-u-d-page-header>
                </v-flex>
                <v-flex d-flex style="background-color: white;">
                    <v-container fluid fill-height pt-3 pb-5>
                        <v-layout row fill-height>
                            <v-flex xs6 d-flex px-4>
                                <v-layout column fill-height>
                                    <v-flex xs1>
                                        <projects-header></projects-header>
                                    </v-flex>
                                    <v-flex d-flex style="background-color: red">
                                        <v-layout >

                                        </v-layout>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex d-flex>
                                <v-card color="orange">

                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import CRUDPageHeader from './CRUDPageHeader';
    import ProjectsHeader from './headers/ProjectsHeader'
    export default {
        name: "MainCrudPage",
        components: {
            CRUDPageHeader,
            ProjectsHeader
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
