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
<!--        <v-flex grow>-->
<!--            <v-card-title>{{ name }}</v-card-title>-->
<!--        </v-flex>-->
        <v-flex fill-height xs5 py-4 style="background-color: #89a226">
            <v-card style="" flat color="transparent" class="white--text text-xs-center display-2 font-weight-black first-page-title"
                    :class="{'createOwnRouteTitle': $vuetify.breakpoint.xsOnly}">
                {{ name }}
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectPageHeader",
        props: {
            name: ''
        },
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
    .first-page-title {
        font-family: "Market Deco", Market_Deco !important;
        font-weight: bold !important;
    }

    .createOwnRouteTitle {
        font-size: 14px!important;
        line-height: 16px !important;
    }
</style>