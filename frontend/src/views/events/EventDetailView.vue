<template>
    <HeaderLayout />
    <EventDetailLayout />
    <FooterLayout />
</template>


<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue';
import EventDetailLayout from '@/components/events/EventDetailLayout.vue';
import FooterLayout from '@/components/templates/FooterLayout.vue';

export default {
    name: 'EventDetailView',
    components: {
    HeaderLayout,
    FooterLayout,
    EventDetailLayout
}
}
</script>


<style lang="scss">
</style>
