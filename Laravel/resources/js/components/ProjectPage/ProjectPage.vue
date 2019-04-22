<template>
    <div style="height: 100vh; background-color: #89a226;">
        <v-layout fill-height column>
            <v-flex xs1 ma-3>
                <project-page-header></project-page-header>
            </v-flex>
            <v-flex style="background-color: red" grow>

                <v-layout row fill-height>
                    <v-flex ma-3 style="background-color: white" grow>

                    </v-flex>
                    <v-flex xs4 shrink style="background-color: blue">
                        adasdsad
                    </v-flex>
                </v-layout>
            </v-flex>

        </v-layout>
    </div>
</template>

<script>
    import ProjectPageHeader from './ProjectPageHeader';

    export default {
        name: "ProjectPage",
        mounted() {
            this.$vuetify.goTo('#projectPage');
        },
        components: {
            ProjectPageHeader,
        }
    }
</script>

<style scoped>

</style>