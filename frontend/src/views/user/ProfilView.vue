<template>
    <HeaderLayout />
    <ProfilLayout />
    <FooterLayout />
</template>

<script>
// @ is an alias to /src
import HeaderLayout from '@/components/templates/HeaderLayout.vue'
import FooterLayout from '@/components/templates/FooterLayout.vue'
import ProfilLayout from '@/components/user/ProfilLayout.vue'


export default {
    name: 'ProfilView',
    components: {
        HeaderLayout,
        FooterLayout,
        ProfilLayout
    }
}
</script>

<style scoped lang="scss">
</style>