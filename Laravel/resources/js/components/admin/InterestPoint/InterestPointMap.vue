<template>
    <map-component ref="map" :parent-page="parentPage" :add-event="add">

    </map-component>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import mapComponent from "../Map";

    export default {
        name: "InterestPointMap",
        components: {
            LMap,
            LTileLayer,
            LMarker,
            mapComponent,
        },
        props: {
            parentPage: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                isDrawMode: false,
                markers: [],
                mapObject: null,
                placedMarker: null,
            }
        },
        mounted() {
            this.mapObject = this.$refs.map.getMapObject();
        },
        methods: {
            setDrawMode(value) {
                this.isDrawMode = value;
            },
            loadMapObjects(points) {
                this.$refs.map.loadMapObjects(points);
            },
            clearMap() {
                if (this.markers.length > 0) {
                    this.markers.splice(-1, 1);
                }
            },
            add(event) {
                if (this.isDrawMode) {
                    var coord = event.latlng;
                    var lat = coord.lat;
                    var lng = coord.lng;

                    if(this.placedMarker)
                        this.mapObject.removeLayer(this.placedMarker);

                    this.placedMarker = L.marker([lat, lng]);
                    this.placedMarker.addTo(this.mapObject);
                }
            },
        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }
</style>