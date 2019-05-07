<template>
    <div>
        <v-img
                height="100vh"
                src="/img/FirstPage/wet-rainy-road-leaf-fallen-hd-gl.jpg">
            <v-layout align-center justify-center row fill-height>
                <v-flex xs12 sm5 md4 lg3>
                    <v-card color="rgba(160, 181, 80, 0.9)" height="100%" width="100%" class="pa-4">
                        <v-img src="/img/RoadLeaf-Logo.png" style="filter: brightness(0) invert(1);" class="mb-5"/>

                        <v-layout align-center justify-center column>
                            <!-- TODO: Make background with rounded corners and add text field -->
                            <v-card width="100%" style="border-radius: 20px;" class="mb-4">
                                <v-text-field
                                        prepend-inner-icon="person"
                                        single-line
                                        full-width
                                        flat
                                        hide-details
                                        color="green"
                                ></v-text-field>
                            </v-card>

                            <v-card width="100%" style="border-radius: 20px;">
                                <v-text-field
                                        prepend-inner-icon="lock"
                                        single-line
                                        full-width
                                        flat
                                        hide-details
                                        color="green"
                                ></v-text-field>
                            </v-card>
                            <v-btn>
                                LOG IN
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
        name: "loginScreen"
    }
</script>

<style scoped>

</style>