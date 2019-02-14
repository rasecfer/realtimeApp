<template>
  <div>
    <toolbar></toolbar>
    <v-content>
      <router-view></router-view>
    </v-content>
    <app-footer></app-footer>
  </div>
  
</template>

<script>

import toolbar from './Toolbar'
import AppFooter from './AppFooter'

export default {
  components: {
    toolbar,
    AppFooter
  }
}
</script>

<style>

</style>

