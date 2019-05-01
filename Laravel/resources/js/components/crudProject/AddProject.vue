<template>

    <div id="markProject" style="height: 100vh;">
        <v-layout align-center justify-space-around row fill-height style="background-color: #89a226">
            <v-flex>
                <v-btn color="orange darken-2" href="/beheer/project/overzicht" dark>
                    <v-icon dark left>arrow_back</v-icon>Back
                </v-btn>
                <v-form lazy-validation>
                    <v-text-field label="Naam" v-model="name" :rules="nameRules" dark></v-text-field>
                    <v-select label="Kies een categorie" v-model="select" :items="categories" :rules="[v => !!v || 'Categorie is vereist']" required dark></v-select>
                    <v-textarea label="Beschrijving" v-model="text"  :rules="textRules" required dark></v-textarea>
                    <v-text-field label="Latidude" :value="lat" :rules="[v => !!v || 'Punt moet op de mag geselecteerd worden']" readonly required dark></v-text-field>
                    <v-text-field label="Longitude" :value="long" :rules="[v => !!v || 'Punt moet op de mag geselecteerd worden']" readonly required dark></v-text-field>


                    <v-btn color="warning" @click="">Media Uploaden</v-btn>
                    <v-btn color="succes" @click="validate" >Klaar</v-btn>
                </v-form>
            </v-flex>

            <v-flex fill-height>
                // v-on:click="add($event)" calls the mouse listener and $event gets the click event with latlng
                <l-map ref="eenElement" v-on:click="add($event)"
                       :zoom="zoom"
                       :center="center"
                       style="width:100%; height:80%"

                >
                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    // single marker ----remove later---------------
                    <l-marker :lat-lng="marker"></l-marker>

                    // markers that are added with clicking on the map
                    <l-marker v-for="item in markers" :key="item.id" :lat-lng="item.latlng"></l-marker>

                </l-map>
            </v-flex>
        </v-layout>
    </div>

</template>

<script>
    import {LMap, LTileLayer, LMarker, LPopup,} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import MapPageHeader from "../map-page-header";

    export default {
        name: 'MarkProject',
        components: {
            MapPageHeader,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
        },

        data() {
            return {
                // Data form
                name: '',
                nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
                select: null,
                categories: [],
                text: '',
                textRules: [
                    v => !!v || 'Beschreiving is vereist',
                    v => (v && v.length <= 65.535) || 'Tekst mag niet langer zijn dan 65.535 karakters zijn'
                ],

                zoom: 13,
                center: L.latLng(47.413220, -1.219482),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                // test marker
                marker: L.latLng(47.413220, -1.219482),
                // here will come the added markers
                markers: [],
                long: '',
                lat: '',
                buttonImage: "img/MapPage/button.png",
                id: 0,
            }
        },

        methods: {
            // adds a marker to the markers array. the event.latlng needs to be converted to floats because they are delivered as strings
            validate () {
                axios({
                    method: 'post',
                    url: '/beheer/AddProject',
                    data: {
                        name: this.name,
                        category: this.select,
                        information: this.text,
                        lat: this.lat,
                        long: this.long,
                    }
                });
            },

            add(event) {
                if(this.markers.length > 0){
                    this.markers.splice(-1, 1);
                }
                this.id++;
                var coord = event.latlng;
                var lat = coord.lat;
                var lng = coord.lng;
                this.long = lng;
                this.lat = lat;
                console.log("lat: "+ lat + " lng: " + lng)
                this.markers.push({
                    id: this.id,
                    latlng: L.latLng(parseFloat(lat), parseFloat(lng)),
                    content: 'hoi!'
                });
                console.log("marked at " + event.latlng);
            },
            remove() {
                this.markers.splice(-1, 1);
            }


        },

        // test method
        mounted() {
            this.$refs.eenElement.mapObject.on('click', function (e) {
                console.log(e.latlng);

            });

            window.axios.get('http://127.0.0.1:8000/getCategories').then(response => {
                let temp = response.data;

                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }

</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 0px 0px 10px 10px;
        height: 50px;
        width: 100%;
    }
</style>