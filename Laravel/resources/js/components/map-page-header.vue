<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex shrink class="hidden-sm-and-down">
            <v-img src="img/RoadLeaf-Logo.png"
                   height="100%"
                   max-height="100px"
                   contain
                   position="center left"
                   style="filter: brightness(0) invert(1);"
                   width="150px"/>
        </v-flex>
        <v-flex grow>
            <v-layout align-center justify-center row fill-height>
                <v-btn large flat icon color="white">
                    <v-icon large>
                        arrow_back_ios
                    </v-icon>
                </v-btn>

                <div :class="{'subheading': $vuetify.breakpoint.xs}" class="text-xs-center font-weight-black white--text display-1">
                    LAAT MIJ NATUUR ZIEN
                </div>

                <v-btn large flat icon color="white">
                    <v-icon large>arrow_forward_ios</v-icon>
                </v-btn>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "map-page-header"
    }
</script>

<style scoped>

</style>