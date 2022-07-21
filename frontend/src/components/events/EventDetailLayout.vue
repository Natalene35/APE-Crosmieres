<template>
    <section class="event--card">
        <h2 class="event--card__title">{{ title }}</h2>

        <div class="event--card__date">Date de l'événement</div>
        <div class="event--card__location">Emplacement de l'événement</div>

        <img class="img" v-bind:src="tilleulPic">
        <div class="media-image" v-bind:style="'background-image:url(' + image + ')'"></div>

        <div class="event--card__content" v-html="content"></div>

        <img class="event--card__map" v-bind:src="mapPic">
    </section>
</template>

<script>
import EventService from "@/services/events/EventService";
import tilleulPic from '@/assets/images/tilleul.jpg';
import mapPic from '@/assets/images/map.jpg'
export default {
    name: "EventDetailLayout",
    data() {
        return {
            tilleulPic: tilleulPic,
            mapPic: mapPic,
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
            /* this.date = response.date.rendered;
            this.location = response.location.rendered; */
            this.content = response.content.rendered;
            this.image = response._embedded['wp:featuredmedia'] ? response._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100';
            console.log(this.image)
            // this.map = response.map.rendered;
        }
    }
}
</script>

<style lang="scss" scoped>
.event--card {
    color: $black;
    border: 1px solid $black;
    width: 70%;
    margin: auto;
    height: auto;
    padding: 1rem;
    border-radius: 1rem;

    h2 {
        font-size: 2rem;
        font-weight: bold;
        padding-bottom: 1rem;
    }

    .event--card__date,
    .event--card__location,
    .event--card__img,
    .event--card__content,
    .event--card__map {
        padding: 1rem;
    }

    .event--card__img {
        width: 100%;

        height: auto;
        margin: auto;
    }

    .event--card__map {
        width: 40%;
        margin: auto;
    }

    .event--card__content {
        width: 100%;
    }

    .img {
        width: 58%;
        height: auto;
        border-radius: 1em 1em 0 0;
        -o-object-fit: cover;
        object-fit: cover;
        transform: translateY(-2%);
    }

    .media-image {
        min-height: 300px;
        background-position: center;
        background-size: cover;
        border-radius: 1rem;
        margin-bottom: 1rem;
    }
}
</style>