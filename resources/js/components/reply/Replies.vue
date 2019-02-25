<template>
  <v-container>
    <reply v-for="(reply, index) in content" :key="reply.id" :reply="reply" v-if="content" :index="index"></reply>
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Confirmar?</v-card-title>
        <v-card-text>¿Desea eliminar la respuesta?</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" flat @click="deleteReply()">Sí</v-btn>
          <v-btn color="red darken-1" flat @click="dialog = false">No</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import Reply from './Reply'
export default {
  props: ['replies', 'questionSlug'],
  components: {
    Reply
  },
  data(){
    return {
      content: this.replies,
      dialog: false,
      replyId: null,
      index: null
    }
  },
  created(){
    this.listen()
  },
  methods:{
    listen(){
      EventBus.$on('addReply', (reply) =>{
        this.content.unshift(reply)
        EventBus.$emit('updateQuantity', true)
      })

      EventBus.$on('confirmDelete', (replyId, index) => {
        this.replyId = replyId
        this.index = index
        this.dialog = true
      })

      EventBus.$on('updateReply', (reply, index) => {
        this.content.splice(index, 1)
        this.content.unshift(reply)
      })

      Echo.private('App.User.' + User.id())
        .notification((notification) => {
          this.content.unshift(notification.reply)
        })

      Echo.channel('deleteReplyChannel')
        .listen('DeleteReplyEvent', (e) => {
          for(let index = 0; index < this.content.length; index++){
            if(this.content[index].id == e.id){
              this.content.splice(index, 1)
            }
          }
        })
    },
    deleteReply(){
      axios.delete(`/api/question/${this.questionSlug}/reply/${this.replyId}`)
        .then(res => {
          this.content.splice(this.index, 1)
          EventBus.$emit('updateQuantity', false)
          this.dialog = false
        })
        .catch(error => {
          console.log(error.response.data)
        })
    }
  }
}
</script>

<style>

</style>
