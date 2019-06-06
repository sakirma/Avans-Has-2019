<template>
    <v-layout column align-start>
        <v-flex xs7 sm8 lg6 xl4>
            <v-responsive>
                <draggable
                    tag="ul"
                    v-model="currentSelectedProjects"
                    v-bind="dragOptions"
                    @start="drag=true"
                    @end="drag=false"
                    style="padding: 0"
                >
                    <template v-for="(route, index) in currentSelectedProjects">
                        <div   :key="index">
                            <v-layout align-center justify-space-between row fill-height>
                                <div style="width: 100%;" class="my-1 routeDrag" flat>
                                    <v-layout align-center justify-center row fill-height
                                              class="routeButton">
                                        <v-card-text class="py-0 headline "
                                                     style="color: rgba(137,163,36,0.7575)">
                                            {{route.projectName}}
                                        </v-card-text>
                                        <v-icon color="#89a324" class="mr-1">
                                            list
                                        </v-icon>
                                    </v-layout>
                                </div>
                            </v-layout>
                        </div>
                    </template>
                </draggable>
            </v-responsive>
        </v-flex>
        <v-flex xs7 sm8 lg6 xl6 mt-3>
            <v-autocomplete
                v-model="currentSelectedProjects"
                :items="interestPoints"
                box
                chips
                color="blue-grey lighten-2"
                label="Select"
                item-text="projectName"
                return-object
                multiple
                style="max-width: 90%;"
            >
                <template
                    slot="selection"
                    slot-scope="data"
                >
                    <v-chip
                        :selected="data.selected"
                        close
                        class="chip--select-multi"
                        @input="data.parent.selectItem(data.item)"
                    >
                        {{ data.item.projectName }}
                    </v-chip>
                </template>
                <template
                    slot="item"
                    slot-scope="data"
                >
                    <v-list-tile-content>
                        <v-list-tile-title v-html="data.item.projectName"></v-list-tile-title>
                    </v-list-tile-content>
                </template>
            </v-autocomplete>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectSelectionList",
        data() {
            return {
                currentSelectedProjects: [],
                interestPoints: [
                    {
                        id: 0,
                        projectName: 'a Name',
                        checkboxSelected: false,
                    },
                    {
                        id: 1,
                        projectName: 'a Name 1 adasdads',
                        checkboxSelected: false,
                    },
                    {
                        id: 2,
                        projectName: 'a Name 2',
                        checkboxSelected: false,
                    },
                    {
                        id: 3,
                        projectName: 'a Name 3 asdasdsa',
                        checkboxSelected: false,
                    },
                    {
                        id: 4,
                        projectName: 'a Name asdasds a',
                        checkboxSelected: false,
                    },
                    {
                        id: 5,
                        projectName: 'a Name 1 asdasda',
                        checkboxSelected: false,
                    },
                    {
                        id: 6,
                        projectName: 'a Name 2',
                        checkboxSelected: false,
                    },
                    {
                        id: 7,
                        projectName: 'a Name 3 asdsads',
                        checkboxSelected: false,
                    },{
                        id: 8,
                        projectName: 'a Name',
                        checkboxSelected: false,
                    },
                    {
                        id: 9,
                        projectName: 'a Name 1',
                        checkboxSelected: false,
                    },
                    {
                        id: 10,
                        projectName: 'a Name 2',
                        checkboxSelected: false,
                    },
                    {
                        id: 11,
                        projectName: 'a Name 3',
                        checkboxSelected: false,
                    },
                    {
                        id: 12,
                        projectName: 'a Name',
                        checkboxSelected: false,
                    },
                    {
                        id: 13,
                        projectName: 'a Name 1',
                        checkboxSelected: false,
                    },
                    {
                        id: 14,
                        projectName: 'a Name 2',
                        checkboxSelected: false,
                    },
                    {
                        id: 15,
                        projectName: 'a Name 3',
                        checkboxSelected: false,
                    },
                ],
            }
        },
        mounted() {

        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        },
        methods: {
            getSelectedProjectPoints() {
                return this.currentSelectedProjects;
            }
            // toggleProjectPoint(projectPoint) {
            //     projectPoint.checkboxSelected = !projectPoint.checkboxSelected;
            //     if (projectPoint.checkboxSelected)
            //         this.currentSelectedProjects.push(projectPoint);
            //     else
            //         this.removeFromSelectedProjects(projectPoint);
            // },
            // removeProjectPoint(projectPoint) {
            //     projectPoint.checkboxSelected = false;
            //     this.removeFromSelectedProjects(projectPoint);
            // },
            // removeFromSelectedProjects(point) {
            //     for (let i = 0; i < this.currentSelectedProjects.length; i++) {
            //         if (this.currentSelectedProjects[i] === point) {
            //             this.currentSelectedProjects.splice(i, 1);
            //         }
            //     }
            // }
        }
    }
</script>

<style scoped>

</style>
