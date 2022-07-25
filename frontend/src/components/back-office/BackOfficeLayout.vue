<template>
    <section class="back-office--container__all">

        <section class="back-office--container__sales">
            <div class="sale" v-for="sale in allSales" v-bind:key="sale" >
                {{sale.title.rendered}}
            </div>
        </section>

        <section class="back-office--container__events">
            <div class="sale" v-for="sale in allSales" v-bind:key="sale" >
               
            </div>
        </section>

        <section class="back-office--container__users">

        </section>
    </section>
</template>

<script>
import SaleService from "@/services/sales/SaleService";
import UserLoginService from '@/services/login/UserLoginService'
export default {
  name: 'BackOfficeLayout',
   data(){
    return{
        allSales: null,
        allUsers: null,
    }
   },
 async mounted(){  
    this.allSales=await SaleService.findAll();
    this.allUsers=await UserLoginService.findAll();
    },
}
</script>

<style lang="scss">
.back-office--container__all{
    display: flex;
    height: 100%;
    width: 100%;

    .back-office--container__sales{
        background-color: red;
    }
    .back-office--container__events{
        background-color: yellow;
    }
    .back-office--container__users{
        background-color: green;
    }
}

</style>