<template>
    <v-layout column fill-height justify-center>
        <v-flex xs1>
            <v-layout row align-center justify-center fill-height>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324">
                    Natuurgebieden
                </v-btn>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324">
                    Bezienswaardigheden
                </v-btn>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324">
                    Eten & Drinken
                </v-btn>
                <v-btn depressed block class="categorieButton mx-1 white--text" color="#89A324">
                    Activiteiten
                </v-btn>
            </v-layout>
        </v-flex>
        <v-flex>
            <div style="height: 100%;">
                <l-map :center="center" :zoom="zoom" id="map" ref="map" style="height:100%;" v-on:click="add($event)">
                    <l-tile-layer :url="url"></l-tile-layer>

                        <l-marker v-for="item in markers" :key="item.id" :lat-lng="item.latlng"></l-marker>
                </l-map>
            </div>
        </v-flex>
    </v-layout>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    export default {
        name: "InterestPointMap",
        components: {
            LMap,
            LTileLayer,
            LMarker,
        },
        props: {
            parent: {
                type: Object,
                required: true
            }

        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                isDrawMode: false,
                markers: [],

            }
        },
        methods: {
            setdrawMode(value) {
                this.isDrawMode = value;

            },
            clearMap(){
                if(this.markers.length > 0){
                    this.markers.splice(-1, 1);
                }
            },
            emitToParent (event) {
                console.log("EMIT:");
                console.log(this.markers[0].latlng);
                this.$emit('childToParent', this.markers[0].latlng)
            },
            add(event) {
                if(this.isDrawMode){
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
                console.log('MArkers added: ');
                    console.log(this.markers);
                this.emitToParent(event);

            }},

        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }
</style>
