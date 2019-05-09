<template>
    <div style="height: 100vh; background-color: #89a226">
        <v-layout align-start justify-start column>
            <v-flex pt-3>
                <c-r-u-d-page-header></c-r-u-d-page-header>
            </v-flex>
        </v-layout>
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