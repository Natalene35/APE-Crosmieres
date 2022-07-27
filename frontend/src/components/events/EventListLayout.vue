<template>

    <div class="event--card">
        <!--<router-link v-bind:to="{name: 'event', params: {id: id}}">-->
             
            <div class="event--card__media--image" v-bind:style="'background-image:url(' + image +')'">
            </div>

            <h2 class="event--card__title">
                <div v-html="title"></div>
            </h2>
                <div class="event--card__content">
                    <div v-html="content"></div>
                </div>
        <!--</router-link>-->    
    </div>
     
</template>


<script>

export default {
    name: "EventListLayout",

    props: {
        image: String,
        title: String,
        content: String,
        id: Number
    },

}

</script>


<style scoped lang="scss">
.event--card {
    border: 1px solid $white;
    border-radius: 2rem 2rem;
    background-color: $white;
    margin: 1%;
    display: flex;
    flex-direction: column;
    margin-bottom: 3rem;
    box-sizing: border-box;
    padding-bottom: 1rem;
    width: 95%;

        .event--card__title {
            color: $grey;
            font-weight: bold;
            padding-right: 2rem;
            padding-left: 2rem;
            font-size: 1.2rem;
            padding-top: 1rem;
     
        }

        .event--card__media--image {
            
            min-height: 30vh;
            background-position: center;
            background-size: cover;
            border-radius: 2rem 2rem 0 0;
           
        }

        .event--card__content {
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