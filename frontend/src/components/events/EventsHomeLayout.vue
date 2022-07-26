<template>
    <!-- //Liste Evenements  -->
    <section class="event--section">
        <EventHomeListLayout v-bind:image="event.featured_media !== 0 ? event._embedded['wp:featuredmedia'][0].source_url : 'https://source.unsplash.com/collection/157&random=100'" v-bind:id="event.id" v-bind:title="event.title.rendered" v-bind:excerpt="event.excerpt.rendered" v-for="event in eventsList" v-bind:key="event.id"/>

    </section>

</template>


<script>
import EventHomeListLayout from '@/components/events/EventHomeListLayout.vue';
import EventService from '@/services/events/EventService';


export default {
    name: 'EventsHomelayout',

    components: {
        EventHomeListLayout
    },

    async mounted() {
        //list of events from our API
        this.eventsList = await EventService.findAll();
        
    },

    data() {
        return {
            eventsList: [],
            
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
}
        

</style>