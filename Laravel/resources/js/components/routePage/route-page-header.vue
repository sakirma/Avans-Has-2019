<template>
    <v-layout align-end justify-end row fill-height >
        <v-flex>
            <v-btn @click="GoToMapPage">
                Back
            </v-btn>
        </v-flex>
        <v-flex fill-height xs5 py-4 style="background-color: #89a226">
            <v-card style="" flat color="transparent" class="white--text text-xs-center display-2 font-weight-black first-page-title"
                    :class="{'createOwnRouteTitle': $vuetify.breakpoint.xsOnly}">
                MAAK JE EIGEN ROUTE!
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "route-page-header",
        methods: {
            GoToMapPage() {
                this.$parent.GoToMapPage();
            },
        }
    }
</script>

<style scoped>
    .first-page-title {
        font-family: "Market Deco", Market_Deco !important;
        font-weight: bold !important;
    }

    .first-page-text {
        font-family: "FlorenceRegular", FlorenceRegular !important;
        font-weight: bold !important;
    }

    .createOwnRouteTitle {
        font-size: 14px!important;
        line-height: 16px !important;
    }
</style>