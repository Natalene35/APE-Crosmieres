<template>
    <section>
        <h1>Liste des utilisateurs</h1>
        <ul>
            <li v-for="user in users" v-bind:key="user.id">
                <div class="detail">
                    <div>{{ user.last_name }} {{ user.first_name }}</div>
                    <div>{{ user.email }}</div>
                    <div>{{ user.roles[0] }}</div>
                </div>
                <!-- Only the admin can modify the users list -->
                <div v-if="this.$store.getters.getRole === 'administrator'" class="change">
                    <!-- This button calls the chooseARole methods et make appears the selected form -->
                    <button v-on:click="chooseARole(user.id)">Modifier le rôle</button>
                    <!-- Calls the delete method to delete a user -->

                    <img v-on:click="opacity = 1; zindex = 20;selectUserId=user.id" class="picture" title="Supprimer ce compte" alt="trash"
                        v-bind:src="trash" />
                </div>
            </li>
        </ul>

        <PopUpLayout v-bind:id="selectUserId" v-bind:opacity="this.opacity" v-bind:zindex="this.zindex"
            v-on:yes="deleteById" v-on:no="this.opacity = 0, this.zindex = -20" />

        <!-- The selected form appears on the click of the button by the chooseARole method -->
        <div class="select" v-if="showSelected">
            <label for="role-select">Choisir un nouveau rôle </label>
            <select name="role" id="role-select" v-model="selectedRole">
                <option value="apemember">apemember</option>
                <option value="apeuser">apeuser</option>
                <option value="administrator">administrator</option>
            </select>

            <input type="submit" v-on:click="updateRole()" value="Modifier le rôle">
        </div>
        <!-- display a succes message if the role is correctly modified -->
        <p class="succesUpdate" v-for="succesMsg in succesUpdate" v-bind:key="succesMsg">
            {{ succesMsg }}
        </p>
    </section>
</template>

<script>
import UserloginService from '@/services/login/UserLoginService';
import UserService from '@/services/user/UserService';
import trash from '@/assets/images/icons8-trash-can-100.png';
import PopUpLayout from '@/components/back-office/PopUpLayout';

export default {
    name: 'UsersListLayout',
    components: {
        PopUpLayout
    },

    data() {
        return {
            users: [],
            trash: trash,
            selectedRole: null,
            errors: [],
            succesUpdate: [],
            showSelected: false,
            idToChange: null,
            zindex: -20,
            opacity: 0,
            selectUserId: null
        }
    },
    async mounted() {
        // Contain the users list returns by the API
        this.users = await UserloginService.findAll();
        console.log(this.users);
    },

    methods: {
        async deleteById(e) {
            this.opacity=0
            this.zindex=-20 
            const response = await UserService.deleteById(e);
            this.users = await UserloginService.findAll();
            console.log(response);
        },

        chooseARole(id) {
            // console.log(id);
            this.showSelected = true;
            this.idToChange = id;
        },

        async updateRole() {
            // If the connected person is the administrator
            if (this.$store.getters.getRole === "administrator") {
                const response = await UserService.update(this.idToChange,
                    {
                        roles: [this.selectedRole]
                    });
                if (response.id) {
                    // console.log(response);
                    this.users = await UserloginService.findAll();
                    this.succesUpdate.push("Le statut de " + response.name + "a bien été modifié");
                    setTimeout(() => {
                        this.succesUpdate = [];
                    }, 5000);
                } else {
                    this.errors.push("Le rôle n'a pas été modifié");
                    setTimeout(() => {
                        this.errors = [];
                    }, 5000);
                }
            }
            this.showSelected = false;
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