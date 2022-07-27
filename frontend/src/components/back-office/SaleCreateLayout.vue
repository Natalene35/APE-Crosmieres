<template>
    <div class="back-office--crud__all">
        <div class="back-office--crud__title">
            <h3>Titre</h3>
            <input type="text" v-model="this.title">
        </div>
        
        <div class="back-office--crud__content">
            <h3>Contenu</h3>
            <textarea class="back-office--crud__textarea" id="" cols="30" rows="5" v-model="this.content">
            </textarea>
        </div>
        
        <div class="back-office--crud__location">
            <h3>Lieu</h3>
            <input type="text" v-model="this.location">
        </div>
        
        <div class="back-office--crud__date">
            <h3>Date</h3>
            <input type="date" v-model="this.date">
        </div>
        
        <div class="back-office--crud__link">
            <h3>Lien</h3>
            <input type="link" v-model="this.link">
        </div>                           
        
        <div class="back-office--crud__button" v-if="this.selectPost==null">
            <button v-on:click="createSale" @keyup.enter="$emit('reloadSal')" class="button sale">Créer vente</button>
        </div>
        <div class="back-office--crud__button" v-if="this.selectPost!=null">
            <button v-on:click="updateSale" @keyup.enter="$emit('reloadSal')" class="button sale">Modifier vente</button>
        </div>                             
    </div>

</template>

<script>
import SaleService from "@/services/sales/SaleService";
export default {
    
    name: "SaleCreateLayout",
    emits: ["reloadSal"],
    props: {
        active: String,
    },
    data() {
        return {
            selectPost: null,
            selectPostMeta: null,
            //FIELD FORM CRUD //
            title: null,
            content: null,
            location: null,
            date: null,
            link: null,
        }
    },
    methods: {
        //<------------------------------------SQL METHOD------------------------------------>
        //<---------------SALES------------------->
        //CREATE SALE
        async createSale() {
            const response = await SaleService.create({
                "title": this.title,
                "content": this.content,
                "lieu": this.location,
                "date": this.date,
                "lien": this.link
            });
                this.$emit("reloadSal");
            //UPDATE POST FOR TAKE IT PUBLISH
            const majPost = await SaleService.update({
                "status": "publish",
                "id": response.id
            });
            //RELOAD ALL SALES FOR SEE NEW SALE
            this.allSales = await SaleService.findAll();
            this.menuActive = "listSale";
            console.log(response + majPost);
        },
        //UPDATE SALE
        async updateSale() {
            const response = await SaleService.delete({
                "id": parseInt(this.active)
            }); 
            console.log(response)  
            this.createSale()
        },
    },
    async mounted() {       
        if(this.active!=null){
            this.selectPost=await SaleService.find(parseInt(this.active))        
            this.title = this.selectPost.title.rendered;
            this.content = this.selectPost.content.rendered;
            this.selectPostMeta= await SaleService.findMeta(this.active);
            this.date =  this.selectPostMeta.date
            this.location =  this.selectPostMeta.lieu
            this.link =  this.selectPostMeta.lien
        }    
    },
}
</script>

<style lang="scss">
.navActive{
    filter: brightness(1.4);
}
.back-office--crud__all{
    height: 100%;
    display: flex;
    flex-direction: row;
    width: 100%;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: flex-start;
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
            box-shadow: -7px -6px 1px $blue-bg-header;
            margin-top: 2%;
            border-radius: 10%;
        }
    }
    .back-office--crud__link{
        width: 40%;
    }
    .back-office--crud__location{
        width: 40%
    }   
    .back-office--crud__date{
        width: 40%;
    }
    .back-office--crud__button{
        width: 40%;
        height: 0;
        button{
            border-radius: 10%;
            border: 1px solid white;
            box-shadow: -3px -3px 1px $blue-bg-header;
        }
        button:hover{
            filter: brightness(1.2);
            transform: scale(1.2);
            cursor: pointer;

        }
    } 
}




</style>