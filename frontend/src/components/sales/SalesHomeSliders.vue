<template>
    <section class="sale--sliders" >
        <div class="sale--row__left left" v-on:click="Slide">-</div>
        <div class="sale--sliders__image" >
            <img v-bind:src="tilleulPic" class="active 1" >
            <img v-bind:src="logoPic" class="hidden 2">
            <img v-bind:src="monstrePic" class="hidden 3" >
            </div>
        <div class="sale--row__right right" v-on:click="Slide"> + </div>
    </section>
</template>

<script>
//Image
import tilleul from '@/assets/images/tilleul.jpg'
import logo from '@/assets/images/logoAPE_V1.jpeg'
import monstre from '@/assets/images/surr-holidays.png'
//Service
// import SaleService from '@/services/sales/SaleService'
// import logo from '@/assets/images/tilleul.jpg'
export default {
  name: 'SalesHomeSliders',
  data(){
    return{
        //Images
        tilleulPic: tilleul,
        logoPic: logo,
        monstrePic: monstre,
        allSales: null,
        //Define the slide show in first
        slide: 0,
        //For up the number of img in sliders maxSlide ++
        maxSlide: 3,   
    }
  },
    methods: {
        SlideAuto(){
            if(this.slide!=this.maxSlide){
                this.slide++
            }
            else{
                this.slide=1
            }

            //We take the next slide become--->active
            let slideActive= document.getElementsByClassName(""+this.slide+"")
            //We take the previous slide become--->hidden
            let hiddenSlide= document.getElementsByClassName("active")
            //Toggle class hidden previous slide
            hiddenSlide[0].classList.add("hidden")
            hiddenSlide[0].classList.toggle("active")
            //Toggle class active next slide
            slideActive[0].classList.toggle("active")
            slideActive[0].classList.toggle("hidden")
            this.interval()
                   
        },
        interval(){
            console.log("entree interval")         
            
         },       

        //<---------------------ACTIVE IF U WANT USE SLIDER MANUAL----------------->
        // Slide(e){  
           
        //     //If the target of the click is right we show next slide
        //     if(e.currentTarget.classList[1]=="right"){
        //         if(this.slide!=this.maxSlide){
        //             this.slide++
        //         }
        //         else{
        //             this.slide=1
        //         }
        //     }
        //      //If the target of the click is right we show previous slide
        //     if(e.currentTarget.classList[1]=="left"){
        //         if(this.slide!=1){
        //             this.slide--
        //         }
        //         else{
        //             this.slide=this.maxSlide
        //         }
        //     }
        //     //We take the next slide become--->active
        //     let slideActive= document.getElementsByClassName(""+this.slide+"")
        //     //We take the previous slide become--->hidden
        //     let hiddenSlide= document.getElementsByClassName("active")
        //     //Toggle class hidden previous slide
        //     hiddenSlide[0].classList.add("hidden")
        //     hiddenSlide[0].classList.toggle("active")
        //     //Toggle class active next slide
        //     slideActive[0].classList.toggle("active")
        //     slideActive[0].classList.toggle("hidden")

        //     console.log(slideActive[0].classList[1]) 
        // },
        
    },
   async mounted(){          
    setInterval(this.SlideAuto, 10000);
    }
}
</script>

<style lang="scss">

.hidden{
    display: none;
}
.sale--sliders{
    display: none;
}
@media (max-width: 425px) {

    main{
    flex-direction: column;
    }
    .sale--section{
        display: none;
    }
        .sale--sliders{
            display: flex;
            justify-content: space-between;
            border-radius: 1rem;
            color: black;
            width: 80%;
            margin: 0px auto 1rem auto;
            height: 12rem;
            align-items: center;
            div{
                display: flex;
                align-items: center;
                
            }

            .sale--row__left{
                //Desactive for use button manual sliders
                display: none;
                border-radius: 8px;
                border: 1px solid $black;
                justify-content: center;
                width: 5%;
                background-color: $blue-bg-header;
                height: 3rem;
                box-shadow: 3px -1px 1px $black;
                
            }
            .sale--row__right{
                //Desactive for use button manual sliders
                display: none;
                background-color: $blue-bg-header;
                border: 1px solid $black;
                justify-content: center;
                height: 3rem;
                border-radius: 8px;
                width: 5%;
                box-shadow: 3px -1px 1px $black;
            }
            .sale--sliders__image{
                width:100%;
                box-shadow:-6px -7px 1px $blue-bg-header;
                border-radius: 1rem;
                padding: margin;
                margin: 0px 6px 0px 6px;
                img{
                    height: 12rem;
                    width: inherit;
                    border: 1px solid $white;
                    border-radius: 1rem;
                }
            }
        }
}
</style>