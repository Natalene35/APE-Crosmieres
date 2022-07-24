<template>
    <HeaderLayout />
    <UserLoginLayout />
    <FooterLayout />
</template>

<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue'
import FooterLayout from '@/components/templates/FooterLayout.vue'
import UserLoginLayout from '@/components/login/UserLoginLayout.vue'

export default {
    name: 'HomeView',
    components: {
    HeaderLayout,
    FooterLayout,
    UserLoginLayout
}
}
</script>

<style lang="scss">
</style>