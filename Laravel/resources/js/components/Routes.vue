<template>
    <ul>
        <li v-for="route in routeList">{{ route.project_point_id }}<button @click="getProjectPoint(route.project_point_id)">Volg route</button> </li>
        
    </ul>
</template>


<script>
import MapPage from './MapPage';

export default {
    name: "RoutesComponent",
    data () {
        return {
            routeList: [],
            projectPoints: [],
        }
    },
    methods: {
        getProjectPoint($id){
            window.axios.get('http://127.0.0.1:8000/getProjectPoint/' + $id).then(response => {
                console.log(response.data);
                this.projectPoints.push(response.data);
            }).catch(e => {
                console.log(e);
            }); 
        }
    },
    mounted() {
        window.axios.get('http://127.0.0.1:8000/getProjectPointIDs')
            .then(response => {
                console.log(response.data);
                this.routeList = response.data;
            }).catch(e => {
                console.log(e);
            }); 
    }
}
</script>

<style scoped>
</style>