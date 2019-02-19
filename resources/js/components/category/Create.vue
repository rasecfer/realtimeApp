<template>
  <v-container>
    <v-form @submit.prevent="create()">
      
      <v-text-field
        v-model="form.name"
        label="Nombre de Categoría"
        type="text"
        :error-messages="errors.name ? errors.name[0] : ''"
        required
      ></v-text-field>

      <v-btn
        color="green"
        type="submit"
        v-if="!editar"
      >Crear
      </v-btn>

      <v-btn
        color="green"
        type="submit"
        v-else
      >Editar
      </v-btn>

      <router-link to="/forum">
        <v-btn color="blue">Foro</v-btn>
      </router-link>

    </v-form>
    <v-card>
      <v-toolbar color="teal" dense dark class="mt-2">
        <v-toolbar-title>Categorías</v-toolbar-title>
      </v-toolbar>
      <v-list>
        <div v-for="(category, index) in categories" :key="category.id">
          <v-list-tile>
            <v-list-tile-avatar>
              <v-icon class="white">arrow_right</v-icon>
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title>{{category.name}}</v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-btn icon small @click="edit(index)">
                <v-icon color="primary">edit</v-icon>
              </v-btn>
            </v-list-tile-action>
            <v-list-tile-action>
              <v-btn icon small @click="confirmar(category, index)">
                <v-icon color="red">delete</v-icon>
              </v-btn>
            </v-list-tile-action>
          </v-list-tile>
          <v-divider></v-divider>
        </div>
      </v-list>
    </v-card>
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Confirmar?</v-card-title>
        <v-card-text>¿Desea eliminar la categoría {{ categoria_a_eliminar ? categoria_a_eliminar.name : '' }}?</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" flat @click="deleteCategory(categoria_a_eliminar.slug)">Sí</v-btn>
          <v-btn color="red darken-1" flat @click="dialog = false">No</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  data(){
    return {
      form: {
        name: null
      },
      errors: {
        name: null
      },
      categories: {},
      categoria_a_eliminar: null,
      indice: null,
      dialog: false,
      editar: false,
      editSlug: null
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
      if(this.editar){
        axios.patch(`/api/category/${this.editSlug}`, this.form)
          .then(res => {
            this.categories.splice(this.indice, 1)
            this.categories.unshift(res.data)
            this.form.name = null
            this.editar = false
          })
          .catch(error => {
            this.errors = error.response.data.errors
          })
      } else {
        axios.post('/api/category', this.form)
          .then(res => {
            this.categories.unshift(res.data)
            this.form.name = null
          })
          .catch(error => {
            this.errors = error.response.data.errors
          })
      }      
    },
    confirmar(dato, indice){
      this.categoria_a_eliminar = dato
      this.indice = indice
      this.dialog = true
    },
    deleteCategory(slug){
      axios.delete(`/api/category/${slug}`)
        .then(res => {
          this.dialog = false
          this.categories.splice(this.indice, 1)
        })
        .catch(error => {
          console.log(error)
        })
    },
    edit(index){
      this.form.name = this.categories[index].name
      this.editSlug = this.categories[index].slug
      this.indice = index
      this.editar = true
    }
  }
}
</script>

<style>

</style>
