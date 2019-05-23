<template>
    <v-layout row fill-height align-center justify-center>
        <v-flex xs1>
            <v-card-title class="display-2" style="color: #89a324;">
                Projecten
            </v-card-title>
        </v-flex>
        <v-flex fill-height>
            <v-layout row fill-height align-center justify-end>
                <v-flex xs2 align-self-center mx-3>
                    <v-btn block style="height: 100%;" color="#89a324">
                        <v-card style="white-space: normal;" color="transparent" flat class="white--text">
                            Project Toevoegen
                        </v-card>
                    </v-btn>
                </v-flex>
                <v-flex xs5>
                    <v-text-field solo hide-details round label="zoek een project" class="search-bar pa-0" flat append-icon="search"></v-text-field>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProjectsHeader"
    }
</script>

<style scoped>

</style>