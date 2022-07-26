<template>
    <section class="event--section">

        <img class="event--card__img" v-bind:src="eventPicture">

        <EventListLayout v-bind:image="event.featured_media !== 0 ? event._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100'" v-bind:id="event.id" v-bind:title="event.title.rendered" v-bind:content="event.content.rendered" v-for="event in eventsList" v-bind:key="event.id"/>

    </section>

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

    data() {
        return {
            eventsList: [],
            eventPicture: picture,
        }
    }
}

</script>

<style scoped lang="scss">

.event--card__img {
        width: 6rem;
        
}


</style>


