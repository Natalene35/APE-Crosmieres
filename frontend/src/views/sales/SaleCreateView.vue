<template>
  <HeaderLayout />
  <sale-create-layout />
  <FooterLayout />
</template>

<script>
// @ is an alias to /src
import HeaderLayout from "@/components/templates/HeaderLayout.vue";
import FooterLayout from "@/components/templates/FooterLayout.vue";
import SaleCreateLayout from "../../components/sales/SaleCreateLayout.vue";

export default {
  name: "EventFormView",
  components: {
    HeaderLayout,
    FooterLayout,
    SaleCreateLayout,
  },
  mounted() {
    document.title = "Ajout vente";
  },
};
</script>

<style lang="scss">
</style>