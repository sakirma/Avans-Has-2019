<template>
    <div class="projectEditSection" v-bar>
        <div class="testingCSS">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Punt</v-card-title>
                <v-btn fab flat @click="close">
                    <v-icon x-large color="green"> close</v-icon>
                </v-btn>
            </v-layout>

            <v-layout column >
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
                            <v-card-title class="title">Kies een Project:</v-card-title>
                        </v-flex>
                        <v-flex xs3>
                            <v-text-field v-model="project" label="optioneel"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs1>
                    <v-layout row>
                        <v-flex xs3>
                            <v-card-title class="title">Beschrijving</v-card-title>
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

                        <v-carousel v-if="files.length > 0">
                            <v-carousel-item
                                    v-for="(image,i) in images"
                                    :key="i"
                                    :src="image"
                            ></v-carousel-item>
                        </v-carousel>
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

                <v-flex xs1 pr-5>
                    <v-layout reverse row xs1>
                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226" @click="save()">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text">
                                Aanpassingen Toepassen
                            </v-card>
                        </v-btn>

                        <v-btn style="max-width: 10%; height: 100%;" color="#89A226" @click="remove()">
                            <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                    class="white--text text-xs-center">
                                Punt Verwijderen
                            </v-card>
                        </v-btn>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InterestPointEdit",
        data() {
            return {
                id: 0,
                offset: 0,
                input: null,
                files: [],
                images: [],
                project: null,
                name: null,
                information: null,
                category: null
            }
        },
        props: {
            parent: {
                type: Object,
                required: true,
            }
        },
        mounted(){
            this.input = this.$el.querySelector('input[type=file]');
            this.input.addEventListener('change', () => this.onFileSelection());
            this.input.setAttribute('multiple', 'multiple');
        },
        methods: {
            projectEditSection(product) {
                this.id = product;
                axios.get("/getProjectPoint/"+product)
                    .then(({data}) => {
                        this.name = data.name;
                        this.category = data.category;
                        this.project = data.project_id;
                        this.information = data.information;
                    });

                axios.get("/getMediaFromProjectPoint/"+product)
                    .then(({data}) => {
                        this.files = [];
                        this.images = [];
                        for(let i = 0; i < data.length; i++){
                            this.files.push(data[i]);
                            this.images.push("getmedia/" + data[i]);
                        }
                        this.offset = data.length;
                        this.startingMediaNumber = this.offset;
                        console.log("offset " + this.offset);
                    }).catch((error) => {
                        console.log(error);
                    });
            },
            close() {
                this.parent.enableViewMode();
            },
            onFileSelection() {
                for (let file of this.input.files) {
                    this.files.push(file);
                    let reader = new FileReader();
                    reader.onload = (ev) => {
                        this.images.push(ev.target.result);
                    };
                    reader.readAsDataURL(file);
                }
                this.input.value = null;
            },
            removeFile(index) {
                if(index < this.offset){
                    axios.post("/removemedia", {
                        medianame: this.files[index],
                        folder: "points"
                    }).catch((error) => {
                        alert("Er ging iets mis bij het verwijderen van de foto...");
                        return;
                    });
                    this.files.splice(index, 1);
                    this.offset--;
                }else{
                    this.files.splice(index, 1)
                }
            },
            save(){
                axios.post("/updatePoint", {
                    id: this.id,
                    project_id: this.project,
                    lat: 51.50537683608064,
                    long: 5.357208251953125,
                    area: null,
                    name: this.name,
                    information: this.information,
                    category: this.category
                }).then(({ data }) => {
                    for(let i = this.offset; i < this.files.length; i++){
                        if(this.files[i] == null) continue;
                        let formData = new FormData();
                        formData.append("image", this.files[i]);
                        formData.append("name", data.id + "_" + (this.startingMediaNumber + i - this.offset));
                        formData.append("folder", "points");
                        formData.append("id", data.id);
                        axios.post("/media", formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        ).catch((error) => {
                            alert("Er ging iets mis bij het opslaan...2");
                            console.log(error);
                        });
                    }
                }).catch((error) => {
                    alert("Er ging iets mis bij het opslaan...");
                    console.log(error);
                });
                this.close();
            },
            remove(){
                axios.post("/removePoint", { id: this.id })
                    .catch((error) => {
                        alert("Er ging iets mis bij het verwijderen...");
                    });
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

    .testingCSS::-webkit-scrollbar {
        display: none;
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