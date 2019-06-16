<template>
    <v-layout align-center justify-center row fill-height ml-3>
        <v-flex class="hidden-md-and-up">
            <v-btn @click="GoBackToMapPage">
                Go back
            </v-btn>
        </v-flex>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal">
            <v-layout align-center justify-center fill-height>
                <v-img src="img/RoadLeaf-Logo.png"
                       height="100%"
                       max-height="100px"
                       contain
                       style="filter: brightness(0) invert(1);"
                       width="150px"/>
                <v-btn fab dark class="ml-5" @click="GoBackToMapPage">
                    <v-icon>
                        arrow_upward
                    </v-icon>
                </v-btn>
            </v-layout>
        </v-flex>
        <v-flex grow>
        </v-flex>
        <v-flex class="tooltipTopRight">
            <v-tooltip top content-class="tooltip-inner">
                <template v-slot:activator="{ on }">
                    <v-img class="tooltipImage"
                           contain
                           v-on="on"
                           src="img/context-sensitive-help.png"/>
                </template>
                <span>
                    Deze pagina geeft informatie weer over een interessante plek.
                    Wilt u terug naar de homepagina met de kaart, druk dan op de knop linksboven.
                </span>
            </v-tooltip>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectPageHeader",
        methods: {
            GoBackToMapPage() {
                let pageStates = this.$store.getters.pageStates;
                this.$store.commit('setPageState', pageStates.mapPage);

                this.$parent.$parent.UpdateScreen();
            }
        }
    }
</script>

<style scoped>
    .tooltipTopRight {
        max-width: 30px;
        right: 10px;
        position: relative;
    }

    .tooltipImage {
        width: 20px;
        height: 20px;
    }

    .tooltip-inner {
        color: white;
        padding: 24px;
        border-radius: 5px;
        box-shadow: 0 5px 30px;
        max-height: 100px;
        max-width: 450px;
    }
</style>