<template>
  <section class="event--section">
    <div class="event--section__search">
      <img class="event--card__img" v-bind:src="eventPicture" />
      <!-- Load icon library from font awesome -->
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      />
      <button class="search-icon"><i class="fa fa-search"></i></button>
      <input type="text" placeholder="Rechercher..." v-model="searchString" />

      <div>Choix du type d'évènement:</div>
      <input type="radio" id="all" v-model="picked" value="all" />
      <label for="statement">Tous</label>
      <!-- value 3 = id of taxonomie statement "réunion in backoffice wp" -->
      <input type="radio" id="statement" value="3" v-model="picked" />
      <label for="statement">Réunion</label>
      <!-- value 4 = id of taxonomie actuality "actualité in backoffice wp" -->
      <input type="radio" id="actuality" value="4" v-model="picked" />
      <label for="actuality">Actualité</label>
    </div>
    <EventListLayout
      v-bind:image="
        event.featured_media !== 0
          ? event._embedded['wp:featuredmedia'][0].source_url
          : 'https://source.unsplash.com/collection/157&random=100'
      "
      v-bind:id="event.id"
      v-bind:title="event.title.rendered"
      v-bind:content="event.content.rendered"
      v-for="event in eventsNewList"
      v-bind:key="event.id"
    />
  </section>
</template>


<script>
import EventListLayout from "@/components/events/EventListLayout.vue";
import EventService from "@/services/events/EventService";
import picture from "@/assets/images/surr-holidays.png";

export default {
  name: "EventsListLayout",

  components: {
    EventListLayout,
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
        console.log("ok");
        if(this.picked == "all"){
            if (event.title.rendered.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").includes(this.searchString.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase())) {
                return true;
                } else {
                return false;
                }
        } else { 
            if ( event.title.rendered.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").includes(this.searchString.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase()) && (this.picked == event.types[0])) {
            return true;
            } else {
            return false;
            }
        }
      });
    },
  },

  data() {
    return {
      eventsList: [],
      eventPicture: picture,
      searchString: "",

      picked: "all",
    };
  },
};
</script>

<style scoped lang="scss">
.event--section {
  display: flex;
  flex-direction: column;
  align-items: center;

  .event--section__search {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  input {
    padding: 11px;
    font-size: 15px;
    border-style: none;
    width: 25%;
    background: $white;
    border: 1px solid $blue-bg-header;
    border-radius: 0.5em;
  }

  .search-icon {
    border-style: none;
    background-color: $red;
    color: $white;
    height: 40px;
    width: 40px;
    border-radius: 25%;
    margin-right: 5px;
    margin-left: 2rem;
  }

  .event--card__img {
    width: 6rem;
  }
}
</style>


