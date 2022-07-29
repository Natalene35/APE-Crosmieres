<template>

    <!-- //Liste Evenements  -->

    <section class="event--section">

        <EventHomeListLayout
            v-bind:image="event.featured_media !== 0 ? event._embedded['wp:featuredmedia'][0].source_url : defaultPicture"
            v-bind:id="event.id" v-bind:title="event.title.rendered" v-bind:excerpt="event.excerpt.rendered"
            v-for="event in eventsList" v-bind:key="event.id" />

    </section>

</template>


<script>
import EventHomeListLayout from '@/components/events/EventHomeListLayout.vue';
import EventService from '@/services/events/EventService';
import PictureFlags from '@/assets/images/events/flags.jpg';
import PictureBallon1 from '@/assets/images/events/ballon-1.jpg';
import PictureBallon2 from '@/assets/images/events/ballon-2.jpg';
import PictureMulticolored from '@/assets/images/events/multicoloured.jpg';


export default {
    name: "EventsHomeLayout",

    components: {
        EventHomeListLayout
    },

    async mounted() {
        //list of events from our API
        //GET AN ARRAY OF ALL EVENTS
        let list = await EventService.findAll();
        // ORDER BY DATE ARRAY OF EVENTS
        list.sort(function (b, a) {
            var c = new Date(a.date);
            var d = new Date(b.date);
            return c - d;
        }),
            //SLICE (0.4) CUT THE ARRAY AND GET 4 FIRST EVENT ORDER BY DATE
            this.eventsList = list.slice(0, 4)

    },

    data() {
        return {
            eventsList: [],
            images: [
                PictureFlags,
                PictureBallon1,
                PictureBallon2,
                PictureMulticolored
            ],
            defaultPicture: null
        }
    },

    methods: {
        randomItem(items) {
            return items[Math.floor(Math.random() * items.length)];
        }
    },
    created() {
        this.defaultPicture = this.randomItem(this.images)
    }
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