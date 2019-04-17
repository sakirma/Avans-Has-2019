<template>
    <v-menu offset-y nudge-top="10px" z-index="1000" :close-on-content-click="false">
        <template v-slot:activator="{ on }">
            <v-btn class="rounded-bottom-card" color="rgb(160, 181, 80, 1)" v-on="on">
                <v-layout xs3 column>
                    <v-flex class="white--text font-weight-bold">
                        {{ title }}
                    </v-flex>
                    <v-icon style="height: 10px;" large color="white">
                        expand_more
                    </v-icon>
                </v-layout>
            </v-btn>
        </template>
        <v-card>
            <v-list>
                <v-list-tile avatar>
                    <v-list-tile-title>
                        SADIASJDIOSA ASIOD ASASD
                    </v-list-tile-title>
                </v-list-tile>
            </v-list>

            <v-divider></v-divider>

            <v-list>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-switch v-model="message" color="purple"></v-switch>
                    </v-list-tile-action>
                    <v-list-tile-title>Enable messages</v-list-tile-title>
                </v-list-tile>

                <v-list-tile>
                    <v-list-tile-action>
                        <v-switch v-model="hints" color="purple"></v-switch>
                    </v-list-tile-action>
                    <v-list-tile-title>Enable hints</v-list-tile-title>
                </v-list-tile>
            </v-list>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn flat @click="menu = false">Cancel</v-btn>
                <v-btn color="primary" flat @click="menu = false">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-menu>
</template>

<script>
    export default {
        name: "DropDownButton",
        props: {
            title: {
                type: String,
                default: '',
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
