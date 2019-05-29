<template>
    <v-container fluid fill-height pt-3 pb-5>
        <v-layout row fill-height justify-space-around>
            <v-flex xs6>
                <interest-point-view :parent="this" :headers="headers" :desserts="desserts"
                                     v-if="currentPageState === ProjectPageStates.viewMode"></interest-point-view>
                <interest-point-new :parent="this"
                                    v-else-if="currentPageState === ProjectPageStates.newMode"></interest-point-new>
                <interest-point-edit :parent="this" ref="projectEditSection"
                                     v-show="currentPageState === ProjectPageStates.editMode"></interest-point-edit>
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
                        value: 'calories',
                    },
                    {
                        text: 'Project',
                        align: 'left',
                        value: 'projectId',
                    },
                    {
                        text: 'Beschrijving',
                        align: 'left',
                        value: 'fat',
                    },
                ],
                desserts: [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                        projectId: 1,
                        fat: 6.0,
                    },
                    {
                        name: 'Ice cream sandwich',
                        calories: 237,
                        projectId: 2,
                        fat: 9.0,
                    },
                    {
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        projectId: 1,
                    },
                    {
                        name: 'Cupcake',
                        calories: 305,
                        fat: 3.7,
                        carbs: 67,
                        protein: 4.3,
                        iron: '8%'
                    },
                    {
                        name: 'Gingerbread',
                        calories: 356,
                        fat: 16.0,
                        carbs: 49,
                        protein: 3.9,
                        iron: '16%'
                    },
                    {
                        name: 'Jelly bean',
                        calories: 375,
                        fat: 0.0,
                        carbs: 94,
                        protein: 0.0,
                        iron: '0%'
                    },
                    {
                        name: 'Lollipop',
                        calories: 392,
                        fat: 0.2,
                        carbs: 98,
                        protein: 0,
                        iron: '2%'
                    },
                    {
                        name: 'Honeycomb',
                        calories: 408,
                        fat: 3.2,
                        carbs: 87,
                        protein: 6.5,
                        iron: '45%'
                    },
                    {
                        name: 'Donut',
                        calories: 452,
                        fat: 25.0,
                        carbs: 51,
                        protein: 4.9,
                        iron: '22%'
                    },
                    {
                        name: 'KitKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        projectId: 4,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                    {
                        name: 'KiasdasdasdtKat',
                        calories: 518,
                        fat: 26.0,
                        carbs: 65,
                        protein: 7,
                        iron: '6%'
                    },
                ]
            }
        },
        methods: {
            newProjectButtonPressed() {
                this.currentPageState = this.ProjectPageStates.newMode;
            },
            enableViewMode() {
                this.currentPageState = this.ProjectPageStates.viewMode;
            },
            editAProject(product) {
                this.currentPageState = this.ProjectPageStates.editMode;
                this.$refs.projectEditSection.projectEditSection(product);
            }
        }
    }
</script>

<style scoped>

</style>