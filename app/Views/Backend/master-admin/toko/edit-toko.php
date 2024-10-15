<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Master Toko</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Master Toko</a></li>
                        <li class="breadcrumb-item">Edit</li>
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
                    <h4>Edit Data Edit</h4>
                </div>
                <form action="<?php echo base_url('/admin/update-toko');?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?php echo base_url(); ?>Assets/img/toko/<?php echo $dataToko['foto_toko']; ?>"
                                        class="rounded-circle" width="150px">
                                        <input type="hidden" name="foto_toko_old" value="<?php echo $dataToko['foto_toko']?>">
                                        <i>Ubah Foto</i>
                                        <input type="file" class="form-control" name="foto_toko" accept="image/*,.jpg,.jpeg,.png">
                                    <br />
                                    <span class="text-black-50">
                                        <?php if($dataToko['status_toko'] == '0'){
                                      echo '<span class="badge bg-danger">Akun Tidak aktif</span>';
                                    } elseif($dataToko['status_toko'] == '1'){
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
                                                <label class="col-form-label" for="nama-toko">Nama Toko</label>
                                            </div>
                                            <div class="col-lg-1 col-1">
                                                <label class="col-form-label" for="nama-toko">:</label>
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <input type="text" id="nama-user" class="form-control" name="nama_toko"
                                                    placeholder="nama user"
                                                    value="<?php echo $dataToko['nama_toko'];?>">
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
                                                    placeholder="nama user"
                                                    value="<?php echo $detail_peternak['no_hp'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label" for="nama-toko">Alamat Toko</label>
                                            </div>
                                            <div class="col-lg-1 col-1">
                                                <label class="col-form-label" for="nama-toko">:</label>
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    name="alamat_toko"
                                                    rows="3"><?php echo $dataToko['alamat_toko'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label" for="nama-user">Status</label>
                                            </div>
                                            <div class="col-lg-1 col-1">
                                                <label class="col-form-label" for="nama-user">:</label>
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <select class="form-control" id="nama-user" required="required"
                                                    name="status_toko" rows="3">
                                                    <option> -- Pilih Status Toko --</option>
                                                    <option value="0"
                                                        <?php if($dataToko['status_toko']=='0'){echo "selected";} else echo "";?>>
                                                        Akun Tidak Aktif</option>
                                                    <option value="1"
                                                        <?php if($dataToko['status_toko']=='1'){echo "selected";} else echo "";?>>
                                                        Akun Aktif </option>
                                                    <option value="2"
                                                        <?php if($dataToko['status_toko']=='2'){echo "selected";} else echo "";?>>
                                                        Akun Di Blokir </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="/admin/master-toko"><button type="button"
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