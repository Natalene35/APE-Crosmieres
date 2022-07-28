<template>

  <HeaderLayout v-bind:backOff="this.backOff" />
  <main>
    <BackOfficeLayout />
  </main>
  <FooterLayout />

</template>

<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue'
import FooterLayout from '@/components/templates/FooterLayout.vue'
import BackOfficeLayout from '../../components/back-office/BackOfficeLayout.vue'


export default {
  name: 'HomeView',
  data(){
    return{
      backOff: true,
    }
  },
  components: {
    HeaderLayout,
    FooterLayout,
    BackOfficeLayout
}
}
</script>

<style scoped lang="scss">

main {
    height: 100%;
    display: flex;
    list-style-type: none;
    justify-content: space-between;
}
</style>

