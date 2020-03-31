<template>
    <div class="row">

        <div v-for="p in products"  class="col-md-6">
            <div :class="'col-md-12 food-menu '+p.category" style="border: 10px solid transparent; box-shadow: 1px 0px 10px 0px;padding-top: 15px;border-radius: 12px;    margin-bottom: 15px;">
                <div class="sided-90x">
                    <div class="s-left"><img class="br-3" :src="'/files/products/'+p.id+'.'+p.img_extension" :alt="p.name"></div><!--s-left-->
                    <div class="s-right">
                        <h5 class="">
                            <b>{{p.name}}</b>
                            <b class="color-primary float-right">R$ {{p.value.toFixed(2)}}</b>
                        </h5>
                        <p class="">{{p.description}}</p>
                        <div class="row">
                            <div class="col-md-6 offset-md-6 col-xs-12">
                                <button  @click="addToCart(p)" style="" class="m-10 btn-brdr-primary plr-25" ><b>Pedir</b></button>
                            </div>
                        </div>
                    </div><!--s-right-->
                </div><!-- sided-90x -->
            </div><!-- food-menu -->
        </div>

        <div class="row">
            <div class="col-md-6 food-menu MONTAR">
                <h5 style="padding: 20px;">Selecione 2 sabores para montar uma pizza meio a meio.</h5>
            </div>
            <div class="col-md-6 food-menu MONTAR" >
                <div v-if="mounted != null" style="padding: 20px">
                    <div class="form-group">
                        <label><h5>Pizza montada:</h5></label>
                        <input type="" name="" disabled="true" class="form-control" v-model="mounted.name">
                        <h5>Valor da pizza: {{mounted.value.toFixed(2)}}</h5>
                        <button class="mt-10 btn btn-success" v-if="count == 1 || count == 2" @click="cancelMounted()">Cancelar</button>
                        <button class="mt-10 btn btn-success" v-if="count == 2" @click="addToCart(mounted)">Adicionar ao pedido</button>
                    </div>
                    
                </div>
            </div>
        </div>

        <hr>

        <div v-for="p in getPizzas"  class="col-md-6" :key="p.id">
            <div :class="'col-md-12 food-menu MONTAR'" style="border: 10px solid transparent; box-shadow: 1px 0px 10px 0px;padding-top: 15px;border-radius: 12px;    margin-bottom: 15px;">
                <div class="sided-90x">
                    <div class="s-left"><img class="br-3" :src="'/files/products/'+p.id+'.'+p.img_extension" :alt="p.name"></div><!--s-left-->
                    <div class="s-right">
                        <h5 class="">
                            <b>{{p.name}}</b>
                            <b class="color-primary float-right">R$ {{p.value.toFixed(2)}}</b>
                        </h5>
                        <p class="">{{p.description}}</p>
                        <div class="row">
                            <div class="col-md-6 offset-md-6 col-xs-12" v-if="!disableBtnSelectPizza(p)">
                                <button  @click="mount(p)" style="" class="m-10 btn-brdr-primary plr-25" v-if="count <= 1"><b>Escolher</b></button>
                            </div>
                        </div>
                    </div><!--s-right-->
                </div><!-- sided-90x -->
            </div><!-- food-menu -->
        </div>

    </div><!-- container -->
</template>

<script>
    export default {
        props:['products'],
        data(){
            return {
                mounted: null,
                count: 0,
                allProducts: null
            }
        },
        computed: {
            getPizzas: function () {
                return this.allProducts.filter(function( obj ) {
                    return obj.category != 'BEBIDAS';
                });
            },

        },
        methods:{
            disableBtnSelectPizza(p)
            {
                if(this.mounted == null){
                    return false;
                }
                if(this.mounted != null && this.mounted.id == p.id){
                    return true
                }
                return false;
            },
            cancelMounted(){
                this.mounted = null;
                this.count   = 0;

            },
            addToCart: function(product){
                $('.dropdown').addClass('on-add');
                this.$store.state.cart.products.push(product);
                $('.dropdown').on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
                    $(this).removeClass("on-add");
                });
            },
            mount(p){
                this.pizza = JSON.parse(JSON.stringify(p));
                let mount = this.mounted;
                //SE A PIZZA NAO ESTIVER MONTADA
                if(this.count <=1){
                    if(mount == null && this.count == 0){//SE FOR A PRIMEIRA PIZZA ADICIONADA
                        mount = this.pizza;
                        this.count++;
                    }else if( mount != null && this.count == 1){//SE FOR A SEGUNDA PIZZA ADICIONADA
                        mount.name += ' | '+this.pizza.name;
                        mount.value = Math.max(mount.value,this.pizza.value);
                        this.count++;
                    }

                    //ADICIONA A PIZZA MONTADA NO DATA mounted E SETA allProducts SEM A PIZZA MONTADA
                    this.mounted = mount;
                }
            }
        },
        created(){
            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
            });
            const productsList = this.products;
            this.allProducts = productsList;
        }
    }
</script>
