<template>
    <section class="back-office--container__all">
        <section class="back-office--sales__all">

            <h2>Espace Administration de <span>{{ userName }}</span></h2>
            <!-- //MENU NAV -->
            <div class="back-office--menu__nav">

                <div class="home" v-on:click="showMenu">
                    <router-link v-bind:to="{ name: 'home' }" class="header--nav__home">
                        Accueil
                    </router-link>
                </div>
                <div class="updateEvent" v-on:click="showMenu">Modifier un evenements</div>
                <div class="createEvent" v-on:click="showMenu">Créer un evenement</div>
                <div class="updateSale" v-on:click="showMenu">Modifier une ventes</div>
                <div class="createSale" v-on:click="showMenu">Créer une vente</div>


            </div>

            <div v-if="this.menu == 3" class="back-office--container__components">
                <EventListLayout v-bind:backOffice="this.backOffice"
                    v-bind:image="event.featured_media !== 0 ? event._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100'"
                    v-bind:id="event.id" v-bind:title="event.title.rendered" v-bind:content="event.content.rendered"
                    v-for="event in eventsList" v-bind:key="event.id" />
            </div>
            <div v-if="this.menu == 1" class="back-office--container__components">
                <SaleListLayout v-bind:backOffice="this.backOffice" v-bind:id="sale.id"
                    v-bind:title="sale.title.rendered" v-bind:content="sale.content.rendered" v-for="sale in salesList"
                    v-bind:key="sale.id" />
            </div>

            <SaleCreateLayout v-if="this.menu == 2" class="back-office--container__components" />
            <EventCreateLayout v-if="this.menu == 4" class="back-office--container__components" />
        </section>
    </section>
</template>

<script>
//LAYOUT
import EventCreateLayout from '../events/EventCreateLayout.vue'
import SaleCreateLayout from '../sales/SaleCreateLayout.vue';
import EventListLayout from '../events/EventListLayout.vue';
import SaleListLayout from '../sales/SaleListLayout.vue';
//SERVICES
import EventService from '@/services/events/EventService';
import SaleService from '@/services/sales/SaleService';
export default {
    name: "BackOfficeLayout",
    data() {
        return {
            userName: sessionStorage.getItem("username"),
            menu: null,
            eventsList: null,
            salesList: null,
            backOffice: true
        };
    },
    methods: {
        showMenu(e) {
            if (e.currentTarget.classList == "updateSale") {
                if (this.menu != 1) {
                    this.menu = 1
                }
                else {
                    this.menu = null
                }

            }
            if (e.currentTarget.classList == "createSale") {
                if (this.menu != 2) {
                    this.menu = 2
                }
                else {
                    this.menu = null
                }
            }
            if (e.currentTarget.classList == "updateEvent") {
                if (this.menu != 3) {
                    this.menu = 3
                }
                else {
                    this.menu = null
                }
            }
            if (e.currentTarget.classList == "createEvent") {
                if (this.menu != 4) {
                    this.menu = 4
                }
                else {
                    this.menu = null
                }
            }
        },
        async reload(){
        this.eventsList = await EventService.findAll();
        this.salesList = await SaleService.findAll();
        }
    },
    components: { EventCreateLayout, SaleCreateLayout, EventListLayout, SaleListLayout }
    ,
    async mounted() {
        this.eventsList = await EventService.findAll();
        this.salesList = await SaleService.findAll();
    }
}
</script>

<style lang="scss" scoped>
.back-office--container__all {
    width: 100%;

    .back-office--sales__all {
        width: 94%;
        max-height: 100vh;
        display: flex;
        flex-direction: column;
        padding: 2%;
        align-items: center;
        padding: 0% 3% 0% 3%;

        .back-office--container__components {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: auto;
            flex-direction: column;
            align-items: center;
            .event--card{
                min-width: 50VH;
                margin-top: 5%;
                .event--card__media--image{
                    background-position: center;
                    background-size: cover;
                    background-repeat: no-repeat;
                }
            }
            .sale--card {
                width: 55%;
                position: relative;
                .sale--card__title{
                    display: flex;
                    flex-direction: row-reverse;
                    align-items: center;
                    justify-content: flex-start;
                    text-align: end;
                }
            }
        }

        h2 {
            margin-bottom: 3%;
            margin-left: 3%;
            color: $grey;
            font-family: "Merienda", cursive;

            span {
                text-transform: uppercase;
            }
        }

        .back-office--menu__nav {
            width: 100%;
            display: flex;
            justify-content: center;

            a {
                display: block;
            }

            div:hover {
                filter: contrast(1.5)
            }

            div {
                width: 22%;
                padding: 0.5rem;
                text-shadow: 1px 1px 1px black;
                border-radius: 10px;
                cursor: pointer;
                margin-right: 0.5rem;
            }

            .home {
                background-color: $purple;
                color: white;

                a {
                    display: block;
                    color: $white,
                }
            }

            .updateEvent {
                background-color: $red;
                color: white;
            }

            .createEvent {
                background-color: $red;
                color: white;
            }

            .updateSale {
                background-color: $orange;
                color: white;
            }

            .createSale {
                background-color: $orange;
                color: white;
                margin-right: 0;
            }
        }
    }
}


@media (max-width: 555px) {
    .back-office--container__all {
        .back-office--sales__all {
            .back-office--menu__nav {
                a {
                    width: 46%;
                }
            }
                    .back-office--container__components {
            .event--card{
                width: 90%;
                .event--card__media--image{
                }
            }
            .sale--card {
                width: 80%;
                .sale--card__title{
                }
            }
        }
        }
    }

}
</style>