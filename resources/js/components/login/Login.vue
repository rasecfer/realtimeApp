<template>
  <v-container>
    <v-form @submit.prevent="login">
      <v-alert
        :value="alert"
        type="error"
        outline
        transition="fade-transition"
      >
        Favor de validar los datos de acceso!
      </v-alert>
      
      <v-text-field
        v-model="form.email"
        label="E-mail"
        type="email"
        required
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        required
      ></v-text-field>

      <v-btn
        color="green"
        type="submit"
        :loading="loading"
        :disabled="loading"
      >Login
        <span slot="loader" class="custom-loader">
          <v-icon light>cached</v-icon>
        </span>
      </v-btn>

      <router-link to="/signup">
        <v-btn color="blue">Sign Up</v-btn>
      </router-link>

    </v-form>
  </v-container>
  
</template>

<script>
export default {
  data(){
    return {
      form : {
        email: null,
        password: null
      },
      loader: false,
      loading: false,
      alert: false,
      valid: false
    }
  },
  created(){
    if(User.loggedIn()){
      this.$router.push('forum')
    }
  },
  methods:{
    login(){
      this.alert = false
      this.loader = this.loading = true
      axios.post('/api/auth/login', this.form)
      .then(res => {
        User.responseAfterLogin(res)
        this.loader = this.loading = false
      })
      .catch(error => {
        // console.log(error.response.data)
        this.alert = true
        this.loader = this.loading = false
      })
    }
  }
}
</script>

<style>
  .custom-loader {
    animation: loader 1s infinite;
    display: flex;
  }
  @-moz-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-webkit-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-o-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
</style>
