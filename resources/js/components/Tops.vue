<template>
    <div class="row">

        <div class="col-lg-3 col-md-4  col-sm-6 " v-for="p in products">
            <div class="center-text mb-30">

                <div class="ïmg-200x mlr-auto pos-relative" v-if="p.tag">
                    <h6 class="ribbon-cont"><div class="ribbon primary"></div><b>{{p.tag}}</b></h6>
                    <img src="images/seller-2-200x200.png" alt="">
                </div>

                <h5 class="mt-20">{{p.name}}</h5>
                <h4 class="mt-5"><b>R$ {{Number(p.value).toFixed(2)}}</b></h4>
                <h6 class="mt-20"><button  @click="addToCart(p)" class="btn-brdr-primary plr-25"><b>Pedir</b></button></h6>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['products'],
        methods:{
            addToCart: function(product){
                $('.dropdown').addClass('on-add');
                this.$store.state.cart.products.push(product);
                $('.dropdown').on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
                   $(this).removeClass("on-add");
               });
            }
        }
    }
</script>
