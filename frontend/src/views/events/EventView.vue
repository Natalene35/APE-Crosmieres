<template>
    <div>
        <HeaderLayout />
        <main>
            <EventDetailLayout />
        </main>
        <FooterLayout />
    </div>
</template>

<script>
import HeaderLayout from '@/components/templates/HeaderLayout.vue';
import FooterLayout from '@/components/templates/FooterLayout.vue';
import EventDetailLayout from '@/components/events/EventDetailLayout.vue';
export default {
    components: {
        HeaderLayout,
        FooterLayout,
        EventDetailLayout
    }
}
</script>

<style>
</style>