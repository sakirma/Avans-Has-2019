<template>
    <div class="projectEditSection" v-bar >
        <div class="pr-2">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Nieuw Project</v-card-title>
                <v-btn fab flat @click="">
                    <v-icon x-large color="green"> close</v-icon>
                </v-btn>
            </v-layout>

            <v-layout column fill-height>
                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Naam:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field :label="selectedProject.name"></v-text-field>
                        </v-flex>
                        <v-spacer></v-spacer>
                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat class="white--text">
                                Project Toevoegen
                            </v-card>
                        </v-btn>
                    </v-layout>
                </v-flex>


                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Kies een categorie:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Beschrijving</v-card-title>
                        </v-flex>
                        <v-flex xs4>
                            <v-textarea box></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout column>
                        <v-flex>
                            <v-card-title class="title">Afbeelding toevoegen:</v-card-title>
                        </v-flex>
                        <v-textarea box></v-textarea>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout column>
                        <v-flex>
                            <v-card-title class="title">Video toevoegen:</v-card-title>
                        </v-flex>
                        <v-textarea box></v-textarea>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProjectsEdit",
        data() {
            return {
                selectedProject: {
                    id: '', // ID is used to get data from database, as an example, to retrieve which image and youtube url is being used.
                    name: '',
                    categorie: '',
                    beschrijving: '',
                },
            }
        },
        methods: {
            projectEditSection(product) {
                this.selectedProject = product;
            }
        }
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