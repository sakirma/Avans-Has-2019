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
        <v-layout align-center justify-center row fill-height>
            <v-btn icon>
                <v-img src="img/MapPage/double_arrow_left.svg">
                </v-img>
            </v-btn>
            <v-btn large flat icon color="white">
                <v-icon large>
                    arrow_back_ios
                </v-icon>
            </v-btn>

            <div :class="{'subheading': $vuetify.breakpoint.xs}"
                 class="text-xs-center font-weight-black white--text display-1">
                LAAT MIJ NATUUR ZIEN
            </div>

            <v-btn large flat icon color="white">
                <v-icon large>arrow_forward_ios</v-icon>
            </v-btn>
            <v-btn icon>
                <v-img style="transform: scaleX(-1);" src="img/MapPage/double_arrow_left.svg">
                </v-img>
            </v-btn>
        </v-layout>
    </v-layout>
</template>

<script>
    export default {
        name: "map-page-header",
        doubleArrowLeft: "img/MapPage/double_arrow_left.svg"
    }
</script>

<style scoped>
    .v-card--reveal {
        margin-left: 1%;
        position: absolute;
        width: 100%;
    }
</style>
