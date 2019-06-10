<template>
    <v-container fluid fill-height pa-5 style="z-index: 3; background-size: 100%" :style="{ backgroundImage: `url('${'img/admin/natuurgebied_brabant.jpg'}')` }">
        <v-layout align-start justify-space-between row fill-height>
            <v-flex xs7 d-flex fill-height pr-5>
                <v-layout align-space-between justify-space-between column fill-height>
                    <v-flex d-flex xs6 lg5 xl5>
                        <v-card color="#8DA659" class="roundedCard">
                            <v-card-title class="display-1 white--text">
                                <v-layout align-start column>
                                    Statistieken
                                    <div class="chart-container">
                                        <bar-chart :data="datasets" :styles="myStyles"/>
                                    </div>

                                </v-layout>

                            </v-card-title>
                        </v-card>
                    </v-flex>

                    <v-flex xs6 d-flex fill-height>
                        <v-card color="#8DA659" class="roundedCard">
                            <v-card-title class="headline white--text" >
                                <v-layout column align-start fill-height>


                                    <v-layout align-start justify-space-between row fill-height>
                                        <v-layout column align-start>
                                            <v-flex xs1>
                                                Meest bezochte routes
                                            </v-flex>
                                            <v-flex xs6>
                                                <v-card-text class="body-2" v-if="popularRoutes">
                                                    1. {{popularRoutes[0]}} <br>
                                                    2. {{popularRoutes[1]}} <br>
                                                    3. {{popularRoutes[2]}} <br>
                                                    4. {{popularRoutes[3]}} <br>
                                                    5. {{popularRoutes[4]}} <br>
                                                </v-card-text>
                                            </v-flex>
                                        </v-layout>
                                        <v-flex xs6>
                                            <v-card-text class="body-2" style="line-height: 1">
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

                    <v-flex xs6 d-flex fill-height>
                        <v-card color="#8DA659" class="roundedCard">
                            <v-card-text class="white--text body-2" style="line-height: 1;">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor ante, a
                                vestibulum magna imperdiet sit amet. Proin accumsan, urna nec lacinia vehicula,
                                ipsum urna volutpat orci, eu semper erat justo eget ligula. Mauris interdum metus
                                vitae laoreet euismod. Phasellus scelerisque urna id turpis gravida, vel condimentum
                                mauris euismod. Mauris vel imperdiet nisl. Nam cursus porttitor placerat. Praesent
                                luctus ullamcorper enim, nec sodales nisl. Suspendisse ultrices urna a orci tempus,
                                ut condimentum sapien eleifend. Sed sodales ornare massa, id feugiat quam varius ut.
                                Fusce dictum auctor dui vitae faucibus. Phasellus porta varius quam. Donec dolor ex,
                                tincidunt eget scelerisque ut, tristique vitae eros. In ut vulputate quam.
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
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

                popularRoutes: [],
            }
        },
        components: {
            BarChart,
        },

        mounted(){
            window.axios.get("getPopularRoutes").then(({data}) => {

                for(let i = 0; i < data.length; i++){
                    this.popularRoutes.push(data[i].name + " (" + data[i].amount_clicks + ")") 
                }
            }).then(console.log(this.popularRoutes));
        },

        computed: {
            myStyles() {
                return {
                    height: `25vh`,
                    width: `25vw`
                }
            }
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
