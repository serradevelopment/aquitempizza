<template>
  <div class="dropdown">
    <button
      class="plr-20 color-white btn-primaryc"
      type="button"
      id="dropdownMenu2"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >PEDIDO</button>

    <ul
      class="dropdown-menu dropdown-cart"
      aria-labelledby="dropdownMenu2"
      role="menu"
      v-if="productsInCart.length != 0"
    >
      <li v-for="(p,i) in productsInCart" :key="i" style="box-shadow: 1px 1px 4px 0px;">
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
        <div class="container">
          <div class="row">
            <div class="col-12">
              <label>Nome:</label>
              <input type="text" style="width: auto" v-model="user.name" class="form-control" />
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label>Endereço:</label>
              <input type="text" style="width: auto" v-model="user.address" class="form-control" />
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
          <hr />
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
          <hr />
        </div>

        <div class="container row" v-if="is_card == false">
          <div class="col-6">
            <span style>Troco:</span>
          </div>
          <div class="col-6">
            <input type="number" v-model="troco" class="form-control money-mask" />
          </div>
          <hr />
        </div>

        <div class="container row">
          <span
            style="color: black;padding: 10px;float: right;"
            v-if="user.neighborhood.value != null"
          >Frete: R$ {{user.neighborhood.value.toFixed(2)}}</span>
        </div>

        <li>
          <span style="color: black;padding: 10px;float: right;">Total: R$ {{getTotalCartValue}}</span>
        </li>

        <li>
          <button
            type="submit"
            class="btn btn-success"
            @click="sendOrder()"
            v-if="user.neighborhood.value != null"
          >Enviar Pedido</button>
        </li>
      </div>
    </ul>

    <ul class="dropdown-menu dropdown-cart" aria-labelledby="dropdownMenu2" role="menu" v-else>
      <li>
        <h5 style="display: block; text-align: center;margin: auto">Vazio</h5>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["freights"],
  data() {
    return {
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
      var total = 0;
      for (var i = this.productsInCart.length - 1; i >= 0; i--) {
        total += this.productsInCart[i].value;
      }
      total += this.user.neighborhood.value;
      return total.toFixed(2);
    }
  },
  methods: {
    is_selected(f) {
      return this.user.neighborhood == f.id ? true : false;
    },
    removeFromCart(s) {
      var index = this.$store.state.cart.products.indexOf(s);
      if (index > -1) {
        this.$store.state.cart.products.splice(index, 1);
      }
    },
    storeOrder() {
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
          text += "             _"+moment().format('L')+" às "+moment().format('LTS')+"_           \n";
          text += "PEDIDO: #"+response.data.id+"\n";
          text += "CLIENTE: " + this.user.name + "\n";
          text += "ENDEREÇO: " + this.user.address + "\n";
          text += "BAIRRO: " + this.user.neighborhood.neighborhood + "\n";
          text += "*----------------PAGAMENTO--------------*\n";
          text += "FRETE: R$ " + this.user.neighborhood.value.toFixed(2) + "\n";
          text += "*TOTAL: R$" + this.getTotalCartValue+"*";
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
              pizzas += "*1 x " + this.productsInCart[i].name + " = R$"+this.productsInCart[i].value.toFixed(2)+"*\n";
            }
            if (this.productsInCart[i].category == "BEBIDAS") {
              bebidas += "*1 x " + this.productsInCart[i].name + " = R$"+this.productsInCart[i].value.toFixed(2)+"*\n";
            }
          }

          text += pizzas;
          text += bebidas;
          text += "*----------------------------------------------*\n";
          

          text = window.encodeURIComponent(text);
          var url =
            "https://api.whatsapp.com/send?phone=5524998160954&text=" + text;
          var win = window.open(url, "_blank");
          win.focus();
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

    $(document).on("click", ".dropdown-menu", function(e) {
      e.stopPropagation();
    });
  }
};
</script>
<style type="text/css">
.btn-primaryc:hover{
  color: black!important;
  background: #e4ff04!important;
}

.on-add {
  -webkit-transition: max-height 0.8s;
  -moz-transition: max-height 0.8s;
  transition: max-height 0.8s;
  animation: SHW 0.5s;
  animation-fill-mode: both;
}

@keyframes SHW {
  0% {
    transform: scale(0.2);
    opacity: 0;
  }
  50% {
    transform: scale(2);
    opacity: 0.5;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

ul.dropdown-cart {
  min-width: 250px;
  overflow: auto;
  max-height: 300px;
}
ul.dropdown-cart li .item {
  display: block;
  padding: 3px 10px;
  margin: 3px 0;
}
ul.dropdown-cart li button {
  display: block;
  text-align: center;
}

ul.dropdown-cart li .item:hover {
  background-color: #f3f3f3;
}
ul.dropdown-cart li .item:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}
ul.dropdown-cart li {
  display: block !important;
}
ul.dropdown-cart li .item-left {
  float: left;
}
ul.dropdown-cart li .item-left img,
ul.dropdown-cart li .item-left span.item-info {
  float: left;
}
ul.dropdown-cart li .item-left span.item-info {
  margin-left: 10px;
}
ul.dropdown-cart li .item-left span.item-info span {
  display: block;
}
ul.dropdown-cart li .item-right {
  float: right;
}
ul.dropdown-cart li .item-right button {
  margin-top: 14px;
}
</style>