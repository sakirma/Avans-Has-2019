<template>
    <v-container fluid fill-height pt-3 pb-5>
        <v-layout row fill-height justify-space-around>
            <v-flex xs6>
                <routes-view :parent="this" :headers="headers" :desserts="desserts"  v-if="currentPageState === ProjectPageStates.viewMode"></routes-view>
                <routes-new :parent="this" v-else-if="currentPageState === ProjectPageStates.newMode"></routes-new>
                <routes-edit :parent="this" ref="projectEditSection" v-show="currentPageState === ProjectPageStates.editMode"></routes-edit>
            </v-flex>
            <v-flex d-flex xs5>
                <map-section></map-section>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import MapSection from '../Map';
    import RoutesView from './RoutesView';
    import RoutesNew from './RoutesNew';
    import RoutesEdit from './RoutesEdit';

    export default {
        name: "ProjectList",
        components: {
            MapSection,
            RoutesView,
            RoutesNew,
            RoutesEdit
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
                        text: 'Aantal Km',
                        align: 'left',
                        value: 'AantalKm',
                    },
                    {
                        text: 'Duur',
                        align: 'left',
                        value: 'duur',
                    },
                ],
                desserts: [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                        fat: 6.0,
                    },
                    {
                        name: 'Ice cream sandwich',
                        calories: 237,
                        fat: 9.0,
                        carbs: 37,
                        protein: 4.3,
                        iron: '1%'
                    },
                    {
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        carbs: 23,
                        protein: 6.0,
                        iron: '7%'
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

<style>
    .projectTable .v-datatable .v-datatable__actions .v-datatable__actions__select {
        display: none;
    }

    .projectTable .v-table__overflow {
        overflow-y: hidden;
        padding-right: 15px;
    }

    .removeScrollBar::-webkit-scrollbar {
        display: none;
    }

    .removeScrollBar {
        scrollbar-width: none;
    }

    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0, 0, 0, 0);
        transform: rotate3d(0, 0, 0, 0);
        -webkit-transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        background-color: rgba(38, 38, 38, 0.1);
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.3);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(38, 38, 38, 0.5);
    }
</style>
