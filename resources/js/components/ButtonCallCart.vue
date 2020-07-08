<template>
    <button v-if="productsInCart.length != 0" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modalCart">Meu Pedido</button>
</template>

<script>
    export default {
       computed:{
           productsInCart() {
               return this.$store.state.cart.products;
           },
       }
    }
</script>

<style scoped>

</style>
