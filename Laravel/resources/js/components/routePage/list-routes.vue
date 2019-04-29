<template>

    <v-flex xs12 sm4 md3 py-3 style="background-color: #D9DECD; z-index: 1001;">
        <v-card flat color="#D9DECD" style="min-height: 250px;">
            <!--                    <v-list dense style="background-color: #D9DECD" v-for="(item, index) in selectedPoints" v-bind:key="index">-->
            <!--                    </v-list>-->
            <draggable tag="ul" v-model="selectedPoints" v-bind="dragOptions" @start="drag=true" @end="drag=false">
                <transition-group type="transition">
                    <selected-list-route v-for="item in selectedPoints" :key="item[1]"
                                         :projectName="item[0]"></selected-list-route>
                </transition-group>
            </draggable>
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
            }
        },
        mounted() {
            let mainPageComponent = this.$parent.$parent.$parent;
            mainPageComponent.disableInputEvents(this);

            this.selectedPoints = [
                ['wow', 1, 'lat', 'lng'],
                ['lol', 2, 'lat', 'lng'],
                ['hehd', 3, 'lat', 'lng'],
                ['hsasd', 4, 'lat', 'lng'],
                ['fuak', 5, 'lat', 'lng'],
            ];
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