<template>
  <v-card>
    <v-toolbar color="teal" dense dark class="mt-2">
      <v-toolbar-title>Categorías</v-toolbar-title>
    </v-toolbar>
    <v-list>
      <v-list-tile v-for="category in categories" :key="category.id">
        <v-list-tile-avatar>
          <v-icon class="white">arrow_right</v-icon>
        </v-list-tile-avatar>
        <v-list-tile-content>
          <v-list-tile-title>{{category.name}}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </v-card>
</template>

<script>
export default {
  data(){
    return {
      categories: null
    }
  },
  created(){
    axios.get('/api/category')
      .then(res => {
        this.categories = res.data.data
      })
      .catch(error => {
        console.log(error.response.data)
      })
  },
  methods:{
    create(){

    }
  }
}
</script>

<style>

</style>
