<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Master Pengguna</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Master Pengguna</a></li>
                        <li class="breadcrumb-item">Detail</li>
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
                    <h4>Detail Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo base_url(); ?>assets/img/profile/<?php echo $detail_pengguna['foto_user']; ?>"
                                        class="rounded-circle" width="150px">
                                <br />
                                <span class="text-black-50">
                                    <?php if($detail_pengguna['status'] == '0'){
                                      echo '<span class="badge bg-danger">Akun Tidak aktif</span>';
                                    } elseif($detail_pengguna['status'] == '1'){
                                      echo '<span class="badge bg-success">Akun Aktif</span>';
                                    } else{
                                      echo '<span class="badge bg-secondary">Akun DiBlokir</span>';
                                    } ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-user">Nama</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-user">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="nama-user" class="form-control" name="nama_user"
                                                placeholder="nama user"
                                                value="<?php echo $detail_pengguna['nama_user'];?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-user">Email</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-user">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="nama-user" class="form-control" name="email_user"
                                                placeholder="nama user"
                                                value="<?php echo $detail_pengguna['email_user'];?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-user">Telpon</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-user">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="nama-user" class="form-control" name="no_hp"
                                                placeholder="nama user" value="<?php echo $detail_pengguna['no_hp'];?>"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-user">Alamat</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-user">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                name="alamat_user" rows="3"
                                                disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>