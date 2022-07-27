<template>
    <section class="event--card">

        <div class="picture--container">
            <img class="picture" v-bind:src="picture" />
        </div>

        <h2 class="event--card__title">{{ title }}</h2>

        <div class="event--card__date">{{ date }}</div>
        <div class="event--card__location">{{ location }}</div>

        <div class="media-image" v-bind:style="'background-image:url(' + image + ')'"></div>

        <div class="event--card__content" v-html="content"></div>

        <img class="event--card__map" v-bind:src="mapPic">
    </section>
</template>

<script>
import EventService from "@/services/events/EventService";
import mapPic from '@/assets/images/map.jpg';
import jelly from '@/assets/images/sand-tower.png';

export default {
    name: "EventDetailLayout",
    data() {
        return {
            mapPic: mapPic,
            picture: jelly,
            title: null,
            date: null,
            location: null,
            content: null,
            image: null,
            map: null
        }
    },

    async mounted() {
        let id = this.$route.params.id;
        if (id) {
            let arrayMeta = await EventService.getMeta(id)
            console.log(arrayMeta.lieu);
            this.date = arrayMeta.date;
            this.location = arrayMeta.lieu;

            // Allow to retrieve the id dynamic parameter by using the $route object
            const response = await EventService.find(id);
            if (response.code) {
                // If error
                alert(response.message);
                // @TODO Ajouter une redirection vers l'accueil avec un message d'erreur
            } else {
                this.title = response.title.rendered;
                this.content = response.content.rendered;
                this.image = response._embedded['wp:featuredmedia'] ? response._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100';
            }
        }
    }
}

</script>

<style lang="scss" scoped>
.event--card {
    width: 90%;
    margin: 1rem auto;
    height: auto;
    padding: 1rem;
    border-radius: 1rem;
    font-size: 1rem;
    color: $grey;
    background-color: $white;
    box-shadow: 0px 17px 34px -20px $blue-bg-header;

    .picture--container {
        display: flex;
        justify-content: center;
        max-width: 100%;
        margin-bottom: 1rem;
        margin: auto;

        .picture {
            max-width: 70%;
            margin-top: -2rem;
        }
    }

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

    .event--card__date {
        margin-bottom: 1rem;
    }

    .event--card__map {
        width: 70%;
        margin: auto;
    }

    .event--card__content {
        width: 100%;
        margin: auto;
    }

    .media-image {
        width: 100%;
        min-height: 18rem;
        background-position: center;
        background-size: cover;
        border-radius: 1rem;
        margin: 1rem auto;
    }

    // Media query

    @media (min-width: 450px) {
        .event--card {
            width: 80%;

            .picture--container {
                max-width: 70%;
            }

            h2 {
                font-size: 1.6rem;
            }
        }
    }

    @media (min-width: 700px) {
        .event--card {
            width: 70%;
        }

        .picture--container {
            max-width: 50%;
        }

        h2 {
            font-size: 1.6rem;
        }

        .media-image {
            width: 90%;
            min-height: 25rem;
        }

        .event--card__content {
            width: 90%;
        }

        .event--card__map {
            width: 40%;
        }

    }

    @media (min-width: 1000px) {
        .event--card {
            width: 70%;
        }

        .picture--container {
            max-width: 30%;
        }

        h2 {
            font-size: 1.8rem;
        }

        .media-image {
            width: 80%;
            min-height: 35rem;
        }

        .event--card__content {
            width: 80%;
        }
    }
}
</style>
