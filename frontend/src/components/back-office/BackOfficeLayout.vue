<template>
    <section class="back-office--container__all">
        <section class="back-office--sales__all">
            <h2>Bienvenue {{this.userName}} sur votre espace d'administration</h2>
            <!-- //MENU NAV -->
            <div class="back-office--menu__nav">

                <div class="updateSale" v-on:click="showMenu" >Modifier une ventes</div>
                <div class="createSale" v-on:click="showMenu">Créer une vente</div>
                <div class="updateEvent" v-on:click="showMenu">Modifier un evenements</div>
                <div class="createSale" v-on:click="showMenu">Créer un evenement</div>
                
            </div>
            <page-404-layout v-if="this.menu==1||this.menu==3"/>
            <SaleCreateLayout v-if="this.menu==2"/>
            <EventCreateLayout v-if="this.menu==4" />
        </section>
    </section>
</template>

<script>
import Page404Layout from '../errors/Page404Layout.vue';
import EventCreateLayout from '../events/EventCreateLayout.vue'
import SaleCreateLayout from '../sales/SaleCreateLayout.vue';
export default {
    name: "BackOfficeLayout",
    data() {
        return {
            userName: sessionStorage.getItem("username"),
            menu: null,
        };
    },
    methods:{
        showMenu(e){
            if(e.currentTarget.classList=="updateSale"){
                this.menu=1
            }
            if(e.currentTarget.classList=="createSale"){
                this.menu=2
            }
            if(e.currentTarget.classList=="updateEvent"){
                this.menu=3
            }
            if(e.currentTarget.classList=="createEvent"){
                this.menu=4
            }
        }
    },
    components: { EventCreateLayout, SaleCreateLayout, Page404Layout }
}
</script>

<style lang="scss" scoped>
.back-office--container__all{
     width: 100%;
    .back-office--sales__all{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        h2{
            margin-bottom: 3%;
            margin-left: 3%;
            color: black;
        }
        .back-office--menu__nav{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            height: 5%;
            margin-bottom: 1%;
            margin-top: -2%;
            justify-content: center;            
            div:hover{
               filter: brightness(1.4);
            }
            div{
            margin-top:10% ;
            width: 22%;
            margin: 1%;
            padding: 0.2%;
            border: 1px solid white;
            cursor: pointer;
            background-color: #46BFC7;
            text-shadow: 1px 1px 1px black;
            border-radius: 10px;
            color: white;
            }
        } 
    }
}
@media (max-width: 555px) {
    .back-office--container__all{
    .back-office--sales__all{
        .back-office--menu__nav{       
            a{
                width: 46%;
                }
            } 
        }
    }
        
}

</style>