<template>
    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="modalCart" aria-hidden="true"
         v-if="productsInCart.length != 0 ">
        <!--  <img src="/images/motoboy.png" id="dropdownMenu2" data-toggle="dropdown"-->
        <!--          aria-haspopup="true"-->
        <!--          aria-expanded="false" style="width: 200px; height: 200px; cursor: pointer">-->
        <div class="modal-dialog" role="menu" v-if="productsInCart.length != 0">
            <div class="modal-content" v-if="!finished">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCart">Resumo do pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <li v-for="(p,i) in productsInCart" :key="i"
                        style="box-shadow: 1px 1px 0px 0px;border-radius: 20px;margin-bottom: 10px;">
            <span class="item">
              <span class="item-left">
                <!-- <img src="http://lorempixel.com/50/50/" alt="" /> -->
                <span class="item-info">
                  <span style="font-weight: 900;font-size: large;">{{p.name}}</span>
                  <span style="font-weight: 900;font-size: medium;">R$ {{p.value.toFixed(2)}}</span>
                  <span style="font-style: italic;" v-if="p.note">Observação: {{p.note}}</span>
                  <span style="font-style: bold;font-size: medium" v-if="p.additionals">Adicionais:
                    <p v-for="a in p.additionals">1x {{a.name}} - R$ {{a.price.toFixed(2)}}</p>
                  </span>
                </span>
              </span>
              <span class="item-right" style="margin: 10px;">
                <span class="badge badge-danger p-2 pull-right" @click="removeFromCart(p)">x</span>
              </span>
            </span>
                    </li>
                    <li class="divider"></li>
                    <div style="padding: 10px;  background-color:  rgb(246 254 69 / 0%);     margin-top: 20px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <label>Nome:</label>
                                    <input type="text" style="width: -webkit-fill-available;" v-model="user.name"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Endereço:</label>
                                    <input type="text" style="width: -webkit-fill-available;" v-model="user.address"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Bairro:</label>
                                    <select required v-model="user.neighborhood" class="form-control select-2">
                                        <option :value="f" v-for="f in freights" :key="f.id">{{f.neighborhood}}</option>
                                    </select>
                                    <p
                                        v-if="user.neighborhood.value == null"
                                        style="color:red"
                                    >No momento não fazemos entrega para este bairro.</p>
                                </div>
                            </div>
                            <hr/>
                        </div>

                        <div class="container" v-if="troco == 0">
                            <div class="row">
                                <div class="col-6">
                                    <label>Pagamento em cartão?</label>
                                </div>
                                <div class="col-6">
                                    <input
                                        type="checkbox"
                                        style="width: auto"
                                        v-model="is_card"
                                        value="true"
                                        name
                                        class="mt-20 form-control"
                                    />
                                </div>
                            </div>
                            <hr/>
                        </div>

                        <div class="container row" v-if="is_card == false">
                            <div class="col-6">
                                <span style>Troco para:</span>
                            </div>
                            <div class="col-6">
                                <input type="number" v-model="troco" class="form-control money-mask"/>
                            </div>
                            <hr/>
                        </div>

                        <div class="container row">
              <span
                  style="color: black;padding: 10px;float: right;"
                  v-if="user.neighborhood.value != null"
              >Frete: R$ {{(configuration.is_freight_unique)?configuration.freight_value:user.neighborhood.value.toFixed(2)}}</span>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-success"
                            @click="sendOrder()"
                            v-if="user.neighborhood.value != null"
                        >Enviar Pedido
                        </button>

                        <span class="badge badge-danger m-2"
                              style="font-size: 16px;color: white;float: right; display: inline-flex">Total: R$ {{getTotalCartValue}}</span>
                    </div>
                </div>

            </div>
            <div class="modal-content" v-if="finished">
                <div class="modal-header">
                    <h5 class="modal-title">Resumo do pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="badge badge-success" style="font-size: large;margin: 15px;">Pedido realizado com sucesso.</span>
                    <button class="btn btn-primary" style="    margin: 15px;float: right;" @click="finished = false">Novo pedido</button>
                </div>
            </div>

        </div>

        <!--        <ul aria-labelledby="dropdownMenu2" role="menu" v-else>-->
        <!--          <li>-->
        <!--            <h5 style="display: block; text-align: center;margin: auto">Vazio</h5>-->
        <!--          </li>-->
        <!--        </ul>-->
    </div>
</template>

<script>
    export default {
        props: ["freights", "configuration"],
        data() {
            return {
                finished: false,
                troco: 0,
                is_card: false,
                user: {
                    name: null,
                    address: null,
                    neighborhood: {
                        value: null
                    }
                }
            };
        },
        computed: {
            productsInCart() {
                return this.$store.state.cart.products;
            },
            getTotalCartValue() {
                var total = this.$store.getters.getTotal;
                this.$store.commit('updateTotal', total);
                total += ((this.configuration.is_freight_unique) ? this.configuration.freight_value : this.user.neighborhood.value);
                return total.toFixed(2);
            }
        },
        methods: {
            is_selected(f) {
                return this.user.neighborhood == f.id ? true : false;
            },
            removeFromCart(s) {
                this.$store.commit('removeFromCart', s);
                if (this.productsInCart.length == 0) {
                    this.$store.commit('updateTotal', 0);
                    $('#modalCart').modal('toggle');
                }
            },
            storeOrder() {
                console.log(this.productsInCart)
                var user = this.user;
                axios
                    .post("/orders", {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        client_name: user.name,
                        client_address: user.address,
                        is_card: this.is_card,
                        troco: this.troco,
                        freight_id: this.user.neighborhood.id,
                        products: this.productsInCart,
                        total: parseFloat(this.getTotalCartValue)
                    })
                    .then(response => {
                        var pizzas = "Pizzas:\n";
                        var bebidas = "\nBebidas:\n";
                        var card = "Pagamento com cartão";
                        var text = "";


                        text += "*--------------AQUI TEM PIZZA-----------*\n";
                        text += "             _" + moment().format('L') + " às " + moment().format('LTS') + "_           \n";
                        text += "PEDIDO: #" + response.data.id + "\n";
                        text += "CLIENTE: " + this.user.name + "\n";
                        text += "ENDEREÇO: " + this.user.address + "\n";
                        text += "BAIRRO: " + this.user.neighborhood.neighborhood + "\n";
                        text += "*----------------PAGAMENTO--------------*\n";
                        text += "FRETE: R$ " + ((this.configuration.is_freight_unique) ? this.configuration.freight_value : this.user.neighborhood.value.toFixed(2)) + "\n";
                        if (this.troco != 0) {
                            text += " | Troco para: R$" + this.troco;
                            text += "\nTroco: R$" + (this.troco - this.getTotalCartValue).toFixed(2);
                        }
                        if (this.is_card) {
                            text += "\n" + card;
                        }
                        text += "\n*------------------PEDIDO-----------------*\n";


                        for (var i = 0; i < this.productsInCart.length; i++) {
                            if (this.productsInCart[i].category == "PIZZAS") {
                                pizzas += "*1 x " + this.productsInCart[i].name + " = R$" + this.productsInCart[i].value.toFixed(2) + "*\n";
                                if (this.productsInCart[i].note) {
                                    pizzas += 'Obs: _' + this.productsInCart[i].note + '_\n';
                                }
                                if(this.productsInCart[i].additionals){
                                    pizzas += 'Adicionais:\n';
                                    for(var j = 0; j < this.productsInCart[i].additionals.length; j++){
                                        pizzas += '1x '+this.productsInCart[i].additionals[i].name+'\n';
                                    }
                                }
                            }
                            if (this.productsInCart[i].category == "BEBIDAS") {
                                bebidas += "*1 x " + this.productsInCart[i].name + " = R$" + this.productsInCart[i].value.toFixed(2) + "*\n";
                            }
                        }

                        text += pizzas;
                        text += bebidas;
                        text += "*----------------------------------------------*\n";
                        text += "*TOTAL: R$" + this.getTotalCartValue + "*";


                        text = window.encodeURIComponent(text);
                        var url =
                            "https://api.whatsapp.com/send?phone=5524998160954&text=" + text;
                        var win = window.open(url, "_blank");
                        win.focus();
                        this.finished = true;
                    }).catch(error => {
                    console.log(error);
                });
            },
            sendOrder() {
                if (
                    this.user.name &&
                    this.user.address &&
                    this.user.neighborhood.value != null
                ) {
                    this.$cookies.set("user", this.user);
                    this.storeOrder();
                }
            }
        },
        mounted() {
            moment.locale('pt-br')

            var user = this.$cookies.get("user");
            if (user != null) {
                this.user.name = this.$cookies.get("user").name;
                this.user.address = this.$cookies.get("user").address;
            }

            $(document).on("click", ".dropdown-menu", function (e) {
                e.stopPropagation();
            });
        }
    };
</script>
<style type="text/css">
    .btn-primaryc:hover {
        color: black !important;
        background: #e4ff04 !important;
    }

    /*.on-add {*/
    /*  -webkit-transition: max-height 0.8s;*/
    /*  -moz-transition: max-height 0.8s;*/
    /*  transition: max-height 0.8s;*/
    /*  animation: SHW 2.5s;*/
    /*    -webkit-animation-fill-mode: forwards; !* Chrome 16+, Safari 4+ *!*/
    /*    -moz-animation-fill-mode: forwards;    !* FF 5+ *!*/
    /*    -o-animation-fill-mode: forwards;      !* Not implemented yet *!*/
    /*    -ms-animation-fill-mode: forwards;     !* IE 10+ *!*/
    /*    animation-fill-mode: forwards;         !* When the spec is finished *!*/
    /*}*/

    /*@keyframes SHW {*/
    /*    0% {*/
    /*        left: 0%;*/
    /*    }*/
    /*  59% {*/
    /*      left: -100%;*/
    /*      opacity: 0;*/
    /*  }*/
    /*  60% {*/
    /*    left: 100%;*/
    /*      opacity: 0;*/

    /*  }*/
    /*  100% {*/
    /*      left: 0%;*/
    /*      opacity: 1;*/
    /*  }*/
    /*}*/

    dropdown-cart {
        min-width: 250px;
        overflow: auto;
        max-height: 300px;
    }

    .item {
        display: block;
        padding: 3px 10px;
        margin: 3px 0;
    }

    li button {
        display: block;
        text-align: center;
    }

    .item:hover {
        background-color: #f3f3f3;
    }

    .item:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

    li {
        display: block !important;
    }

    .item-left {
        float: left;
    }

    .item-left img,
    .item-left span.item-info {
        float: left;
    }

    .item-left span.item-info {
        margin-left: 10px;
    }

    .item-left span.item-info span {
        display: block;
    }

    .item-right {
        float: right;
    }

    .item-right button {
        margin-top: 14px;
    }
</style>
