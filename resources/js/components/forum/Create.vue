<template>
  <v-container>
    <v-form @submit.prevent="create">
      
      <v-text-field
        v-model="form.title"
        label="Título"
        type="text"
        :error-messages="errors.title ? errors.title[0] : ''"
        required
      ></v-text-field>

      <v-autocomplete
        :items="categories"
        v-model="form.category_id"
        item-text="name"
        item-value="id"
        label="Categoría"
        :error-messages="errors.category_id ? errors.category_id[0] : ''"
        autocomplete
      ></v-autocomplete>

      <div>
        <markdown-editor v-model="form.body"></markdown-editor>
        <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
      </div>
      

      <v-btn
        color="green"
        type="submit"
      >Crear
      </v-btn>

      <router-link to="/forum">
        <v-btn color="blue">Foro</v-btn>
      </router-link>

    </v-form>
  </v-container>
</template>

<script>
export default {
  data(){
    return {
      form: {
        title: null,
        category_id: null,
        body: ''
      },
      categories:[],
      errors: {
        title:'',
        category_id: '',
        body: ''
      }
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
  methods: {
    create(){
      axios.post('/api/question', this.form)
      .then(res => {
        this.$router.push(res.data.path)
      })
      .catch(error => {
        this.errors = error.response.data.errors
      })
    }
  }
}
</script>

<style>

</style>
