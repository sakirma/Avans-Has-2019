<template>
    <div style="height: 100vh; background-color: #89a226;">
        <v-layout fill-height column>
            <v-flex xs1 ma-3>
                <project-page-header></project-page-header>
            </v-flex>

            <v-flex style="background-color: red">
                <v-layout row fill-height>
                    <v-flex my-4 mr-5 style="background-color: white">
                        <v-layout align-space-between justify-center column fill-height>
                            <!-- TEXT -->
                            <v-layout align-start justify-center row wrap>
                                <v-flex xs12 fill-height>
                                    <v-textarea
                                        solo
                                        name="input-7-4"
                                        label="Solo textarea"
                                        :value="Wows"
                                        height="100%"
                                        rows="20"

                                        style="background-color: #9561e2"
                                    >

                                    </v-textarea>
                                    <!--<v-card color="#9E9C33" flat class="white&#45;&#45;text headline"-->
                                            <!--width="100%"-->
                                            <!--max-width="65vw"-->
                                            <!--style="transition: none; border-radius: 0" max-height="15vw">-->
                                       <!---->
                                    <!--</v-card>-->
                                </v-flex>
                            </v-layout>

                            <!-- MEDIA -->
                            <v-layout align-start justify-center row>
                                <v-flex xs12>
                                    <v-card height="100%" style="background-color: #9561e2">
                                        WOW
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-layout>
                    </v-flex>

                    <v-flex xs3 lg4 style="background-color: blue">
                        <v-card>
                            WAT
                        </v-card>
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
        data() {
            return {
                Wows: "WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW WOW "

            }
        },
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
