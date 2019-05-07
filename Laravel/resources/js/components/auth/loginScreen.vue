<template>
    <div>
        <v-img
                height="100vh"
                src="/img/FirstPage/wet-rainy-road-leaf-fallen-hd-gl.jpg">
            <v-layout align-center justify-center row fill-height>
                <v-flex xs3>
                    <v-card color="green" height="100%" width="100%">
                        <v-img src="/img/RoadLeaf-Logo.png">

                        </v-img>
                        <v-layout align-center justify-center column>
                            <v-text-field
                                    label="username"
                                    solo
                                    flat
                            ></v-text-field>
                            <v-text-field
                                    label="password"
                                    solo
                                    flat
                            ></v-text-field>
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