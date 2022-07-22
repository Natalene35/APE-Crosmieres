<template>
    <section class="event--card">

        <div class="picture--container">
            <img class="picture" alt="Illustration" v-bind:src="picture" />
        </div>
        <h2 class="event--card__title">{{ title }}</h2>

        <div class="event--card__date">Date de la vente</div>

        <div class="media-image" v-bind:style="'background-image:url(' + image + ')'"></div>

        <div class="event--card__content" v-html="content"></div>

        <a class="event--card__link" v-bind:href="link">Lien vers le site marchand</a>
        <img class="snake" alt="Arrow" v-bind:src="bigSnake" />


    </section>
</template>

<script>
import SaleService from "@/services/sales/SaleService";
import illustration from '@/assets/images/purchases.png';
import bigArrow from '@/assets/images/squiggly-32.png';


export default {
    name: "SaleDetailLayout",
    data() {
        return {
            picture: illustration,
            bigSnake: bigArrow,
            title: null,
            date: null,
            content: null,
            image: null,
            link: null
        }
    },
    async mounted() {
        // Allow to retrieve the id dynamic parameter by using the $route object
        let id = this.$route.params.id;
        const response = await SaleService.find(id);
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
            this.link = response.link;
        }
    }
}
</script>

<style lang="scss" scoped>
.event--card {
    color: $black;
    border: 1px solid $black;
    width: 80%;
    margin: auto;
    height: auto;
    padding: 1rem;
    border-radius: 1rem;
    font-size: 1rem;

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
        font-size: 1.4rem;
        font-weight: bold;
        padding-bottom: 1rem;
    }

    .event--card__date {
        margin-bottom: 1rem;
    }

    .event--card__date,
    .event--card__img,
    .event--card__content {
        padding: 1rem;
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

    .event--card__link {
        color: $orange;
        text-shadow: 1px 1px 1px black;
        padding-right: 0.3rem;
    }

    .snake {
        margin-bottom: -0.5rem;
    }

    @media (min-width: 450px) {
        .picture--container {
            max-width: 70%;
        }

        h2 {
            font-size: 1.6rem;
        }
    }

    @media (min-width: 700px) {
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