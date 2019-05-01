<template>
    <v-layout align-start fill-height row style="background-color: #89a226">
        <v-flex >
            <v-card v-for="p in projects" :key="names"    style="width:30%; height:100%">
                <p class="text-sm-center">{{ p.name}}</p>
                <v-list-item>
                    <v-list-item-content >
                        <v-container align-center justify-center row fill-height >
                            <v-btn color="success" >Details</v-btn>
                            <v-btn color="warning">Bewerken</v-btn>
                            <v-btn color="error" @click="deleteItem(p._id)">{{p._id}}</v-btn>
                        </v-container>
                    </v-list-item-content>
                </v-list-item>
            </v-card>
            <v-btn fab dark color="green" href="/beheer/project/aanmaken">
                <v-icon dark>add</v-icon>
            </v-btn>
        </v-flex>

    </v-layout>

</template>

<script>
    export default {
        name: "viewProjects",
        data() {
            return {
                projectNames: [],
                projectIds: [],
                projects: [],

            }
        },
        methods:{

            deleteItem (id) {
                console.log(id);
                if(confirm(id)){
                    axios({
                        method: 'delete',
                        url: '/beheer/project/',

                    });
                };

            },

        },
        mounted() {
            window.axios.get('http://127.0.0.1:8000/getProjects').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.projectNames.push( temp[i].name);
                    this.projectIds.push( temp[i].id);
                    this.projects.push({name: temp[i].name,_id: temp[i].id});
                }
                for (let i = 0; i < temp.length; i++) {

                    console.log(this.projects[i].name + " - "+ this.projects[i]._id)


                }

            }).catch(function (error) {
                console.log(error);
            });
        }
    }

</script>

<style scoped>

</style>