<template>
    <section class="event--card">

        <div class="picture--container">
            <img class="picture" alt="Illustration" v-bind:src="picture" />
        </div>
        <h2 class="event--card__title">{{ title }}</h2>

        <div class="event--card__date">{{ date }}</div>

        <div class="media-image" v-bind:style="'background-image:url(' + image + ')'"></div>

        <div class="event--card__content" v-html="content"></div>

        <a class="event--card__link" v-bind:href="link">Lien vers le site marchand
            <img class="snake" alt="Arrow" v-bind:src="bigSnake" />
        </a>
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
        let id = this.$route.params.id;
        if (id) {
            let arrayMeta = await SaleService.getMeta(id)
            console.log(arrayMeta);
            for (let index = 0; index < arrayMeta.length; index++) {
                const metaElmt = arrayMeta[index];
                console.log(arrayMeta[0]);
                if (metaElmt.meta_key == "date") {
                    this.date = metaElmt.meta_value;
                }
                if (metaElmt.meta_key == "lien") {
                    this.link = metaElmt.meta_value;
                }
            }
            // Allow to retrieve the id dynamic parameter by using the $route object

            const response = await SaleService.find(id);
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
            margin-top: -3rem;
        }
    }

    h2 {
        font-size: 1.4rem;
        font-weight: bold;
        padding-bottom: 1rem;
        margin-top: -2rem;
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
        text-shadow: 1px 1px 1px $black;
        transition: 1s;
        padding-bottom: 2rem;
    }

    .event--card__link:hover {
        transform: scale(1.25);
        font-size: 1.1em;
    }

    .snake {
        margin-bottom: -0.5rem;
    }
}

// Media query

@media (min-width: 450px) {
    .picture--container {
        max-width: 70%;
    }

    h2 {
        font-size: 1.6rem;
    }
}

@media (min-width: 700px) {
    .event--card {
        width: 80%;

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
}

@media (min-width: 1000px) {
    .event--card {
        width: 70%;

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