<template>
    <v-layout align-start justify-sapce-between row fill-height  style="background-color: #89a226">
        <v-flex >
            <h2>Project Points</h2>
            <v-btn   dark color="green" @click="OpenAddPressed" style="margin-left:1%"> Nieuw Project </v-btn>
            <v-card v-for="p in projects" :key="projects.id" style="width:30%; height:100%; margin-left: 1%; margin-bottom: 1% ">
                <p class="text-sm-center">{{ p.name}}</p>
                <p class="text-sm-center">{{ p.text}}</p>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-content >
                            <v-container align-center justify-center row fill-height >
                                <v-btn @click="OpenEditPagePressed(p._id)">{{p._id}}</v-btn>
                                <v-btn color="error" @click="deleteItem(p._id)">Wissen</v-btn>
                            </v-container>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ViewProjects",
        props: {
            onAddOpened: {
                type: Function,
            },
            onEditPageOpened: {
                type: Function,
            }
        },
        data() {
            return {
                selectedEditPage: {
                    isSelected: false,
                    projectId: undefined
                },
                projects: [],
            }
        },
        methods:{
            OpenEditPagePressed: function (projectId) {
                this.onEditPageOpened(projectId);
            },
            OpenAddPressed: function () {
                this.onAddOpened();
            },
            deleteItem (id) {
                if(confirm(' wil je dit project zeker verwijderen?')){
                    axios({
                        method: 'post',
                        url: '/beheer/DeleteProject',
                        data: {
                            id: id,

                        }
                    });
                    window.location.reload();
                }
            },
        },
        mounted() {
            window.axios.get('/getProjectPoints').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.projects.push({name: temp[i].name,_id: temp[i].id , text: temp[i].information});
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

<style scoped>

</style>