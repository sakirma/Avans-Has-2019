<template>
    <l-map ref="map"
           :zoom="zoom"
           :center="center"
           style="height:100%;">
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

        <template v-for="marker in markers">
            <l-marker :lat-lng="marker.latlng" :icon="redPin">
                <l-popup>
                    <v-layout column align-center fill-height>
                        <p class="text-xs-center title">dafq word dit wel groter als de text langer word?</p>
                        <v-card-text class="text-xs-center">WOW</v-card-text>
                        <v-btn dark @click="OpenProjectPagePressed(marker.id)">Open</v-btn>
                    </v-layout>
                </l-popup>
            </l-marker>
        </template>

        <template v-for="polygon in polygons">
            <l-polygon :lat-lngs="polygon.latlng" :color="polygonLineColor" :fill-color="polygonFillColor" :fill-opacity="0.6" >
                <l-popup>
                    <v-layout column align-center fill-height>
                        <p class="text-xs-center title">dafq word dit wel groter als de text langer word?</p>
                        <v-card-text class="text-xs-center">WOW</v-card-text>
                        <v-btn dark @click="OpenProjectPagePressed(polygon.id)">Open</v-btn>
                    </v-layout>
                </l-popup>
            </l-polygon>
        </template>

        <template v-for="polyline in polylines">
            <l-polyline :lat-lngs="polyline.latlng">
                <l-popup>
                    <v-layout column align-center fill-height>
                        <p class="text-xs-center title">dafq word dit wel groter als de text langer word?</p>
                        <v-card-text class="text-xs-center">WOW</v-card-text>
                        <v-btn dark @click="OpenProjectPagePressed(polyline.id)">Open</v-btn>
                    </v-layout>
                </l-popup>
            </l-polyline>
        </template>

        <template v-for="rectangle in rectangles">
            <l-polyline :lat-lngs="rectangle.latlng">
                <l-popup>
                    <v-layout column align-center fill-height>
                        <p class="text-xs-center title">dafq word dit wel groter als de text langer word?</p>
                        <v-card-text class="text-xs-center">WOW</v-card-text>
                        <v-btn dark @click="OpenProjectPagePressed(rectangle.id)">Open</v-btn>
                    </v-layout>
                </l-popup>
            </l-polyline>
        </template>
    </l-map>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";

    export default {
        name: 'MapPage',
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LPolygon,
            LPolyline,
            LRectangle,
            LPopup
        },
        props: {
            parentPage: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                zoom: 11,
                center: L.latLng(51.7142669290121, 5.3173828125),
                url: 'https://api.mapbox.com/styles/v1/sakirma/cjw0hdemp03kx1coxkbji4wem/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FraXJtYSIsImEiOiJjanM5Y3kzYm0xZzdiNDNybmZueG5jeGw0In0.yNltTMF52t5uEFdU15Uxig',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [],
                polygons: [],
                polylines: [],
                rectangles: [],
                buttonImage: "img/MapPage/button.png",
                LeftDropDownButton: ['Projectnaam A', 'Projectnaam B', 'Projectnaam C'],
                RightDropDownButton: ['Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks', 'Een kopje koffie', 'Mooie kunst', 'promenade', 'Heerlijke Snacks'],

                polygonFillColor: '#C5DF24',
                polygonLineColor: '#89a324',
                redPin: L.icon({
                    iconUrl: 'img/Punaise rood.png',

                    iconSize: [34, 51],
                }),
            }
        },
        methods: {
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId) {
                this.parentPage.onProjectOpened(projectId);
            },
            createPolygon: function (id, coordinates) {
                let points = [];
                for (let k = 0; k < coordinates[0].length; k++) {
                    points.push(L.latLng(coordinates[0][k][1], coordinates[0][k][0]));
                }
                this.polygons.push({"id": id, "latlng": points});
            },
            createPoint: function (id, coordinates) {
                this.markers.push({"id": id, "latlng": L.latLng(coordinates[1], coordinates[0])});
            },
            loadMapObjects: function () {
                axios.get('/getAllProjectPoints').then(({data}) => {
                    for (let i = 0; i < data.length; i++) {
                        if (data[i].info.type == "Point") {
                            this.createPoint(data[i].id, data[i].info.coordinates);
                        } else if (data[i].info.type == "GeometryCollection") {
                            for (let j = 0; j < data[i].info.geometries.length; j++) {
                                if (data[i].info.geometries[j].type == "Point") {
                                    this.createPoint(data[i].id, data[i].info.geometries[j].coordinates);
                                } else if (data[i].info.geometries[j].type == "Polygon") {
                                    this.createPolygon(data[i].id, data[i].info.geometries[j].coordinates);
                                } else {
                                    let points = [];
                                    for (let k = 0; k < data[i].info.geometries[j].coordinates.length; k++) {
                                        points.push(L.latLng(data[i].info.geometries[j].coordinates[k][1], data[i].info.geometries[j].coordinates[k][0]));
                                    }
                                    if (data[i].info.geometries[j].type == "LineString") this.polylines.push({
                                        "id": data[i].id,
                                        "latlng": points
                                    });
                                    else if (data[i].info.geometries[j].type == "Rectangle") this.rectangles.push({
                                        "id": [data[i].id],
                                        "latlng": points
                                    });
                                }
                            }
                        }
                    }
                });
            }
        },
        mounted() {
            this.loadMapObjects();
        }
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0;
        border-radius: 10px 10px 0px 0px;
        height: 50px;
        width: 100%;
    }
</style>
