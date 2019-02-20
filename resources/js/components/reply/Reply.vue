<template>
  <div class="mt-3">
    <v-card>
      <v-card-title>
          <div class="headline">{{reply.user}}</div>
          <div class="ml-2 mt-1 grey--text">dijo {{reply.created_at}}</div>
          <v-spacer></v-spacer>
          
          <div v-if="own">
            <v-btn icon class="primary" @click="edit()">
              <v-icon>edit</v-icon>
            </v-btn>
            <v-btn icon class="error" @click="confirm()">
              <v-icon>delete</v-icon>
            </v-btn>
          </div>         
          <like :reply="reply"></like> 
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text v-html="replyFormated"></v-card-text>
    </v-card>
  </div>
  
</template>

<script>
import Like from '../like/Like'
export default {
  props: ['reply', 'index'],
  components:{
    Like
  },
  data(){
    return {
      own: User.own(this.reply.user_id)
    }
  },
  computed: {
    replyFormated(){
      return md.parse(this.reply.reply)
    }
  },
  methods:{
    confirm(){
      EventBus.$emit('confirmDelete', this.reply.id, this.index)
    },
    edit(){
      EventBus.$emit('openDialogEdit', this.reply, this.index)
    }
  }
}
</script>

<style>

</style>
