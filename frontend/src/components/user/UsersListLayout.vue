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
                    <img v-on:click="doDelete" class="picture" title="Supprimer ce compte" alt="trash" v-bind:src="trash" />
                    <button  @click="doDelete">Delete Page</button>
                    <ConfirmDialogue ref="confirmDialogue" />
                </div>
            </li>
        </ul>
    </section>
</template>

<script>
import UserloginService from '@/services/login/UserLoginService';
import UserRegistrationService from '@/services/user/UserService';
import trash from '@/assets/images/icons8-trash-can-100.png'
import ConfirmDialogue from '@/components/confirmation-box/ConfirmDialogue.vue'

export default {
    name: 'UsersListLayout',
    components: { 
        ConfirmDialogue 
        },

    data() {
        return {
            users: [],
            trash: trash,
        }
    },
    async mounted() {
        // Contain the users list returns by the API
        this.users = await UserloginService.findAll();
        //
        let id = this.$route.params.id;
        this.user = await UserRegistrationService.delete(id);
    },
    methods: {
        async doDelete() {
            console.log(this.$ref);
            const ok = await this.$refs.confirmDialogue.show({
                title: "Suppression d'un utilisateur",
                message: "Etes vous sûr de vouloir supprimer ce compte ?",
                okButton: "Supprimer",
            })
            // If you throw an error, the method will terminate here unless you surround it wil try/catch
            if (ok) {
                alert('Cet utilisateur a bien été supprimé')
            } else {
                alert('Retour à la liste des utilisateurs')
            }
        }
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