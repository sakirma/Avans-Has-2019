<template>
    <v-img height="100vh" max-height="100%" src="/img/admin/natuurgebied_brabant.jpg">
        <v-container fluid fill-height pa-5>
            <v-layout align-start justify-space-between row fill-height>
                <v-flex xs7 d-flex fill-height pr-5>
                    <v-layout align-space-between justify-space-between column fill-height>
                        <v-flex d-flex xs6>
                            <v-card color="#8DA659" class="roundedCard">
                                <v-card-title class="display-1 white--text">
                                    <v-layout align-start column>
                                        Statistieken
                                        <div class="chart-container" style="position: relative; height: 10vh; width: 15vw">
                                            <bar-chart :data="datasets"/>
                                        </div>

                                    </v-layout>

                                </v-card-title>
                            </v-card>
                        </v-flex>

                        <v-flex xs5 d-flex fill-height>
                            <v-card color="#8DA659" class="roundedCard">
                                <v-card-title class="headline white--text">
                                    <v-layout column align-start fill-height>
                                        <v-flex xs1>
                                            Meest bezochte routes
                                        </v-flex>

                                        <v-layout align-start justify-space-between row fill-height>
                                            <v-flex xs3>
                                                <v-card-text class="body-2">
                                                    1. Route van de avonturier <br>
                                                    2. Route van Napoleon <br>
                                                    3. Traditionele route <br>
                                                    4.Vlinder tocht <br>
                                                    5. Herfst promenade <br>
                                                </v-card-text>
                                            </v-flex>
                                            <v-flex xs5>
                                                <v-card-text class="body-2">
                                                    Lorem ipsum dolor sit amet,
                                                    consectetuer adipiscing elit, sed diam
                                                    nonummy nibh euismod tincidunt ut
                                                    laoreet dolore magna aliquam erat
                                                    volutpat. Ut wisi enim ad minim
                                                    veniam, quis nostrud exerci tation
                                                    ullamcorper suscipit lobortis nisl ut
                                                    aliquip ex ea commodo consequat.
                                                    Duis autem vel eum iriure dolor in
                                                    hendrerit in vulputate velit esse
                                                    molestie consequat, vel illum dolore
                                                    eu feugiat nulla facilisis at vero eros et
                                                </v-card-text>
                                            </v-flex>
                                        </v-layout>
                                    </v-layout>
                                </v-card-title>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-flex xs5 d-flex fill-height>
                    <v-layout align-space-between justify-space-between column fill-height>
                        <v-flex d-flex fill-height xs6>
                            <v-layout align-center justify-center column>
                                <v-flex xs5 d-flex pb-1 style="width: 40%">
                                    <v-card color="#8DA659" class="visitorsToday">
                                        <v-card-text class="pt-1 pb-0">
                                            <v-layout column align-center fill-height>
                                                <v-flex shrink>
                                                    <p class="text-xs-center headline font-weight-bold mb-0">
                                                        Vandaag
                                                    </p>
                                                </v-flex>
                                                <v-flex grow>
                                                    <v-layout align-end justify-center row fill-height>
                                                        <p class="display-4 font-weight-bold white--text">
                                                            --
                                                        </p>
                                                        <p class="text-xs-right body-1">
                                                            Bezoekers
                                                        </p>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>

                                        </v-card-text>
                                    </v-card>
                                </v-flex>

                                <v-flex xs5 d-flex pb-1 style="width: 40%">
                                    <v-card color="#8DA659" class="visitorsWeek">
                                        <v-card-text class="pt-1 pb-0">
                                            <v-layout column align-center fill-height reverse>
                                                <v-flex shrink>
                                                    <p class="text-xs-center headline font-weight-bold mb-0">
                                                        Deze week
                                                    </p>
                                                </v-flex>
                                                <v-flex grow>
                                                    <v-layout align-end justify-center row fill-height>
                                                        <p class="display-4 font-weight-bold white--text">
                                                            --
                                                        </p>
                                                        <p class="text-xs-right body-1">
                                                            Bezoekers
                                                        </p>
                                                    </v-layout>
                                                </v-flex>
                                            </v-layout>

                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-flex>

                        <v-flex xs5 d-flex fill-height>
                            <v-card color="#8DA659" class="roundedCard">
                                <v-card-text class="white--text body-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor ante, a vestibulum magna imperdiet sit amet. Proin accumsan, urna nec lacinia vehicula, ipsum urna volutpat orci, eu semper erat justo eget ligula. Mauris interdum metus vitae laoreet euismod. Phasellus scelerisque urna id turpis gravida, vel condimentum mauris euismod. Mauris vel imperdiet nisl. Nam cursus porttitor placerat. Praesent luctus ullamcorper enim, nec sodales nisl. Suspendisse ultrices urna a orci tempus, ut condimentum sapien eleifend. Sed sodales ornare massa, id feugiat quam varius ut. Fusce dictum auctor dui vitae faucibus. Phasellus porta varius quam. Donec dolor ex, tincidunt eget scelerisque ut, tristique vitae eros. In ut vulputate quam.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-container>
    </v-img>
</template>

<script>
    import BarChart from './BarChart';

    export default {
        name: "StatisticsPage",
        data() {
            return {
                datasets: {
                    labels: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
                    datasets: [{
                        label: 'bezoekers',
                        backgroundColor: '#d9decd',
                        data: [40, 30, 20, 10, 0, 50, 60, 70]
                    }]
                },
            }
        },
        components: {
            BarChart,
        }
    }
</script>

<style scoped>
    .visitorsToday {
        border-radius: 15px 15px 0 0;
    }

    .visitorsWeek {
        border-radius: 0 0 15px 15px;
    }

    .roundedCard {
        border-radius: 15px;
    }
</style>