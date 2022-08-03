<template>

  <HeaderLayout />
  <main>
    <SalesHomeSliders />
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
import SalesHomeSliders from '@/components/sales/SalesHomeSliders.vue'


export default {
  name: 'HomeView',
  data(){
    return{
    }
  },
  components: {
    HeaderLayout,
    EventsHomeLayout,
    SalesHomeLayout,
    FooterLayout,
    SalesHomeSliders
},
}
</script>

<style scoped lang="scss">

main {
    height: 100%;
    display: flex;
    list-style-type: none;
    justify-content: space-between;

}
@media (max-width: 425px) {
    main{
    flex-direction: column;
    position: relative;
    z-index: 3;
    overflow: hidden;
  }
}
</style>

