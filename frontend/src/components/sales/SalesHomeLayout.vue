<template>
<!-- //Liste Vente  -->
    <section class="sale--section">
        <ul class="sale--list">

            <li class="sale--card">
                <h2 class="sale--card__title">Titre</h2>
                <img class="sale--card__img">
                <div class="sale--card__content">Paragraphe</div>
            </li>

            <li class="sale--card">
                <h2 class="sale--card__title">Titre</h2>
                <img class="sale--card__img">
                <div class="sale--card__content">Paragraphe</div>
            </li>

            <li class="sale--card">
                <h2 class="sale--card__title">Titre</h2>
                <img class="sale--card__img">
                <div class="sale--card__content">Paragraphe</div>
            </li>

            <li class="sale--card">
                <h2 class="sale--card__title">Titre</h2>
                <img class="sale--card__img">
                <div class="sale--card__content">Paragraphe</div>
            </li>

        </ul>
    </section>

</template>


<script>

export default {
    name: 'SalesHomeLayout',
    data() {
        return {
            
        }
    },
}
</script>


<style scoped lang="scss">

.sale--section {
    
    width: 30%;
    height: 100%;
    

    ul::-webkit-scrollbar {
        display: none;
    }

    ul {
        height: 100%;
        list-style-type: none;
        overflow: scroll;

        li {
            border-radius: 1rem;
            border: 1px solid $white;
            height: 30%;
            margin-bottom: 0.5rem;
            background-color: $white;
            color: $grey;

            .sale--card__title {
                padding: 0.4rem;
                border-radius: 1rem 1rem 0 0;
                background-color: $orange;
                color: $white;
                font-weight: bold;
                

            }
        }
    }
}

</style>

 

