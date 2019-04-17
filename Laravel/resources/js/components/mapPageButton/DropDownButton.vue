<template>
    <div>
        <v-btn style="z-index: 1005;" class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" v-on="on">
            <v-layout column>
                <v-flex class="white--text font-weight-bold">
                    {{ buttonTitle }}
                </v-flex>
                <v-icon style="height: 10px;" large color="white">
                    expand_more
                </v-icon>
            </v-layout>
        </v-btn>

        <v-layout row>
            <v-flex xs12>
                <v-card style=" position: relative; top: -10px;" class="pt-4 px-5">
                    <div class="title text-xs-center pb-2">
                        {{ title }}
                    </div>
                    <v-divider></v-divider>
                    <v-list
                            subheader
                            two-line
                    >
                        <v-list-tile @click="">
                            <v-list-tile-action>
                                <v-checkbox v-model="notifications"></v-checkbox>
                            </v-list-tile-action>

                            <v-list-tile-content @click="notifications = !notifications">
                                <v-list-tile-title>Notifications</v-list-tile-title>
                                <v-list-tile-sub-title>Allow notifications</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile @click="">
                            <v-list-tile-action>
                                <v-checkbox v-model="sound"></v-checkbox>
                            </v-list-tile-action>

                            <v-list-tile-content @click="sound = !sound">
                                <v-list-tile-title>Sound</v-list-tile-title>
                                <v-list-tile-sub-title>Hangouts message</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile @click="">
                            <v-list-tile-action>
                                <v-checkbox v-model="video"></v-checkbox>
                            </v-list-tile-action>

                            <v-list-tile-content @click="video = !video">
                                <v-list-tile-title>Video sounds</v-list-tile-title>
                                <v-list-tile-sub-title>Hangouts video call</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile @click="">
                            <v-list-tile-action>
                                <v-checkbox v-model="invites"></v-checkbox>
                            </v-list-tile-action>

                            <v-list-tile-content @click="invites = !invites">
                                <v-list-tile-title>Invites</v-list-tile-title>
                                <v-list-tile-sub-title>Notify when receiving invites</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
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
                fav: true,
                menu: false,
                message: false,
                hints: true
            }
        },
    }
</script>

<style scoped>
    .rounded-bottom-card {
        margin: 0px 0px 0px 0px;
        border-radius: 0px 0px 10px 10px;
        height: 50px;
        width: 100%;
    }
</style>
