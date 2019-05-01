<template>
    <v-layout align-start fill-height row style="background-color: #89a226">
        <v-flex >
            <v-btn fab dark color="green" href="/beheer/project/aanmaken">
                <v-icon dark>add</v-icon>
            </v-btn>
            <v-card v-for="p in projects" :key="projects.id"    style="width:30%; height:100%">
                <p class="text-sm-center">{{ p.name}}</p>
                <p class="text-sm-center">{{ p.text}}</p>
                <v-list-item>
                    <v-list-item-content >
                        <v-container align-center justify-center row fill-height >
                            <v-btn color="warning">Bewerken</v-btn>
                            <v-btn color="error" @click="deleteItem(p._id)">Wissen</v-btn>
                        </v-container>
                    </v-list-item-content>
                </v-list-item>
            </v-card>

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
                if(confirm(' wil je dit project zeker verwijderen?')){
                    axios({
                        method: 'post',
                        url: '/beheer/DeleteProject',
                        data: {
                            id: id,

                        }
                    });

                    window.location.reload();

                };

            },

        },
        mounted() {
            window.axios.get('http://127.0.0.1:8000/getProjects').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    this.projectNames.push( temp[i].name);
                    this.projectIds.push( temp[i].id);
                    this.projects.push({name: temp[i].name,_id: temp[i].id , text: temp[i].information});
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