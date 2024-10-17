<div class="page-content">
    <div class="row">
        <div class="">
            <div class="card-header">
                <h4>Tambah Rekening</h4>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <form action="<?= base_url('/admin/simpan-rekening-peternak/')?>" method="post"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="col-lg-12 col-12">
                                                        <label class="col-form-label" for="nama_pemilik">Nama Pemilik
                                                            Rekening
                                                            :</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-12">
                                                        <input type="text" class="form-control" id="nama_pemilik"
                                                            name="nama_pemilik" required>
                                                        <small><i>tulis nama lengkap sesuai dengan buku tabungan
                                                                anda!</i></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="col-lg-12 col-12">
                                                        <label class="col-form-label" for="no_rekening">No. Rekening
                                                            :</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-12">
                                                        <input type="number" class="form-control" id="no_rekening"
                                                            name="no_rekening" required>
                                                        <small><i>pastikan anda menuliskan dengan benar!</i></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="col-lg-12 col-12">
                                                        <label class="col-form-label" for="nama_bank">Nama Bank
                                                            :</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-12">
                                                        <select class="form-control" name="nama_bank" id="nama_bank">
                                                            <option>pilih bank</option>
                                                            <option value="bca">BCA</option>
                                                            <option value="bni">BNI</option>
                                                            <option value="mandiri">Mandiri</option>
                                                            <option value="bri">BRI</option>
                                                            <option value="bsi">BSI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="/admin/toko-saya-peternak"><button type="button"
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
    </div>
</div>