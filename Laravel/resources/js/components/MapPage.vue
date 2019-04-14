<template>
    <v-card id="mapPage" height="100vh">
        <l-map ref="map"
               :zoom="zoom"
               :center="center"
               style="height:100%;">
            <l-tile-layer :url="url"
                          :attribution="attribution"></l-tile-layer>
            <l-marker :lat-lng="marker"></l-marker>
        </l-map>
    </v-card>
</template>

<script>
    import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    export default {
        name: 'example',
        components: {
            LMap,
            LTileLayer,
            LMarker
        },
        data () {
            return {
                zoom:13,
                center: L.latLng(47.413220, -1.219482),
                url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(47.413220, -1.219482),
            }
        },
        methods: {
            mounted() {
                setTimeout(function() { window.dispatchEvent(new Event('resize')) }, 250);
            }
        },
        mounted() {
            this.$refs.map.mapObject.scrollWheelZoom.disable();
        }
    }
</script>

<style scoped>
</style>
