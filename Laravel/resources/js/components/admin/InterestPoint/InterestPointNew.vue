<template>
    <div class="projectEditSection" v-bar >
        <div class="pr-2">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Nieuwe punt</v-card-title>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green"> close</v-icon>
                </v-btn>
            </v-layout>

            <v-form ref="form">
                <v-layout column>
                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Naam:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-text-field v-model="name" :rules="nameRules"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een project:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-select v-model="projectName" :items="projectNames" label="optioneel"></v-select>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een categorie:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-select v-model="category" :items="categories" :rules="categoryRules"></v-select>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Beschrijving:</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-textarea v-model="text" :rules="textRules" box></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout column>
                            <v-flex>
                                <v-card-title class="title">*Afbeelding toevoegen:</v-card-title>
                            </v-flex>
                            <v-textarea box></v-textarea>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout column>
                            <v-flex>
                                <v-card-title class="title">*Video toevoegen:</v-card-title>
                            </v-flex>
                            <v-textarea box></v-textarea>
                        </v-layout>
                    </v-flex>

                    <v-layout align-center justify-end row>
                        <v-btn @click="validate" style="max-width: 10%; height: 100%;" color="#89A226">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat class="white--text">
                                Project Toevoegen
                            </v-card>
                        </v-btn>
                    </v-layout>
                </v-layout>
            </v-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InterestPointNew",
        props: {
            parent: {
                type: Object,
                required: true
            },
            categories: {
                type: Array,
                required: true
            },
            projects: {
                type: Array,
                required: true
            },
            projectNames: {
                type: Array,
                required: true
            },
            projectIds: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                valid: false,
                name: '',
                nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
                category: null,
                categoryRules: [
                    v => !!v || 'Categorie is vereist',
                ],
                text: '',
                textRules: [
                    v => !!v || 'Beschreiving is vereist',
                    v => (v && v.length <= 65535) || 'Tekst mag niet langer zijn dan 65.535 karakters zijn'
                ],
                projectName: null,
                projectId: null,
            }
        },
        methods: {
            close() {
                this.parent.enableViewMode();
            },
            validate () {
                if(this.projectName != null) {
                    for(let i = 0; i<this.projectNames.length;i++){
                        if(this.projects[i].name == this.projectName){
                            this.projectId = this.projects[i].id;
                        }
                    }
                }

                if(this.$refs.form.validate()) {
                    /*
                    axios({
                        method: 'post',
                        url: '/admin/addProjectPoint',
                        data: {
                            project_id: this.projectId,
                            name: this.name,
                            category: this.category,
                            information: this.text,
                            markerLat: this.lat,
                            markerLong: this.long,
                            area: this.area,
                        }
                    });
                    */
                }
            },
        }
    }
</script>

<style>
    .projectEditSection {
        height: 100%;
        border-radius: 20px;
        border-style: solid;
        border-width: 2px;
        border-color: #89a226;
    }

    .projectTable .v-datatable .v-datatable__actions .v-datatable__actions__select {
        display: none;
    }

    .projectTable .v-table__overflow {
        overflow-y: hidden;
        padding-right: 15px;
    }

    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0, 0, 0, 0);
        transform: rotate3d(0, 0, 0, 0);
        -webkit-transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        background-color: rgba(38, 38, 38, 0.1);
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.3);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
    }
</style>