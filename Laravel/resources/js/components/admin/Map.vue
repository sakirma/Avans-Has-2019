<template>
    <v-layout column fill-height justify-center>
        <v-flex xs1>
            <v-layout row align-center justify-center fill-height>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324"
                       :class="{'categoryButtonPressed': pressedImages[Object.keys(pressedImages)[0]]}"
                       @click="filter(Object.keys(pressedImages)[0])">
                    Activiteiten
                </v-btn>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324"
                       :class="{'categoryButtonPressed': pressedImages[Object.keys(pressedImages)[1]]}"
                       @click="filter(Object.keys(pressedImages)[1])">
                    Eten & Drinken
                </v-btn>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324"
                       :class="{'categoryButtonPressed': pressedImages[Object.keys(pressedImages)[2]]}"
                       @click="filter(Object.keys(pressedImages)[2])">
                    Bezienswaardigheden
                </v-btn>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324"
                       :class="{'categoryButtonPressed': pressedImages[Object.keys(pressedImages)[3]]}"
                       @click="filter(Object.keys(pressedImages)[3])">
                    Natuurgebieden
                </v-btn>
            </v-layout>
        </v-flex>
        <v-flex>
            <div style="height: 100%;">
                <map-component ref="mapComponent" :parent="this" :add-event="addEvent"></map-component>
            </div>
        </v-flex>
    </v-layout>
</template>

<script>
    import "leaflet/dist/leaflet.css";

    import MapComponent from "../ProjectPage/MapComponent"

    export default {
        name: "Map",
        components: {
            MapComponent
        },
        props: {
            parentPage: {
                type: Object,
                required: true
            },
            addEvent: {
                type: Function,
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                pressedImages: {
                    activiteit: false,
                    "eten en drinken": false,
                    bezienswaardigheid: false,
                    natuurgebied: false
                },
            }
        },
        methods: {
            filter(key) {
                this.pressedImages[key] = !this.pressedImages[key];
            },
            getMapObject() {
                return this.$refs.mapComponent.getMapObject();
            },
            onProjectOpened(projectId, isProject) {
                this.parentPage.editAProject(projectId);
            },
            loadMapObjects: function(arr) {
                this.$refs.mapComponent.loadMapObjects(arr);
            }

        },
        mounted() {

        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }

    .categoryButtonPressed {
        filter: brightness(0.5);
    }
</style>
