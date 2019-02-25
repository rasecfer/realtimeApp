<template>
  <div v-if="question">
    <edit-question :question="question" v-if="editing"></edit-question>
    <show-question :question="question" v-else></show-question>
    <replies :replies="question.replies" :questionSlug="question.slug"></replies>
    <create-reply v-if="loggedIn" :slug="question.slug"></create-reply>
    <edit-reply v-if="loggedIn" :slug="question.slug"></edit-reply>
  </div>
</template>

<script>
import ShowQuestion from './ShowQuestion'
import EditQuestion from './EditQuestion'
import Replies from '../reply/Replies'
import CreateReply from '../reply/Create'
import EditReply from '../reply/Edit'
export default {
  components: {
    ShowQuestion,
    EditQuestion,
    Replies,
    CreateReply,
    EditReply
  },
  data(){
    return {
      question: null,
      editing: false
    }
  },  
  created(){
    this.listen()
    this.getQuestion()
  },
  computed:{
    loggedIn(){
      return User.loggedIn()
    }
  },
  methods:{
    listen(){
      EventBus.$on('startEditing', () => {
        this.editing = true
      })

      EventBus.$on('cancelEditing', () => {
        this.editing = false
      })
    },
    getQuestion(){
      axios.get(`/api/question/${this.$route.params.slug}`)
      .then(res => {
        this.question = res.data.data
      })
      .catch()
    }
  }
}
</script>

<style>

</style>
