<template>
    <main>
        <h2 class="event--card__title">Chevalier de Provence</h2>

        <div class="date">Date de l'événement</div>
        <div class="location">Emplacement de l'événement</div>

        <img class="event--card__img" v-bind:src="tilleulPic">
        
        <div class="event--card__content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime
            adipisci delectus amet quisquam quibusdam eius itaque, C’est une tarte aux myrtilles. 
            Pourquoi elle vous revient pas? Mais parce qu’on a des frais! Vous pouvez pas vous rentrer ça dans le crâne? </div>

        <div>Carte de l'endroit</div>
    </main>
</template>

<script>
import EventService from "@/services/events/EventService";

export default {
    name: "EventDetailLayout",

    data() {
        return {
            title: null,
            date: null,
            location: null,
            content: null,
            image: null,
            map: null
        }
    },
    async mounted() {
        // Allow to retrieve the id dynamic parameter by using the $route object
        let id = this.$route.params.id;
        const response = await EventService.find(id);
        if (response.code) {
            // IL y a une erreur
            alert(response.message);
            // @TODO Ajouter une redirection vers l'accueil avec un message d'erreur
        } else {
            this.title = response.title.rendered;
            this.date = response.date.rendered;
            this.location = response.location.rendered;
            this.content = response.content.rendered;
            this.image = response._embedded['wp:featuredmedia'] ? response._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100';
            this.map = response.map.rendered;
        }
    }
}
</script>

<style lang="scss" scoped>
main {
    color: $black;
    border: 1px solid $black;
    width: 70%;
    margin: auto;
    height: auto;
    padding: 2rem;
    border-radius: 1rem;
    h2 {
        font-size: 2rem;
        font-weight: bold;
    }

}

</style>