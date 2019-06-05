<template>
    <l-popup>
        <v-layout column align-center fill-height>
            <p class="text-xs-center title">{{ name }}</p>
            <v-card-text class="text-xs-center">{{ info }}</v-card-text>
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
            id: {
                type: Number,
                required: true
            },
            parent: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                name: '',
                info: ''
            }
        },
        mounted() {
            axios.get('/getProjectPoint/'+this.id)
                .then(({ data }) => {
                    this.name = data.name;
                    this.info = data.information;
                });
        }
    }
</script>

<style scoped>

</style>