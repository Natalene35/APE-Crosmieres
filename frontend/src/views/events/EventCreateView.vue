<template>
  <HeaderLayout />
  <EventCreateView />
  <FooterLayout />
</template>

<script>
// @ is an alias to /src
import HeaderLayout from "@/components/templates/HeaderLayout.vue";
import FooterLayout from "@/components/templates/FooterLayout.vue";
import EventCreateView from "@/components/events/EventCreateView.vue";

export default {
  name: "EventFormView",
  components: {
    HeaderLayout,
    FooterLayout,
    EventCreateView,
  },
};
</script>

<style lang="scss">
</style>