<template>

 <div class="dropdown">
  <button class="plr-20 color-white btn-primaryc" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    PEDIDO
</button>
<div class="dropdown-menu"  aria-labelledby="dropdownMenu2" style="    box-shadow: -2px 5px 20px 1px;background-color: red; margin: auto;max-height: 350px;overflow: auto;">
    <div  v-if="productsInCart.length != 0" >
        <div v-for="p in productsInCart"  style="background-color: white; margin: 10px; box-shadow: inset 1px 0px 4px 1px;padding-top:15px ">
            <div class="sided-90x mb-30 ">
                <div class="container">
                    <h5><b>{{p.name}}</b><b class="color-primary float-right">R$ {{p.value}}</b></h5>
                    <p class="pr-70">{{p.description}}</p>
                </div><!--s-right-->
            </div><!-- sided-90x -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <span style="color: white">Total: {{getTotalCartValue}}</span>
                </div>
                <div class="col-8">
                    <span style="color: white">Troco:</span> <input type="number" v-model="troco" class="form-control money-mask">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-success" @click="sendOrder()" style="margin-top: 20px;float: right;">Enviar Pedido</button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="productsInCart.length == 0" class="row">
        <span style="color: white; margin: auto">Vazio</span>
    </div>
</div>
</div>

</template>

<script>
    export default {
        data(){
            return {
                troco:0
            }
        },
        computed: {
            productsInCart () {
                return this.$store.state.cart.products
            },
            getTotalCartValue(){
                var total = 0;
                for (var i = this.productsInCart.length - 1; i >= 0; i--) {
                    total += this.productsInCart[i].value;
                }
                return total.toFixed(2);
            }
        },
        methods:{
            sendOrder(){
                console.log(this.productsInCart);
                var text = '----------------NOVO PEDIDO-------------\n';

                var pizzas  =  'Pizzas:\n';
                var bebidas = '\nBebidas:\n';
                for (var i = 0; i < this.productsInCart.length; i++) {
                    if(this.productsInCart[i].category == 'PIZZAS'){
                        pizzas += '1 x '+this.productsInCart[i].name+'\n';
                    }
                    if(this.productsInCart[i].category == 'BEBIDAS'){
                        bebidas += '1 x '+this.productsInCart[i].name+'\n';
                    }
                }

                text += pizzas; 
                text += bebidas;
                text += '----------------------------------------------\n';
                text += 'TOTAL: R$'+this.getTotalCartValue;
                if(this.troco != 0){
                    text += ' | Troco: R$'+this.troco;
                }
                text = window.encodeURIComponent(text);
                var url = "https://api.whatsapp.com/send?phone=5524998160954&text="+text;
                var win = window.open(url, '_blank');
                win.focus();
            }
        },
        mounted() {
            console.log(this.productsInCart.length)
        }
    }
</script>
<style type="text/css">
    .on-add{
        -webkit-transition: max-height 0.8s;
        -moz-transition: max-height 0.8s;
        transition: max-height 0.8s;
        animation: SHW .5s;
        animation-fill-mode: both
    }

    @keyframes SHW {
        0% {
            transform:scale(0.2);
            opacity:0
        }
        50% {
            transform: scale(2);
            opacity:0.5
        }
        100%{
            transform: scale(1);
            opacity:1
        }
    }
</style>