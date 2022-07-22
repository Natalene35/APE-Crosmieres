<template>
    <section class="wrapper">
        <div class="container">
            <div class="content">
                <h1 class="title">Ajouter vos enfants</h1>
                <label class="field__label">Prénom</label>
                <input v-model="child_firstname" type="text" class="inputbox" placeholder="Prénom de votre enfant"
                    name="firstname">
                <label class="field__label">Nom</label>
                <input v-model="child_lastname" type="text" class="inputbox" placeholder="Classe de votre enfant"
                    name="lastname">
                <label class="field__label">Date de naissance</label>
                <input v-model="child_birthday" type="date" id="birthday" name="birthday">



                <div class="child--class">
                    <input type="radio" id="CP" value="CP" v-model="picked" />
                    <label for="CP">CP</label>
                    <input type="radio" id="CM1" value="CM1" v-model="picked" />
                    <label for="CM1">CM1</label>
                    <input type="radio" id="CM2" value="CM2" v-model="picked" />
                    <label for="CM2">CM2</label>
                    <input type="radio" id="CE1" value="CE1" v-model="picked" />
                    <label for="CE1">CE1</label>
                    <input type="radio" id="CE2" value="CE2" v-model="picked" />
                    <label for="CE2">CE2</label>
                </div>

                <button v-on:click="add_child" class="subscribe">Ajouter un enfant ?</button>
            </div>
        </div>
    </section>
</template>

<script>
import ChildRegistrationService from '@/services/registration/ChildRegistrationService.js'

export default {
    data() {
        return {
            child_firstname: null,
            child_lastname: null,
            child_birthday: null,
            picked: null
        };
    },

    methods: {
        async add_child() {
            this.errors = [];
            // Validation of the form data
            if (!this.child_firstname) {
                this.errors.push("Il faut votre prénom");
            }
            if (!this.child_lastname) {
                this.errors.push("Il faut le nom de Famille d'usage");
            }
            if (!this.child_birthday) {
                this.errors.push("Il faut la date de naissance");
            }
            if (!this.picked) {
                this.errors.push("If faut la classe de l'enfant");
            }

            // Verification d'absence d'erreurs et transmision des données 
            if (this.errors.length === 0) {
                const response = await ChildRegistrationService.registerChild({
                    "pseudo": this.child_firstname,
                    "email": this.child_lastname,
                    "password": this.child_birthday,
                    "firstname": this.picked,

                });
                if (response.code === 200) {
                    console.log(response);

                    // Reset the input in the form
                    this.child_firstname = null,
                        this.child_lastname = null,
                        this.child_birthday = null,
                        this.picked = null

                }
                else if (response.code === 406) {
                    this.errors.push('Cette e-mail de compte existe déja');
                } else {
                    this.errors.push("Oups une erreur, veuilliez recommencer");
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