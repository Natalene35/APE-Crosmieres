<template>
  <section class="sale--sliders__all">
    <div class="sale--sliders">
      <div
        v-for="sales in saleSlide"
        v-bind:key="sales"
        v-bind:class="'sale--sliders__texte hidden'"
      >
        <h2>{{ sales.title.rendered }}</h2>
        <p v-html="sales.excerpt.rendered"></p>
      </div>
    </div>
    <section class="background--design__all">
      <div class="background--design"></div>
      <div class="background--design"></div>
      <div class="background--design"></div>
      <div class="background--design"></div>
      <div class="background--design"></div>
    </section>
  </section>
</template>

<script>
//Service
import SaleService from "@/services/sales/SaleService";
export default {
  name: "SalesHomeSliders",
  data() {
    return {
      allSales: null,
      //Define the slide show in first
      slide: 0,
      //For up the number of img in sliders maxSlide ++
      maxSlide: 3,
      saleSlide: null,
    };
  },
  methods: {
    SlideAuto() {
      let allSlideText = document.getElementsByClassName("hidden");
      if (this.slide != this.maxSlide) {
        this.slide++;
        allSlideText[this.slide - 1].classList.remove("active");
      } else {
        this.slide = 1;
        allSlideText[this.maxSlide].classList.remove("active");
      }

      allSlideText[this.slide].classList.toggle("active");
    },
  },
  async mounted() {
    setInterval(this.SlideAuto, 10000);
    this.saleSlide = await SaleService.findAll();
    this.maxSlide = this.saleSlide.length - 1;
  },
};
</script>

<style lang="scss">
.sale--sliders {
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
      align-items: center;
    }
    .sale--sliders {
      border-radius: 1rem;
      padding: margin;
      height: 8rem;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      h2 {
        text-shadow: 1px 1px 1px black;
        font-style: italic;
      }
      .hidden {
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
  }
}
</style>