<template>
    <div class="projectEditSection" v-bar >
    <v-form v-model="valid" ref="form">
        <div class="pr-2">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Nieuw Project</v-card-title>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green"> close</v-icon>
                </v-btn>
            </v-layout>

            <v-layout column>
                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Naam:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="name" :rules="nameRules"></v-text-field>
                        </v-flex>
                        <v-spacer></v-spacer>
                        <v-btn @click="validate" style="max-width: 10%; height: 100%;" color="#89A226">
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
                             <v-select 
                             v-model="select"
                             :items="categories" 
                             menu-props="auto"
                             label="Selecteren"
                             :rules="[v => !!v || 'Categorie is vereist']" 
                             required 
                             single-line>
                             </v-select>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Beschrijving:</v-card-title>
                        </v-flex>
                        <v-flex xs4>
                            <v-textarea box v-model="text" :rules="textRules"></v-textarea>
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
        </v-form>
    </div>
</template>

<script>
    export default {
        name: "ProjectsEdit",
        props: {
            parent: {
                type: Object,
                required: true
            }
        },
        methods: {
            close() {
                this.parent.enableViewMode();
            },

            validate () {
                if(this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/admin/addProject',
                        data: {
                            name: this.name,
                            category: this.select,
                            information: this.text,
                            lat: this.lat,
                            long: this.long,
                        }
                    });
                    this.parent.loadProjects(); 
                    this.close();
                }
        }
        },

            

        mounted(){
            window.axios.get('/getCategories').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name);
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
    

    data(){
        return {
            nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
            textRules: [
                    v => !!v || 'Beschreiving is vereist',
                    v => (v && v.length <= 65.535) || 'Tekst mag niet langer zijn dan 65.535 karakters zijn'
                ],
         categories: [],
         select: null,
         name: '',
         text: '',
         valid: false,
        }
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