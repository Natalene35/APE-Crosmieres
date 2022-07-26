<template>
    <div class="container">
        <div>
            <h1 class="profil--title">Bienvenue {{ user.first_name }}</h1>
            <button v-on:click="remove" class="delete_button ">Supprimer votre compte ?</button>
        </div>
        <section class="wrapper--profil">
            <div class="profil--info">
                <div class="field">
                    <div class="field--type">Votre nom <span>{{ user.last_name }}</span></div>
                    <div class="field--type"> Votre idenifiant <span>{{ user.username }}</span></div>
                    <div class="field--type">Votre email <span>{{ user.email }}</span></div>
                    <div class="field--type">Votre téléphone <span>{{ phone }}</span></div>
                </div>
            </div>
            <div class="profil--info">
                <div class="field">
                    <h2>Vos enfants</h2>
                    <div class="field--type">Pierre<span> Pierre</span></div>
                    <div class="field--type">Pierre<span> Paul</span></div>
                    <div class="field--type">Pierre<span> Jaques</span></div>
                    <div class="field--type"><span></span></div>
                </div>
            </div>
        </section>
        <ChildRegistrationLayout />
    </div>
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
            metaUser: [],
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
 main {
     flex-direction: column;
 }
 
 .profil--title {
     color: black;
     font-size: xx-large;
     margin-bottom: 1rem;
 }
 
 .wrapper--profil {
     color: #313846;
     font-family: "Muli", sans-serif;
     font-size: 1rem;
     display: flex;
     place-items: end;
     justify-content: space-around;
     flex-direction: row;
     align-items: center;
     width: 100%;
     border-bottom: #313846 2px solid;
 
     .profil--info {
         display: flex;
         width: 40%;
         flex-direction: column;
         align-items: center;
 
         .field--type {
             padding: 0.5rem;
             text-align: start;
 
             span {
                 color: $red;
                 text-transform: uppercase;
             }
         }
     }
 
     .profil--child {
         display: flex;
         width: 40%;
         flex-direction: column;
         align-items: flex-start;
 
         .field--type {
             padding: 0.5rem;
             text-align: start;
         }
     }
 }
 
 .delete_button {
     color: #fff;
     font-size: 1.3rem;
     font-weight: 700;
     border: none;
     border-radius: 0.5em;
     width: 60%;
     background-color: #EF6852;
     cursor: pointer;
 }
 
 @media (max-width: 425px) {
     .container {
         background-color: transparent;
         box-shadow: none;
         border-radius: none;
 
         .content {
             display: flex;
             flex-direction: column;
         }
     }
 
     .wrapper--profil {
         flex-direction: column;
         align-items: start;
 
 
         .profil--info {
             flex-direction: column;
             align-items: start;
             width: 100%;
         }
     }
 }
 </style>
