<template>

    <section class="sale--sliders__all" >
        <!-- <------------------BUBBLE----------------> 
        <div class="background--bubble__container">
            <div class="background--design__bubble"></div>
            <div class="background--design__bubble"></div>
            <div class="background--design__bubble"></div>
            <div class="background--design__bubble"></div>
        </div>
        
            <div class="sale--sliders__titre">
                <h2>Ventes</h2>
            </div>
           
           <div class="sale--sliders" >
                <div v-for="sales in saleSlide" v-bind:key="sales" v-bind:class="'sale--sliders__texte hidden first'"  >
                    <h2 class="sale--sliders__h2">{{sales.title.rendered}}</h2>
                    <p v-html="sales.excerpt.rendered"></p>
                    
                </div>
            </div>
         
            
            <section class="background--design__all">
                <div class="background--design"> </div>
                <div class="background--design"></div>
                <div class="background--design"></div>
                <div class="background--design"></div>
                <div class="background--design background__5" v-bind:style="'height:'+this.scroll+'%'"></div>
            </section>

  </section>
</template>

<script>
//Service
import SaleService from "@/services/sales/SaleService";
export default {


  name: 'SalesHomeSliders',
  data(){
    return{
        allSales: null,
        //Define the slide show in first
        slide: 0,
        //Define number of slide
        maxSlide: null,   
        saleSlide: null,
        scroll: null,
    }
  },
    methods: {
        SlideAuto(){
            
            let allSlideText=document.getElementsByClassName("hidden")
            allSlideText[0].classList.remove("first")
            if(this.slide!=this.maxSlide){
                this.slide++
                allSlideText[this.slide-1].classList.remove("active")
                allSlideText[this.slide-1].classList.remove("animsliders")               
              }
            else{
                this.slide=0
                allSlideText[this.maxSlide].classList.remove("active")
                allSlideText[this.maxSlide].classList.remove("animsliders")
            }
            allSlideText[this.slide].classList.add("active")
            allSlideText[this.slide].classList.add("animsliders")                   
        },
        handleScroll(){
            //Modify her for scroll animation
            this.scroll=(window.scrollY)/8

        }
 
    },
   async mounted(){  
    setInterval(this.SlideAuto, 10000);
    this.saleSlide=await SaleService.findAll();
    this.maxSlide=this.saleSlide.length-1;
     window.addEventListener('scroll', this.handleScroll);

    }
}
</script>

<style lang="scss">


.sale--sliders__all{

    display: none;
}

@media (max-width: 425px) {

    main {
        flex-direction: column;
        position: relative;
        z-index: 3;
        overflow: hidden;
    }

    .sale--section {
        display: none;
      }
      .active {
        display: contents;
      }
      .sale--sliders__text {
        height: 12rem;
        width: inherit;
        border: 1px solid $white;
        border-radius: 1rem;
      }
    }

    .sale--sliders__all {

        display: flex;
        justify-content: space-between;
        border-radius: 1rem;
        color: black;
        width: 80%;
        margin: 0px auto 1rem auto;
        height: 12rem;
        align-items: center;
        justify-content: center;

        .background--design__all {
            height: 500vh;
            width: 1000vh;
            background-color: transparent;
            position: absolute;
            z-index: -7;
            display: flex;
            flex-wrap: wrap;
            display: initial;

            .background--design {
                background-color: $blue-bg-header;
                margin: auto;
                border: 2px solid black;
                box-shadow: 1px 1px 1px black;
                border-radius: 50%;
                width: 8%;
                height: 26%;
                z-index: 0;
                position: relative;
                border-radius: 66%;
                box-shadow: -14px 0px 1px white;
            }
        }

        div {
            display: flex;

            flex-direction: column;
            justify-content: space-between;
            border-radius: 1rem;
            color: black;
            width: 80%;
            margin: 0px auto 1rem auto;
            height: 12rem;
            align-items: center;
            justify-content: center;
            .sale--sliders__titre{
                background-color: $blue-light-bg;
                position: absolute;
                top: 0;
                width: 50%;
                display: flex;
                justify-content: center;
                font-weight: bold;
                padding: 1%;
                box-shadow: 0px 6px 1px black;
                color: $grey;
            }
            @import "../../assets/animations/bubbleAnim.scss";

            .background--design__all{
                height: 500vh;
                width: 1000vh;
                background-color: transparent;
                position: absolute;
                z-index: -7;
                display: flex;
                flex-wrap: wrap;
                display: initial;
                .background--design:nth-child(5){
                    background-color: $blue-light-bg;
                    position: absolute;
                    top: 40%;
                    height: 1px;
                    width: 26%;
                    right: 47%;
                }
                
                .background--design{
                    background-color:$blue-bg-header;
                    margin: auto;
                    border: 2px solid black;
                    box-shadow: 1px 1px 1px black;
                    border-radius: 50%;
                    width: 8%;
                    height: 26%;
                    z-index: 0;
                    position: relative;
                    border-radius: 66%;
                    box-shadow: -14px 0px 1px white;                   
                }

            }

            .hidden {
                display: none;
            }
            .sale--sliders{
                    border-radius: 1rem;
                    padding: margin;
                    height: 8REM;
                    display: flex;
                    flex-direction: column;
                    overflow: hidden;
                    opacity: 1;
                    width: 90%;
                    color: $grey;
                    
                h2{
                    text-shadow: 1px 1px 1px black;
                    font-style: italic;
                    text-decoration: underline;
                    padding: 1%;   
                    width: 100%;
                    margin-bottom: 2%;
                    color: $grey;
                }
                p{
                    margin-right: 300px;
                    
                }
                .animsliders+h2,p{
                    transition: all ease-in;
                    animation: animSliders ;
                    animation-iteration-count: 1;
                    animation-duration: 120s;
                }
                @keyframes animSliders {
                    0.5%{
                     margin-right: 0;                    
                    }
                    90%{
                       margin-right: 0;                        
                    }
                }
                .hidden{
                    display: none;
                }
                .first:nth-child(1){
                    display: contents;
                }
                .active{
                    display: contents;
                    transition: display 0.2S ease-in;
                }
                .sale--sliders__text{
                    height: 12rem;
                    width: inherit;
                    border: 1px solid $white;
                    border-radius: 1rem;
                    transition: all;                    
                }
                


            .active {
                display: contents;
            }

            .sale--sliders__text {
                height: 12rem;
                width: inherit;
                border: 1px solid $white;
                border-radius: 1rem;

            }
        }
    }
}


</style>