<template>


    <div id="markProject" style="height: 100vh;">
        <v-layout align-center justify-space-around row fill-height style="background-color: #89a226">
            <v-flex>
                <v-form lazy-validation>
                    <v-text-field label="Naam"></v-text-field>

                    <v-text-field label="Beschrijving" required></v-text-field>
                    <v-btn color="warning" @click="">Media Uploaden</v-btn>
                    <v-btn color="succes" @click="">klaar</v-btn>
                </v-form>
            </v-flex>

            <v-flex fill-height>
                <l-map ref="eenElement" v-on:click="add($event)"
                       :zoom="zoom"
                       :center="center"
                       style="width:100%; height:100%"

                >
                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker :lat-lng="marker"></l-marker>

                    <l-marker v-for="item in markers" :key="item.id" :lat-lng="item.latlng"></l-marker>

                </l-map>
            </v-flex>
        </v-layout>
    </div>

</template>

<script>
    import {LMap, LTileLayer, LMarker, LPopup,} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import MapPageHeader from "./map-page-header";

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
                zoom: 13,
                center: L.latLng(47.413220, -1.219482),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker:  L.latLng(47.413220, -1.219482),
                markers: [],
                buttonImage: "img/MapPage/button.png",
                id: 0,
            }
        },
        methods: {

            mark: function () {
                console.log("hello");
            },

            add(event) {
                this.id++;
                var coord = event.latlng;
                var lat = coord.lat;
                var lng = coord.lng;
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
        mounted() {
            this.$refs.eenElement.mapObject.on('click', function (e) {
                console.log(e.latlng);

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


