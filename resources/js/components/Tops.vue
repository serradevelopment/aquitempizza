<template>
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6" v-for="p in products" :key="p.id" v-if="!p.locked">
      <div class="center-text mb-30">
        <div class="ïmg-200x mlr-auto pos-relative" >
          <h6 class="ribbon-cont" v-if="p.tag">
            <div class="ribbon primary"></div>
            <b>{{p.tag}}</b>
          </h6>
          <img :src="getImgUrl(p)" :alt="p.name" >
        </div>

        <h5 class="mt-20">{{p.name}}</h5>
        <h4 class="mt-5">
          <b>R$ {{Number(p.value).toFixed(2)}}</b>
        </h4>
        <h6 class="mt-20" v-if="configuration.is_online">
          <button @click="addToCart(p)" class="btn-brdr-primary plr-25">
            <b>Pedir</b>
          </button>
        </h6>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["products","configuration"],
  methods: {
    getImgUrl(p) {
      var image = "/files/products/" + p.id + "." + p.img_extension;
      return image;
    },
    addToCart: function(product) {
      $(".dropdown").addClass("on-add");
      this.$store.state.cart.products.push(product);
      $(".dropdown").on(
        "animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd",
        function() {
          $(this).removeClass("on-add");
        }
      );
    }
  },
  mounted() {}
};
</script>
