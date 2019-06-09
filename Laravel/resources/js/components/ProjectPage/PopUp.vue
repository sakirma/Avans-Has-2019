<template>
    <l-popup>
        <v-layout column align-center fill-height>
            <p class="text-xs-center title">{{ this.item.name }}</p>
            <v-card-text class="text-xs-center">{{ this.item.information }}</v-card-text>
            <v-btn dark @click="parent.OpenProjectPagePressed(id)">Open</v-btn>
        </v-layout>
    </l-popup>
</template>

<script>
    import {LPopup} from 'vue2-leaflet';

    export default {
        name: "PopUp",
        components: {
            LPopup
        },
        props: {
            item: {
                type: Object,
                required: true
            },
            parent: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                project: false
            }
        },
        mounted() {
            if(this.item.project_id) this.project = true;
            console.log(this.project);
        }
    }
</script>

<style scoped>

</style>