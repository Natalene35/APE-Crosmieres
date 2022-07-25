<template>
    <section class="back-office--container__all">
        <section class="back-office--container__sales"></section>
        <section class="back-office--container__events"></section>
        <section class="back-office--container__users"></section>
    </section>
</template>

<script>
export default {
  name: 'BackOfficeLayout',
   data(){
    return{
        allSales: null,
    }
   },
 async mounted(){  
    this.saleSlide=await SaleService.findAll();
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