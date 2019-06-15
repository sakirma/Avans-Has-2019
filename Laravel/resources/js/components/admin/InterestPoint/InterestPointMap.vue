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
                newMode: false,
                editMode: false
            }
        },
        mounted() {
            this.mapObject = this.$refs.map.getMapObject();
        },
        methods: {
            setNewMode(value) {
                this.newMode = value;
            },
            setEditMode(value) {
                this.editMode = value;
            },
            setDrawMode(value) {
                this.isDrawMode = value;
            },
            loadMapObjects(points) {
                this.$refs.map.loadMapObjects(points);
            },
            clearMap() {
                this.mapObject.removeLayer(this.placedMarker);

            },
            editPoint(lat, lng){
                this.placedMarker = L.marker([lat, lng]);
                this.placedMarker.addTo(this.mapObject);
            },
            add(event) {

                if (this.isDrawMode) {
                    var coord = event.latlng;
                    var lat = coord.lat;
                    var lng = coord.lng;
                    console.log("teesssst");

                    if(this.placedMarker)
                        this.mapObject.removeLayer(this.placedMarker);

                    this.placedMarker = L.marker([lat, lng]);
                    this.placedMarker.addTo(this.mapObject);

                    if(this.newMode){
                    this.parentPage.$refs.newInterstPage.marker = this.placedMarker._latlng;
                        this.parentPage.$refs.newInterstPage.markerLat = this.placedMarker._latlng.lat;
                        this.parentPage.$refs.newInterstPage.markerLng = this.placedMarker._latlng.lng;


                    } if(this.editMode){
                        this.parentPage.$refs.projectEditSection.markerLat = this.placedMarker._latlng.lat;
                        this.parentPage.$refs.projectEditSection.markerLong = this.placedMarker._latlng.lng;
                    }
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