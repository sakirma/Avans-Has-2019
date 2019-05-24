<template>

    <div id="markPoint" style="height: 100vh;">
        <v-layout align-center justify-space-around row fill-height style="background-color: #89a226">
            <v-flex>
                <v-btn color="orange darken-2" @click=" goToHome" dark>
                    <v-icon dark left>arrow_back</v-icon>Back
                </v-btn>
                <v-form v-model="valid" ref="form">
                    <v-select label="Project" v-model="selectName" :items="projectNames" dark></v-select>
                    <v-text-field label="Latidude" :value="lat" :rules="[v => !!v || 'Punt moet op de map geselecteerd worden']" readonly required dark></v-text-field>
                    <v-text-field label="Longitude" :value="long" :rules="[v => !!v || 'Punt moet op de map geselecteerd worden']" readonly required dark></v-text-field>
                    <v-text-field label="Naam" v-model="name" :rules="nameRules" dark></v-text-field>
                    <v-textarea label="Beschrijving" v-model="text"  :rules="textRules" required dark></v-textarea>
                    <v-select label="Kies een categorie" v-model="selectCat" :items="categories"  dark></v-select>
                    <v-btn @click="validate" :class="{ red: !valid, green: valid }">Klaar</v-btn>

                </v-form>
            </v-flex>
            <v-flex fill-height>
                <l-map ref="eenElement" v-on:click="add($event)"
                       :zoom="zoom"
                       :center="center"

                       style="width:100%; height:80%"
                >
                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker v-for="item in markers" :key="item.id" :lat-lng="item.latlng"></l-marker>
                    <!--<v-polygon v-for="s in shapes"-->
                               <!--:key="s.id"-->
                               <!--:color="s.color"-->
                               <!--:lat-lngs="s.geometry.coordinates"-->
                               <!--@l-mouseover=change_color(s)-->
                    <!--&gt;-->
                    <!--</v-polygon>      -->
                </l-map>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import {LMap, LTileLayer, LMarker, LPopup,} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import MapPageHeader from "../map-page-header";
    import LDraw from 'leaflet-draw';
    import LPolygon from "vue2-leaflet/src/components/LPolygon";
    // import "leaflet-draw/dist/leaflet.draw.css";

    export default {
        name: 'Point',
        components: {
            LPolygon,
            MapPageHeader,
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
        },
        props: {
            _id: { type: String}
        },

        data() {
            return {
                // Data form
                name: '',
                nameRules: [
                    v => !!v || 'Naam is vereist',
                    v => (v && v.length <= 191) || 'Naam mag niet langer zijn dan 190 karakters'
                ],
                selectCat: null,
                selectName: null,
                selectedId: null,
                categories: [],
                projects: [],
                projectNames: [],
                projectIds: [],
                text: '',
                textRules: [
                    v => !!v || 'Beschreiving is vereist',
                    v => (v && v.length <= 65.535) || 'Tekst mag niet langer zijn dan 65.535 karakters zijn'
                ],
                point_id: '',
                projectId: '',

                valid: false,

                zoom: 13,
                center: L.latLng(47.413220, -1.219482),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [],
                areaLatLngs: [],
                long: '',
                lat: '',
                buttonImage: "img/MapPage/button.png",
                id: 0,
                project_points: [],
                shapes: [
                    {id: 'my_id',
                        color: '#3388ff',
                        geometry: {
                            coordinates:
                                []
                        }
                    }
                ],
                array: null,

            }
        },

        methods: {
            // adds a marker to the markers array. the event.latlng needs to be converted to floats because they are delivered as strings
            validate () {
                for(let i = 0; i<this.projectNames.length;i++){

                    if(this.projects[i].name === this.projectNames){
                        this.selectedId = this.projects[i].id;
                    }
                }
                var areaCords = [];
                for(let i = 0; i< this.areaLatLngs.length;i++){
                    areaCords.push({lat: this.areaLatLngs[i].lat, lng: this.areaLatLngs[i].lng})
                }
                if(this.$refs.form.validate()) {
                    axios({
                        method: 'post',
                        url: '/admin/updateProjectPoint/',
                        data: {
                            project_id: this.selectedId,
                            name: this.name,
                            category: this.selectCat,
                            information: this.text,
                            markerLat: this.lat,
                            markerLong: this.long,
                            area: areaCords,
                        }
                    });
                }
            },

            goToHome(){
                window.location.reload();

                this.$vuetify.goTo('#view-project-points');
                this.$parent.selectedEditPage.isSelected = false;
                this.$parent.selectedEditPage.PointId = undefined;
            },
            add(event) {
            //     if(this.markers.length > 0){
            //         this.markers.splice(-1, 1);
            //     }
            //     var coord = event.latlng;
            //     var lat = coord.lat;
            //     var lng = coord.lng;
            //     this.long = lng;
            //     this.lat = lat;
            //     this.markers.push({
            //         id: this.id,
            //         latlng: L.latLng(parseFloat(lat), parseFloat(lng)),
            //         content: ''
            //     });
            // },
            // remove() {
            //     this.markers.splice(-1, 1);
            }
        },
        mounted() {
            setTimeout(function() { window.dispatchEvent(new Event('resize')) }, 250);
            this.$vuetify.goTo('#edit-project-point');
            this.$refs.eenElement.mapObject.on('click', function (e) {
                console.log(e.latlng);

            });
            window.axios.get('/getProjects').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.projects.push({id: temp[i].id.toString(), name: temp[i].name.toString()})
                    this.projectNames.push( temp[i].name.toString());
                    this.projectIds.push( temp[i].id.toString());

                }
            }).catch(function (error) {
                console.log(error);
            });
            window.axios.get('getCategories').then(response => {

                let temp = response.data;

                for (let i = 0; i < temp.length; i++) {
                    this.categories.push(temp[i].name);
                }
            }).catch(function (error) {
                console.log(error);
            });
            console.log(this._id + " sfsdafgsf")
            window.axios.get('/admin/projectpoint/edit/'+this._id ).then(response => {
                let temp = response.data;
                this.name = temp.name;
                this.selectCat = temp.category;
                this.text = temp.information;
                this.lat = temp.location.coordinates[1];
                this.long = temp.location.coordinates[0];
                this.id = temp.id;
                this.projectId = temp.project_id;
                for(let $i = 0; $i < this.projects.length;$i++){
                    if(this.projectId == this.projects[$i].id){
                        this.selectName = this.projects[$i].name;
                    }
                }
                this.array = temp.area;
                console.log(temp);
                this.markers.push({
                    id: this.id,
                    latlng: L.latLng(parseFloat(this.lat), parseFloat(this.long)),
                    content: 'hoi!'
                })
                ;
            }).catch(function (error) {
                console.log(error);
            });
            console.log("tredgtdsfgd");
            console.log(this.array);
            this.$nextTick(() => {
                const map = this.$refs.eenElement.mapObject;
                const drawControl = new window.L.Control.Draw({
                    position: 'bottomleft',
                    draw: {
                        polygon: {
                            allowIntersection: false,
                            showArea: true
                        },
                        polyline: false,
                        rectangle: false,
                        circle: false,
                        marker: true,
                        circlemarker: false
                    }
                });

                map.addControl(drawControl);

                const editableLayers = new window.L.FeatureGroup().addTo(map);
                map.on(window.L.Draw.Event.CREATED, (e) => {
                    const type = e.layerType;
                    var layer = e.layer;

                    if (type === 'polygon') {
                        for (let i = 0; i < layer._latlngs[0].length; i++) {

                            this.areaLatLngs.push({lat: layer._latlngs[0][i].lat, lng: layer._latlngs[0][i].lng});
                        }

                        for (let i = 0; i < this.areaLatLngs.length; i++) {


                        }
                        // Do whatever else you need to. (save to db, add to map etc)
                        editableLayers.addLayer(layer);
                    } else if (type === 'marker') {
                        if (this.markers.length > 0) {
                            this.markers.splice(-1, 1);
                        }
                        this.id++;
                        var coord = layer._latlng;
                        var lat = coord.lat;
                        var lng = coord.lng;
                        this.long = lng;
                        this.lat = lat;
                        this.markers.push({
                            id: this.id,
                            latlng: L.latLng(parseFloat(lat), parseFloat(lng)),
                            content: 'hoi!'
                        });
                    }


                });
            });
        }
    }

</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 0px 0px 10px 10px;
        height: 50px;
        width: 100%;
    }
</style>