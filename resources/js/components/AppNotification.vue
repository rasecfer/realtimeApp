<template>
  <div class="text-xs-center">
    <v-menu offset-y>
      <v-btn icon slot="activator">
        <v-icon :color="color">{{icono}}</v-icon>{{this.unreadCount}}
      </v-btn>
      <v-list>
        <v-list-tile v-for="notif in unread" :key="notif.id">
          <router-link :to="notif.path">
            <v-list-tile-title @click="markRead(notif)">{{notif.replyBy}} respondió {{notif.created_at}}</v-list-tile-title>
          </router-link>          
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile v-for="notif in read" :key="notif.id">
            <v-list-tile-title @click="markRead(notif)">{{notif.replyBy}} respondió {{notif.created_at}}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
  </div>
    
</template>

<script>
export default {
  data(){
    return {
      read: {},
      unread: {},
      unreadCount: 0,
      sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3"
    }
  },
  computed:{
    color(){
      return this.unreadCount >0 ? 'primary' : 'grey'
    },
    icono(){
      return this.unreadCount >0 ? 'notifications_active' : 'notifications'
    }
  },
  created(){
    if(User.loggedIn()){
      this.getNotifications()

      Echo.private('App.User.' + User.id())
        .notification((notification) => {
          this.playSound()
          this.unread.unshift(notification)
          this.unreadCount++
        })
    }
  },
  methods:{
    getNotifications(){
      axios.post('/api/notifications')
        .then(res => {
          this.read = res.data.read
          this.unread = res.data.unread
          this.unreadCount = res.data.unread.length
        })
        .catch(error => {
          Exception.handle(error)
        })
    },
    markRead(notification){
      axios.post('/api/notifications/markAsRead', {id: notification.id})
        .then(res => {
          this.unread.splice(notification, 1)
          this.read.push(notification)
          this.unreadCount--
        })
        .catch(error => {
          console.log(error.response)
        })
    },
    playSound(){
      let mp3 = new Audio(this.sound)
      let alert = mp3.play()
      if(alert !== null){
        alert.catch(() => {
          mp3.play()
        })
      }
    }
  }
}
</script>

<style>

</style>
