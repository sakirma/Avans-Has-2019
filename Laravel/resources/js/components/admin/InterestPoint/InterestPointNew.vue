<template>
    <div class="projectEditSection" v-bar >
        <div class="pr-2">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Nieuwe punt</v-card-title>
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
                            <v-text-field v-model="name"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Kies een project:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="project" label="optioneel"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Kies een categorie:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="category"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Beschrijving:</v-card-title>
                        </v-flex>
                        <v-flex xs4>
                            <v-textarea v-model="information" box></v-textarea>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout column>
                        <v-flex>
                            <v-card-title class="title">Afbeelding toevoegen:</v-card-title>
                        </v-flex>
                        <input type="file">
                        <ul>
                            <li v-for="file,index in files">
                                <button @click="removeFile(index)">
                                    x
                                </button>
                                {{ file.name }}
                            </li>
                        </ul>
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

                <v-layout align-center justify-end row>
                    <v-btn style="max-width: 10%; height: 100%;" color="#89A226" @click="save()">
                        <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat class="white--text">
                            Project Toevoegen
                        </v-card>
                    </v-btn>
                </v-layout>
            </v-layout>
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
            }
        },
        data() {
            return {
                input: null,
                files: [],
                project: null,
                name: null,
                information: null,
                category: null
            }
        },
        methods: {
            close() {
                this.parent.enableViewMode();
            },
            onFileSelection() {
                for (let file of this.input.files) {
                    this.files.push(file);
                }
                this.input.value = null;
            },
            removeFile(index) {
                this.files.splice(index, 1)
            },
            save(){
                axios.post("/createPoint", {
                    project_id: this.project,
                    lat: 51.50537683608064,
                    long: 5.357208251953125,
                    area: null,
                    name: this.name,
                    information: this.information,
                    category: this.category
                }).then(({ data }) => {
                    console.log(data);
                    for(let i = 0; i < this.files.length; i++){
                        let formData = new FormData();
                        formData.append("image", this.files[i]);
                        formData.append("name", data.id + "_" + i);
                        formData.append("folder", "points");
                        formData.append("id", data.id);
                        axios.post("/media", formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        ).then(({ data }) => {
                            console.log(data);
                        });
                    }
                });
            }
        },
        mounted() {
            this.input = this.$el.querySelector('input[type=file]');
            this.input.addEventListener('change', () => this.onFileSelection());
            this.input.setAttribute('multiple', 'multiple');
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