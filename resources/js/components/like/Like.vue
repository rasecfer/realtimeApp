<template>
  <v-btn icon @click="likeIt()">
    <v-icon :color="likeColor">thumb_up</v-icon>&nbsp;{{this.count}}
  </v-btn>
</template>

<script>
export default {
  props: ['reply'],
  data(){
    return {
      liked: this.reply.liked,
      count: this.reply.like_count
    }
  },
  computed:{
    likeColor(){
      return this.liked ? 'teal' : 'grey'
    }
  },
  methods: {
    likeIt(){
      if(User.loggedIn()){
        this.liked ? this.decr() : this.incr()
        this.liked = !this.liked
      }
    },
    incr(){
      axios.post(`/api/like/${this.reply.id}`)
        .then(res => {
          console.log(res.data)
          this.count ++
        })
        .catch(error => {
          console.log(error.response)
        })
      
    },
    decr(){
      axios.delete(`/api/like/${this.reply.id}`)
        .then(res => {
          console.log(res.data)
          this.count --
        })
        .catch(error => {
          console.log(error.response)
        })
      
    }
  }
}
</script>

<style>

</style>
