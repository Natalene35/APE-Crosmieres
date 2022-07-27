<template>
    
        <div class="sale--card">
            <h2 class="sale--card__title">
                <div v-html="title"></div>
            </h2>
            <img class="sale--card__img">
            <div class="sale--card__excerpt">
                <div v-html="excerpt"></div>
            </div>
        </div>
            
</template>


<script>
export default {
    name: 'SaleHomeListLayout',

    props: {
        title: String,
        excerpt: String,
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
    margin-bottom: 0.7rem;
    background-color: $white;
    color: $grey;
    padding-bottom: 2rem;
    

    .sale--card__title {
        padding: 0.7rem;
        border-radius: 1rem 1rem 0 0;
        background-color: $orange;
        color: $white;
        font-weight: bold;
        
    }

    .sale--card__excerpt {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
    }
}





</style>