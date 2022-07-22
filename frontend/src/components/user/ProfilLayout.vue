<template>
    <section class="wrapper">
        <div class="container">
            <h2 class="title">Bienvenue {{ user.first_name }}</h2>
            <div class="field">
                <h2>{{ user.last_name }}</h2>
                <h2></h2>
                <h2></h2>
                <h2></h2>
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
            user: []
        }
    },

    async mounted() {
        let user_ID = this.$store.getters.getUserID;
        console.log(this.$store.getters.getUserID)
        this.user = await UserLoginService.find(user_ID);
        console.log(this.user);
    },
}

</script>

 <style scoped lang="scss">
 .wrapper {
     color: #313846;
     font-family: "Muli", sans-serif;
     font-size: 1rem;
     display: flex;
     place-items: end;
     border-radius: 1em;
     justify-content: flex-end;
     flex-direction: row;
 
     .container {
         width: 100%;
         overflow: hidden;
         padding: 0;
         margin-top: 1rem;
         margin-bottom: 1rem;
         border-radius: 1em;
         place-items: center;
     }
 
     .title {
         font-size: 1.6rem;
         font-weight: 700;
         margin-bottom: 0.9em;
     }
 
     .content {
         place-items: center;
         padding: 0 2em;
     }
 
     .inputbox {
         padding: 0.5em 0 0.5em 1.5em;
         line-height: 3;
         width: 100%;
         border: 1px solid $blue-light-bg;
         border-radius: 0.5em;
         margin: 0.3rem 0 1rem 0;
         padding: 0;
         text-align: center;
     }
 
     ::placeholder {
         color: $red;
     }
 
     .subscribe {
         color: #fff;
         font-size: 1.3rem;
         font-weight: 700;
         background-color: #f55951;
         padding: 0.9em 0;
         display: inline-block;
         border: none;
         border-radius: 0.5em;
         width: 100%;
         margin-bottom: 1.3em;
         cursor: pointer;
     }
 
     .child--class {
         margin-top: 1rem;
         margin-bottom: 1rem;
     }
 
     .child__listing {
         width: 100%;
         display: flex;
     }
 
     .child--info {
         width: 40%;
         border: 1px solid $black
     }
 
 
 
     @media (max-width: 425px) {
         .container {
             background-color: transparent;
             box-shadow: none;
             border-radius: none;
 
             .img--container {
                 border-radius: none;
             }
         }
     }
 }
 </style>
