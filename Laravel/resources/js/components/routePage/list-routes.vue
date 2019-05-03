<template>

    <v-flex xs12 sm4 md3 py-3 style="background-color: #D9DECD; z-index: 1001;">
        <v-card flat color="#D9DECD" style="min-height: 250px;" v-bar>
            <v-responsive max-height="250px" >
                <draggable tag="ul" v-model="routeList" v-bind="dragOptions" @start="drag=true" @end="drag=false">
                    <transition-group type="transition">
                        <selected-list-route v-for="route in routeList" :key="route.id"
                                             :name="route.name" :id="route.id"></selected-list-route>
                    </transition-group>
                </draggable>
            </v-responsive>
        </v-card>
    </v-flex>
</template>

<script>
    import SelectedListRoute from "./selected-list-route";
    import draggable from "vuedraggable";

    export default {
        name: "list-routes",
        components: {
            SelectedListRoute,
            draggable,
        },
        data() {
            return {
                selectedPoints: [],
                routeList: [],
            }
        },
        mounted() {

            window.axios.get('http://127.0.0.1:8000/getAllRoutes')
            .then(response => {
                console.log(response.data);
                this.routeList = response.data;
            }).catch(e => {
                console.log(e);
            });

           
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
        }
    }
</script>

<style scoped>
    .button {
        margin-top: 35px;
    }

    .flip-list-move {
        transition: transform 0.5s;
    }

    .no-move {
        transition: transform 0s;
    }

    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }

    .list-group {
        min-height: 20px;
    }

    .list-group-item {
        cursor: move;
    }

    .list-group-item i {
        cursor: pointer;
    }
</style>