<div class="page-heading">
   <div class="page-title">
      <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Master Paket Usaha</h3>
            <p class="text-subtitle text-muted"></p>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin/master-paket">Master Paket Usaha</a></li>
                  <li class="breadcrumb-item">Edit Data</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</div>
<div class="page-content">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4>Edit Paket Usaha</h4>
            </div>
            <form action="<?php echo base_url('/admin/update-paket');?>" method="post" class="form"
               enctype="multipart/form-data" data-parsley-validate>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-7">
                        <div class="col-md-12">
                           <div class="divider divider-left">
                              <div class="divider-text">Keterangan</div>
                           </div>
                           <div class="form-group mandatory">
                              <label for="nama_paket">Nama Paket</label>
                              <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                                 placeholder="Masukkan Nama Paket Usaha" data-parsley-required="true" value="<?= $dataPaket['nama_paket']; ?>">
                           </div>
                           <div class="form-group">
                              <label for="thumbnail" class="form-label">Thumbnail paket (300 x 120
                                 pixel)<small><i>*ukuran
                                       disarankan</i></small></label>
                              <input class="form-control" type="file" id="thumbnail" name="foto_paket">
                              <input class="form-control" type="hidden" id="thumbnail" name="nama_foto_paket" value="<?= $dataPaket['foto_paket'] ?>">
                           </div>
                           <div class="form-group">
                              <label for="nama_paket">Deskripsi</label>
                              <div class="form-floating">
                                 <textarea class="form-control" placeholder="Detail Paket Usaha" id="floatingTextarea"
                                    data-parsley-required="true" style="height: 115px;" name="keterangan"><?= $dataPaket['keterangan']; ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="col-md-12">
                           <div class="divider divider-left">
                              <div class="divider-text">Tanggal</div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label for="tgl_tersedia">Tersedia</label>
                                 <input type="datetime" class="form-control mb-3 flatpickr-no-config" id="tgl_tersedia"
                                    placeholder="" name="tgl_tersedia" data-parsley-required="true" value="<?= $dataPaket['tgl_tersedia'] ?>">
                              </div>
                              <div class="form-group col-md-6">
                                 <label for="tgl_berakhir">Berakhir</label>
                                 <input type="datetime" class="form-control mb-3 flatpickr-no-config" id="tgl_berakhir"
                                    placeholder="" name="tgl_berakhir" data-parsley-required="true" value="<?= $dataPaket['tgl_berakhir'] ?>">
                              </div>
                           </div>
                           <div class="divider divider-left">
                              <div class="divider-text">Pricing</div>
                           </div>
                           <div class="form-group">
                              <label for="kuota">Kuota Tersedia</label>
                              <input type="number" class="form-control" id="kuota" min="0"
                                 placeholder="masukkan jumlah kouta" name="kuota" data-parsley-required="true" value="<?= $dataPaket['kuota'];?>">
                           </div>
                           <div class="form-group">
                              <label for="harga">Harga</label>
                              <div class="input-group">
                                 <span class="input-group-text" id="basic-addon1">Rp</span>
                                 <input type="number" class="form-control" placeholder="0" aria-label="Harga" value="<?= $dataPaket['harga'] ?>"
                                    aria-describedby="basic-addon1" name="harga" min="0" id="harga">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12" style="text-align: right;">
                              <br>
                              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                              <a href="/admin/master-paket"><button type="button"
                                    class="btn btn-danger">Batal</button></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>