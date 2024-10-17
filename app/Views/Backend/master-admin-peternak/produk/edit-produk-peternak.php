<div class="section" style="padding: 15px 15px 20vb 15px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4>Tambah Produk</h4>
      <div class="row">
         <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="row">
               <div class="col-sm-6 col-xs-6 col-md-6">okey</div>
               <div class="col-sm-6 col-xs-6 col-md-6"> okey</div>
            </div>
         </div> -->
         <div class="row">
            <div class="card">
               <div class="col-md-12"></div>
               <div class="col-md-12 product-details">
                  <form action="<?= base_url()?>admin/update-produk-peternak" method="post" enctype="multipart/form-data">
                     <div class="card-body">
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
                                 <figure style="border: 1px solid #5e5e5e; border-radius: 10px;" for="gambar_produk">
                                    <img id="chosen-image" for="gambar_produk">
                                    <div class="file-input">
                                       <input type="file" name="foto_produk1" id="file-input"
                                          class="image-preview-filepond"
                                          accept="image/png, image/jpeg, image/jpg, image/svg" required />
                                       <label class="image-preview-filepond" for="file-input" style="margin-bottom: 0;">
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
                                 <figure style="border: 1px solid #5e5e5e; border-radius: 10px;" for="gambar_produk">
                                    <img id="chosen-image2" for="gambar_produk">
                                    <div class="file-input">
                                       <input type="file" name="foto_produk2" id="file-input2"
                                          class="image-exif-filepond"
                                          accept="image/png, image/jpeg, image/jpg, image/svg" required />
                                       <label class="image-exif-filepond" for="file-input2" style="margin-bottom: 0;">
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
                                 <figure style="border: 1px solid #5e5e5e; border-radius: 10px;" for="gambar_produk">
                                    <img id="chosen-image3" for="gambar_produk">
                                    <div class="file-input">
                                       <input type="file" name="foto_produk3" id="file-input3"
                                          class="image-resize-filepond"
                                          accept="image/png, image/jpeg, image/jpg, image/svg" required />
                                       <label class="image-resize-filepond" for="file-input3" style="margin-bottom: 0;">
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
                        <!-- <input type="hidden" name="id_produk">
                        <input type="hidden" name="id_toko"> -->
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label for="nama_produk">Nama Produk</label>
                                 <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                    value="<?= $dataProduk['nama_produk']?>" required>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="harga_produk">Harga</label>
                                 <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="text" name="harga" class="form-control" id="dengan-rupiah"
                                       aria-label="Harga" style="text-align: right;" aria-describedby="basic-addon1"
                                       value="<?= $dataProduk['harga']?>" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label for="harga_produk">berat</label>
                                 <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">gram</span>
                                    <input type="number" name="berat" class="form-control" style="text-align: right;"
                                       value="<?= intval($dataProduk['berat'])?>" required>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="stok">stok</label>
                                 <input type="number" class="form-control" name="stok" min="0" max="999"
                                    value="<?= intval($dataProduk['stok'])?>" required>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label for="deskripsi_produk">Deskripsi</label>
                                 <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" cols="30"
                                    rows="5" required><?= $dataProduk['deskripsi_produk']?></textarea>
                              </div>
                           </div>
                           <div class="col-md-4">
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
                        <div class="col-md-12" style="text-align: right;">
                           <button class="btn btn-success" type="submit">Simpan</button>
                           <a href="/admin/produk-saya-peternak" type="button" class="btn btn-warning">Batal</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /container -->
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