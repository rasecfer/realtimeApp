<template>
  <v-dialog v-model="dialog" persistent max-width="600">
    <v-card>
      <v-card-title class="headline">Editar Respuesta</v-card-title>
      <v-card-text>
        <div>
          <markdown-editor v-model="form.body"></markdown-editor>
          <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
        </div>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" flat @click="postReply()">Actualizar</v-btn>
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
      },
      reply_id: null,
      index: null
    }
  },
  created(){
    this.listen()
  },
  methods:{
    listen(){
      EventBus.$on('openDialogEdit', (reply, index) => {
        this.form.body = reply.reply
        this.reply_id = reply.id
        this.index = index
        this.dialog = true
      })
    },
    postReply(){
      axios.patch(`/api/question/${this.slug}/reply/${this.reply_id}`, this.form)
        .then(res => {
          this.form.body = ''
          EventBus.$emit('updateReply', res.data, this.index)
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
