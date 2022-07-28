<template>
    <section class="wrapper">
        <div class="container">
            <div class="card">
                <div class="avatar">
                    <img src="@/assets/images/icons8-profile-60.png" alt="avatar de l'utilisateur" />
                </div>
                <hr />
                <div class="stats">
                    <h2>{{ user.first_name }} {{ user.last_name }}</h2>
                    <div>
                        <p>{{ user.first_name }}</p>
                        <p>{{ user.last_name }}</p>
                        <p>{{ user.email }}</p>
                        <p>{{ phone }}</p>
                    </div>
                    <hr />
                    <h2>Mes enfants</h2>
                    <div>
                        <p v-for="child in childs" v-bind:key="child.id">{{ child.child_firstname + ' ' +
                                child.child_lastname + ' / ' + child.child_class
                        }}</p>
                    </div>
                    <hr />
                </div>
            </div>

            <div class="button--link">
                <p class="push--error" v-for="error in errors" v-bind:key="error">{{ error }}</p>

                <a v-on:click="showChildRegistrationLayout" class="addChild">Ajouter mes enfants</a>
                <ChildRegistrationLayout @reloadChilds="reloadChilds" class="ChildRegistrationLayout--display active" />

                <a v-on:click="showUserUpdateInformationLayout" class="update">Mise à jour de vos données</a>
                <div class="UserUpdateInformationLayout--display active">
                    <div class="user--update">
                        <label class="field__label">Prénom</label>
                        <input v-model="user.first_name" type="text" class="inputbox" placeholder="Votre prénom"
                            name="firstname">

                        <label class="field__label">Nom</label>
                        <input v-model="user.last_name" type="text" class="inputbox" placeholder="Votre nom"
                            name="lastname">

                        <label class="field__label">E-mail</label>
                        <input v-model="user.email" type="email" class="inputbox" placeholder="Votre e-mail"
                            name="mail">

                        <label class="field__label">Numéro de téléphone</label>
                        <input v-model="phone" type="text" class="inputbox" placeholder="Votre numéro de contact"
                            name="phone">

                        <p class="succesUpdate" v-for="succesMsg in succesUpdate" v-bind:key="succesMsg">
                            {{ succesMsg }}
                        </p>

                        <a v-on:click="updateUser" class="updateConfirm">Enregistrer vos modifications</a>
                    </div>
                </div>
                <a v-on:click="deleteConfirm" class="delete">Supprimer votre compte ?</a>
                <a v-on:click="removeUser" class="deleteConfirm active">Suppression du compte</a>
            </div>
        </div>
    </section>
</template>

<script>
import ChildRegistrationLayout from '@/components/registration/ChildRegistrationLayout.vue'
import UserLoginService from '@/services/login/UserLoginService';
import UserService from '@/services/user/UserService'
import ChildRegistrationService from '@/services/registration/ChildRegistrationService';

export default {
    name: 'UserProfil',
    emits: ["reloadChilds"],
    components: {
        ChildRegistrationLayout,
    },

    data() {
        return {
            user: [],
            errors: [],
            succesUpdate: [],
            childs: [],
            phone: null,
        }
    },

    async mounted() {
        // The user ID for the axios request 
        let user_ID = this.$store.getters.getUserID;

        if (user_ID) {
            //retrieve logged-in user data information
            this.user = await UserLoginService.find(user_ID);
            //retrieve logged-in user child
            this.childs = await ChildRegistrationService.findChild(user_ID);
            //retrieve logged in user meta data
            let arrayMeta = await UserLoginService.getMeta(user_ID)
            for (let index = 0; index < arrayMeta.length; index++) {
                const metaElmt = arrayMeta[index];
                //For take meta_key enter key in the exemple its "phone"
                if (metaElmt.meta_key == "phone") {
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

        //When user click on button add form for modification information
        showUserUpdateInformationLayout() {
            let UserUpdateInformationLayout = document.querySelector(".UserUpdateInformationLayout--display");
            UserUpdateInformationLayout.classList.toggle("active");
        },

        deleteConfirm() {
            let deleteConfirm = document.querySelector(".deleteConfirm");
            deleteConfirm.classList.toggle("active");
        },

        //Delete ours personnal account 
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

        // Update ours personnal account 
        async updateUser() {
            if (this.$store.getters.getUserID) {
                const response = await UserService.update(this.$store.getters.getUserID, {
                    "email": this.user.email,
                    "first_name": this.user.first_name,
                    "last_name": this.user.last_name,
                    "phone": this.user.phone
                });
                if (response.id) {
                    this.succesUpdate.push('Mise à jour réussie');
                    setTimeout(() => { this.succesUpdate = []; }, 500);
                } else {
                    this.errors.push("Echec suppression");
                    setTimeout(() => { this.errors = []; }, 500);
                }
            }
        },

        //When the components Child registration is execute reload the childs array 
        async reloadChilds() {
            this.childs = await ChildRegistrationService.findChild(this.$store.getters.getUserID);
        }
    }
}
</script>

 <style scoped lang="scss">
 .wrapper {
     color: $grey;
     font-family: 'Muli', sans-serif;
     font-size: 1rem;
     place-items: center;
     border-radius: 1em;
 
 
     .container {
         max-width: 400px;
         overflow: hidden;
         padding: 0;
         background-color: $white;
         margin-top: 1rem;
         margin-bottom: 1rem;
         border-radius: 1em;
         display: -ms-grid;
         display: grid;
         place-items: center;
         justify-content: center;
         box-shadow: 0px 17px 34px -20px $blue-bg-header;
 
         h2 {
             font-size: 1.5rem;
             margin: 1rem;
             text-align: center;
         }
 
         a {
             padding: 1rem;
             color: $black;
             font-size: 0.7em;
             margin: 0.5rem;
             width: 90%;
             text-align: center;
             text-decoration: none;
             font-weight: 600;
             letter-spacing: 1px;
         }
     }
 
     p {
         margin: 0 0 10px;
         font-size: 1rem;
         letter-spacing: 1px;
         opacity: 0.8;
     }
 
     .button--link {
         display: flex;
         flex-direction: column;
         align-items: center;
         padding-bottom: 2rem;
 
 
         .addChild {
             border: 1px solid $pink;
             background-color: $pink;
             border-radius: 10px;
             cursor: pointer
         }
 
         .update {
             border: 1px solid $orange;
             background-color: $orange;
             border-radius: 10px;
             cursor: pointer
         }
 
         .delete {
             border: 1px solid $red;
             background-color: $red;
             border-radius: 10px;
             cursor: pointer
         }
 
         .deleteConfirm {
             border: 1px solid $red;
             background-color: $red;
             border-radius: 10px;
             cursor: pointer
         }
 
 
         .updateConfirm {
             color: $white;
             font-size: 1.3rem;
             font-weight: 700;
             background-color: $green;
             display: inline-block;
             border: none;
             border-radius: 10px;
             width: 60%;
             padding: 0.5rem;
             margin: 1rem;
             cursor: pointer;
         }
 
         .succesUpdate {
             color: $green;
             text-transform: uppercase;
             font-size: 1rem;
             margin-bottom: 1rem;
         }
 
         .push--error {
             color: $red;
             text-transform: uppercase;
             font-size: 1rem;
             margin-bottom: 1rem;
         }
     }
 
     .inputbox {
         padding: 0.5em 0 0.5em 1.5em;
         font-size: 1rem;
         line-height: 3;
         width: 80%;
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
 
 .user--update {
     display: flex;
     flex-direction: column;
     align-items: center;
 }
 
 @media (min-width: 800px) {
     .wrapper {
         width: 55vh;
     }
 }
 </style>
