<div class="page-heading">
   <div class="page-title">
      <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">

            <!-- <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery required).</p> -->
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Paket Usaha</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <section class="section">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  <h3>Paket Usaha</h3>
               </div>
               <div class="col-md-6">
                  <div class="float-end">
                     <a href="<?= base_url('/admin/input-paket')?>" type="button" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Paket
                     </a>
                  </div>

               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <?php
         $no = 0;
         //variable dari GetResultArray
         foreach($dataPaket as $data){
            $nodesk = $no++;
      ?>
         <div class="col-md-4 col-sm-6">
            <div class="card">
               <div class="card-content">
                  <img class="card-img-bottom img-fluid"
                     src="<?= base_url().'Assets/img/paket_usaha/'.$data['foto_paket'];?>" alt="Card image cap"
                     style="height: 100%; object-fit: cover; border-top-right-radius: var(--bs-card-inner-border-radius);border-top-left-radius: var(--bs-card-inner-border-radius);" />
                  <div class="card-body">
                     <h4 class="card-title"><?php echo $data['nama_paket'];?></h4>
                     <!-- <p class="card-text"> -->
                     <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                           <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#flush-deskripsi<?= $nodesk ?>" aria-expanded="false"
                                 aria-controls="flush-deskripsi<?= $nodesk ?>">
                                 Deskripsi
                              </button>
                           </h2>
                           <div id="flush-deskripsi<?= $nodesk?>" class="accordion-collapse collapse"
                              aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body" style="">
                                 <span style="font-size: 14px;"><?php echo $data['keterangan']; ?></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- </p> -->
                     <p class="card-text">
                        <i class="bi bi-person-lines-fill"></i> <?php echo $data['kuota'];?> orang<br>
                        <i class="bi bi-cash"></i><b> Rp
                           <?php echo $money_number = number_format($data['harga'],2,',','.');?></b><br>
                        <i class="bi bi-calendar-range"></i>
                        <small><?php echo date("Y-M-d", strtotime($data['tgl_tersedia']));?> -
                           <?php echo $data['tgl_berakhir'];?></small>
                     </p>
                     <div class="row">
                        <div class="col-md-6">
                           <?php
                        $tgl_tersedia = new DateTime($data['tgl_tersedia']);
                        $tgl_berakhir = new DateTime($data['tgl_berakhir']);
                        $tgl_skrg = new DateTime();
                        $jarak = $tgl_skrg->diff($tgl_berakhir);
                        
                        if ($tgl_skrg>=$tgl_tersedia) { ?>
                           <button class="btn btn-sm btn-success">Tersedia</button>
                           <?php 
                        }elseif($tgl_skrg > $tgl_berakhir) { ?>
                           <button class="btn btn-sm btn-danger">Berakhir</button>
                           <?php
                        }elseif($tgl_skrg < $tgl_tersedia) { ?>
                           <button class="btn btn-sm btn-warning">Belum Dimulai</button>
                           <?php
                        } ?>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                           <a href="/admin/pkt/detail/<?php echo sha1($data['id_paket'])?>"
                              class="btn btn-sm btn-info">
                              <i class="bi bi-eye-fill"></i>
                           </a>
                           <a href="/admin/edit-paket/<?php echo sha1($data['id_paket'])?>"
                              class="btn btn-sm btn-warning">
                              <i class="bi bi-pencil-square"></i>
                           </a>
                           <a href="/admin/hapus-paket/<?php echo sha1($data['id_paket'])?>"
                              class="btn btn-sm btn-danger ">
                              <i class="bi bi-trash"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </section>
</div>