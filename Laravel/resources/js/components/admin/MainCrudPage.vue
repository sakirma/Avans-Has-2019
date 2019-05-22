<template>
    <div style="height: 100vh; background-color: #89a324">
        <v-container fluid fill-height py-0 px-0>
            <v-layout column>
                <v-flex xs1 d-flex mx-5 my-3>
                        <c-r-u-d-page-header ></c-r-u-d-page-header>
                </v-flex >
                <v-flex d-flex style="background-color: black;">

                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import CRUDPageHeader from './CRUDPageHeader';

    export default {
        name: "MainCrudPage",
        components: {
            CRUDPageHeader
        }
    }
</script>

<style scoped>
</style>
