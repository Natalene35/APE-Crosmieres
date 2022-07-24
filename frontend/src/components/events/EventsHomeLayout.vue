<template>
        <!-- //Liste Evenements  -->
        <section class="event--section">
            
                <div class="event--card">
                    <img class="event--card__img" v-bind:src="eventPicture">
                    <h2 class="event--card__title">Concours de lancer de menhir</h2>
                    <div class="event--card__content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime
                        adipisci delectus amet quisquam quibusdam eius itaque, </div>
                </div>

                <div class="event--card">
                    <img class="event--card__img" v-bind:src="eventPicture">
                    <h2 class="event--card__title">Classe découverte de la faune et la flore</h2>
                    <div class="event--card__content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime
                        adipisci delectus amet quisquam quibusdam eius itaque,</div>
                </div>

                <div class="event--card">
                    <img class="event--card__img" v-bind:src="eventPicture">
                    <h2 class="event--card__title">Concours du cri de la mouette</h2>
                    <div class="event--card__content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime
                        adipisci delectus amet quisquam quibusdam eius itaque,</div>
                </div>

                <div class="event--card">
                    <img class="event--card__img" v-bind:src="eventPicture">
                    <h2 class="event--card__title">Championnat interstellaire de corde à sauter</h2>
                    <div class="event--card__content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime
                        adipisci delectus amet quisquam quibusdam eius itaque, </div>
                </div>

        </section>

</template>

<script>
import picture from '@/assets/images/surr-holidays.png'
export default {
    name: 'EventsHomelayout',
    data() {
        return {
            eventPicture: picture,
        }
    },
}
</script>

<style lang="scss" scoped>

    
    .event--section {
        width: 100%;
       justify-content: center;
        display: flex;
        flex-wrap: wrap;
        
            .event--card {
                border: 1px solid $white;
                border-radius: 50%;
                width:45%;
                background-color: $white;
                margin: 1%;
                display: flex;
                flex-direction: column;
                margin-bottom: 3rem;
                box-sizing: border-box;

                .event--card__img {
                    width: 6rem;
                    
                }

                .event--card__title {
                    color: $grey;
                    font-weight: bold;
                }

                .event--card__content {
                    color: $grey;
                }
            
        }
    //<---------------------MEDIA QUERIES ------------------------>
            @media (max-width: 425px) {
                .event--card{
                    width:90%;
        }

    }
}
</style>