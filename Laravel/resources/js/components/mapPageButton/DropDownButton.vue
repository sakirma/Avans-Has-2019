<template>
    <div>
        <v-btn style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" @click="expand = !expand">
            <v-layout column>
                <v-flex class="white--text font-weight-bold">
                    {{ buttonTitle }}
                </v-flex>
                <v-icon style="height: 10px;" large color="white">
                    expand_more
                </v-icon>
            </v-layout>
        </v-btn>

        <v-expand-transition>
            <v-layout row v-show="expand">
                <v-flex xs12>
                    <v-card class="pt-4 px-5 map-page-themes-list" color="rgb(217, 217, 217, 1)">
                        <div class="title text-xs-center pb-2">
                            {{ title }}
                        </div>
                        <v-divider></v-divider>
                        <v-list
                                style="background-color: #d9d9d9"
                        >
                            <v-list-tile ripple>
                                <v-list-tile-action>
                                    <v-checkbox></v-checkbox>
                                </v-list-tile-action>

                                <v-list-tile-content>
                                    <v-list-tile-title>Notifications</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>

                            <v-list-tile>
                                <v-list-tile-action>
                                    <v-checkbox></v-checkbox>
                                </v-list-tile-action>

                                <v-list-tile-content>
                                    <v-list-tile-title>Sound</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>

                            <v-list-tile>
                                <v-list-tile-action>
                                    <v-checkbox></v-checkbox>
                                </v-list-tile-action>

                                <v-list-tile-content>
                                    <v-list-tile-title>Video sounds</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>

                            <v-list-tile>
                                <v-list-tile-action>
                                    <v-checkbox></v-checkbox>
                                </v-list-tile-action>

                                <v-list-tile-content>
                                    <v-list-tile-title>Invites</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-expand-transition>
    </div>
</template>

<script>
    export default {
        name: "DropDownButton",
        props: {
            buttonTitle: {
                type: String,
                default: '',
            },
            title: {
                type: String,
                default: "",
            }
        },
        data() {
            return {
                expand: false,
            }
        },
        mounted() {
            this.$parent.$parent.disableInputEvents(this);
        }
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 0px 0px 10px 10px;
        height: 50px;
        width: 100%;
    }

    .map-page-themes-list {
        border-radius: 0px 0px 10px 10px;
        position: relative;
        top: -10px;
    }
</style>
