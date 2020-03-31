<template>

   <div class="dropdown">
      <button class="plr-20 color-white btn-primaryc" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        PEDIDO
    </button>

    <ul class="dropdown-menu dropdown-cart" aria-labelledby="dropdownMenu2" role="menu" v-if="productsInCart.length != 0">
        <li v-for="p,i in productsInCart" style="box-shadow: 1px 1px 4px 0px;">
            <span class="item">
                <span class="item-left">
                    <!-- <img src="http://lorempixel.com/50/50/" alt="" /> -->
                    <span class="item-info">
                        <span>{{p.name}}</span>
                        <span>R$ {{p.value.toFixed(2)}}</span>
                    </span>
                </span>
                <span class="item-right" style="margin: 10px;">
                    <button class="btn btn-xs btn-danger pull-right" @click="removeFromCart(p)">x</button>
                </span>
            </span>
        </li>
        <li class="divider"></li>
        <div style="padding: 10px;  background-color: #f6fe4533;">
            <div class="container" v-if="troco == 0">
                <div class="row">
                    <div class="col-6">
                        <label>Pagamento em cartão?</label>
                    </div>
                    <div class="col-6">
                        <input type="checkbox" style="width: auto" v-model="is_card" value="true" name="" class="mt-20 form-control">
                    </div>
                </div>
                <hr>
            </div>

            <div class="container row" v-if="is_card == false">
                <div class="col-6">
                    <span style="">Troco:</span>
                </div>
                <div class="col-6">
                    <input type="number" v-model="troco" class="form-control money-mask">     
                </div>
                <hr>
            </div>
            <li><span style="color: black;padding: 10px;float: right;">Total: {{getTotalCartValue}}</span></li>

            <li><button class="btn btn-success" @click="sendOrder()" >Enviar Pedido</button></li>
        </div>
    </ul>

    <ul class="dropdown-menu dropdown-cart" aria-labelledby="dropdownMenu2" role="menu" v-else>
        <li><h5 style="display: block; text-align: center;margin: auto">Vazio</h5></li>
    </ul>
<!-- 
    <div class="dropdown-menu"  aria-labelledby="dropdownMenu2" style="width: max-content;    box-shadow: -2px 5px 20px 1px;background-color: red; margin: auto;max-height: 350px;overflow: auto;">
        <div  v-if="productsInCart.length != 0" >
            <div v-for="p in productsInCart"  style="background-color: white; margin: 10px; box-shadow: inset 1px 0px 4px 1px; ">
                <div class="sided-90x mb-30 ">
                    <div class="container row">
                        <div class="col-6">
                            <p>
                                <b>{{p.name}}</b>
                            </p>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <b class="color-primary " style="color: red; right: 10px">R$ {{p.value.toFixed(2)}}</b>
                        </div>
                    </div>
                </div>
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
                <hr>
                <div class="row">
                    <div class="col-6">
                        <label>Pagamento em cartão?</label>
                    </div>
                    <div class="col-6">
                        <input type="checkbox" style="width: auto" v-model="is_card" value="true" name="" class="mt-20 form-control">
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
    </div> -->
</div>

</template>

<script>
    export default {
        data(){
            return {
                troco:0,
                is_card: false
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
            removeFromCart(s){
                var index = this.$store.state.cart.products.indexOf(s);
                if (index > -1) {
                    this.$store.state.cart.products.splice(index, 1);
              }
          },
          sendOrder(){
            var text = '----------------NOVO PEDIDO-------------\n';

            var pizzas  =  'Pizzas:\n';
            var bebidas = '\nBebidas:\n';
            var card    = 'Pagamento com cartão';

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
                text += ' | Troco para: R$'+this.troco;
            }
            if(this.is_card){
                text += '\n'+card
            }
            text = window.encodeURIComponent(text);
            var url = "https://api.whatsapp.com/send?phone=5524998160954&text="+text;
            var win = window.open(url, '_blank');
            win.focus();
        }
    },
    mounted() {
        // console.log(this.productsInCart.length)
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

    ul.dropdown-cart{
        min-width:250px;
        overflow: auto;
        max-height: 300px
    }
    ul.dropdown-cart li .item{
        display:block;
        padding:3px 10px;
        margin: 3px 0;
    }
    ul.dropdown-cart li button{
        display: block;
        text-align: center;
    }

    ul.dropdown-cart li .item:hover{
        background-color:#f3f3f3;
    }
    ul.dropdown-cart li .item:after{
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    ul.dropdown-cart li{
        display: block!important;
    }
    ul.dropdown-cart li .item-left{
        float:left;
    }
    ul.dropdown-cart li .item-left img,
    ul.dropdown-cart li .item-left span.item-info{
        float:left;
    }
    ul.dropdown-cart li .item-left span.item-info{
        margin-left:10px;   
    }
    ul.dropdown-cart li .item-left span.item-info span{
        display:block;
    }
    ul.dropdown-cart li .item-right{
        float:right;
    }
    ul.dropdown-cart li .item-right button{
        margin-top:14px;
    }
</style>