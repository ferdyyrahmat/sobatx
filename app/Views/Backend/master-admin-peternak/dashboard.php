<div class="page-heading">
   <div class="page-title">
      <div class="row">
         <!-- <div class="col-12 col-md-6 order-md-1 order-last">
            <h3></h3>
            <p class="text-subtitle text-muted"></p>
         </div> -->
         <div class="col-12 col-md-12 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-start">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>
<div class="page-content">
   <section class="row">
      <div class="col-12 col-lg-12">
         <?php
            foreach($dataPeternak as $data){
         ?>
         <h1 style="text-align: center; color:black;">Selamat Datang <span><?php echo $data['nama_user'];?></span></h1>
         <?php } ?>
      </div>
   </section>
</div>