<style>
   .modal {
      text-align: center;
      padding: 0 !important;
   }

   .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
   }

   .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
   }

   .file-input__input {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
   }

   .file-input__label {
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      font-size: 14px;
      padding: 10px 12px;
      background-color: #4245a8;
      box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
      width: -webkit-fill-available;
      width: 100%;
      justify-content: center;
   }

   .file-input__label svg {
      height: 16px;
      /* margin-right: 4px; */
   }

   .add-button {
      z-index: 999999;
      position: fixed;
      bottom: 20px;
      left: 0;
      width: 100%;
      height: 100%;
      max-height: 70px;
      display: flex;
      overflow-x: auto;
      justify-content: center;
      border: 0;
   }

   .product-details .add-to-cart .add-to-cart-btn {
      border-radius: 0;
      background-color: #FD873F;
   }

   .carousel {
      /* border: 1px solid grey;  */
      /* box-shadow: 0 3px 4px 0; */
   }

   .harga-product {
      padding: 10px 15px;
      background: rgba(247, 165, 49, 0.3)
   }

   .harga-product h3 {
      margin: 0;
   }

   .nama-product {
      margin-top: 10px;
      padding: 10px 15px;
      background: rgba(247, 165, 49, 0.2)
   }

   .nama-product p {
      margin: 0;
      font-size: 15px;
      font-weight: 500;
   }

   .deskripsi-product {
      margin-top: 10px;
      /* padding: 10px 15px; */
      /* background: rgba(247, 165, 49, 0.2) */
   }

   .deskripsi-product .panel-heading {
      padding: 0 15px;
   }
</style>
<!-- SECTION -->
<div class="section" style="padding: 15px 15px 20vb 15px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4><a href="/peternak/produk-s"><i class="fa-solid fa-arrow-left"></i></a>&ensp;Edit Produk</h4>
      <div class="row">
         <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="row">
               <div class="col-sm-6 col-xs-6 col-md-6">okey</div>
               <div class="col-sm-6 col-xs-6 col-md-6"> okey</div>
            </div>
         </div> -->
         <div class="row">
            <div class="col-md-12" style="padding: 0;">
               <!-- Start Preview Product -->
               <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                     <?php 
                     $i=1;
                     foreach($dataFotoProduk as $data){ ?>
                     <div class="item <?php if($i==1){echo 'active';};?>">
                        <img src="<?= base_url()?>Assets/img/toko/produk/<?= $data['nm_foto']?>"
                           alt="<?= $data['nm_foto']?>" style="width: 100%; height: 400px; object-fit: contain;">
                     </div>
                     <?php $i++; } ?>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                     <span class="fa-solid fa-chevron-left" aria-hidden="true"
                        style="position: absolute; top: 50%;"></span>
                     <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                     <span class="fa-solid fa-chevron-right" aria-hidden="true"
                        style="position: absolute; top: 50%;"></span>
                     <span class="sr-only">Next</span>
                  </a>
               </div>

               <div class="harga-product">
                  <h3><small style="color: darkorange"><b>Rp</b> </small><?= $dataProduk['harga']; ?></h3>
               </div>
               <div class="nama-product">
                  <p><?= $dataProduk['nama_produk']; ?></p>
               </div>
               <div class="deskripsi-product">
                  <div class="panel panel-default">
                     <div class="panel-heading">Deskripsi</div>
                     <div class="panel-body">
                        <?= $dataProduk['deskripsi_produk'];?>
                     </div>
                  </div>
               </div>

               <!-- End Preview Product -->
            </div>
            <div class="col-md-12 product-details">
               <form action="<?= base_url()?>peternak/update-produk" method="post" enctype="multipart/form-data"
                  style="padding-top: 20px;">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                           <label for="gambar_produk">Gambar Produk <small><i style="color: red">*wajib upload 3
                                    foto</i></small></label>
                        </div>
                     </div>
                     <!-- foto produk 1 -->
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                           <figure class="image-container-prv" style="border: 2px solid #5e5e5e; border-radius: 10px;"
                              for="gambar_produk">
                              <img id="chosen-image" for="gambar_produk" data-toggle="modal"
                                 data-target="#Modal_Product1"
                                 style="width: 100%; max-width: 10vb; min-height:10vb; max-height:10vb; margin-bottom: 1px; border-radius: 5px;">
                              <div class="file-input">
                                 <input type="file" name="foto_produk1" id="file-input" class="file-input__input"
                                    accept="image/png, image/jpeg, image/jpg, image/svg" />
                                 <label class="file-input__label" for="file-input" style="margin-bottom: 0;">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload"
                                       class="svg-inline--fa fa-upload fa-w-16" role="img"
                                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                       <path fill="currentColor"
                                          d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                       </path>
                                    </svg>
                                 </label>
                              </div>
                           </figure>
                        </div>
                     </div>
                     <?php $i=1; foreach($dataFotoProduk as $data) { ?>
                     <input type="hidden" name="foto_produk<?= $i;?>_old" value="<?= $data['nm_foto']?>">
                     <?php $i++; } ?>
                     <!-- foto produk 2 -->
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                           <figure class="image-container-prv" style="border: 2px solid #5e5e5e; border-radius: 10px;"
                              for="gambar_produk">
                              <img id="chosen-image2" for="gambar_produk" data-toggle="modal"
                                 data-target="#Modal_Product2"
                                 style="width: 100%; max-width: 10vb; min-height:10vb; max-height:10vb; border-radius: 10px;">
                              <div class="file-input">
                                 <input type="file" name="foto_produk2" id="file-input2" class="file-input__input"
                                    accept="image/png, image/jpeg, image/jpg, image/svg" />
                                 <label class="file-input__label" for="file-input2" style="margin-bottom: 0;">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload"
                                       class="svg-inline--fa fa-upload fa-w-16" role="img"
                                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                       <path fill="currentColor"
                                          d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                       </path>
                                    </svg>
                                 </label>
                              </div>
                           </figure>
                        </div>
                     </div>
                     <!-- foto produk 3 -->
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                           <figure class="image-container-prv" style="border: 2px solid #5e5e5e; border-radius: 10px;"
                              for="gambar_produk">
                              <img id="chosen-image3" for="gambar_produk" data-toggle="modal"
                                 data-target="#Modal_Product3"
                                 style="width: 100%; max-width: 10vb; min-height:10vb; max-height:10vb; margin-bottom: 1px; border-radius: 5px;">
                              <div class="file-input">
                                 <input type="file" name="foto_produk3" id="file-input3" class="file-input__input"
                                    accept="image/png, image/jpeg, image/jpg, image/svg" />
                                 <label class="file-input__label" for="file-input3" style="margin-bottom: 0;">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload"
                                       class="svg-inline--fa fa-upload fa-w-16" role="img"
                                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                       <path fill="currentColor"
                                          d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                       </path>
                                    </svg>
                                 </label>
                              </div>
                           </figure>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="nama_produk">Nama Produk</label>
                     <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                        value="<?= $dataProduk['nama_produk']?>" required>
                  </div>
                  <div class="row">
                     <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                           <label for="harga_produk">Harga</label>
                           <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Rp</span>
                              <input type="text" name="harga" class="form-control" id="dengan-rupiah"
                                 style="text-align: right;" aria-describedby="basic-addon1"
                                 value="<?= $dataProduk['harga']?>" required>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                           <label for="stok">stok</label>
                           <input type="number" class="form-control" name="stok" min="0" max="999"
                              value="<?= intval($dataProduk['stok'])?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                           <label for="stok">berat <small><i>*gram</i></small></label>
                           <input type="number" class="form-control" name="berat"
                              value="<?= intval($dataProduk['berat'])?>" required>
                        </div>
                     </div>
                     <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="form-group">
                           <label for="kategori">Kategori</label>
                           <select name="kategori_produk" class="form-control" required>
                              <option value="-"></option>
                              <?php
                              foreach($dataKategori as $data){ ?>
                              <option value="<?php echo $data['id_kategori'];?>"
                                 <?php if($dataProduk['id_kategori']==$data['id_kategori']){echo 'selected';}?>>
                                 <?php echo $data['nama_kategori']?>
                              </option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="deskripsi_produk">Deskripsi</label>
                     <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10"
                        required><?= $dataProduk['deskripsi_produk']?></textarea>
                  </div>
                  <div class="add-to-cart add-button">
                     <button class="btn-xs add-to-cart-btn" style="border-radius: 20px;">
                        <span class="fa-solid fa-floppy-disk"></span>&nbsp; Simpan
                     </button>
                     <a href="<?= base_url()?>peternak/produk-s/hapus/<?= sha1($dataProduk['id_produk'])?>"
                        class="btn-xs add-to-cart-btn"
                        style="border-radius: 20px; background-color: #ef233c; margin-left: 5px; align-content: center;">
                        <span class="fa-solid fa-trash"></span>&nbsp; Hapus
                     </a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /container -->
</div>
<!-- /Modal Foto -->
<div class="modal fade" id="Modal_Product1" tabindex="-1" role="dialog" aria-labelledby="Modal_Product1"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <figure class="image-container-prv"
               style="width: 100%; height:100%; border: 2px solid #5e5e5e; border-radius: 10px;">
               <img id="modal-image1" class="img-fluid">
            </figure>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="Modal_Product2" tabindex="-1" role="dialog" aria-labelledby="Modal_Product2"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <figure class="image-container-prv"
               style="width: 100%; height:100%; border: 2px solid #5e5e5e; border-radius: 10px;">
               <img id="modal-image2" class="img-fluid">
            </figure>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="Modal_Product3" tabindex="-1" role="dialog" aria-labelledby="Modal_Product3"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <figure class="image-container-prv"
               style="width: 100%; height:100%; border: 2px solid #5e5e5e; border-radius: 10px;">
               <img id="modal-image3" class="img-fluid">
            </figure>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
   /* Dengan Rupiah */
   var dengan_rupiah = document.getElementById('dengan-rupiah');
   dengan_rupiah.addEventListener('keyup', function (e) {
      dengan_rupiah.value = formatRupiah(this.value);
   });

   /* Fungsi */
   function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
         split = number_string.split(','),
         sisa = split[0].length % 3,
         rupiah = split[0].substr(0, sisa),
         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
         separator = sisa ? '.' : '';
         rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
   }
</script>