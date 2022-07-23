<template>
    <h1 class="profil--title">Bienvenue {{ user.first_name }}</h1>
    <section class="wrapper--profil">
        <div class="profil--info">
            <div class="field">
                <div class="field--type">Votre nom <span>{{ user.last_name }}</span></div>
                <div class="field--type"> Votre idenifiant <span>{{ user.username }}</span></div>
                <div class="field--type">Votre email <span>{{ user.email }}</span></div>
                <div class="field--type">Votre téléphone <span>{{ metaUser[14] }}</span></div>
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
</template>

<script>
import ChildRegistrationLayout from '@/components/registration/ChildRegistrationLayout.vue'
import UserLoginService from '@/services/login/UserLoginService';

export default {
    name: 'UserProfil',

    components: {
        ChildRegistrationLayout,
    },

    data() {
        return {
            user: [],
            metaUser: []
        }
    },

    async mounted() {
        let user_ID = this.$store.getters.getUserID;
        this.user = await UserLoginService.find(user_ID);
        this.metaUser = await UserLoginService.getMeta(user_ID);
        console.log(this.user);
        console.log(this.metaUser);
    },
}

</script>

 <style scoped lang="scss">
 .profil--title {
     color: black;
     font-size: xx-large;
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
 
     .profil--picture {
         position: absolute;
         width: 50%;
 
         img {
             width: 255px;
         }
     }
 
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
         }
     }
 }
 </style>
