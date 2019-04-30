<template>
    <v-layout align-center justify-center row fill-height>
        <v-flex xs9>
            <v-btn block outline color="secondary" dark flat class="custom-btn" :ripple="false">
                <v-layout align-center justify-space-around row fill-height>
                    <v-flex>
                        <div class="text-xs-left">
                            {{ projectName }}
                        </div>
                    </v-flex>
                    <v-flex class="text-xs-right">
                        <v-btn  style="margin: 0;" icon dark>
                            <v-icon color="#666666">
                                menu
                            </v-icon>
                        </v-btn>
                    </v-flex>
                </v-layout>
            </v-btn>
        </v-flex>
        <v-flex shrink>
            <v-btn icon>
                <v-icon color="#666666" large>
                    close
                </v-icon>
            </v-btn>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "selected-list-route",
        props: {
            projectName: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>
    .v-btn:hover:before {
        color: transparent
    }

    .v-btn:focus:before {
        color: transparent;
    }
</style>