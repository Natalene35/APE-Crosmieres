<template>
    <section>
        <h1>Liste des utilisateurs</h1>
        <ul>
            <li v-for="user in users" v-bind:key="user.id">
                {{ user.last_name }} {{ user.first_name }}
                <div>
                    
                    <label for="role-select">Changer le rôle</label>
                    <select name="role" id="role-select">
                        <option value="current role"></option>
                        <option value="membre">Membre</option>
                        <option value="utilisateur">Utilisateur</option>
                        <option value="admin">Admin</option>
                    </select>
                    <img class="picture" title="Supprimer ce compte" alt="trash" v-bind:src="trash" />
                </div>
            </li>
        </ul>
    </section>
</template>

<script>
import UserloginService from '@/services/login/UserLoginService';
import UserRegistrationService from '@/services/user/UserService';
import trash from '@/assets/images/icons8-trash-can-100.png'

export default {
    name: 'UsersListLayout',

    data() {
        return {
            users: [],
            trash: trash
        }
    },
    async mounted() {
        // Contain the users list returns by the API
        this.users = await UserloginService.findAll();
        //
        let id = this.$route.params.id;
        this.user = await UserRegistrationService.delete(id);
    }
}
</script>

<style lang="scss" scoped>
section {
    color: $grey;

    h1 {
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    li {
        border: 1px solid $black;
        background-color: $white;
        width: 60%;
        height: 2rem;
        margin: 0.2rem auto;
        border-radius: 1rem;

        .picture {
            height: 3rem;  
            cursor: pointer;
        }

        .picture:hover {
            filter: brightness(1.1);
            transform: scale(1.2);
        }
    }
}
</style>