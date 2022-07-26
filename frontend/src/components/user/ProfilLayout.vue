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

                <!--<label class="field__label">Mot de passe</label>
                <input v-model="password" class="inputbox" type="password" placeholder="Mot de passe">

                <label class="field__label">Confirmer le mot de passe</label>
                <input v-model="passwordconfirm" class="inputbox" type="password" placeholder="Mot de passe" required>-->
                <div class="button--link">
                    <a v-on:click="showChildRegistrationLayout" class="addChild">Ajouter mes enfants</a>
                    <a href="" class="update">Mettre à jour</a>
                    <a href="" class="delete">Supprimer mon compte</a>
                </div>
            </figcaption>
        </figure>
        <ChildRegistrationLayout class="ChildRegistrationLayout--display active" />
    </section>

</template>

<script>
import ChildRegistrationLayout from '@/components/registration/ChildRegistrationLayout.vue'
import UserLoginService from '@/services/login/UserLoginService';
import UserRegistrationService from '@/services/registration/UserRegistrationService'

export default {
    name: 'UserProfil',

    components: {
        ChildRegistrationLayout,
    },

    data() {
        return {
            user: [],
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

        showChildRegistrationLayout() {
            let ChildRegistrationLayout = document.querySelector(".ChildRegistrationLayout--display");
            ChildRegistrationLayout.classList.toggle("active");
        },

        async remove() {
            let user_ID = this.$store.getters.getUserID;
            const response = await UserRegistrationService.delete(user_ID)

            console.log(response);
            if (response.id) {
                this.$router.push({ name: 'home' });
            } else {
                alert(response.message);
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
 }
 
 .user-profile * {
     -webkit-box-sizing: border-box;
     box-sizing: border-box;
     -webkit-transition: all 0.25s ease;
     transition: all 0.25s ease;
 }
 
 .user-profile figcaption {
     width: 100%;
     background-color: $blue-light-bg;
     padding: 25px;
     position: relative;
 }
 
 .user-profile figcaption h2 {
     font-size: 2rem;
     margin: 1rem;
     text-align: center;
 }
 
 .profuser-profile figcaption:before {
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
 
 .user-profile figcaption a {
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
 
 .user-profile figcaption a:hover {
     opacity: 1;
 }
 
 .user-profile .profile {
     border-radius: 50%;
     bottom: 100%;
     max-width: 90px;
     opacity: 1;
     box-shadow: 0 0 15px $black;
     margin: 1rem;
     width: 12%;
 }
 
 .user-profile .follow {
     margin-right: 4%;
     border-color: $green;
     color: $grey;
 }
 
 .user-profile h2 {
     margin: 0 0 5px;
     font-weight: 300;
 }
 
 .user-profile h2 span {
     display: block;
     font-size: 0.5em;
     color: $grey;
 }
 
 .profuser-profile p {
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
         cursor: pointer
     }
 
     .update {
         border: 1px solid $purple;
         background-color: $purple ;
     }
 
     .delete {
         border: 1px solid $red;
         background-color: $red ;
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
 
 .active {
     display: none;
 }
 </style>
