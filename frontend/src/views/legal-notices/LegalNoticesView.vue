<template>
    <HeaderLayout />
    <LegalNoticesLayout />
    <FooterLayout />
</template>

<script>
import HeaderLayout from '../../components/templates/HeaderLayout.vue';
import FooterLayout from '../../components/templates/FooterLayout.vue';
import LegalNoticesLayout from '../../components/legal-notices/LegalNoticesLayout.vue';

export default {
    name : "LegalNoticesView",
    components: {
        HeaderLayout,
        FooterLayout,
        LegalNoticesLayout
    },

}
</script>

<style>
</style>