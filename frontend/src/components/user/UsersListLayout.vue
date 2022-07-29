<template>
    <section>
        <h1>Liste des utilisateurs</h1>
        <ul>
            <li v-for="user in users" v-bind:key="user.id">
                <div class="detail">
                    <div>{{ user.last_name }} {{ user.first_name }}</div>
                    <div>{{ user.email }}</div>
                    <div>{{ user.role }}</div>
                </div>
                <div class="change">
                    <div class="select">
                        <label for="role-select">Changer le rôle </label>
                        <select name="role" id="role-select" @change="changeRole(user.id)" v-model="selected">
                            <option value="user.roles[0]">{{ user.roles[0] }}</option>
                            <option value="apemember">apemember</option>
                            <option value="apeuser">apeuser</option>
                            <option value="administrator">administrator</option>
                        </select>
                    </div>
                    <img v-on:click="deleteById(user.id)" class="picture" title="Supprimer ce compte" alt="trash"
                        v-bind:src="trash" />
                </div>
            </li>
        </ul>
    </section>
</template>

<script>
import UserloginService from '@/services/login/UserLoginService';
import UserService from '@/services/user/UserService';
import trash from '@/assets/images/icons8-trash-can-100.png'

export default {
    name: 'UsersListLayout',

    data() {
        return {
            users: [],
            trash: trash,
            selected: ''
        }
    },
    async mounted() {
        // Contain the users list returns by the API
        this.users = await UserloginService.findAll();
        console.log(this.users);
    },

    methods: {
        async deleteById(id) {
            const response = await UserService.deleteById(id);
            this.users = await UserloginService.findAll();
            console.log(response);
        },
        changeRole(e) {
            console.log(e);
        }
    }
}
</script>

<style lang="scss" scoped>
section {
    color: $grey;
    margin-bottom: 2rem;

    h1 {
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    li {
        border: 1px solid $black;
        background-color: $white;
        width: 90%;
        height: auto;
        margin: 0.2rem auto;
        border-radius: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;

        .select {
            display: flex;
            flex-direction: column;
        }

        .picture {
            height: 3rem;
            cursor: pointer;
        }

        .picture:hover {
            filter: brightness(1.1);
            transform: scale(1.2);
        }

        .change {
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }

    }

    @media (min-width: 1024px) {
        li {
            width: 60%;
        }
    }
}
</style>