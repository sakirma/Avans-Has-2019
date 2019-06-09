<template>
    <l-popup>
        <v-layout column align-center fill-height>
            <p class="text-xs-center title">{{ this.item.name }}
                <br>
                {{(!this.item.project_id) ? '(Project)' : ''}}
            </p>
            <v-card-text class="text-xs-center">{{ this.item.information }}</v-card-text>
            <v-btn dark @click="parent.OpenProjectPagePressed(this.item.id)">Open</v-btn>
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
        }
    }
</script>

<style scoped>

</style>