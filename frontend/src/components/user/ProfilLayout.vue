<template>
    <section class="wrapper">
        <div class="container">
            <img src="@/assets/images/icons8-profile-60.png" alt="exemple photo-profile-avatar" class="profile" />
            <h2>{{ user.name }}</h2>

            <label class="field__label">Prénom</label>
            <input v-model="user.first_name" type="text" class="inputbox" placeholder="Votre prénom" name="firstname">

            <label class="field__label">Nom</label>
            <input v-model="user.last_name" type="text" class="inputbox" placeholder="Votre Nom" name="lastname">

            <label class="field__label">E-mail</label>
            <input v-model="user.email" type="email" class="inputbox" placeholder="Votre e-mail" name="mail">

            <label class="field__label">Numéro de téléphone</label>
            <input v-model="phone" type="text" class="inputbox" placeholder="Votre numéro de contact" name="phone">

            <label class="field__label">Votre identifiant de connexion</label>
            <input v-model="user.nickname" type="text" class="inputbox" placeholder="Votre pseudo" name="username">

            <div class="button--link">
                <p class="push--error" v-for="error in errors" v-bind:key="error">{{ error }}</p>

                <a v-on:click="showChildRegistrationLayout" class="addChild">Ajouter mes enfants</a>

                <ChildRegistrationLayout class="ChildRegistrationLayout--display active" />

                <a v-on:click="updateUser" class="update">Enregistrer vos modifications</a>
                <p class="succesUpdate" v-for="succesMsg in succesUpdate" v-bind:key="succesMsg">{{
                        succesMsg
                }}</p>

                <a v-on:click="showUpdatePassword" class="updatePassword">Mettre à jour votre mot de
                    passe</a>

                <a v-on:click="removeUser" class="delete">Supprimer mon compte</a>
            </div>
        </div>
    </section>
</template>

<script>
import ChildRegistrationLayout from '@/components/registration/ChildRegistrationLayout.vue'
import UserLoginService from '@/services/login/UserLoginService';
import UserService from '@/services/user/UserService'

export default {
    name: 'UserProfil',

    components: {
        ChildRegistrationLayout,
    },

    data() {
        return {
            user: [],
            errors: [],
            succesUpdate: [],
            phone: null,
        }
    },

    async mounted() {
        let user_ID = this.$store.getters.getUserID;
        if (user_ID) {
            //retrieve logged in user data
            this.user = await UserLoginService.find(user_ID);
            console.log(this.user);
            //retrieve logged in user meta data
            let arrayMeta = await UserLoginService.getMeta(user_ID)
            for (let index = 0; index < arrayMeta.length; index++) {
                const metaElmt = arrayMeta[index];
                //For take meta_key enter key in the exemple its "phone"
                if (metaElmt.meta_key == "phone") {
                    console.log(metaElmt.meta_value)
                    return this.phone = metaElmt.meta_value
                }
            }
        }
    },

    methods: {

        //When user click on button add children display the component
        showChildRegistrationLayout() {
            let ChildRegistrationLayout = document.querySelector(".ChildRegistrationLayout--display");
            ChildRegistrationLayout.classList.toggle("active");
        },

        //When user click on button add children display the component
        showUpdatePassword() {
            let updatePassword = document.querySelector(".updatePassword--display");
            updatePassword.classList.toggle("active");
        },

        async removeUser() {
            if (this.$store.getters.getUserID) {
                const response = await UserService.delete(this.$store.getters.getUserID)
                console.log(response);
                if (response.id) {
                    this.$router.push({ name: 'home' });
                } else {
                    this.errors.push("Echec suppression");
                }
            }
        },

        async updateUser() {
            if (this.$store.getters.getUserID) {
                const response = await UserService.update(this.$store.getters.getUserID, {
                    "pseudo": this.user.nickname,
                    "email": this.user.email,
                    "first_name": this.user.first_name,
                    "last_name": this.user.last_name,
                    "phone": this.user.phone
                });
                if (response.id) {
                    this.succesUpdate.push('Mise à jour réussi');
                } else {
                    this.errors.push("Echec suppression");
                }
            }
        }
    }
}
</script>

 <style scoped lang="scss">
 .wrapper {
     color: #313846;
     font-family: "Muli", sans-serif;
     font-size: 1rem;
     display: grid;
     place-items: center;
     border-radius: 1em;
     width: 100%;
     justify-items: center;
     justify-content: center;
 
     * {
         -webkit-box-sizing: border-box;
         box-sizing: border-box;
         -webkit-transition: all 0.25s ease;
         transition: all 0.25s ease;
     }
 
     .container {
         max-width: 400px;
         overflow: hidden;
         padding: 0;
         margin-top: 1rem;
         margin-bottom: 1rem;
         border-radius: 1em;
         display: -ms-grid;
         display: grid;
         place-items: center;
 
         h2 {
             font-size: 2rem;
             margin: 1rem;
             text-align: center;
         }
 
         :before {
             position: absolute;
             content: '';
             bottom: 100%;
             left: 0;
             width: 0;
             height: 0;
             border-style: solid;
             border-width: 55px 0 0 400px;
             border-color: transparent transparent transparent $blue-light-bg;
         }
 
         a {
             padding: 5px;
             color: $black;
             font-size: 0.7em;
             text-transform: uppercase;
             margin: 0.5rem;
             opacity: 0.65;
             width: 100%;
             text-align: center;
             text-decoration: none;
             font-weight: 600;
             letter-spacing: 1px;
         }
 
         a:hover {
             opacity: 1;
         }
     }
 
     .profile {
         border-radius: 50%;
         bottom: 100%;
         max-width: 90px;
         opacity: 1;
         box-shadow: 0 0 15px $black;
         margin: 1rem;
         width: 12%;
     }
 
     .follow {
         margin-right: 4%;
         border-color: $green;
         color: $grey;
     }
 
     h2 {
         margin: 0 0 5px;
         font-weight: 300;
 
         span {
             display: block;
             font-size: 0.5em;
             color: $grey;
         }
     }
 
     p {
         margin: 0 0 10px;
         font-size: 0.8em;
         letter-spacing: 1px;
         opacity: 0.8;
     }
 
     .button--link {
         display: flex;
         flex-direction: column;
         align-items: center;
 
 
         .addChild {
             border: 1px solid $green;
             background-color: $green ;
             border-radius: 10px;
             cursor: pointer
         }
 
         .update {
             border: 1px solid $purple;
             background-color: $purple;
             border-radius: 10px;
             cursor: pointer
         }
 
         .delete {
             border: 1px solid $red;
             background-color: $red;
             border-radius: 10px;
             cursor: pointer
         }
 
         .updatePassword {
             border: 1px solid $pink;
             background-color: $pink;
             border-radius: 10px;
             cursor: pointer
         }
 
         .succesUpdate {
             color: green;
             text-transform: uppercase;
             font-size: 1rem;
             margin-bottom: 1rem;
         }
     }
 
     .inputbox {
         padding: 0.5em 0 0.5em 1.5em;
         font-size: 1rem;
         line-height: 3;
         width: 100%;
         border: 1px solid $blue-bg-header;
         border-radius: 0.5em;
         margin: 0 0 1rem 0;
         padding: 0;
         text-align: center;
     }
 }
 
 .active {
     display: none;
 }
 </style>
