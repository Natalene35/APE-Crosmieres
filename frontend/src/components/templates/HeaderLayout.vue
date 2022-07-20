<template>
    <div>
        <header>
            <div class="header--title">

                <img class="header--title__logo" v-bind:src="logoApe" alt="">

                <h1><span>A</span>ssociation des <span>P</span>arents d'<span>E</span>leves <div class="header--town">de
                        Crosmières</div>
                </h1>

                <div class="header--profil__picture">
                    <div class="header--nav__Inscription" style="margin-right: 4px;">Inscription /</div>
                    <router-link v-if="!this.$store.getters.getToken" v-bind:to="{ name: 'login' }"
                        class="header--login">Connexion
                    </router-link>
                    <a class="header--disconnect" href="" v-if="this.$store.getters.getToken"
                        v-on:click="disconnect">Deconnection</a>
                </div>
                <!-- /*<--------------------Button menu BURGER HIDDEN IN DESKTOP---------------------------->
                <div class="header--burger__container">

                    <div id="menu_button">
                        <input type="checkbox" id="menu_checkbox" v-on:click="showMenu">
                        <label for="menu_checkbox" id="menu_label">
                            <div id="menu_text_bar"></div>

                        </label>
                    </div>
                </div>
                <!--       END BURGER         -->
            </div>

            <nav>
                <div class="header--nav__Accueil">
                    <router-link v-bind:to="{ name: 'home' }" class="header--accueil">Accueil</router-link>
                </div>
                <div class="header--nav__Vente">Vente</div>
                <div class="header--nav__Evenement">Evenement</div>
                <div class="header--nav__Presentation">Présentation APE</div>

            </nav>
        </header>
        <!-- /*<--------------------MENU BURGER HIDDEN IN DESKTOP---------------------------->
        <div class="header--burger__menu">
            <ul>
                <li class="header--nav__Accueil">
                    <router-link v-bind:to="{ name: 'home' }" class="header--accueil">Accueil
                    </router-link>
                </li>
                <li class="header--nav__Vente">Vente</li>
                <li class="header--nav__Evenement">Evenement</li>
                <li class="header--nav__Presentation">Présentation APE</li>
                <li class="header--nav__Inscription">Inscription</li>
                <li class="header--nav__Connexion">
                    <router-link v-if="!this.$store.getters.getToken" v-bind:to="{ name: 'login' }"
                        class="header--login">Connexion
                    </router-link> <a class="header--disconnect" href="" v-if="this.$store.getters.getToken"
                        v-on:click="disconnect">Deconnection</a>
                </li>
            </ul>
            <div v-bind:class="'burger--menu__picture'">
                <img v-bind:src="profilPic">
            </div>
        </div>
    </div>

</template>

<script>
import profil from '@/assets/images/profil.svg'
import logoAPE from '@/assets/images/logoAPE.jpeg'
export default {
    name: 'HeaderLayout',
    data() {
        return {
            profilPic: profil,
            logoApe: logoAPE
        }
    },
    methods: {
        showMenu() {
            let headerMenu = document.querySelector(".header--burger__menu")
            let body = document.querySelector("body")
            body.classList.toggle("overflow--hidden")
            headerMenu.classList.toggle("active")
        },

        disconnect() {
            // On supprime dans le store les infos liéés à l'utilisateur 
            this.$store.commit('deleteToken');
            this.$store.commit('deleteUsername');
            this.$store.commit('deleteUserID');
            this.$store.commit('deleteRole');
            // On redirige l'utilisateur
            this.$router.push({ name: 'login' });
        }
    },

}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap');
@import "../../assets/animations/burgerAnim.scss";

header {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    padding-bottom: 2rem;


    //<--------------BANNER------------>
    .header--title {
        background-color: #46BFC7;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
        border-radius: 10px;
        text-shadow: 1px 1px 1px black;
        padding: 1rem;


        .header--title__logo {
            border-radius: 50%;
            position: absolute;
            left: 13px;
            top: 2px;
            z-index: 1;
            border: 3px solid black;
            box-shadow: -1px 1px 3px 0px black;
        }

        .header--profil__picture {

            display: flex;
            padding: 1%;
            align-items: flex-end;
            width: 20%;
            flex-wrap: wrap;

        }

        .header--profil__picture div:hover {
            color: #0087ca;
        }

        h1 {
            width: 100%;
            font-size: 3rem;
            color: white;
            font-family: 'Merienda', cursive;

            span {
                color: #FBAD18;
            }

            .header--town {
                font-size: 2rem;
            }
        }

        .header--login {
            color: $white;
        }

        .header--disconnect {
            color: $red;
        }

    }

    //<-----------NAV----------->
    nav {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 2rem;
        margin-top: 0.5rem;


        .header--nav__Accueil {
            background-color: #85B689;
            margin-right: 0.3rem;
        }

        .header--nav__Vente {
            background-color: #FBAD18;
            margin-right: 0.3rem;

        }

        .header--nav__Evenement {
            background-color: #EF6852;
            margin-right: 0.3rem;

        }

        .header--nav__Presentation {
            background-color: #F8AAA4;

        }

        div {
            width: 25%;
            display: inline-block;
            position: relative;
            font-size: large;
            border-radius: 7px;
            text-shadow: 1px 1px 1px black;
            padding: 3px;

        }

        //WE USE THE underlineAnim.scss for animate nav  
        @import "../../assets/animations/underlineAnim.scss";
    }
}

//<----------------------MENU BURGER ---------------->
.header--burger__menu {
    display: none;
    height: 1000vh;

    ul {
        padding-top: 2%;
        display: flex;
        flex-direction: column;
        list-style-type: none;
        color: $white;

        .header--nav__Accueil {
            background-color: #85B689;

            .header--accueil {
                color: $white;
            }
        }

        .header--nav__Vente {
            background-color: #FBAD18;
            color: $white;
        }

        .header--nav__Evenement {
            background-color: #EF6852;
            color: $white;
        }

        .header--nav__Presentation {
            background-color: #8FCED7;
            color: $white;
        }

        .header--nav__Inscription {
            background-color: #F8AAA4;
            color: $white;
        }

        .header--nav__Connexion {
            background-color: #946973;

            .header--login {
                color: $white;
            }

            .header--disconnect {
                color: $white;
            }
        }

        li {
            font-size: x-large;
            height: 100%;
            padding: 6%;
            font-weight: bold;
            margin-top: 0.5rem;
            color: white;
            border-radius: 22px;
            box-shadow: 1px 1px 1px;
        }
    }

    .burger--menu__picture {
        height: 100vh;
    }

    img {
        margin: 11%;
        height: 80px;
        width: 80px;
        border: 1px solid black;
        border-radius: 50%;
        padding: 4%;
        box-shadow: -0.5em 0.5em black;
    }
}


//<----------Media queries-------->
@media (max-width: 1311px) {
    header .header--title .header--title__logo {
        position: unset;
        float: left;
        border-radius: 50%;
        left: 0;
        z-index: 1;

    }
}

@media (max-width: 800px) {
    .header--title__logo {
        height: 12vh;
    }
}

@media (max-width: 425px) {
    header {

        .header--title {
            padding: 4%;

            h1 {
                font-size: 1.4rem;
                text-align: start;
                width: 60%;
            }

            .header--profil__picture {
                display: none;
            }

            .header--burger__container {
                display: unset;
                height: 100%;
                display: contents;
            }
        }

        nav {
            div {
                display: none;
            }
        }

    }

    .active {
        display: contents;

        .header--profil__picture {
            width: 20px;
            height: 20px;
        }
    }

}
</style>
