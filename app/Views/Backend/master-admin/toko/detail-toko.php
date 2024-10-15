<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Master Peternak</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Master Peternak</a></li>
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
                    <h4>Detail Toko</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?php echo base_url(); ?>assets/img/profile/<?php echo $dataToko['foto_toko']; ?>"
                                    class="rounded-circle" width="150px">
                                <br />
                                <span class="text-black-50">
                                    <?php if($dataToko['status_toko'] == '0'){
                                      echo '<span class="badge bg-danger">Toko Tidak aktif</span>';
                                    } elseif($dataToko['status_toko'] == '1'){
                                      echo '<span class="badge bg-success">Toko Aktif</span>';
                                    } else{
                                      echo '<span class="badge bg-secondary">Toko DiBlokir</span>';
                                    } ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-toko">Nama Toko</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-toko">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="nama-user" class="form-control" name="nama_toko"
                                                placeholder="nama toko" value="<?php echo $dataToko['nama_toko'];?>"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-user">Owner</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-user">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="nama-user" class="form-control" name="nama_user"
                                                placeholder="nama user"
                                                value="<?php echo $detail_peternak['nama_user'];?>" disabled>
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
                                                value="<?php echo $detail_peternak['email_user'];?>" disabled>
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
                                                placeholder="nama user" value="<?php echo $detail_peternak['no_hp'];?>"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="nama-toko">Alamat</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-toko">:</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                name="alamat_toko" rows="3"
                                                disabled><?php echo $dataToko['alamat_toko'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider">
                            <div class="divider-text">Informasi Toko</div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8 col-md-12">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-2">
                                        <label class="col-form-label" for="nama-toko">Status</label>
                                    </div>
                                    <div class="col-lg-1 col-1">
                                        <label class="col-form-label" for="nama-toko">:</label>
                                    </div>
                                    <div class="col-lg-8 col-md-9">
                                        <?php if($dataToko['status_toko'] == '0'){
                                          echo '<span class="badge bg-danger">Toko Tidak aktif</span>';
                                        } elseif($dataToko['status_toko'] == '1'){
                                          echo '<span class="badge bg-success">Toko Aktif</span>';
                                        } else{
                                          echo '<span class="badge bg-secondary">Toko DiBlokir</span>';
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-2">
                                        <label class="col-form-label" for="nama-toko">Nama Toko</label>
                                    </div>
                                    <div class="col-lg-1 col-1">
                                        <label class="col-form-label" for="nama-toko">:</label>
                                    </div>
                                    <div class="col-lg-8 col-md-9">
                                        <input type="text" id="nama-toko" class="form-control" name="nama_toko"
                                            placeholder="nama toko" value="<?php echo $dataToko['nama_toko'];?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-2">
                                        <label class="col-form-label" for="alamat-toko">Alamat toko</label>
                                    </div>
                                    <div class="col-lg-1 col-1">
                                        <label class="col-form-label" for="alamat-toko">:</label>
                                    </div>
                                    <div class="col-lg-8 col-md-9">
                                        <textarea class="form-control" id="alamat-toko"
                                            name="alamat_toko" rows="3"
                                            disabled><?php echo $dataToko['alamat_toko'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>