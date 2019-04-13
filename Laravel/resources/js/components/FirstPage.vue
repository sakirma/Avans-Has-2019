<template>
    <div>
        <v-img
                height="100vh"
                src="img/FirstPage/wet-rainy-road-leaf-fallen-hd-gl.jpg">
            <v-layout justify-end row fill-height style="transition: none;">
                <v-flex  xs12 md4>
                        <v-card height="100vh" color="rgb(136, 176, 0, 0.5)"
                                style="transition: none" class="text-xs-center white--text">

                            <v-layout align-center justify-center column fill-height>
                                <v-spacer></v-spacer>

                                <v-card-text class="first-page-title display-3">ROADLEAF</v-card-text>
                                <v-card-text class="first-page-text display-1">Ontdek Brabant op een andere wijze</v-card-text>

                                <v-spacer></v-spacer>
                                <v-btn color="rgb(0,0,0, 0.65)" outline fab>
                                    <v-icon>arrow_drop_down_circle</v-icon>
                                </v-btn>
                            </v-layout>
                        </v-card>
                </v-flex>
            </v-layout>
        </v-img>
    </div>
</template>

<script>
    export default {
        name: "FirstPage"
    }
</script>

<style scoped>
    .first-page-title {
        font-family: bebas_neuebold !important;
        font-weight: bold !important;
    }

    .first-page-text {
        font-family: VerveineW01-Regular !important;
        font-weight: bold !important;
    }
</style>