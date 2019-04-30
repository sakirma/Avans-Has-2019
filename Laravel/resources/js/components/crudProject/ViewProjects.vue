<template>
    <v-layout align-start fill-height row style="background-color: #89a226">
        <v-flex >
            <v-card v-for="p in projects"     style="width:30%; height:100%">
                <p class="text-sm-center">{{ p.name }}</p>

                <v-list-item>
                    <v-list-item-content >
                        <v-container align-center justify-center row fill-height >
                            <v-btn color="success" >Details</v-btn>
                            <v-btn color="warning">Bewerken</v-btn>
                            <v-btn color="error" @click.prevent="deleteItem(id)">Wissen</v-btn>
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
                projects: [],



            }
        },
        methods:{
          deleteItem(id){
              var _this = this;
              axios.post('/vueitems/' + item.id).then(function (response) {
                  _this.getVueItems();
                  _this.hasDeleted = false
              });
          },
        },
        mounted() {
            window.axios.get('http://127.0.0.1:8000/getProjects').then(response => {
                let temp = response.data;
                console.log(response);
                for (let i = 0; i < temp.length; i++) {
                    this.projects.push({name: temp[i].name}, {id: temp[i].id});


                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }

</script>

<style scoped>

</style>