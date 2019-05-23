<template>
    <div style="height: 100vh; background-color: #89a324">
        <v-container fluid fill-height py-0 px-0>
            <v-layout column>
                <v-flex xs1 d-flex mx-5 my-3>
                    <c-r-u-d-page-header></c-r-u-d-page-header>
                </v-flex>
                <v-flex d-flex style="background-color: white;">
                    <v-container fluid fill-height pa-0>
                        <v-layout row fill-height>
                            <v-flex xs6 d-flex px-4>
                                <v-layout column fill-height>
                                    <v-flex xs1>
                                        <v-layout row fill-height align-center justify-center>
                                            <v-flex xs1>
                                                <v-card-title class="display-2" style="color: #89a324;">
                                                    Projecten
                                                </v-card-title>
                                            </v-flex>
                                            <v-flex fill-height>
                                                <v-layout row fill-height align-center justify-end>
                                                    <v-flex xs2 align-self-center mx-3>
                                                        <v-btn block style="height: 100%;" color="#89a324">
                                                            <v-card style="white-space: normal;" color="transparent" flat class="white--text">
                                                                Project Toevoegen
                                                            </v-card>
                                                        </v-btn>
                                                    </v-flex>
                                                    <v-flex xs5>
                                                        <v-text-field solo hide-details round label="zoek een project" class="search-bar pa-0" flat append-icon="search"></v-text-field>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
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

    export default {
        name: "MainCrudPage",
        components: {
            CRUDPageHeader
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
