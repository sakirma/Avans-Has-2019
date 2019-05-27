<template>
    <v-layout column fill-height>
        <v-flex xs1>
            <v-card color="red">

            </v-card>
        </v-flex>
        <v-flex>
            <div style="height: 100%;">
                <l-map :center="center" :zoom="zoom" id="map" ref="map" style="height:100%;">
                    <l-tile-layer :url="url"></l-tile-layer>

                </l-map>
            </div>
        </v-flex>
    </v-layout>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    export default {
        name: "Map",
        components: {
            LMap,
            LTileLayer,
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
            }
        }
    }
</script>

<style scoped>

</style>
