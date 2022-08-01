<template>


    <div class="sale--card">

        <router-link v-if="backOffice==false" v-bind:to="{name: 'sale', params: {id: id}}">

            <h2 class="sale--card__title">
                <div v-html="title"></div>
            </h2>
            <img class="sale--card__img">
            <div class="sale--card__content">
                <div v-html="content"></div>
            </div>
        </router-link>

        <!-- //VERSION BACK-OFFICE -->
        <div v-if="backOffice==true" v-bind:style="'width:100%'">

            <h2 class="sale--card__title" v-bind:style="'justify-content: space-between;'">
                <div class="sale--backoffice__img">
                    <img v-on:click="opacity=1;zindex=20;selectSale=id" v-bind:src="trashPic">
                    <router-link class="sale--card__editPic" v-bind:to="{name: 'saleUpdate', params: {id: id}}">
                    <img  v-bind:src="editPic">
                    </router-link>
                </div>
                
                <div v-html="title"></div>
            </h2>
            <img class="sale--card__img">
            <div class="sale--card__content">
                <div v-html="content"></div>
            </div>
            <PopUpLayout v-bind:id="id" v-bind:opacity="this.opacity" v-bind:zindex="this.zindex" v-on:yes="del" v-on:no="this.opacity=0,this.zindex=-20"/> 
        </div>
           
    </div>

</template>


<script>
import SaleService from '@/services/sales/SaleService';
import edit from '@/assets/images/icons8-edit-100.png';
import trash from '@/assets/images/icons8-trash-can-100.png';
import PopUpLayout from '../back-office/PopUpLayout.vue';
export default {
    name: "SaleListLayout",
    emits: ["reloadSal"],
    props: {
        title: String,
        content: String,
        id: Number,
        backOffice: Boolean
    },
    data() {
        return {
            trashPic: trash,
            editPic: edit,
            zindex: -20,
            opacity: 0,
            selectSale: null,
        };
    },
    methods: {
        async del() {
            this.opacity=0
            this.zindex=-20  
            const response = await SaleService.delete({
                "id": this.selectSale
            });
            this.$emit("reloadSal");
            console.log(response);            
        },
    },
    components: { PopUpLayout }
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

    a {
        color: $grey;
    }

    .sale--card__title {
        padding: 0.7rem;
        border-radius: 1rem 1rem 0 0;
        background-color: $orange;
        color: $white;
        font-weight: bold;
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        justify-content: center;
        .sale--backoffice__img{
            display: flex;
            width: 40%;
            justify-content: flex-end;
        }
        img,
        a {
            height: 4rem;           
            cursor: pointer;
        }

        img:hover {
            filter: brightness(1.1);
            transform: scale(1.2);
        }

        .sale--card__editPic {
            right: 15%;
        }
    }

    .sale--card__content {
        padding-right: 1rem;
        padding-left: 1rem;
    }
}
</style>

