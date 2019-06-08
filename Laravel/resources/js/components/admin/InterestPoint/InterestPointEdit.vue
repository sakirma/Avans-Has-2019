<template>
    <div class="projectEditSection" v-bar>
        <div class="testingCSS">
            <v-layout align-center justify-space-between row>
                <v-card-title class="display-1">Punt</v-card-title>
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
                                <v-text-field v-model="selectedProject.name" :rules="nameRules"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een Project:</v-card-title>
                            </v-flex>
                            <v-layout row align-center>
                                <v-flex xs3>
                                    <v-select v-model="projectName" :items="projectNames" label="optioneel"></v-select>
                                </v-flex>
                                <v-btn icon color="green" flat @click="removeProject">
                                    <v-icon>
                                        close
                                    </v-icon>
                                </v-btn>
                            </v-layout>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Kies een categorie:</v-card-title>
                            </v-flex>
                            <v-flex xs3>
                                <v-select v-model="selectedProject.category" :items="categories"
                                          :rules="categoryRules"></v-select>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout row>
                            <v-flex xs3>
                                <v-card-title class="title">Beschrijving</v-card-title>
                            </v-flex>
                            <v-flex xs4>
                                <v-textarea v-model="selectedProject.information" :rules="textRules" box></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1>
                        <v-layout column>
                            <v-flex>
                                <v-card-title class="title">Afbeelding toevoegen:</v-card-title>
                            </v-flex>
                            <input type="file">

                            <v-carousel v-if="images.length > 0">
                                <v-carousel-item
                                    v-for="(image,i) in images"
                                    :key="i"
                                    :src="image"
                                ></v-carousel-item>
                            </v-carousel>
                        </v-layout>
                    </v-flex>

                    <v-flex xs1 pr-5>
                        <v-layout reverse row xs1>
                            <v-btn @click="validate" style="max-width: 10%; height: 100%;" color="#89A226">
                                <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                        class="white--text">
                                    Aanpassingen Toepassen
                                </v-card>
                            </v-btn>

                            <v-btn @click="deleteItem" style="max-width: 10%; height: 100%;"
                                   color="#89A226">
                                <v-card style="white-space: normal; max-width: 60%;" color="transparent" flat
                                        class="white--text text-xs-center">
                                    Punt Verwijderen
                                </v-card>
                            </v-btn>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InterestPointEdit",
        data() {
            return {
                name: '',
                nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
                bool: false,
                projectName: null,
                projectId: null,
                category: null,
                categories: [],
                categoryRules: [
                    v => !!v || 'Categorie is vereist',
                ],
                text: '',
                textRules: [
                    v => !!v || 'Beschreiving is vereist',
                    v => (v && v.length <= 10000) || 'Tekst mag niet langer zijn dan 10.000x` karakters zijn'
                ],
                selectedProject: {
                    id: '', // ID is used to get data from database, as an example, to retrieve which image and youtube url is being used.
                    name: '',
                    category: '',
                    project_id: '',
                    information: '',
                },
                markerLat: null,
                markerLong: null,
                offset: 0,
                startingMediaNumber: 0,
                input: null,
                files: [],
                images: [],
            }
        },
        props: {
            parent: {
                type: Object,
                required: true,
            }
        },
        methods: {
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
                if (index < this.offset) {
                    axios.post("/beheer/removemedia", {
                        medianame: this.files[index],
                        folder: "points"
                    }).catch((error) => {
                        alert("Er ging iets mis bij het verwijderen van de foto...");
                        return;
                    });
                    this.files.splice(index, 1);
                    this.offset--;
                } else {
                    this.files.splice(index, 1)
                }
            },
            projectEditSection(product) {
                this.selectedProject = product;
                if (this.bool == false) {
                    this.markerLat = product.location.coordinates[1];
                    this.markerLong = product.location.coordinates[0];
                }

                this.parent.$refs.mapSection.markers.push({
                    id: 1,
                    latlng: L.latLng(parseFloat(this.markerLong), parseFloat(this.markerLat)),
                    content: 'hoi!'
                });
                this.parent.$refs.mapSection.setdrawMode(true);
                this.getUpdateProjectName();

                axios.get("/getMediaFromProjectPoint/" + this.selectedProject.id)
                    .then(({data}) => {
                        this.files = [];
                        this.images = [];
                        for (let i = 0; i < data.length; i++) {
                            this.files.push(data[i]);
                            this.images.push("getmedia/" + data[i]);
                        }
                        this.offset = data.length;
                        this.startingMediaNumber = this.offset;
                    }).catch((error) => {
                    console.log(error);
                });
            },
            close() {
                this.parent.$refs.mapSection.setdrawMode(false);
                this.parent.$refs.mapSection.clearMap();
                this.parent.loadPoints();
                this.parent.enableViewMode();
            },
            getUpdateProjectName() {
                for (let i = 0; i < this.projects.length; i++) {
                    if (this.projects[i].id == this.selectedProject.project_id) {
                        this.projectName = this.projects[i].name;
                    } else {
                        console.log(this.projects[i].id + " - " + this.selectedProject.project_id);
                    }
                }
            },
            deleteItem() {
                if (confirm('Weet u zeker dat deze interessepunt wilt verwijderen?')) {
                    axios({
                        method: 'post',
                        url: '/admin/deleteProjectPoint',
                        data: {
                            id: this.selectedProject.id,
                        }
                    });
                    this.close();
                }
            },
            validate() {
                if (this.projectName != null) {
                    for (let i = 0; i < this.projectNames.length; i++) {
                        if (this.projects[i].name == this.projectName) {
                            this.projectId = this.projects[i].id;
                        }
                    }
                }

                if (this.$refs.form.validate()) {

                    console.log("validate: ");
                    console.log(this.markerLat);
                    console.log(this.markerLong);
                    axios({
                        method: 'post',
                        url: '/admin/updateProjectPoint',
                        data: {
                            id: this.selectedProject.id,
                            name: this.selectedProject.name,
                            category: this.selectedProject.category,
                            information: this.selectedProject.information,
                            project_id: this.projectId,

                            lat: this.markerLat,
                            long: this.markerLong,
                        }
                    });

                    for (let i = this.offset; i < this.files.length; i++) {
                        if (this.files[i] == null) continue;
                        let formData = new FormData();
                        formData.append("image", this.files[i]);
                        formData.append("name", this.selectedProject.id + "_" + (this.startingMediaNumber + i - this.offset));
                        formData.append("folder", "points");
                        formData.append("id", this.selectedProject.id);
                        axios.post("/beheer/media", formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        ).catch((error) => {
                            alert("Er ging iets mis bij het opslaan...");
                            console.log(error);
                        });
                    }
                    this.close();
                }
            },
            removeProject() {
                this.projectName = null;
                this.projectId = null;
            },
        },
        mounted() {
            this.input = this.$el.querySelector('input[type=file]');
            this.input.addEventListener('change', () => this.onFileSelection());
            this.input.setAttribute('multiple', 'multiple');
            window.axios.get('/getCategories').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name.toString());
                }
            }).catch(function (error) {
                console.log(error);
            });
            window.axios.get('/getProjectPoints').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {

                }
            }).catch(function (error) {
                console.log(error);
            });
        },

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
