<template>
    <div class="row">

        <div v-for="p in products" :class="'col-md-5 food-menu '+p.category" style=" margin: 10px;
        box-shadow: inset 1px 0px 4px 1px;padding-top:15px ">
        <div class="sided-90x mb-30 ">
            <div class="s-left"><img class="br-3" :src="'/files/products/'+p.id+'.'+p.img_extension" :alt="p.name"></div><!--s-left-->
            <div class="s-right">
                <h5 class="mb-10">
                    <b>{{p.name}}</b>
                    <b class="color-primary float-right">R$ {{p.value.toFixed(2)}}</b>
                </h5>
                <p class="pr-70">{{p.description}}</p>
                <button  @click="addToCart(p)" style="float: right" class="m-10 btn-brdr-primary plr-25"><b>Pedir</b></button>

            </div><!--s-right-->
        </div><!-- sided-90x -->
    </div><!-- food-menu -->


</div><!-- container -->
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
        },
        mounted(){
            console.log(this.products);
        }
    }
</script>
