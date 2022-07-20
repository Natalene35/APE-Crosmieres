<template>

  <HeaderLayout />
  <main>
    <EventsHomeLayout />
    <SalesHomeLayout />
  </main>
  <FooterLayout />

</template>

<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue'
import EventsHomeLayout from '@/components/events/EventsHomeLayout.vue'
import SalesHomeLayout from '@/components/sales/SalesHomeLayout.vue'
import FooterLayout from '@/components/templates/FooterLayout.vue'


export default {
  name: 'HomeView',
  components: {
    HeaderLayout,
    EventsHomeLayout,
    SalesHomeLayout,
    FooterLayout,
    
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

