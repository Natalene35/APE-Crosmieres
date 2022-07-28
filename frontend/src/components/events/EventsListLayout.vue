<template>
<div>
    <!-- Load icon library from font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <button class="search-icon"> <i class="fa fa-search"></i></button> 
    <input type="text" placeholder="Rechercher un évènement..." v-model="searchString">

    <section class="event--section">
        <img class="event--card__img" v-bind:src="eventPicture">
        <EventListLayout v-bind:image="event.featured_media !== 0 ? event._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100'" v-bind:id="event.id" v-bind:title="event.title.rendered" v-bind:content="event.content.rendered" v-for="event in eventsNewList" v-bind:key="event.id"/>
    </section>
</div>
</template>


<script>
import EventListLayout from '@/components/events/EventListLayout.vue';
import EventService from '@/services/events/EventService';

import picture from '@/assets/images/surr-holidays.png';


export default {
    name: "EventsListLayout",

    components: {
        EventListLayout
    },

    async mounted() {
        //list of events from our API
        this.eventsList = await EventService.findAll();
        
    },

    computed: {
        eventsNewList() {
        //Return an array that contains the rows where the callback returned true
            return this.eventsList.filter((event) => {
                // We take the title of the current event and we check if the searched term is contained in this title.
                // If yes, return true   
                if(event.title.rendered.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').includes(this.searchString.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase())) {
                    return true;
                } else {
                    return false;
                }
            });
        }

    },

    data() {
        return {
            eventsList: [],
            eventPicture: picture,
            searchString:"",
            
        }
    }
}

</script>

<style scoped lang="scss">

/* Style the search field */
input {
padding: 11px;
font-size: 15px;
border-style: none;
box-shadow: 1px 1px 1px $blue;
border-radius : 10px;
width: 25%;
background: $white;
}

.search-icon {
border-style:none;
background-color: $grey;
box-shadow: 1px 1px 1px rgba(88, 200, 235, 0.1);
color:$white;
height: 40px;
width: 40px;
border-radius:25%;
margin-right: 5px;

}
 

.event--section {
    display: flex;
    flex-direction: column;
    align-items: center;

    .event--card__img {
            width: 6rem;
            
    }
}


</style>


