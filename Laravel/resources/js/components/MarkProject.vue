<template>
    <div id="markProject" style="height: 100vh;">
        <v-layout  column  fill-height style="background-color: #89a226">
            <v-flex   >
                  <l-map ref="map"
                       :zoom="zoom"
                       :center="center"

                       style="width:50%; height:50%"
                       >


                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker :lat-lng="marker"></l-marker>
                </l-map>
                <v-form
                ref="form"
                v-model="valid"
                lazy-validation
                >


      <v-text-field
        v-model="name"
        :counter="10"
        :rules="nameRules"
        label="Naam"
        required
      ></v-text-field>

      <v-text-field
        v-model="inforamtion"
        :rules="emailRules"
        label="Beschrijving"
        required
      ></v-text-field>
      <v-btn
        
        color="warning"
        @click="validate"
      >
        Media Uploaden
      </v-btn>
  
      <v-btn
        color="succes"
        @click="reset"
      >
        klaar
      </v-btn>
  
     
    </v-form>
            </v-flex>

        </v-layout>
    </div>
</template>

<script>
    import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
    import "leaflet/dist/leaflet.css";
    import MapPageHeader from "./map-page-header";

    export default {
        name: 'MarkProject',
        components: {
            MapPageHeader,
            LMap,
            LTileLayer,
            LMarker
        },
        data() {
            return {
                zoom: 13,
                center: L.latLng(47.413220, -1.219482),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(47.413220, -1.219482),
                buttonImage: "img/MapPage/button.png"
            }
        },
        methods: {
            mounted() {
                setTimeout(function () {
                    window.dispatchEvent(new Event('resize'))
                }, 250);
            }
        },
        mounted() {
            this.$refs.map.mapObject.zoomControl.remove();
            this.$refs.map.mapObject.scrollWheelZoom.disable();
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
