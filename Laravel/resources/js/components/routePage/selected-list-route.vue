<template>
  <v-layout align-center justify-center row fill-height>
    <v-flex xs9>
      <v-btn
        block
        outline
        color="secondary"
        @click="followRoute(id)"
        dark
        flat
        class="custom-btn"
        :ripple="false"
      >
        <v-layout align-center justify-space-around row fill-height>
          <v-flex>
            <div class="text-xs-left">{{ name }}</div>
          </v-flex>
        </v-layout>
      </v-btn>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: "selected-list-route",
  props: {
    name: {
      type: String,
      required: true
    },

    id: {
      type: Number,
      required: true
    }
  },
  data ()  {
      return {
        allProjectPointIDs: [],
      }
  },
  methods: {
    followRoute($id) {
        window.axios.get("http://127.0.0.1:8000/getProjectPointIDs/" + $id)
            .then(response => {
                console.log(response.data);
                this.allProjectPointIDs = response.data;
            }).catch(e => {
                console.log(e);
            }); 
    
    //   window.axios
    //     .get("http://127.0.0.1:8000/getProjectPoint/")
    //     .then(response => {
    //       console.log(response.data);
    //       this.projectPoints.push(response.data);
    //     })
    //     .catch(e => {
    //       console.log(e);
    //     });
    }
  }
};
</script>

<style scoped>
.v-btn:hover:before {
  color: transparent;
}

.v-btn:focus:before {
  color: transparent;
}
</style>