<template>
    <v-container fluid fill-height pt-3 pb-5>
        <v-layout row fill-height justify-space-around>
            <v-flex xs6 class="ml-5">
                <interest-point-view :parent="this" :headers="headers" :values="values" v-if="currentPageState === ProjectPageStates.viewMode"></interest-point-view>
                <interest-point-new :parent="this" v-else-if="currentPageState === ProjectPageStates.newMode"></interest-point-new>
                <interest-point-edit :parent="this" ref="projectEditSection" v-show="currentPageState === ProjectPageStates.editMode"></interest-point-edit>
            </v-flex>
            <v-flex d-flex xs5>
                <map-section></map-section>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import MapSection from '../Map';
    import InterestPointView from './InterestPointView';
    import InterestPointNew from './InterestPointNew';
    import InterestPointEdit from './InterestPointEdit'

    export default {
        name: "InterestPointPage",
        components: {
            MapSection,
            InterestPointView,
            InterestPointNew,
            InterestPointEdit
        },
        data() {
            return {
                ProjectPageStates: {'viewMode': 0, 'editMode': 1, 'newMode': 2},
                currentPageState: 0,
                headers: [
                    {
                        text: 'Naam',
                        align: "left",
                        value: 'name',
                    },
                    {
                        text: 'Categorie',
                        align: 'left',
                        value: 'category',
                    },
                    {
                        text: 'Project',
                        align: 'left',
                        value: 'project_id',
                    },
                    {
                        text: 'Beschrijving',
                        align: 'left',
                        value: 'information',
                    },
                ],
                values: []
            }
        },
        methods: {
            newProjectButtonPressed() {
                this.currentPageState = this.ProjectPageStates.newMode;
            },
            enableViewMode() {
                this.currentPageState = this.ProjectPageStates.viewMode;
                this.values = [];
                axios.get('/getAllProjectPointsFullInfo')
                    .then(({data}) => {
                        for(let i = 0; i < data.length; i++){
                            this.values.push({
                                id: data[i].id,
                                name: data[i].name,
                                category: data[i].category,
                                project_id: data[i].project_id,
                                information: data[i].information
                            });
                        }
                    });
            },
            editAProject(product) {
                this.currentPageState = this.ProjectPageStates.editMode;
                this.$refs.projectEditSection.projectEditSection(product);
            }
        },
        mounted() {
            this.enableViewMode();
        }
    }
</script>

<style scoped>

</style>
