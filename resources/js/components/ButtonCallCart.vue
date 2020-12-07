<template>
    <div >
        <a data-toggle="modal" data-target="#modalCart">
            <i class="fas fa-shopping-cart"></i>
            Ver Pedido</a>
        <a data-toggle="modal" data-target="#modalCart" style="right: 10px;margin-right: 10px;position: absolute;">R$ {{cartTotal}}</a>

    </div>
</template>

<script>
    export default {
       computed:{
           productsInCart() {
               return this.$store.state.cart.products;
           },
           cartTotal(){
               return this.$store.getters.getTotal.toFixed(2);
           }
       }
    }
</script>

<style scoped>

</style>
