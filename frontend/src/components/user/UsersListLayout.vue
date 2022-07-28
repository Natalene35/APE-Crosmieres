<template>
    <section>
        <h1>Liste des utilisateurs</h1>
        <ul>
            <li v-for="user in users" v-bind:key="user.id">
            {{ user.last_name }} {{ user.first_name }}
            </li>
        </ul>
    </section>
</template>

<script>
import UserloginService from '@/services/login/UserLoginService';

export default {
    name: 'UsersListLayout',

    data() {
        return {
            users: []
        }
    },
    async mounted() {
        console.log('bla');
        // Contain the users list returns by the API
        this.users = await UserloginService.findAll();
    }
}
</script>

<style lang="scss" scoped>
section {
    color: $grey;
}
</style>