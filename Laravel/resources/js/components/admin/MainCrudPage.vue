<template>
    <div style="height: 100vh; background-color: #a2282a">
        <v-container fluid fill-height>
            <v-layout column>
                <v-flex md1 d-flex >
                        <c-r-u-d-page-header></c-r-u-d-page-header>
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