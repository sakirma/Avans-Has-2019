<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal">
            <v-img src="img/RoadLeaf-Logo.png"
                   height="100%"
                   max-height="100px"
                   contain
                   style="filter: brightness(0) invert(1);"
                   width="150px"/>
        </v-flex>
        <v-flex mx-5>
            <v-layout align-center justify-center row fill-height mx-5>
                <v-flex>
                    <v-card>
                        Categorie 1
                    </v-card>
                </v-flex>
                <v-flex>
                    <v-card>
                        Categorie 2
                    </v-card>
                </v-flex>
                <v-flex>
                    <v-card>
                        Categorie 3
                    </v-card>
                </v-flex>
                <v-flex>
                    <v-card>
                        Categorie 4
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "map-page-header",
    }
</script>

<style scoped>
    .v-card--reveal {
        margin-left: 1%;
    }
</style>
