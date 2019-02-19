<template>
  <v-dialog v-model="dialog" persistent max-width="600">
      <v-card>
        <v-card-title class="headline">Responder Pregunta</v-card-title>
        <v-card-text>
          <div>
            <markdown-editor v-model="form.body"></markdown-editor>
            <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
          </div>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" flat @click="postReply()">Publicar</v-btn>
          <v-btn color="red darken-1" flat @click="dialog = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
  props:['slug'],
  data(){
    return{
      dialog: false,
      form:{
        body: '',
      },
      errors:{
        body: ''
      }
    }
  },
  created(){
    this.listen()
  },
  methods:{
    listen(){
      EventBus.$on('openDialog', () => {
        this.dialog = true
      })
    },
    postReply(){
      axios.post(`/api/question/${this.slug}/reply`, this.form)
        .then(res => {
          this.form.body = ''
          EventBus.$emit('addReply', res.data)
          this.dialog = false
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
