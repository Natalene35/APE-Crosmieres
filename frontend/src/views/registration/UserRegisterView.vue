<template>
    <HeaderLayout />
    <UserRegisterLayout />
    <FooterLayout />
</template>

<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue'
import FooterLayout from '@/components/templates/FooterLayout.vue'
import UserRegisterLayout from '@/components/registration/UserRegisterLayout.vue'

export default {
    name: 'HomeView',
    components: {
        HeaderLayout,
        FooterLayout,
        UserRegisterLayout
    }
}
</script>

<style lang="scss">
</style>