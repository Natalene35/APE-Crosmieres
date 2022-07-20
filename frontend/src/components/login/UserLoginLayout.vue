<template>
    <section class="wrapper">
        <div class="container">
            <div class="img--container">
                <img alt="" class="img" v-bind:src="picture">
            </div>
            <div v-on:keyup.enter="login" class="content">
                <h1 class="title">Connexion</h1>
                <div class="field">
                    <label class="field__label">Nom utilisateur</label>
                    <input v-model="userName" class="inputbox" type="text" placeholder="Votre pseudo ou e-mail">
                </div>
                <div class="field field--error">
                    <label class="field__label">Mot de passe</label>
                    <input v-model="password" class="inputbox" type="password" placeholder="Votre mot de passe">
                </div>
                <p class="succesregistration" v-for="succesMsg in succesLogin" v-bind:key="succesMsg">{{
                        succesMsg
                }}</p>
                <p class="error" v-for="error in errors" v-bind:key="error">{{ error }}</p>
                <button v-on:click="login" class="subscribe">Connexion</button>
            </div>
        </div>
    </section>
</template>

<script>
import illustrationPicture from '@/assets/images/tilleul.jpg'
import UserLoginService from '@/services/login/UserLoginService'
export default {
    // Nom de notre composant 
    name: 'UserLoginLayout',

    data() {
        return {
            //Picture for the form 
            picture: illustrationPicture,
            //Information of the form 
            userName: null,
            password: null,

            errors: [],
            succesLogin: []
        }
    },

    methods: {
        async login() {
            // Reset error table
            this.errors = [];
            // Form Content Validation
            if (!this.userName) {
                this.errors.push("il me faut votre pseudo");
            }
            if (!this.password) {
                this.errors.push("Oups il manque le mot de passe");
            }
            // Send connection request
            if (this.errors.length === 0) {
                const response = await UserLoginService.login({
                    username: this.userName,
                    password: this.password,
                })

                console.log(response.data.id);
                this.$store.commit('setUserID', response.data.id);

                if (response.success === true) {
                    console.log(response);
                    // We store your token in session in the store
                    this.$store.commit('setToken', response.data.token);
                    this.$store.commit('setUsername', response.data.nicename);

                    // Recovering the role after having the token with another request
                    const roles = await UserLoginService.getRoles(response.data.id);
                    this.$store.commit('setRole', roles.roles[0]);
                    // A success message is displayed
                    this.succesLogin.push("Connexion réussi");
                    // redirect after showing success message
                    setTimeout(() => this.$router.push({ name: 'home' }), 500);
                } else {
                    this.errors.push("Mauvais nom ou mot de passe");
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.wrapper {
    color: #000;
    font-family: 'Muli', sans-serif;
    font-size: 1rem;
    display: -ms-grid;
    display: grid;
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
        box-shadow: 0px 17px 34px -20px $blue-bg-header;


        .title {
            font-size: 1.6rem;
            font-weight: 700;
        }

        .img {
            width: 100%;
            height: auto;
            border-radius: 1em 1em 0 0;

            object-fit: cover;
            transform: translateY(-26%);
        }

        .img--container {
            height: 200px;
            overflow: hidden;
            margin-bottom: 1.5em;
        }

        .title {
            margin-bottom: 0.9em;
        }


        .content {
            display: -ms-grid;
            display: grid;
            place-items: center;
            padding: 0 2em;
            margin-bottom: 1.8em;
        }

        .inputbox {
            padding: 0.5em 0 0.5em 1.5em;
            line-height: 3;
            width: 100%;
            border: 1px solid $blue-light-bg;
            border-radius: 0.5em;
            margin: 1rem 0 1rem 0;
            padding: 0;
            text-align: center;
        }

        ::placeholder {
            color: $red;
        }

        .subscribe {
            color: $white;
            font-size: 1.3rem;
            font-weight: 700;
            background-color: $red;
            padding: 0.9em 0;
            display: inline-block;
            border: none;
            border-radius: 0.5em;
            width: 100%;
            margin-bottom: 1.3em;
            cursor: pointer;
        }
    }
}
</style>