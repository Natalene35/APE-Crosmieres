<template>
    <section class="sale--section" >
        <div class="sale--list">
            <SaleHomeListLayout v-bind:id="sale.id" v-bind:title="sale.title.rendered" v-bind:excerpt="sale.excerpt.rendered" v-for="sale in salesList" v-bind:key="sale.id"/>
        </div>
    </section>

</template>


<script>
import SaleHomeListLayout from '@/components/sales/SaleHomeListLayout.vue';
import SaleService from '@/services/sales/SaleService';

export default {
    name: 'SalesHomeLayout',
    components: {
        SaleHomeListLayout
    },

    async mounted() {
        //list of s from our API
        this.salesList = await SaleService.findAll();
        
    },

    data() {
        return {
            salesList: [],
       
        }
    },
}
</script>


<style scoped lang="scss">
::-webkit-scrollbar {
    display: none;
    }
.sale--section {    
    width: 30%;
    height: 100%; 
    .sale--list {
    height: 100vh;
    overflow-y: scroll;
    }

}
@media (max-width: 425px) {


    .sale--section {
        display: none;
    }
}
    
</style>

 

