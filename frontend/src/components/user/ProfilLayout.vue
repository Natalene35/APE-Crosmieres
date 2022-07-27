<template>
    <section class="section">
        <figure class="user-profile">
            <figcaption>
                <img src="@/assets/images/icons8-profile-60.png" alt="exemple photo-profile-avatar" class="profile" />
                <h2>Bienvenue {{ user.name }}</h2>

                <label class="field__label">Prénom</label>
                <input v-model="user.first_name" type="text" class="inputbox" placeholder="Votre prénom"
                    name="firstname">

                <label class="field__label">Nom</label>
                <input v-model="user.last_name" type="text" class="inputbox" placeholder="Votre Nom" name="lastname">

                <label class="field__label">E-mail</label>
                <input v-model="user.email" type="email" class="inputbox" placeholder="Votre e-mail" name="mail">

                <label class="field__label">Numéro de téléphone</label>
                <input v-model="phone" type="text" class="inputbox" placeholder="Votre numéro de contact" name="phone">

                <label class="field__label">Votre identifiant de connexion</label>
                <input v-model="user.nickname" type="text" class="inputbox" placeholder="Votre pseudo" name="username">

                <div class="button--link">
                    <a v-on:click="showChildRegistrationLayout" class="addChild">Ajouter mes enfants</a>
                    <a v-on:click="updateUser" class="update">Enregistrer vos modifications</a>
                    <a v-on:click="showUpdatePassword" class="updatePassword">Mettre à jour votre mot de
                        passe</a>
                    <a v-on:click="removeUser" class="delete">Supprimer mon compte</a>
                </div>
            </figcaption>
        </figure>
        <ChildRegistrationLayout class="ChildRegistrationLayout--display active" />
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
                    alert(response.message);
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
                console.log(response);
            }
        }
    }
}
</script>

 <style scoped lang="scss">
 .user-profile {
     overflow: hidden;
     text-align: left;
     line-height: 1.4em;
     background-color: $blue-light-bg;
     color: $grey;
 
     * {
         -webkit-box-sizing: border-box;
         box-sizing: border-box;
         -webkit-transition: all 0.25s ease;
         transition: all 0.25s ease;
     }
 
     figcaption {
         width: 100%;
         background-color: $blue-light-bg;
         padding: 25px;
         position: relative;
 
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
             width: 47%;
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
