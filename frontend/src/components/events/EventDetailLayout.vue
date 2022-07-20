<template>
    <main>
        <ul>
            <li class="event--card">
                <img class="event--card__img" v-bind:src="tilleulPic">
                <h2 class="event--card__title">Concours de lancer de menhir</h2>
                <div class="event--card__content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime
                    adipisci delectus amet quisquam quibusdam eius itaque, </div>
            </li>
        </ul>
    </main>
</template>

<script>
export default {
    name: "EventDetailLayout",

    data() {
        return {
            image: null,
            title: null,
            content: null
        }
    },
    async mounted() {
    // Allow to retrieve the id dynamic parameter by using the $route object
    }
}
</script>

<style>
</style>