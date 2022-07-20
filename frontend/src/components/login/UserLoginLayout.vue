<template>
    <section class="wrapper">
        <div class="container">
            <div class="img__container">
                <img src="https://images.unsplash.com/photo-1546793665-c74683f339c1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                    alt="salad" class="img">
            </div>
            <div v-on:keyup.enter="login" class="content">
                <h1 class="title">Connexion</h1>
                <div class="field">
                    <label class="field__label">Nom utilisateur</label>
                    <input v-model="userName" class="inputbox" type="text" placeholder="Votre pseudo ou e-mail">
                </div>
                <div class="field field--error">
                    <label class="field__label">Mot de passe</label>
                    <input v-model="password" class="inputbox" type="password" placeholder="votre mot de passe">
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

export default {
    // Nom de notre composant 
    name: 'LoginLayout',

    data() {
        return {
            userName: null,
            password: null,
            errors: [],
            succesLogin: []
        }
    },
}
</script>

<style scoped>
.wrapper {
    color: #000;
    font-family: 'Muli', sans-serif;
    font-size: 1rem;
    background-color: #F1E8E6;
    display: -ms-grid;
    display: grid;
    place-items: center;
    border-radius: 1em;
}

.container {
    max-width: 400px;
    overflow: hidden;
    padding: 0;
    background-color: #fff;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-radius: 1em;
    display: -ms-grid;
    display: grid;
    place-items: center;
    box-shadow: 0px 17px 34px -20px #f55951;
}

.title {
    font-size: 1.6rem;
    font-weight: 700;
}

.img {
    width: 100%;
    height: auto;
    border-radius: 1em 1em 0 0;

    object-fit: cover;
    transform: translateY(-50%);
}

.img__container {
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
    border: 1px solid #d9d9d9;
    border-radius: 0.5em;
    margin-bottom: 1em;
}

::placeholder {
    color: #f00c0c;
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
</style>