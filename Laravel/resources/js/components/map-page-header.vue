<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex shrink class="hidden-sm-and-down v-card--reveal" style="position: absolute; left: 2%;">
            <v-img src="img/RoadLeaf-Logo.png"
                   height="100%"
                   max-height="100px"
                   contain
                   style="filter: brightness(0) invert(1);"
                   width="150px"/>
        </v-flex>
        <v-flex xs12 sm8 md7 lg4 :class="{ 'mx-5': $vuetify.breakpoint.smAndUp}" fill-height>
            <v-layout align-center justify-center row fill-height :class="{ 'mx-5': $vuetify.breakpoint.smAndUp}">
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Activiteiten.png" :class="{'categoryButtonPressed': parent.pressedImages[0]}">
                        <div class="categoryButton" @click="toggleCategory(Object.keys(parent.pressedImages)[0])"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Horeca.png" :class="{'categoryButtonPressed': parent.pressedImages[1]}">
                        <div class="categoryButton" @click="toggleCategory(Object.keys(parent.pressedImages)[1])"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Bezienswaardigheden.png" :class="{'categoryButtonPressed': parent.pressedImages[2]}">
                        <div class="categoryButton" @click="toggleCategory(Object.keys(parent.pressedImages)[2])"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Natuurgebieden.png" :class="{'categoryButtonPressed': parent.pressedImages[3]}">
                        <div class="categoryButton" @click="toggleCategory(Object.keys(parent.pressedImages)[3])"></div>
                    </v-img>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "map-page-header",
        props: {
            parent: {
                type: Object
            }
        },
        methods: {
            toggleCategory(key) {
                this.parent.filter(key);
            }
        }
    }
</script>

<style scoped>
    .v-card--reveal {
        margin-left: 1%;
    }

    .categoryButton {
        cursor: pointer;
        position: absolute;
        width: 70%;
        height: 60%;
        left: 15%;
        top: 14%;
    }

    .categoryButtonPressed {
        filter: brightness(0.5);
    }
</style>
