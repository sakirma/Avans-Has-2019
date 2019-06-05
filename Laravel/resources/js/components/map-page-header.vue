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
                    <v-img src="img/Symbolen_Activiteiten.png" :class="{'categoryButtonPressed': image0IsPressed}">
                        <div class="categoryButton" @click="toggleCategory(0)"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Horeca.png" :class="{'categoryButtonPressed': image1IsPressed}">
                        <div class="categoryButton" @click="toggleCategory(1)"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Bezienswaardigheden.png" :class="{'categoryButtonPressed': image2IsPressed}">
                        <div class="categoryButton" @click="toggleCategory(2)"></div>
                    </v-img>
                </v-flex>
                <v-flex d-flex>
                    <v-img src="img/Symbolen_Natuurgebieden.png" :class="{'categoryButtonPressed': image3IsPressed}">
                        <div class="categoryButton" @click="toggleCategory(3)"></div>
                    </v-img>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "map-page-header",
        methods: {
            toggleCategory(imageNumber) {
                if (imageNumber === 0) {
                    this.image0IsPressed = !this.image0IsPressed;
                } else if (imageNumber === 1) {
                    this.image1IsPressed = !this.image1IsPressed;
                } else if (imageNumber === 2) {
                    this.image2IsPressed = !this.image2IsPressed;
                } else if (imageNumber === 3) {
                    this.image3IsPressed = !this.image3IsPressed;
                }
            }
        },
        data() {
            return {
                image0IsPressed: false,
                image1IsPressed: false,
                image2IsPressed: false,
                image3IsPressed: false,
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
