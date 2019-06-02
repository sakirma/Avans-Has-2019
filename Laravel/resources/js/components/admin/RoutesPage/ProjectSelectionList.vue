<template>
    <div>
        <!--        Added Project Points -->
        <v-expansion-panel expand flat class="transparent elevation-0 vuse-expansion">
            <v-expansion-panel-content class="expansionbg">
                <div slot="header">Gekozen punten ({{currentSelectedProjects.length}})</div>
                <v-card flat>
                    <v-card-text class="overflow-hidden py-0">
                        <v-layout row justify-start align-start class="horiz-scroll">
                            <div class="px-1 py-1 pos-relative" v-for="(project, index) in currentSelectedProjects" :key="index" >
                                <v-card class="projectTitle">
                                    <v-card-text class="title">
                                        {{project.projectName}}
                                        <v-btn small icon class="" color="red" @click="removeProjectPoint(project)">
                                            <v-icon color="white">close</v-icon>
                                        </v-btn>
                                    </v-card-text>
                                </v-card>
                            </div>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-expansion-panel-content>
        </v-expansion-panel>

        <!--        All Projects in list -->
        <v-list
                subheader
                one-line
        >
            <template v-for="(point, index) in projectsInList">
                <v-list-tile :key="index" @click="toggleProjectPoint(point)">
                    <v-list-tile-action>
                        <v-checkbox :input-value="point.checkboxSelected"
                        ></v-checkbox>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>{{point.projectName}}</v-list-tile-title>
                        <v-list-tile-sub-title>Notify me about updates to apps or games that I downloaded
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </div>
</template>

<script>
    export default {
        name: "ProjectSelectionList",
        data() {
            return {
                currentSelectedProjects: [],
                projectsInList: [
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
        methods: {
            toggleProjectPoint(projectPoint) {
                projectPoint.checkboxSelected = !projectPoint.checkboxSelected;
                if (projectPoint.checkboxSelected)
                    this.currentSelectedProjects.push(projectPoint);
                else
                    this.removeFromSelectedProjects(projectPoint);
            },
            removeProjectPoint(projectPoint) {
                projectPoint.checkboxSelected = false;
                this.removeFromSelectedProjects(projectPoint);
            },
            removeFromSelectedProjects(point) {
                for (let i = 0; i < this.currentSelectedProjects.length; i++) {
                    if (this.currentSelectedProjects[i] === point) {
                        this.currentSelectedProjects.splice(i, 1);
                    }
                }
            }
        }
    }
</script>

<style scoped>
    .projectTitle {
        white-space: nowrap;
        overflow: hidden;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    .horiz-scroll {
        overflow-y: hidden;
        overflow-x: auto;
    }
</style>