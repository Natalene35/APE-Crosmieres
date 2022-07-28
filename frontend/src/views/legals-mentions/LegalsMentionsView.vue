<template>
    <HeaderLayout />
    <LegalsMentionsLayout />
    <FooterLayout />
</template>

<script>
import HeaderLayout from '../../components/templates/HeaderLayout.vue'
import FooterLayout from '../../components/templates/FooterLayout.vue'
import LegalsMentionsLayout from '../../components/legals-mentions/LegalsMentionsLayout.vue'

export default {
    name : "LegalsMentionsView",
    components: {
        HeaderLayout,
        FooterLayout,
        LegalsMentionsLayout
    },

}
</script>

<style>
</style>