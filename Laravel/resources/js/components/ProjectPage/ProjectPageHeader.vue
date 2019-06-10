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

</style>