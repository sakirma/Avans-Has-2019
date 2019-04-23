<template>
    <div style="height: 100vh; background-color: #89a226;">
        <v-layout fill-height column>
            <v-flex xs1 ma-3>
                <project-page-header></project-page-header>
            </v-flex>
            <v-flex style="background-color: red" grow>

                <v-layout row fill-height>
                    <v-flex ma-3 style="background-color: white" grow>
                        <v-layout align-space-between justify-center column fill-height>
                            <!-- TEXT -->
                            <v-layout align-center justify-center row>
                                <v-flex xs12>
                                    <v-card>
                                        WOW
                                    </v-card>
                                </v-flex>
                            </v-layout>

                            <!-- MEDIA -->
                            <v-layout align-center justify-center row>
                                <v-flex xs12 fill-height>
                                    <v-card height="100%" style="background-color: #9561e2">
                                        WOW
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-layout>
                    </v-flex>

                    <v-flex xs3 lg3 shrink style="background-color: blue">

                    </v-flex>
                </v-layout>
            </v-flex>

        </v-layout>
    </div>
</template>

<script>
    import ProjectPageHeader from './ProjectPageHeader';

    export default {
        name: "ProjectPage",
        mounted() {
            this.$vuetify.goTo('#projectPage');
        },
        components: {
            ProjectPageHeader,
        }
    }
</script>

<style scoped>

</style>