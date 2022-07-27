<template>
    <section class="back-office--container__all">
        <section class="back-office--sales__all">

            <div class="back-office--menu__nav">

                <h2 v-if="this.menuActive=='listSale'" class="navActive" v-on:click="toggleMenu('sale')" >Liste des ventes</h2>
                <h2 v-if="this.menuActive!='listSale'" v-on:click="toggleMenu('sale')" >Liste des ventes</h2>

                <h2 v-if="this.menuActive=='crudSale'" class="navActive" v-on:click="toggleMenu('saleCrud')" >Créer une vente</h2>
                <h2 v-if="this.menuActive!='crudSale'"  v-on:click="toggleMenu('saleCrud')" >Créer une vente</h2>

                <h2 v-if="this.menuActive=='listEvent'" class="navActive" v-on:click="toggleMenu('event')" >Liste des evenements</h2>
                <h2 v-if="this.menuActive!='listEvent'"  v-on:click="toggleMenu('event')" >Liste des evenements</h2>

                <h2 v-if="this.menuActive=='crudEvent'" class="navActive" v-on:click="toggleMenu('eventCrud')" >Créer un evenement</h2>
                <h2 v-if="this.menuActive!='crudEvent'" v-on:click="toggleMenu('eventCrud')" >Créer un evenement</h2>
            </div>

            <div class="back-office--menu_content">
                <h2>{{this.menuContent}}</h2>
            </div>
            <section class="back-office--container__sales">
                <!-- <-----------------------SALES--------------------------->
                                
                <div class="back-office--container__salesTask">
                    <!-- LIST SALES ACTIVES -->
                    <div v-if="this.menuActive=='listSale'">
                        <div  v-bind:class="sale.id + ' back-office--sale'" v-for="sale in allSales"  v-on:click="toggleContent"  v-bind:key="sale" >
                            <div v-on:click="toggleSelectTask" class="back-office--sale__title">
                            <div>{{sale.title.rendered}}</div>
                            <button v-on:click="deleteSale(sale.id)">X</button>
                            </div>
                        </div> 
                    </div>
                      <!-- LIST EVENTS ACTIVES -->
                    <div v-if="this.menuActive=='listEvent'">
                        <div  v-bind:class="event.id + ' back-office--sale'" v-for="event in allEvent"  v-on:click="toggleContent"  v-bind:key="event" >
                            <div v-on:click="toggleSelectTask" class="back-office--sale__title">
                            <div>{{event.title.rendered}}</div>
                            <button v-on:click="deleteEvent(event.id)">X</button>
                            </div>
                        </div> 
                    </div>  
                    <!-- CRUD SALES OFFICE -->
                    <div v-if="this.menuActive=='crudSale'" class="back-office--container__crud">
                        <SaleCreateLayout @enlargeText="onEnlargeText" />
                    </div>
                    <!-- CRUD EVENTS OFFICE -->
                    
                        <!-- //COMPOSANT CREATE EVENT -->
                    <div v-if="this.menuActive=='crudEvent'" class="back-office--container__crud">
                         
                         <EventCreateLayout @reloadEv="reloadEvent" />
                    </div>
                </div>
                 
                
                <!-- CONTENTS HIDDEN IN FIRST -->
                <div class="back-office--sale--contents__all">

                    <div v-bind:class="sale.id + ' back-office--sale--container__contents'" v-for="sale in allSales" v-on:click="toggleContent, toggleSelectTask"  v-bind:key="sale" >
                        <div v-if="this.active==sale.id" class="back-office--content">
                            <SaleCreateLayout @enlargeText="onEnlargeText" v-bind:active="this.active"/>
                        </div>
                    </div>
                    <div v-bind:class="event.id + ' back-office--sale--container__contents'" v-for="event in allEvent" v-on:click="toggleContent, toggleSelectTask"  v-bind:key="event" >
                        <div v-if="this.active==event.id" class="back-office--content">
                            <!-- //COMPOSANT CREATE EVENT -->
                            <EventCreateLayout @reloadEv="reloadEvent" v-bind:active="this.active" />
                        </div>
                    </div>
                </div>               
                    
            </section>
        </section>
    </section>
</template>

<script>
import SaleService from "@/services/sales/SaleService";
import EventService from '@/services/events/EventService.js'
import EventCreateLayout from './EventCreateLayout.vue'
import SaleCreateLayout from './SaleCreateLayout.vue'
export default {
    
    name: "BackOfficeLayout",
    data() {
        return {
            allSales: null,
            allEvent: null,
            active: null,
            menuActive: null,
            menuContent: null,
            selectPost: null,
            selectPostMeta: null,
            //FIELD FORM CRUD //
            title: null,
            content: null,
            place: null,
            date: null,
            link: null,
            image: null,
        };
    },
    async mounted() {
        const allButton=document.querySelectorAll(".button")
        for (const button of allButton) {
            button.addEventListener("click", this.onEnlargeText)
        }
        console.log("coucou tout les button "+allButton)
        this.allSales = await SaleService.findAll();
        this.allEvent = await EventService.findAll();
    },
    methods: {
        //METHOD FOR TOGGLE CLASSE & Animation
        //ACTIVE V-IF 
       async onEnlargeText() {
      console.log("enlarging text");
      this.allSales = await SaleService.findAll();
      this.menuActive = "listSale";

    },
       async reloadEvent() {
      console.log("enlarging text");
      this.allEvent = await EventService.findAll();
      this.menuActive = "listSale";

    },
       reloadSale(){
            console.log("entree reloadSale")
            // this.allSales = await SaleService.findAll();
        },
        toggleMenu(e) {
            if (e == "sale") {
                if(this.menuActive!="listSale"){
                    this.menuActive = "listSale";
                }
                else{
                    this.menuActive=null;
                }                
            }
            if (e == "saleCrud") {
                this.menuActive = "crudSale";
            }
            if (e == "event") {
                this.menuActive = "listEvent";
            }
            if (e == "eventCrud") {
                this.menuActive = "crudEvent";
            }            
                this.menuContent = null;
                this.active=null;
        },
        //FOR SEE THE SELECT SALE TO THE RIGHT 
        async toggleContent(e) {
            const menuContentContainer=document.querySelector(".back-office--menu_content")
            this.active = e.currentTarget.classList[0];
            if (this.menuActive == "listSale") {
                this.selectPost = await SaleService.find(this.active);
                this.selectPostMeta= await SaleService.findMeta(this.active);
                for(const meta of this.selectPostMeta){
                    if(meta.meta_key=="date"){
                       this.date =  meta.meta_value
                    }
                    if(meta.meta_key=="lieu"){
                       this.place =  meta.meta_value
                    }
                    if(meta.meta_key=="lien"){
                       this.link =  meta.meta_value
                    }
                }
                this.menuContent = "Vente " + this.selectPost.title.rendered;
                menuContentContainer.classList.add("sale")
                menuContentContainer.classList.remove("event")
            }
            if (this.menuActive == "listEvent") {
                this.selectPost = await EventService.find(this.active);
                this.menuContent = "Evenement " + this.selectPost.title.rendered;
                
                this.selectPostMeta= await EventService.findMeta(this.active);
                menuContentContainer.classList.add("event")
                menuContentContainer.classList.remove("sale")
            }
            this.title = this.selectPost.title.rendered;
            this.content = this.selectPost.content.rendered;
        },
        //ACTIVE HOVER FOR THE SELECT SALE IN THE LIST
        toggleSelectTask(e) {
            console.log("ici le bug " + e);
            let active = document.querySelector(".active");
            if (active != null) {
                active.classList.remove("active");
            }
            e.currentTarget.classList.toggle("active");
        },
        //<------------------------------------SQL METHOD------------------------------------>
        //<---------------SALES------------------->
        // //CREATE SALE
        // async createSale() {
        //     const response = await SaleService.create({
        //         "title": this.title,
        //         "content": this.content,
        //         "lieu": this.place,
        //         "date": this.date,
        //         "lien": this.link
        //     });
        //     //UPDATE POST FOR TAKE IT PUBLISH
        //     const majPost = await SaleService.update({
        //         "status": "publish",
        //         "id": response
        //     });
        //     //RELOAD ALL SALES FOR SEE NEW SALE
        //     this.allSales = await SaleService.findAll();
        //     this.menuActive = "listSale";
        //     console.log(response + majPost);
        // },
        //DELETE SALE
        async deleteSale(e) {
            const response = await SaleService.delete({
                "id": e
            });
            console.log(response);
            //RELOAD ALL SALES FOR INSTANT MODIFICATION
            this.menuContent = null;
            this.allSales = await SaleService.findAll();
            
        },
        //UPDATE SALE
        async updateSale() {
            console.log("le probleme est "+this.date)
            const response = await SaleService.update({
                "title": this.title,
                "content": this.content,
                "id": this.active
            });
            const metaResponse = await SaleService.update({
                "lieu": this.place,
                "date": this.date,
                "lien": this.link,
                "id": this.active
            });
            //RELOAD ALL SALES FOR SEE NEW SALE
            this.allSales = await SaleService.findAll();
            console.log(response+metaResponse);
        },
        //<---------------EVENTS------------------->
        //CREATE EVENT
        async createEvent() {
            console.log("createEvent backoffice")
            const response = await EventService.create({
                "title": this.title,
                "content": this.content,
                "lieu": this.place,
                "date": this.date
            });
            console.log(response.id);
            //UPDATE POST FOR TAKE IT PUBLISH
            const majPost = await EventService.update({
                "status": "publish",
                "id": response.id
            });
            //RELOAD ALL SALES FOR SEE NEW SALE
            this.allEvent = await EventService.findAll();
            this.menuActive = "listEvent";
            console.log(response + majPost);
        },
        //DELETE EVENT
        async deleteEvent(e) {
            const response = await EventService.delete({
                "id": e
            });
            console.log(response);
            //RELOAD ALL SALES FOR INSTANT MODIFICATION
            this.menuContent = null;
            this.allEvent = await EventService.findAll();
        },
    },
    components: { EventCreateLayout, SaleCreateLayout }
}
</script>

<style lang="scss" scoped>
.wrapper{
    height: 100%;
    width: 100%;
    .container{
        width: 100%;
        background-color: white;
        border-radius: 1em;
        box-shadow: 0px 17px 34px -20px #46bfc7;
        display: flex;
        height: 100%;
        box-shadow: inset;
        .field{
            display: flex;            
            justify-content: center;
            margin: 0;
            padding: 0;
            flex-direction: column;
            align-items: center;
            height: 100%;
            width: 100%;
            .field_label{
                margin: 0;
                width: 20%;
              
            }
            .field_input{
                padding: 0;
                margin: 1%;
            }
            
        }
    }
}
.navActive{
    filter: brightness(1.4);
    border-top-left-radius: 25%;
    border-bottom-right-radius: 25%;
    border-top-right-radius: 0%;
    border-bottom-left-radius: 0%;
}
.back-office--container__all{
    display: flex;
    height: 100%;
    width: 100%;
    flex-wrap: wrap;
    position: relative;
    border-radius: 2%;
    
    
    .back-office--sales__all{
        display: flex;
        width: 99%;
        height: 100%;
        flex-wrap: wrap;
        align-content: flex-start;
        align-items: center;
        
        .back-office--menu__nav{
            width: 50%;
            display: flex;
            flex-wrap: wrap;
            height: 9%;
            margin-bottom: 1%;
            h2:hover{
               filter: brightness(1.4);
                border-top-left-radius: 25%;
                border-bottom-right-radius: 25%; 
                border-top-right-radius: 0%;
                border-bottom-left-radius: 0%;
            }
            h2{
            width: 45%;
            margin: 1%;
            border: 1px solid white;
            box-shadow: -3px -5px 1px white;
            border-top-right-radius: 25%;
            border-bottom-left-radius: 25%;
            cursor: pointer;
            background-color: $blue-bg-header;
            text-shadow: 1px 1px 1px black;
            }
        }
        .sale{
            background-color: $orange;
        }
        .event{
            background-color: $red;
        }
        .back-office--menu_content{
            width: 44%;
            height: -webkit-fit-content;
            height: -moz-fit-content;
            height: fit-content;
            font-weight: 700;
            text-align: center;
            margin-top: 1%;
            margin: 2%;
            position: absolute;
            top: 0;
            right: 0;

            h2{
                box-shadow: -4px -4px 1px $blue-bg-header;
                text-shadow: 1px 1px 1px black;
            }
        }
        
        
       .back-office--container__sales{
            display: flex;
            flex-direction: row;
            height: 84%;
            max-height: 84%;
            width: 100%;
            background-color: #313846;
            box-shadow: inset 1px -6px 1px #46bfc7;
            border: 2px solid white;
            border-radius: 2%;
        .active{
            filter: brightness(1.2);
            background-color: $blue-light-bg;
            width: fit-content;
        }
            //SCSS FOR LIST SALE
            .back-office--container__salesTask{
                width: 50%;               
                height: 90%;
                border-radius: 2%;
                .back-office--sale{
                    width: 100%;                    
                    .back-office--sale__title{ 
                        background-color: $blue-bg-header;
                        border: 1px solid black;
                        width: 95%;
                        margin: 3%;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        border-radius: 7%;
                        text-shadow: 1px 1px 0px white;
                        box-shadow: -3px -2px 1px white;
                        color: black;
                        button{
                            width: 10%;
                            border-radius: 50%;
                        }
                        button:hover{
                            background-color: red;
                        }
                        div{
                            margin: 2%;
                            font-weight: bold;
                        }                    
                    }
                } 
                    //SCSS FOR CRUD SALE
                .back-office--container__crud{
                    width: 200%;
                    height: 100%;
                    padding: 1%;
                    max-height: 100%;
                    display: flex;
                    flex-direction: column;
                    .back-office--crud__all{
                        height: 100%;
                        display: flex;
                        width: 100%;
                        flex-wrap: wrap;
                        justify-content: center;
                        align-items: center;
                        align-content: flex-start;
                        position: relative;
                        z-index: 10;
                        div{
                                display: flex;
                                width: 100%;
                                flex-direction: column;
                                align-items: center;
                                justify-content: space-between;
                                input{
                                    width: 88%;
                                    border: 1px solid #DFF2F0;
                                    border-radius: 10%;
                                    padding: 1%;
                                    font-size: large;
                                    box-shadow: -7px -6px 1px $blue-bg-header;
                                    margin-top: 2%;
                                }
                                h3{
                                    width: 10%;
                                    font-style: italic;
                                    margin: 0.5%;
                                }
                        }
                        .back-office--crud__title{
                            margin: 0% 3% 3% 3%;
                        }
                        .back-office--crud__content{
                            .back-office--crud__textarea{
                                width: 88%;
                                border: 1px solid #DFF2F0;
                                font-size: large;
                                box-shadow: -7px -6px 1px black;
                                margin-top: 2%;
                            }
                        }
                        .back-office--crud__link{
                            width: 40%;
                        }
                        .back-office--crud__location{
                            width: 40%;
                        }   
                        .back-office--crud__date{
                            width: 40%;
                        }
                        .back-office--crud__button{
                            width: 40%;
                            height: 0;
                        }
                    }
                   
                    
                }
            }
        //SCSS FOR THE CONTENTS OF SALE 
        .back-office--sale--contents__all{
            width: 50%;
            display: flex;
            flex-direction: column;
            // background-color: green;
            position: relative;
            height: 90%;
            .back-office--sale--container__contents{            
                // background-color: #f0f;
                width: 100%;
                height: 100%;
                
                .back-office--content{
                    display: flex;
                    flex-wrap: wrap;
                    height: 100%;
                    flex-direction: column;
                    width: 100%;
                    align-items: center;
                    position: absolute;
                    top: 5%;
                    input{
                        margin: 1%;
                    }
                }

            }
        }
        
        }   
    }
}

</style>