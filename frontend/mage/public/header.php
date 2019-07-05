<head>
   <meta name="keywords" content="mage, telematics, multimedia, its, game, event, komputer, esport, teknologi">
   <meta name="description" content="MAGE merupakan serangkaian Kompetisi IT yang diadakan oleh Departemen Teknik Komputer Fakultas Teknologi Elektro ITS Surabaya sebagai media bagi pelajar dan akademisi dalam mengeksplorasi kreativitas, inovasi dan kemampuan dalam bidang IT seperti IoT, Game Dev, Apps Dev dan masih banyak lagi.">
   <meta name="subject" content="MAGE - Multimedia and Game Event">
   <meta name="robots" content="index,follow">
   <meta name="application-name" content="mage">
   <meta name="author" content="MageR">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title><?= $title ?></title>
   <link rel="shortcut icon" type="image/x-icon" href="public/img/mage/logo.png">
   <!--Import Google Icon Font-->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
   <!--Import materialize.css-->
   <link rel="stylesheet" href="public/css/materialize.min.css"  media="screen,projection"/>
   <noscript>javascript mode is off.. some functions can't work well..</noscript>
</head>
<body>
   <!--Import jQuery before materialize.js-->
   <script type="text/javascript" src="public/js/jquery.min.js"></script>
   <script type="text/javascript" src="public/js/materialize.min.js"></script>
   <script>
      $(document).ready(function(){
      
        $('.menu-btn').click(function(){
          $('.menu').toggleClass("slide-menu");
        });
      
      });
   </script>
   <style>
      /** menu header **/
      .menu{
      position: fixed;
      background: #f6f6f6;
      color: #232323;     
      height: 100%;
      width: 200px;
      top: 0;
      right: -300px;
      -webkit-transition: right 0.5s;
      transition: right 0.5s;
      padding: 20px;
      border: 1px solid #ccc;
      z-index:2;
      }
      .menu ul{
      padding: 0;
      }
      .menu li{
      list-style-type: none;
      padding: 0px 0px;
      }
      .menu a{
      color: #232323;
      text-decoration: none;
      font-size: 10pt;
      }
      .menu a:hover{
      color: #7a4c03;
      font-weight:bold;
      font-size: 12pt;
      background-color: transparent;
      }
      .menu-btn{
      float: right;
      background: transparent;
      color: orange;
      border: 0.5px solid #fff;
      cursor: pointer;
      }
      .slide-menu{
      right: 0 !important;
      z-index:20;
      }
      .close{
      color: #232323;
      float: none;
      }
      /** **/
      .header{
      position: fixed;
      width: 100%;
      background: white;
      z-index: 10;
      }
      ::-webkit-scrollbar
      {
      width: 7px;  /* for vertical scrollbars */
      height: 5px; /* for horizontal scrollbars */
      }
      ::-webkit-scrollbar-track
      {
      background:orange;
      }
      ::-webkit-scrollbar-thumb
      {
      background:url('public/img/bgc.png');
      }
      @media only screen and (min-width: 993px) {
      .row .col.push-l1-5 {
      left:12.3333333333%;
      }
      }
      @media screen and (max-width: 1920px) {
      .home{
      padding-bottom:200px; 
      padding-top:170px; 
      padding-left:100px; 
      padding-right:100px;
      }
      .about{
      padding-bottom:170px; 
      padding-top:180px; 
      padding-left:100px;
      padding-right:100px;
      }
      .t1{
      font-size:18px; 
      }
      .t2{
      font-size:30px; 
      }
      .nor{
      display:block;
      }
      .gaknor{
      display:none;
      }
      .ad{
      border-right:solid silver 2px;
      }
      #men li a{
      background:#e86240;
      color:white;
      }
      #men li a:hover{
      background:white;
      color:#e86240;
      }
      .carousel{
      height:650px;
      }
      .ll{
      padding:17px;
      }
      }
      @media screen and (max-width: 1030px) {
      .home{
      padding-bottom:150px; 
      padding-top:170px; 
      padding-left:70px; 
      padding-right:70px;
      }
      .about{
      padding-bottom:200px; 
      padding-top:100px; 
      padding-left:100px;
      padding-right:100px;
      }
      }
      @media screen and (max-width: 990px) {
      .home{
      padding-bottom:150px; 
      padding-top:120px; 
      padding-left:70px; 
      padding-right:70px;
      }
      .about{
      padding-bottom:200px; 
      padding-top:100px; 
      padding-left:50px;
      padding-right:50px;
      }
      .nor{
      display:none;
      }
      .gaknor{
      display:block;
      }
      .carousel{
      height:600px;
      }
      .ll{
      padding:20px;
      }
      }
      @media screen and (max-width: 480px) {
      .home{
      padding-bottom:150px; 
      padding-top:120px; 
      padding-left:10px; 
      padding-right:10px;
      }
      .about{
      padding-bottom:200px; 
      padding-top:100px; 
      padding-left:20px;
      padding-right:20px;
      text-align:center;
      }
      .t1{
      font-size:12px; 
      }
      .t2{
      font-size:18px; 
      }
      .nor{
      display:none;
      }
      .gaknor{
      display:block;
      }
      .ad{
      border-left: solid silver 0px;
      }
      .carousel{
      height:400px;
      }
      }
   </style>
   <!--nav-->
   <div class="header">
      <div class=" row col l12 m12 s12" style="padding-top:8px; margin:0px;">
         <div class="col l5 m10 s10">
            <a href="./"><img src="public/img/Logo MAGE Horizontal.png" style="width : 25%;"></a>
         </div>
         <!-- menu -->
         <div class="col m1 s2 push-m1 gaknor" style="text-align: center">
            <button class="menu-btn material-icons">menu</button>
            <nav class="menu" style="overflow-y: auto">
               <h5 class="menu-btn close">x</h5>
               <ul>
                  <li>
                     <a href="play" style="color:black;">Play Me ^^</a> 
                  </li>
                  <li>
                     <a href="#" class='dropdown-button' style="color:black;" data-activates='m-info' data-constrainwidth='false'>Information</a>
                     <ul id='m-info' class='dropdown-content'>
                        <li><a href="gallery">Gallery</a></li>
                        <li><a href="https://drive.google.com/drive/folders/1v66ju5bqK876Ln4OEIJ7Tyaxo6o2Z4DF?usp=sharing">Guide Book</a></li>
                        <li><a href="./#timeline">Timeline</a></li>
                        <li><a href="./#news">What's New?</a></li>
                        <li><a href="#footer">Contact</a></li>
                        <li><a href="apa-kata-mereka">Apa Kata Mereka?</a></li>
               
                     </ul>
                  </li>
                  <li>
                     <a href="about" style="color:black;">About</a>
                  </li>
                  <li>
                     <a href="#competition" class='dropdown-button' style="color:black;" data-activates='m-comp' data-constrainwidth='false'>Competition</a>
                     <ul id='m-comp' class='dropdown-content'>
                        <li><a href="game">Game</a></li>
                        <li><a href="app">App</a></li>
                        <li><a href="iot">IoT</a></li>
                        <li><a href="esport">E-Sport</a></li>
                     </ul>
                  </li>
                  <li><a href="./#event" style="color:black;">Event</a></li>
                  <li>
                     <a href="#" class='dropdown-button' data-activates='m-regist' data-constrainwidth='false'>Registration</a>
                     <ul id="m-regist" class="dropdown-content">
                        <li><a href="register/competition">Competition</a></li>
                        <li><a href="register/esport">E-Sport</a></li>
                        <li><a href="register/workshop">Workshop</a></li>
                     </ul>
                  </li>
                  <li><a href="account/login" style="color: blue">Login</a></li>
               </ul>
            </nav>
         </div>
         
         <div class="row col l6 m6 s6 push-l1 nor" style="text-align : center;">
            <!--<a href="#home"><div class="col l2 m2 s2" style="color:black;">Home
               </div></a>-->
            <div class="col l2 m2 s2">
               <a href="#" class='dropdown-button' style="color:black;" data-activates='info' data-constrainwidth='false'>Information</a>
               <ul id='info' class='dropdown-content'>
                  <li><a href="gallery">Gallery</a></li>
                  <li><a href="https://drive.google.com/drive/folders/1v66ju5bqK876Ln4OEIJ7Tyaxo6o2Z4DF?usp=sharing">Guide Book</a></li>
                  <li><a href="./#timeline">Timeline</a></li>
                  <li><a href="./#news">What's New?</a></li>
                  <li><a href="#footer">Contact</a></li>
                  <li><a href="apa-kata-mereka">Apa Kata Mereka?</a></li>
                  <li><a href="play">Play Me ^^</a></li>
               </ul>
            </div>
            <div class="col l2 m2 s2">
               <a href="about" style="color:black;">About</a>
            </div>
            <div class="col l2 m2 s2">
               <a href="#competition" class='dropdown-button' style="color:black;" data-activates='comp' data-constrainwidth='false'>Competition</a>
               <ul id='comp' class='dropdown-content'>
                  <li><a href="game">Game</a></li>
                  <li><a href="app">App</a></li>
                  <li><a href="iot">IoT</a></li>
                  <li><a href="esport">E-Sport</a></li>
               </ul>
            </div>
            <div class="col l2 m2 s2">
               <a href="./#event" style="color:black;">Event</a> 
            </div>
            <div class="col l2 m2 s2">
               <a href="#" class='dropdown-button' style="color:black;" data-activates='regist' data-constrainwidth='false'>Registration</a>
               <ul id='regist' class='dropdown-content'>
                  <li><a href="register/competition">Competition</a></li>
                  <li><a href="register/esport">E-Sport</a></li>
                  <li><a href="register/workshop">Workshop</a></li>
               </ul>
            </div>
            <div class="col l2 m2 s2">
               <a href="account/login">Login</a>
            </div>
         </div>
      </div>
   </div>
   <div style="padding-top: 50px"></div>