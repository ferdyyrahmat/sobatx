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
</style>
<!-- SECTION -->
<div class="section" style="padding: 15px 15px 20vb 15px;">
   <!-- container -->
   <div class="container">
      <!-- Content title here! -->
      <h4><a href="/peternak/toko-s"><i class="fa-solid fa-arrow-left"></i></a>&ensp;Tambah Rekening</h4>

      <div class="row">
         <div class="col-md-12"></div>
         <div class="col-md-12 product-details">
            <form action="<?= base_url()?>peternak/simpan-rekening" method="post">
               <div class="form-group">
                  <label for="nama_produk">Nama Pemilik Rekening</label>
                  <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
                  <small><i>tulis nama lengkap sesuai dengan buku tabungan anda!</i></small>
               </div>
               <div class="form-group">
                  <label for="nama_produk">No. Rekening</label>
                  <input type="number" class="form-control" id="no_rekening" name="no_rekening" required>
                  <small><i>pastikan anda menuliskan dengan benar!</i></small>
               </div>
               <div class="form-group">
                  <label for="nama_bank">Nama Bank</label>
                  <select class="form-control" name="nama_bank" id="nama_bank">
                     <option>pilih bank</option>
                     <option value="bca">BCA</option>
                     <option value="bni">BNI</option>
                     <option value="mandiri">Mandiri</option>
                     <option value="bri">BRI</option>
                     <option value="bsi">BSI</option>
                  </select>
               </div>
               <div class="add-to-cart add-button">
                  <button class="btn-xs add-to-cart-btn" style="border-radius: 20px;">
                     Simpan Rekening
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /container -->
</div>