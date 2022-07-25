<template>

    <div class="event--card">
        <!--<router-link v-bind:to="{name: 'event', params: {id: id}}"></router-link>-->
            <img class="event--card__img" v-bind:src="eventPicture">
            <h2 class="event--card__title">
                <div v-html="title"></div>
            </h2>
            <div class="event--card__media--image" v-bind:style="'background-image:url(' + image +')'"></div>
            <div class="event--card__excerpt">
                <div v-html="excerpt"></div>
            </div>
        <!--</router-link>-->    
    </div>
     
</template>



<script>
import picture from '@/assets/images/surr-holidays.png';

export default {
    name: "EventHomeListLayout",

    props: {
        image: String,
        title: String,
        excerpt: String,
        id: Number
    },

    data() {
        return {
            eventPicture: picture,
        }
    },
}

</script>


<style scoped lang="scss">

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
    padding:1.5rem;

        .event--card__img {
            width: 6rem;
            
        }

        .event--card__title {
            color: $grey;
            font-weight: bold;
            padding-right: 2rem;
            padding-left: 2rem;
            
        }

        .event--card__media--image {
            min-height: 20%;
            background-position: center;
            background-size: cover;
            border-radius: 50%;

        }

        .event--card__excerpt {
            color: $grey;
            margin: 1rem 3rem 1rem 3rem;

        }
    
}
//<---------------------MEDIA QUERIES ------------------------>
@media (max-width: 425px) {
    .event--card {
        width:90%;
    }

}

</style>




