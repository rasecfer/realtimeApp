<template>
  <v-card>
    <v-container fluid grid-list-md>
      <v-card-title>
        <div>
          <div class="headline">
            {{content.title}}
          </div>
          <div class="grey--text">{{content.user}} dijo {{content.created_at}}</div>
        </div>
        <v-spacer></v-spacer>
        <v-chip color="teal" text-color="white" class="title">
          <v-avatar class="green darken-4 title">{{content.reply_count}}</v-avatar>
          Respuestas
        </v-chip>
        <v-btn
          color="primary"
          @click="responder()"
          round
        >Responder
          <v-icon small right dark>edit</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text v-html="body"></v-card-text>
      <v-card-actions v-if="own">
        <v-spacer></v-spacer>
        <v-btn icon class="primary" @click="edit()">
          <v-icon>edit</v-icon>
        </v-btn>
        <v-btn icon class="error" @click="deleteQuestion()">
          <v-icon>delete</v-icon>
        </v-btn>
      </v-card-actions>
    </v-container>
    
  </v-card>
</template>

<script>

export default {
  props: ['question'],
  data(){
    return {
      content: this.question,
      own: User.own(this.question.user_id),      
      prueba: null
    }
  },
  created(){
    this.listen()
  },
  computed: {
    body(){
      return md.parse(this.content.body)
    }
  },
  methods: {
    listen(){
      EventBus.$on('updateQuantity', (add) => {
        if(add){
          this.content.reply_count = this.content.reply_count * 1 + 1
        } else {
          this.content.reply_count = this.content.reply_count * 1 - 1
        }    
      })
    },
    deleteQuestion(){
      axios.delete(`/api/question/${this.content.slug}`)
        .then(res => {
          this.$router.push('../forum')
        })
        .catch(error => console.log(error.response.data))
    },
    edit(){
      EventBus.$emit('startEditing')
    },
    responder(){
      EventBus.$emit('openDialog')
    }
  }
}
</script>

<style>

</style>
