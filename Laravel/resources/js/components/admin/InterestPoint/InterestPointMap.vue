<template>
    <map-component ref="map" :parent-page="this.parentPage">

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
                    this.markers.push({
                        id: this.id,
                        latlng: L.latLng(parseFloat(lat), parseFloat(lng)),
                        content: 'hoi!'
                    });
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