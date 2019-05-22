<template>
    <v-layout align-start justify-sapce-between row fill-height  style="background-color: #89a226">
        <h2>INTEREST POINTS</h2>
        <v-flex >
            <v-btn dark color="green" @click="OpenAddPressed" style="margin-left:1%"> Nieuwe bezienswaardigheid </v-btn>
            <v-btn dark color="green" @click="GoBack"> Terug </v-btn>
            <v-card v-for="p in interest_points" :key="interest_points.id" style="width:30%; height:100%; margin-left: 1%; margin-bottom: 1% ">
                <p class="text-sm-center">{{ p.name}}</p>
                <p class="text-sm-center">{{ p.text}}</p>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-content >
                            <v-container align-center justify-center row fill-height >
                                <v-btn @click="OpenEditPagePressed(p.id)">Bewerken</v-btn>
                                <v-btn color="error" @click="deleteItem(p.id)">Wissen</v-btn>
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
        name: "ViewInterestPoints",
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
                    interestPointId: undefined
                },
                interest_points: [],
            }
        },
        methods:{
            OpenEditPagePressed: function (id) {
                this.onEditPageOpened(id);
            },
            OpenAddPressed: function () {
                this.onAddOpened();
            },
            GoBack() {
                window.location.href = '/beheer';
            },
            deleteItem (id) {
                if(confirm('Weet u zeker dat deze bezienswaardigheid wilt verwijderen?')){
                    axios({
                        method: 'post',
                        url: '/admin/deleteInterestPoint',
                        data: {
                            id: id,

                        }
                    });
                    window.location.reload();
                }
            },
        },
        mounted() {
            window.axios.get('/getInterestPoints').then(response => {
                let temp = response.data;
                for (let i = 0; i < temp.length; i++) {
                    console.log(temp[i]);
                    this.interest_points.push({id: temp[i].id,project_id: temp[i].project_id , location: temp[i].location, area: temp[i].area, name: temp[i].name, information: temp[i].information, category: temp[i].categroy});
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

<style scoped>

</style>