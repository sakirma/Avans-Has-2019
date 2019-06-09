<template>
    <l-map ref="map"
           :zoom="zoom"
           :center="center"
           style="height:100%;">
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

        <template v-for="marker in markers">
            <l-marker :key="marker.id" v-if="isAllowedCategory(marker.category)" :lat-lng="marker.latlng" :icon="redPin"
                      style="transform: scale(0.1)">
                <pop-up :id="marker.id" :parent="marker.parent"></pop-up>
            </l-marker>
        </template>

        <template v-for="polygon in polygons">
            <l-polygon :key="polygon.id" v-if="isAllowedCategory(polygon.category)" :lat-lngs="polygon.latlng"
                       :color="polygonLineColor" :fill-color="polygonFillColor" :fill-opacity="0.6">
                <pop-up :id="polygon.id" :parent="polygon.parent"></pop-up>
            </l-polygon>
        </template>

        <template v-for="polyline in polylines">
            <l-polyline :key="polyline.id" v-if="isAllowedCategory(polyline.category)" :lat-lngs="polyline.latlng">
                <pop-up :id="polyline.id" :parent="polyline.parent"></pop-up>
            </l-polyline>
        </template>

        <template v-for="rectangle in rectangles">
            <l-polyline :key="rectangle.id" v-if="isAllowedCategory(rectangle.category)" :lat-lngs="rectangle.latlng">
                <pop-up :id="rectangle.id" :parent="rectangle.parent"></pop-up>
            </l-polyline>
        </template>
    </l-map>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPolygon, LPolyline, LRectangle, LPopup} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import PopUp from "./PopUp";

    export default {
        name: 'MapPage',
        components: {
            PopUp,
            LMap,
            LTileLayer,
            LMarker,
            LPolygon,
            LPolyline,
            LRectangle,
            LPopup
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
                    iconUrl: 'img/Punaise rood.svg',

                    iconSize: [30, 60],
                }),
                parentPage: undefined,
            }
        },
        props: {
            GetItems: {
                type: Function,
                required: true
            }
        },
        methods: {
            assignParentPage(parent) {
                this.parentPage = parent;
            },
            isAllowedCategory(cat) {
                if(!this.parentPage)
                    return true;

                if (cat in this.parentPage.pressedImages)
                    return this.parentPage.pressedImages[cat];
                else return true;
            },
            disableInputEvents(element) {
                this.$parent.disableInputEvents(element);
            },
            OpenProjectPagePressed: function (projectId) {
                this.parentPage.onProjectOpened(projectId);
            },
            createPolygon: function (id, coordinates, category) {
                let points = [];
                for (let k = 0; k < coordinates[0].length; k++) {
                    points.push(L.latLng(coordinates[0][k][1], coordinates[0][k][0]));
                }
                this.polygons.push({"id": id, "latlng": points, parent: this, category: category});
            },
            createPoint: function (id, coordinates, category) {
                this.markers.push({
                    "id": id,
                    "latlng": L.latLng(coordinates[1], coordinates[0]),
                    parent: this,
                    category: category
                });
            },
            loadMapObjects: function () {
                this.items = this.GetItems();
                console.log(this.GetItems().length);
                for (let i = 0; i < this.items.length; i++) {
                    let info = "";
                    if(data[i].location) info = data[i].location;
                    else if(data[i].area) info = data[i].area;
                    else continue;

                    if (info.type == "Point") {
                        this.createPoint(data[i].id, data[i].info.coordinates, data[i].category);
                    } else if (info.type == "GeometryCollection") {
                        for (let j = 0; j < data[i].info.geometries.length; j++) {
                            if (info.geometries[j].type == "Point") {
                                this.createPoint(data[i].id, data[i].info.geometries[j].coordinates, data[i].category);
                            } else if (info.geometries[j].type == "Polygon") {
                                this.createPolygon(data[i].id, data[i].info.geometries[j].coordinates, data[i].category);
                            } else {
                                let points = [];
                                for (let k = 0; k < data[i].info.geometries[j].coordinates.length; k++) {
                                    points.push(L.latLng(data[i].info.geometries[j].coordinates[k][1], data[i].info.geometries[j].coordinates[k][0]));
                                }
                                if (data[i].info.geometries[j].type == "LineString") this.polylines.push({
                                    "id": data[i].id,
                                    "latlng": points,
                                    parent: this,
                                    category: data[i].category
                                });
                                else if (data[i].info.geometries[j].type == "Rectangle") this.rectangles.push({
                                    "id": [data[i].id],
                                    "latlng": points,
                                    parent: this,
                                    category: data[i].category
                                });
                            }
                        }
                    }
                }
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
