<template>

    <section class="sale--section__list">
        <div class="sale--list">
            <SaleListLayout v-bind:id="sale.id" v-bind:title="sale.title.rendered" v-bind:content="sale.content.rendered" v-for="sale in salesList" v-bind:key="sale.id"/>
        </div>
    </section>

</template>


<script>
import SaleListLayout from '@/components/sales/SaleListLayout.vue';
import SaleService from '@/services/sales/SaleService';

export default {
    name: 'SalesListLayout',

    components: {
        SaleListLayout
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


<style scopped lang="scss">

.sale--section__list {
    
    
    height: 100%;
    

}

</style>

 
