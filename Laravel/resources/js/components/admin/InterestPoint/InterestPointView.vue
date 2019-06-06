<template>
    <v-layout align-center justify-center column fill-height>
        <v-flex xs2 style="width: 100%">
            <interest-point-header :OnEditProjectButtonPressed="EditProjects"></interest-point-header>
        </v-flex>
        <v-flex style="background-color: white; overflow: auto; width: 100%;" class="removeScrollBar" v-bar>
            <v-data-table
                    :headers="headers"
<<<<<<< HEAD
                    :items="project_points"
=======
                    :items="values"
>>>>>>> development
                    class="projectTable elevation-1"
                    disable-initial-sort
                    hide-actions
                    :pagination.sync="pagination"
            >
                <template v-slot:items="props">
                    <tr @click="rowSelected(props.item.id)">
                        <td>{{ props.item.name }}</td>
<<<<<<< HEAD
                        <td class="text-xs-left">{{ props.item.category }}</td>
                        <td class="text-xs-left">{{ props.item.project_id }}</td>
                        <td class="text-xs-left">{{ props.item.information }}</td>
=======
                        <td class="text-xs-right">{{ props.item.category }}</td>
                        <td class="text-xs-right">{{ props.item.project_id }}</td>
                        <td class="text-xs-right">{{ props.item.information }}</td>
>>>>>>> development
                    </tr>
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>

<script>
    import InterestPointHeader from './InterestPointHeader';

    export default {
        name: "InterestPointView",
        components: {
            InterestPointHeader,
        },
        props: {
            headers: {
                type: Array,
                required: true
            },
<<<<<<< HEAD
            project_points: {
=======
            values: {
>>>>>>> development
                type: Array,
                required: true,
            },
            parent: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                pagination: {
                    rowsPerPage: -1,
                },
            }
        },
        methods: {
            EditProjects() {
                this.parent.newProjectButtonPressed();
            },
            rowSelected(selectedProject) {
                console.log('SELECTED PROJECT');
                console.log(selectedProject);
                this.parent.editAProject(selectedProject);
            }
        }
    }
</script>

<style scoped>

</style>
