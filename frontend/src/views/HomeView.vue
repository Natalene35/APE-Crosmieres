<template>

  <HeaderLayout/>
  <main>
    <div class="home--title">
    <h1 class="home--title__event">Vos évènements du moment <span>à l'école des Tilleuls </span> <img class="home--img" v-bind:src="treePicture" alt="icône de tilleul"/></h1>
    
    <h1 class="home--title__sale">et les ventes</h1>
    </div>
    <div class="home--container">
      <SalesHomeSliders/>
      <EventsHomeLayout/>
      <SalesHomeLayout v-bind:hiddenSale="this.hiddenSale"/>
    </div>
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

import picture from "@/assets/images/tree.png";


export default {
  name: 'HomeView',

  data(){
    return{
      hiddenSale: false,
      treePicture: picture,
    }
  },

  components: {
    HeaderLayout,
    EventsHomeLayout,
    SalesHomeLayout,
    FooterLayout,
    SalesHomeSliders
  },

  mounted(){
    //HER FIX FOR SLIDERS 
      if(screen.width<=425){
        this.hiddenSale=true;
      }
  }
}
</script>

<style scoped lang="scss">

.home--container {
    height: 100%;
    display: flex;
    list-style-type: none;
    justify-content: space-between;
}

.home--title {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 1.5rem;
  font-family: 'Merienda', cursive;
  text-shadow: 0px 1px 1px $grey;

  .home--title__event {
    color: $red;     
  }

  .home--title__sale {
    color: $orange;
    margin-left: 0.5rem;   
  }
}

//<----------Media queries-------->

@media (max-width: 576px) {
  .home--title {
    display: none;
  }
  
  .home--container {
  flex-direction: column;
  position: relative;
  z-index: 3;
  overflow: hidden;
  }
}

@media (max-width: 992px) {
  span {
    display: none;
  }
}

</style>

