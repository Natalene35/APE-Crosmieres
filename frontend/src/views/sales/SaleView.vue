<template>
    <HeaderLayout />
    <SaleDetailLayout />
    <FooterLayout />
</template>

<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue'
import FooterLayout from '@/components/templates/FooterLayout.vue'
import SaleDetailLayout from '@/components/sales/SaleDetailLayout.vue'

export default {
    name: 'HomeView',
    components: {
    HeaderLayout,
    FooterLayout,
    SaleDetailLayout
}
}
</script>

<style lang="scss">
</style>