<template>
  <v-container>
    <v-form @submit.prevent="update">
      
      <v-text-field
        v-model="form.title"
        label="Título"
        type="text"
        :error-messages="errors.title ? errors.title[0] : ''"
        required
      ></v-text-field>

      <div>
        <markdown-editor v-model="form.body"></markdown-editor>
        <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
      </div>
      

      <v-btn
        color="green"
        type="submit"
      >Actualizar
      </v-btn>

      <v-btn
        color="red"
        @click="cancel()"
      >Cancelar
      </v-btn>

    </v-form>
  </v-container>
</template>

<script>
export default {
  props: ['question'],
  data(){
    return {
      form: {
        title: null,
        body: null
      },
      errors: {
        title:'',
        category_id: '',
        body: ''
      }
    }
  },
  mounted(){
    this.form = this.question
  },
  computed: {
    body(){
      return md.parse(this.question.body)
    }
  },
  methods: {
    cancel(){
      EventBus.$emit('cancelEditing')
    },
    update(){
      axios.patch(`/api/question/${this.form.slug}`, this.form)
      .then(res => {
        this.cancel()
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
