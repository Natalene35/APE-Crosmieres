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
        
        <div class="back-office--crud__button">
            <button v-on:click="createSale" class="button sale">Créer vente</button>
        </div>                            
    </div>

</template>

<script>
import SaleService from "@/services/sales/SaleService";
export default {
    
    name: "SaleCreateLayout",
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
            console.log("entree vente composant")
            const response = await SaleService.create({
                "title": this.title,
                "content": this.content,
                "lieu": this.place,
                "date": this.date,
                "lien": this.link
            });
            //UPDATE POST FOR TAKE IT PUBLISH
            const majPost = await SaleService.update({
                "status": "publish",
                "id": response
            });
            //RELOAD ALL SALES FOR SEE NEW SALE
            this.allSales = await SaleService.findAll();
            this.menuActive = "listSale";
            this.$emit('reloadSaleEmit');
            console.log(response + majPost);
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
    },
     async mounted() {
    if(this.active!=null){
        this.selectEvent=await SaleService.find(parseInt(this.active))
        
        this.title = this.selectEvent.title.rendered;
        this.content = this.selectEvent.content.rendered;
        this.selectPostMeta= await SaleService.findMeta(this.active);
        console.log("levent select est "+this.selectPostMeta)
        for(const meta of this.selectPostMeta){
            if(meta.meta_key=="date"){
                this.date =  meta.meta_value
            }
            if(meta.meta_key=="lieu"){
                this.location =  meta.meta_value
            }
            if(meta.meta_key=="lien"){
                this.link =  meta.meta_value
            }
        }
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
                box-shadow: -7px -6px 1px black;
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
        width: 40%
    }   
    .back-office--crud__date{
        width: 40%;
    }
    .back-office--crud__button{
        width: 40%;
        height: 0;
    }                  


}




</style>