<html>
   <?php
      $title = "MAGE 2018 - Multimedia and Game Event"; 
      include "header.php";
      ?>
   <!-- particles.js container -->
   <div id="particles-js"></div>
   <style>
      #particles-js {
      background: url('public/img/polos.png');
      background-size: cover;
      position:fixed;
      top:0;
      right:0;
      bottom:0;
      left:0;
      z-index:-1; 
      }
   </style>
   <script src="public/js/particles.js"></script>
   <script src="public/js/app.js"></script>   
   <script>
      var update;
      update = function() {
        requestAnimationFrame(update);
      };
      requestAnimationFrame(update);
   </script>  
   
   <script>
      $(document).ready(function(){
         $('.modal').modal({
            dismissible: true, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            inDuration: 500, // Transition in duration
            outDuration: 200, // Transition out duration
            startingTop: '4%', // Starting top style attribute
            endingTop: '10%', // Ending top style attribute
            //ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
              //  alert("Ready");
                //console.log(modal, trigger);
            //},
            //complete: function() { alert('Closed'); } // Callback for Modal close
         });

         $('.modal').modal('open'); 
      });

   </script>

   <!-- Modal Structure -->
   <div id="modal1" class="modal modal-fixed-footer">
     <div class="modal-content" style="background-color: #0b0b0b;text-align: center">
         <img src='public/img/mage/play.jpg' style="height: 100%">
     </div>
     <div class="modal-footer">
       <a href="play" class=" modal-action waves-effect waves-green btn-flat">Play</a>
       <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
     </div>
   </div>

   <!-- Modal Structure -->
   <div id="modal1" class="modal modal-fixed-footer">
     <div class="modal-content" style="background-color: #0b0b0b;text-align: center">
         <img src='public/img/mage/extends-main.jpg' style="height: 100%">
     </div>
     <div class="modal-footer">
       <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
     </div>
   </div>


   <!--home-->
   <div id="home" class="row col xl12 l12 m12 s12 home" style=" //background: url('public/img/BGT1.jpg'); margin:0px;">
      <div class="col xl5 l5 m12 s12">
         <div style=""><b><i class="t1" style=" color:#FFFFFF;">MAGE 2018</i></b>
         </div>
         <div style=""><b><i class="t2" style="color:#FFFFFF;">EXPLORING DIGITAL <br> TECHNOLOGY FOR <br>INDONESIAN SOCIETY <br>  __________</i></b>
         </div>
      </div>
      <div class="row col xl6 l6 m12 s12">
         <img src="public/img/Peta5.png" style="width:100%;">
      </div>
   </div>
   <!--About-->
   <div id="about" class="row col xl12 l12 m12 s12 about" style="background-color: #f7f7f7;">
      <div class="col xl4 l4 m6 s12" style="">
         <img src="public/img/Logo MAGE Verticall.png" style="width:75%;">
      </div>
      <div class="col xl8 l8 m6 s12" style="color:#000000; text-align:justify;">
         <p>
            <b>MAGE (Multimedia and Game Event)</b> merupakan serangkaian Kompetisi IT yang diadakan oleh Departemen Teknik Komputer Fakultas Teknologi Elektro ITS Surabaya sebagai media bagi pelajar dan akademisi dalam mengeksplorasi kreativitas, inovasi dan kemampuan dalam bidang IT seperti IoT, Game Dev, Apps Dev dan masih banyak lagi.  Departemen Teknik Komputer adalah salah satu Departemen yang berada dibawah naungan Fakultas Teknologi Elektro ITS. Departemen Teknik Komputer memiliki Akreditasi A. Adapun disiplin ilmu yaitu  mewujudkan ilmu pengetahuan dan teknologi dari desain, membangun, implementasi, dan pemeliharaan perangkat lunak dan perangkat keras dari sistem komputasi modern, peralatan dikontrol komputer, dan jaringan perangkat cerdas.
         </p>
         <a href="about" style="color: white">
            <div class="btn" style="background :url('public/img/tb.png') ; margin-top:10px;">
               Read More
            </div>
         </a>
      </div>
   </div>
   <!--Competition-->
   <div id="competition" class="row col xl12 l12 m12 s12" style="background-color: #EAEAEA; padding-bottom:10px; padding-top: 100px;margin-top:-20px" >
      <div align="center">
         <h3><b><i>COMPETITION</i></b></h3>
      </div>
      <div class="comp" align="center" style="">
         <div class="col xl3 s12 m6 l3">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bgc.png'); background-size:cover; text-align:center; padding:30px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;">
                     <img src="public/img/Logo Game.png" align="middle" style="width:40%;">
                  </div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;">
                        <b>Game Competition<b>
                     </p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018
                     </p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p style="padding:20px;">MAGE Game Competition diadakan dengan tujuan mendorong kreasi serta inovasi mahasiswa maupun siswa SMA sederajat untuk membuat sebuah aplikasi permainan atau game.<br><br>
                  </p>
               </div>
               <div class="card-action" align="center">
                  <a href="game"><b>Read More</b></a>
               </div>
            </div>
         </div>
         <div class="col xl3 s12 m6 l3" style="">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bgc.png'); background-size:cover; text-align:center; padding:30px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;"><img src="public/img/Logo Apps.png" align="middle" style="width:25%;"></div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;"><b>Apps Competition<b></p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018</p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p class="ll" style="">Application Competition merupakan  lomba  pembuatan  aplikasi mobile yang diselenggarakan berskala nasional sebagai media bagi pelajar dan mahasiswa untuk mengeksplorasi kreativitas dan inovasi dalam bidang teknologi.</p>
               </div>
               <div class="card-action" align="center">
                  <a href="app"><b>Read More</b></a>
               </div>
            </div>
         </div>
         <div class="col xl3 s12 m6 l3 x12" style="">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bgc.png'); background-size:cover; text-align:center; padding:30px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;"><img src="public/img/Logo IOT.png" align="middle" style="width:57%;"></div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;"><b>IoT Competition<b></p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018</p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p style="padding:20px;">Internet of Things Competition adalah lomba pembuatan alat yang memanfaatkan koneksi nirkabel untuk alat kendali yang dapat terhubung/berkomunikasi dengan alat-alat yang dikendalikan.<br><br></p>
               </div>
               <div class="card-action" align="center">
                  <a href="iot"><b>Read More</b></a>
               </div>
            </div>
         </div>
         <div class="col xl3 s12 m6 l3" style="">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bgc.png'); background-size:cover; text-align:center; padding:20px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;"><img src="public/img/Logo E-Sport.png" align="middle" style="width:40%;"></div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;"><b>E-Sport Competition<b></p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018</p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p style="padding:20px;">E-sport merupakan salah satu pra-event dari serangkaian kegiatan MAGE 2018 yang merupakan kompetisi game PES 2017, DOTA 2, dan Mobile Legends. <br><br><br></p>
               </div>
               <div class="card-action" align="center">
                  <a href="esport"><b>Read More</b></a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--Event-->
   <div id="event" class="row col xl12 l12 m12 s12" style="background-color: #EAEAEA; padding-bottom:10px; padding-top: 100px;margin-top:-20px" >
      <div align="center">
         <h3><b><i>EVENT</i></b></h3>
      </div>
      <div class="evn" align="center" style="">
         <div class="col xl3 s12 m6 l3 push-l1-5" style="">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bce.png'); background-size:cover; text-align:center; padding:30px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;"><img src="public/img/Logo Workshop.png" align="middle" style="width:40%;"></div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;"><b>Workshop<b></p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018</p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p style="padding:20px;">Kegiatan ini merupakan kegiatan pelatihan yang ditujukan kepada siswa ataupun mahasiswa. Ada 2 jenis workshop yang diberikan yaitu Aplikasi dan Website. Materi yang diberikan ditujukan kepada pemula yang ingin mempelajari bagaimana membuat suatu aplikasi sederhana dan juga cara membuat sebuah website.<br><br>
                  </p>
               </div>
               <div class="card-action" align="center">
                  <a href="event"><b>Read More</b></a>
               </div>
            </div>
         </div>
         <div class="col xl3 s12 m6 l3 push-l1-5" style="">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bce.png'); background-size:cover; text-align:center; padding:30px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;"><img src="public/img/Logo Talkshow.png" align="middle" style="width:40%;"></div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;"><b>Talkshow<b></p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018</p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p style="padding:20px;">Pada kegiatan Talkshow nantinya akan menghadirkan pembicara inspiratif yang akan membahas “Pengaruh Dunia Digital Bagi Anak Muda dan Sosial Masyarakat”. Acara ini diharapkan mampu menginspirasi para peserta khususnya mahasiswa dan anak-anak muda untuk tetap berkarya secara positif di era digital saat ini.<br><br></p>
               </div>
               <div class="card-action" align="center">
                  <a href="event"><b>Read More</b></a>
               </div>
            </div>
         </div>
         <div class="col xl3 s12 m6 l3 push-l1-5" style="">
            <div class="card" style="">
               <div class="col xl12 s12 m12 l12" style="background:url('public/img/bce.png'); background-size:cover; text-align:center; padding:30px;">
                  <div class="col xl12 s12 m12 l12" style="padding:10px;"><img src="public/img/Logo Exhibition.png" align="middle" style="width:60%;"></div>
                  <div class="col xl12 s12 m12 l12" style="color:white;">
                     <p style="font-size:20px; margin:0px;"><b>Exhibition<b></p>
                     <p style="font-size:12px; margin:0px;">04 Des 2017 - 25 Feb 2018</p>
                  </div>
               </div>
               <div class="col xl12 s12 m12 l12" style="text-align:justify;">
                  <p style="padding:15px;">Exhibition merupakan ajang pameran karya-karya para peserta kompetisi MAGE 2018. Tidak hanya diisi oleh karya peserta, exhibition juga akan dihadiri oleh komunitas-komunitas IT yang ada di Kota Surabaya dan sekitarnya dan juga Startup yang ada di Kota Surabaya dan sekitarnya. Nantinya juga diisi oleh bazaar makanan dan produk lainnya. <br><br></p>
               </div>
               <div class="card-action" align="center">
                  <a href="event"><b>Read More</b></a>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!--timeline-->
   <div id="timeline" class="row col xl12 l12 m12 s12" style="background-color: #EAEAEA; padding-bottom:10px; padding-top: 100px;margin-top:-20px;">
      <div align="center">
         <h3><b><i>TIMELINE</i></b></h3>
      </div>
      <div class="row carousel" style="background:url('public/img/BGTM.jpg');overflow-y: auto;">
         <?php include "timeline.php" ?>
         <!--<div class="col l12 m12 s12 carousel-item" style=" text-align:center; ">
            <img src="public/img/game.png" style="width:50%;">
            </div>  
            <div class="col l12 m12 s12 carousel-item" style=" text-align:center;">
            <img src="public/img/APPS.png" style="width:50%;">
            </div>
            <div class="col l12 m12 s12 carousel-item" style="text-align:center;">
            <img src="public/img/IOT.png" style="width:50%;">
            </div>-->
      </div>
   </div>
   <!--News-->
   <div id="news" class="row col xl12 l12 m12 s12" style="background-color: #EAEAEA; padding-bottom:10px; padding-top: 100px;margin-top:-20px;margin-bottom: 0;padding-bottom: 90px">
      <div align="center">
         <h3><b><i>WHAT'S NEW?</i></b></h3>
      </div>
      <?php include "news.php" ?>
   </div>
   <!--<div class="col l12 m12 s12" style="background:url('public/img/BG_SPONSOR.png'); background-size:cover;  padding-top:370px; padding-bottom:370px; ">
      </div>-->
   <?php include "footer.php" ?>
   </body>
</html>