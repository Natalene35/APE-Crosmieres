<template>
    

    <div class="sale--card">
        <router-link v-bind:to="{name: 'sale', params: {id: id}}">

            <h2 class="sale--card__title">
                <img v-on:click="del(id)" v-bind:src="trashPic" v-if="backOffice==true">
                <router-link class="sale--card__editPic" v-if="backOffice==true" v-bind:to="{name: 'saleUpdate', params: {id: id}}">
                    <img  v-bind:src="editPic">
                </router-link>
                <div v-html="title"></div>
            </h2>
            <img class="sale--card__img">
            <div class="sale--card__content">
                <div v-html="content"></div>
            </div>
        </router-link>
    </div>
            
</template>


<script>
import SaleService from '@/services/sales/SaleService';
import edit from '@/assets/images/icons8-edit-100.png';
import trash from '@/assets/images/icons8-trash-can-100.png';
export default {
    name: 'SaleListLayout',

    props: {
        title: String,
        content: String,

        id: Number,
        backOffice: Boolean

    },

    data() {
        return {
           trashPic: trash ,
           editPic: edit,
        }
    },
    methods:{
        async del(e){
            const response = await SaleService.delete({
                "id": e
            });
            console.log(response);            
        },
        
    }
}
</script>


<style scoped lang="scss">

.sale--card {
    border-radius: 1rem;
    border: 1px solid $white;
    margin-bottom: 4rem;
    background-color: $white;
    color: $grey;
    padding-bottom: 2rem;
    margin: 1rem 1rem 1rem 1rem;
    
    a { color: $grey;
        
    }

    .sale--card__title {
        padding: 0.7rem;
        border-radius: 1rem 1rem 0 0;
        background-color: $orange;
        color: $white;
        font-weight: bold;

        img,a{
                height: 4rem;
                position: absolute;
                right: 0;
                top: 0;
                cursor: pointer;
            }
           img:hover{
            filter: brightness(1.1);
            transform: scale(1.2);
           }
           .sale--card__editPic{
            right: 15%;
           }
    }

    .sale--card__content {
        padding-right: 1rem;
        padding-left: 1rem;
    }
}

</style>

