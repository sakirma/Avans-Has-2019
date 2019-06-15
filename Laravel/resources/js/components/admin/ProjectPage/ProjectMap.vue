<template>
    <!--    <v-layout column fill-height justify-center>-->
    <!--        <v-flex xs1>-->
    <!--            <v-layout row align-center justify-center fill-height>-->
    <!--                <v-btn depressed block class="categorieButton mx-1 white&#45;&#45;text" color="#89A324">-->
    <!--                    Natuurgebieden-->
    <!--                </v-btn>-->
    <!--                <v-btn depressed block class="categorieButton mx-1 white&#45;&#45;text" color="#89A324">-->
    <!--                    Bezienswaardigheden-->
    <!--                </v-btn>-->
    <!--                <v-btn depressed block class="categorieButton mx-1 white&#45;&#45;text" color="#89A324">-->
    <!--                    Eten & Drinken-->
    <!--                </v-btn>-->
    <!--                <v-btn depressed block class="categorieButton mx-1 white&#45;&#45;text" color="#89A324">-->
    <!--                    Activiteiten-->
    <!--                </v-btn>-->
    <!--            </v-layout>-->
    <!--        </v-flex>-->
    <!--        <v-flex>-->
    <!--            <div style="height: 100%;">-->
    <!--                <l-map :center="center" :zoom="zoom" id="map" ref="map" style="height:100%;" v-on:click="add($event) ">-->
    <!--                    <l-tile-layer :url="url"></l-tile-layer>-->
    <!--                    <LPolygon ref="poly"-->
    <!--                              :lat-lngs="polygon.latlngs"-->
    <!--                              :color="polygon.color">-->
    <!--                    </LPolygon>-->
    <!--                </l-map>-->
    <!--            </div>-->
    <!--        </v-flex>-->
    <!--    </v-layout>-->
    <map-component ref="map" :parent-page="this" :add-event="add"></map-component>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup,} from 'vue2-leaflet';

    import MapComponent from "../Map";
    import "leaflet/dist/leaflet.css";

    export default {
        name: "ProjectMap",
        components: {
            LPolygon,
            LMap,
            LTileLayer,
            LMarker,
            MapComponent,
        },
        props: {
            parent: {
                type: Object,
                required: true
            },
            latLngs: {
                type: Array,
                default: () => []
            },

        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                isDrawMode: false,
                markers: [],
                coordinates: [],
                polygon: {
                    latlngs: [],
                    color: 'green'
                },
                leafletPolygon: null,
                mapObject: null,
            }
        },
        methods: {
            setDrawMode(value) {
                this.isDrawMode = value;
            },
            clearMap() {
                if (this.markers.length > 0) {
                    this.markers.splice(-1, 1);
                }
            },
            emitToParent(event) {
                this.$emit('childToParent', this.markers[0].latlng)
            },
            add(event) {
                if (this.isDrawMode) {
                    this.polygon.latlngs.push([event.latlng.lat, event.latlng.lng]);
                    this.onPolygonChanged();
                }
            },
            onPolygonChanged() {
                if(this.leafletPolygon)
                    this.mapObject.removeLayer(this.leafletPolygon);

                this.leafletPolygon = L.polygon(this.polygon.latlngs);
                this.leafletPolygon.addTo(this.mapObject);
            },
            resetPolygon() {
                if(this.leafletPolygon)
                    this.mapObject.removeLayer(this.leafletPolygon);

                this.leafletPolygon = [];
            },
            loadMapObjects(projects) {
                this.$refs.map.loadMapObjects(projects);
            }
        },
        mounted() {
            this.mapObject = this.$refs.map.getMapObject();
        }
    }
</script>

<style scoped>
    .categorieButton {
        border-radius: 5px;
    }
</style>