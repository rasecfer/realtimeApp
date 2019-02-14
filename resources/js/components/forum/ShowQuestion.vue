<template>
  <v-card>
    <v-container fluid grid-list-md>
      <v-card-title>
        <div>
          <div class="headline">
            {{question.title}}
          </div>
          <div class="grey--text">{{question.user}} dijo {{question.created_at}}</div>
        </div>
        <v-spacer></v-spacer>
        <v-chip color="teal" text-color="white">
          <v-avatar class="green darken-4">4</v-avatar>
          Respuestas
        </v-chip>
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
      own: User.own(this.question.user_id)
    }
  },
  computed: {
    body(){
      return md.parse(this.question.body)
    }
  },
  methods: {
    deleteQuestion(){
      axios.delete(`/api/question/${this.question.slug}`)
        .then(res => {
          this.$router.push('../forum')
        })
        .catch(error => console.log(error.response.data))
    },
    edit(){
      EventBus.$emit('startEditing')
    }
  }
}
</script>

<style>

</style>
