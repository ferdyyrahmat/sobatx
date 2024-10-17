<!-- <div class="page-heading">
   <div class="page-title">
      <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">

            <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery required).</p>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                  <h3>Produk Saya</h3>
               </div>
               <div class="col-md-6">
                  <div class="float-end">
                     <a href="<?= base_url('/admin/tambah-produk-peternak')?>" type="button"
                        class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
  
         <div class="col-md-3 col-sm-3">
            <div class="card">
               <div class="card-content">
                  <img class="card-img-bottom img-fluid"
                     src="" alt="Card image cap"
                     style="height: 100%; object-fit: cover; border-top-right-radius: var(--bs-card-inner-border-radius);border-top-left-radius: var(--bs-card-inner-border-radius);" />
                  <div class="card-body">
                     <h4 class="card-title"></h4>
                     <p class="card-text">
                     <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                           <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#flush-deskripsi" aria-expanded="false"
                                 aria-controls="flush-deskripsi
                                 Deskripsi
                              </button>
                           </h2>
                           <div id="flush-deskripsi" class="accordion-collapse collapse"
                              aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body" style="">
                                 <span style="font-size: 14px;"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     </p>
                     <p class="card-text">
                        <i class="bi bi-boxes"></i>  Stok<br>
                        <i class="bi bi-cash"></i><b> Rp
                           </b><br>
                     </p>
                  </div>
                  <div class="col-md-12" style="text-align: center;">
                     <a href="#" class="btn btn-sm btn-info">
                        <i class="bi bi-eye-fill"></i>
                     </a>
                     <a href="#" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i>
                     </a>
                     <a href="#" class="btn btn-sm btn-danger ">
                        <i class="bi bi-trash"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </section>
</div> -->

<div class="page-heading">
   <div class="page-title">
      <div class="row">
         <div class="col-12 col-md-12 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
                  <h5>Produk Saya</h5>
               </div>
               <div class="col-md-6">
                  <div class="float-end">
                     <a href="<?= base_url('/admin/tambah-produk-peternak')?>" type="button"
                        class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                     </a>
                  </div>
               </div>
            </div> <br>
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th data-sortable="true">No</th>
                           <th data-sortable="true">Foto Produk</th>
                           <th data-sortable="true">Nama Produk</th>
                           <th data-sortable="true">Stok</th>
                           <th data-sortable="true">Berat</th>
                           <th data-sortable="true">Harga</th>
                           <th data-sortable="true">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no = 0;
                        //variable dari GetResultArray
                        foreach($dataProduk as $data){
                        ?>
                        <tr>
                           <td data-sortable="true"><?php echo $no=$no+1;?></td>
                           <td data-sortable="true">
                              <img src="<?= base_url().'Assets/img/toko/produk/'.$data['nm_foto'];?>" width="80px"
                                 alt="Card image cap">
                           </td>
                           <td data-sortable="true"><?php echo $data['nama_produk'];?></td>
                           <td data-sortable="true"><?php echo $data['stok'];?></td>
                           <td data-sortable="true"><?php echo $data['berat'];?></td>
                           <td data-sortable="true"><?php echo $data['harga'];?></td>
                           <td>
                              <a href="/admin/detail-produk-peternak/<?= sha1($data['id_produk'])?>" class="btn btn-sm btn-info">
                                 <i class="bi bi-eye-fill"></i>
                              </a>
                              <a href="/admin/edit-produk-peternak/<?= sha1($data['id_produk'])?>" class="btn btn-sm btn-warning">
                                 <i class="bi bi-pencil-square"></i>
                              </a>
                              <a href="/admin/hapus-produk/<?= sha1($data['id_produk'])?>" class="btn btn-sm btn-danger ">
                                 <i class="bi bi-trash"></i>
                              </a>
                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>