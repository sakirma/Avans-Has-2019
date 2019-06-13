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

                    <v-polygon v-for="s in coordinates"
                               :lat-lngs="s.coordinates"
                               >
                    </v-polygon>
                </l-map>
            </div>
        </v-flex>
    </v-layout>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import Vue.component('v-polygon', Vue2Leaflet.Polygon)

    import "leaflet/dist/leaflet.css";
    export default {
        name: "InterestPointMap",
        components: {
            LMap,
            LTileLayer,
            LMarker,
            v-polygon,
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
                coordinates: [],


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
                    console.log(event);
                    console.log(event.latlng);
                    console.log(event.latlng.lng);

                    this.coordinates.push([event.latlng.lat, event.latlng.lng]);


                }},
        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }
</style>