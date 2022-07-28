<template>
    <section class="sale--section__list">
        <div class="sale--section__search">
            <img class="sale--card__img" v-bind:src="salePicture">
            <!-- Load icon library from font awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
            <button class="search-icon"> <i class="fa fa-search"></i></button> 
            <input type="text" placeholder="Rechercher..." v-model="searchString">
        </div>
        <div class="sale--list">
            <SaleListLayout v-bind:id="sale.id" v-bind:title="sale.title.rendered" v-bind:content="sale.content.rendered" v-for="sale in salesNewList" v-bind:key="sale.id"/>
        </div>
    </section>
</template>


<script>
import SaleListLayout from '@/components/sales/SaleListLayout.vue';
import SaleService from '@/services/sales/SaleService';
import picture from '@/assets/images/purchases.png';

export default {
    name: 'SalesListLayout',

    components: {
        SaleListLayout
    },

    async mounted() {
        //list of s from our API
        this.salesList = await SaleService.findAll();
        
    },

    computed: {
        salesNewList() {
        //Return an array that contains the rows where the callback returned true
            return this.salesList.filter((sale) => {
                // We take the title of the current sale and we check if the searched term is contained in this title.
                // If yes, return true   
                if(sale.title.rendered.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').includes(this.searchString.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase())) {
                    return true;
                } else {
                    return false;
                }
            });
        }
    },

    data() {
        return {
            salesList: [],
            salePicture: picture,
            searchString:"",
        }
    },
}
</script>


<style scopped lang="scss">

.sale--section__list {  
    height: 100%;

    .sale--section__search {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    input {
        padding: 11px;
        font-size: 15px;
        border-style: none;
        width: 25%;
        background: $white;
        border: 1px solid $blue-bg-header;
        border-radius: 0.5em;
    }

    .search-icon {
        border-style: none;
        background-color: $orange;
        color:$white;
        height: 40px;
        width: 40px;
        border-radius:25%;
        margin-right: 5px;
        margin-left: 2%;

    }

    .sale--card__img {
        width: 8rem;
            
    }
}

</style>

 
