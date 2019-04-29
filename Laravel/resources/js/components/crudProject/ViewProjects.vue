<template>
    
</template>

<script>
    export default {
        name: "viewProjects",

        data() {
            return {
                projects: [],
            }
        },

        mounted() {
            window.axios.get('http://127.0.0.1:8000/getProjects').then(response => {
                let temp = response.data;

                for (let i = 0; i < temp.length; i++) {
                    this.projects.push(temp[i].name);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>

<style scoped>

</style>