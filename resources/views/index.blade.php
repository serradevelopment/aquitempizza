<!DOCTYPE HTML>
<html lang="pt_br">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="copyright" content="Aqui Tem Pizza" />
    <title>Aqui Tem Pizza</title>  
    
    <meta name="keywords" content="Aqui tem pizza, pizzaria, delivery de pizza, pizzaria valença, pizzaria valenca rj, aquitempizza" />
    <meta name="description" content="O melhor delivery de pizza é aqui! Venha conhecer e faça já o seu pedido! Aqui Tem Pizza Delivery.">
    <meta name="author" content="contato@serradev.com.br">
    <meta name="subject" content="Realize seu pedido pelo nosso site. Aqui tem pizza, o melhor delivery de pizza da cidade!">
    <meta name="url" content="http://www.aquitempizza.com">
    <meta name="language" content="pt_br">
    <meta name="Classification" content="WebSites">
    <meta name="image" content="http://www.aquitempizza.com.br/images/aquitempizza.png"/>

    
    <!-- Open Graph meta -->
    <meta property="og:title" content="Serra Development"/>
    <meta property="og:type" content="website" />
    <meta property="og:image" content="http://www.aquitempizza.com.br/images/aquitempizza.png"/>
    <meta property="og:description" content="O melhor delivery de pizza é aqui! Venha conhecer e faça já o seu pedido! Aqui Tem Pizza Delivery."/>
    <meta property="og:email" content="contato@serradev.com.br"/>
    <meta property="og:phone_number" content="(24)99873-4138"/>
    <meta property="og:site_name" content="Aqui tem pizza" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="http://www.agenciadedigitadores.online/images/aquitempizza.png" type="image/x-icon" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="fonts/beyond_the_mountains-webfont.css" type="text/css"/>

    <!-- Stylesheets -->
    <link href="plugin-frameworks/bootstrap.min.css" rel="stylesheet">
    <link href="plugin-frameworks/swiper.css" rel="stylesheet">
    <link href="fonts/ionicons.css" rel="stylesheet">
    <link href="common/styles.css" rel="stylesheet">
    <link rel="manifest" href="http://aquitempizza.com/manifest.json">
    <link rel="stylesheet" href="common/animate.css">
    @laravelPWA
    <style type="text/css">

        #style-3::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar
        {
            width: 6px;
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar-thumb
        {
            background-color: #000000;
        }

        .card-pcc{
            background-color: #dc3545bf;
            color: white;
            border-radius: 8%;
            padding: 10px;
            margin: auto!important;
            transition: transform 1s;
        }
        .card-pcc:hover{
            box-shadow: 1px 1px 20px 0px black;
            background-color:#dc3545;
            transform: scale(1.1);
        }
        .card-pcc p{
            color: white;
            font-style: italic;
            font-family: cursive;
        }

    </style>
</head>

<body>
    <div id="pre-load" >
        <div class="container center ">
            <div class="row">
                <lottie-player src="https://assets4.lottiefiles.com/temp/lf20_7bMJGd.json"  background="transparent"  speed="1"  style="width: 100%; height: 100%;"  loop autoplay >
                </lottie-player>             
            </div>
        </div>

    </div>

    <!-- <h6><a class="plr-20 color-white btn-fill-primary" href="https://api.whatsapp.com/send?phone=5524998160954&text=Olá, gostaria de fazer um pedido." target="_blank">Pedidos: (24) 99816-0954</a></h6> -->


    <div class="body" style="display: none"  >
        <div id="app">

            <header>
                <div class="container">
                    <div >
                        <a class="logo" href="#"><img src="images/aquitempizza.png" alt="Logo"></a>
                    </div>
                    <div class="right-area" style="position: fixed; bottom: 0;right: 0;left: 0">
                        <cart :freights="{{ json_encode(App\Freight::all()) }}"></cart>

                    </div><!-- right-area -->

                    <div class="clearfix"></div>
                </div><!-- container -->
            </header>


            <section class="bg-pizza1 h-800x main-slider pos-relative">
                <div class="triangle-up pos-bottom"></div>
                <div class="container h-100">
                    <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white">

                            <h5><b>O VERDADEIRO SABOR DA PIZZA</b></h5>
                            <h1 class="mt-30 mb-15 animated zoomIn">Aqui tem Pizza</h1>
                        </div><!-- dplay-tbl-cell -->
                    </div><!-- dplay-tbl -->
                </div><!-- container -->
            </section>


            <section class="story-area left-text center-sm-text pos-relative">
                <div class="abs-tbl bg-2 w-20 z--1 dplay-md-none" ></div>
                <div class="abs-tbr bg-3 w-20 z--1 dplay-md-none"></div>
                <div class="container">
                    <div class="heading">
                        <img class="heading-img" src="images/heading_logo.png" alt="">
                        <h2>Porque comprar conosco?</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-4" style="margin-top: 15px">
                            <div class=" ftco-animate fadeInUp ftco-animated card-pcc">
                                <div class="media d-block text-center block-6 services">
                                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                                        <img src="images/receita.png" style="height: 70px; width: auto">
                                    </div>
                                    <div class="media-body">
                                        <h3 class="heading">O preparo</h3>
                                        <p>Uma pizza gostosa não é feita só de massa, molho e recheio.  
                                            É preciso  conhecimento para  saber os sabores que combinam,  as quantidades na medida certa para que não haja excessos, forno  no tempo certo e a pizza assada no ponto correto.  
                                        Além de tudo isso, também é preciso muito carinho, dedicação, criatividade e um ingrediente secreto... muito amor ao fazer e montar as pizzas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top: 15px">

                            <div class=" ftco-animate fadeInUp ftco-animated card-pcc">
                                <div class="media d-block text-center block-6 services">
                                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                                        <img src="images/entregador.png" style="height: 70px; width: auto">
                                    </div>
                                    <div class="media-body">
                                        <h3 class="heading">A entrega</h3>
                                        <p>Nós sabemos da sua fome! Pensamos no melhor para nossos clientes, e além do atendimento especial, tivemos o cuidado de contratar os melhores entregadores para que a pizza chegue em sua residência quentinha e saborosa, do jeito que você espera!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top: 15px">

                            <div class=" ftco-animate fadeInUp ftco-animated card-pcc" >
                                <div class="media d-block text-center block-6 services">
                                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                                        <img src="images/pizza.png" style="height: 70px; width: auto">
                                    </div>
                                    <div class="media-body">
                                        <h3 class="heading">O sabor</h3>
                                        <p>Nosso molho é totalmente artesanal, com tomates italianos e manjericão selecionados e frescos.
                                            Os produtos utilizados nos caprichados recheios são de marcas conhecidas e manuseados com padrão de higiene correto.
                                        Por tudo isso, as pizzas da Aqui Tem Pizza são gostosas e com sabores inigualáveis e fantásticos, que enchem os olhos dos nossos Clientes e satisfazem suas vontades e desejos.   </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- container -->
            </section>


            <section class="story-area bg-seller color-white pos-relative">
                <div class="pos-bottom triangle-up"></div>
                <div class="pos-top triangle-bottom"></div>
                <div class="container">
                    <div class="heading">
                        <img class="heading-img" src="images/heading_logo.png" alt="">
                        <h2>Mais vendidos</h2>
                    </div>
                    <tops :products="{{App\Product::where('is_top',true)->get()->toJson()}}"></tops>
                </div>
            </section>


            <section>
                <div class="container">
                    <div class="heading">
                        <img class="heading-img" src="images/heading_logo.png" alt="">
                        <h2>Nosso Menu</h2>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="selecton brdr-b-primary mb-15">
                                <li><a class="active" href="#" data-select="PIZZAS"><b>PIZZAS</b></a></li>
                                <li><a href="#" id="bebidas" data-select="BEBIDAS"><b>BEBIDAS</b></a></li>
                                <li><a  href="#" id="montar" data-select="MONTAR"><b>MONTE SUA PIZZA</b></a></li>
                            </ul>
                        </div><!--col-sm-12-->
                    </div><!--row-->

                    <product-list :products="{{json_encode(App\Product::where('locked',false)->get())}}"></product-list>
                </section>

            </div>

            <footer class="pb-50  pt-70 pos-relative">
                <div class="pos-top triangle-bottom"></div>
                <div class="container-fluid">
                    <a href="#"><img src="images/aquitempizza.png" style="height: 150px; width: auto" alt="Logo"></a>

                    <div class="">

                        <div class="row">
                            <div class="pt-30 col-md-4">
                                <p class="underline-secondary"><b>Endereço:</b></p>
                                <p>Rodovia RJ 145, nº 26415, Canteiro </p>
                            </div>
        
                            <div class="pt-30 col-md-4">
                                <p class="underline-secondary mb-10"><b>Telefone:</b></p>
                                <a href="tel:+55 24 998160954 ">(24) 99816-0954 </a> | 
                                <a href="tel:+55 24 24535000 ">(24) 2453-5000 </a>
                            </div>
        
                            <div class="pt-30 col-md-4">
                                <p class="underline-secondary mb-10"><b>Email:</b></p>
                                <a href="mailto:aquitempizzas@gmail.com"> aquitempizzas@gmail.com</a>
                            </div>
                        </div>
                        
                        <div class="row">
                            <ul class="icon mt-30" style="margin:auto">
                                <li><a href="https://www.facebook.com/aquitempizza" target="_blank"><i class="ion-social-facebook"></i></a></li>
                            </ul>
                        </div>
                   
                        <div class="row">
                            <p class="color-light font-9 mt-50 mt-sm-30 mb-10" style="margin:auto"> 
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                                Todos direitos reservados | Este site foi desenvolvido por  
                                <a href="https://www.serradev.com.br" target="_blank">Serra Development</a> 
                            </p>
                        </div>
                    
                </div><!-- container -->
            </footer>
        </div>

        <!-- SCIPTS -->
        <script src="js/app.js"></script>

        <script src="plugin-frameworks/swiper.js"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <script src="common/scripts.js"></script>


        <script type="text/javascript">
            $(document).ready(function(){
             setInterval(function(){ 
                $("#pre-load").css('display','none');
                $(".body").css('display','block');
            }, 2000); 
         });
     </script>


 </body>
 </html>