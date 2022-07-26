<template>
    
        <div class="sale--card">
            <h2 class="sale--card__title">
                <div v-html="title"></div>
            </h2>
            <img class="sale--card__img">
            <div class="sale--card__content">
                <div v-html="content"></div>
            </div>
        </div>
            
</template>


<script>
export default {
    name: 'SaleListLayout',

    props: {
        title: String,
        content: String,
        id: Number
    },

    data() {
        return {
            
        }
    },
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
    

    .sale--card__title {
        padding: 0.7rem;
        border-radius: 1rem 1rem 0 0;
        background-color: $orange;
        color: $white;
        font-weight: bold;
    
        
    }

    .sale--card__content {
        padding-right: 1rem;
        padding-left: 1rem;
    }
}

</style>

