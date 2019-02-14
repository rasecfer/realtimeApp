<template>
  <v-card>
    <v-card-title primary-title>
      <div>
        <h3>
          <router-link :to="question.path">
            {{question.title}}
          </router-link>          
        </h3>
        <div class="grey--text">
          {{question.user}} dijo
          {{question.created_at}}
        </div>
      </div>
    </v-card-title>
    <v-card-text>
      {{question.body}}
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props:['question']
}
</script>

<style>

</style>
