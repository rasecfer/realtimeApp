<template>
  <v-container>
    <v-form @submit.prevent="signup">
      <v-text-field
        v-model="form.name"
        label="Name"
        type="text"
        :error-messages="errors.name ? errors.name[0] : ''"
        required
      ></v-text-field>

      <v-text-field
        v-model="form.email"
        label="E-mail"
        type="email"
        :error-messages="errors.email ? errors.email[0] : ''"
        required
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        :error-messages="errors.password ? errors.password[0] : ''"
        required
      ></v-text-field>

      <v-text-field
        v-model="form.password_confirmation"
        label="Password Confirmation"
        type="password"
        required
      ></v-text-field>

      <v-btn
        color="green"
        type="submit"
        :loading="loading"
        :disabled="loading"
      >Sign Up
        <span slot="loader" class="custom-loader">
          <v-icon light>cached</v-icon>
        </span>
      </v-btn>

      <router-link to="/login">
        <v-btn color="blue">Login</v-btn>
      </router-link>

    </v-form>
  </v-container>
</template>

<script>
export default {
  data(){
    return {
      form : {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      valid: false,
      loader: false,
      loading: false,
      errors : {
        name: '',
        email: '',
        password: ''
      }
    }
  },
  created(){
    if(User.loggedIn()){
      this.$router.push('forum')
    }
  },
  methods:{
    signup(){
      this.loader = this.loading = true
      axios.post('/api/auth/signup', this.form)
        .then(res => {
          User.responseAfterLogin(res)
          this.loader = this.loading = false
          this.$router.push('forum')
        })
        .catch(error => { 
          this.errors = error.response.data.errors
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
