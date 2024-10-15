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
                    <h4>Edit Data Peternak</h4>
                </div>
                <form action="<?php echo base_url('/admin/update-peternak');?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <?php 
                                    $checkFoto = file_exists('Assets/img/profile/'.$detail_peternak['foto_user']);
                                    if($checkFoto){
                                       if ($detail_peternak['foto_user'] == '' or $detail_peternak['foto_user'] == '-') {
                                          $user_profile = base_url().'Assets/img/user.png';
                                       }else{
                                       $user_profile = base_url().'Assets/img/profile/'.$detail_peternak['foto_user'];
                                       }
                                    }
                                    elseif(!$checkFoto){
                                       $user_profile = $detail_peternak['foto_user'];
                                    }
                                    ?>
                                    <img src="<?php echo $user_profile; ?>"
                                        class="rounded-circle" width="150px">
                                    <input type="hidden" name="foto_user_old" value="<?php echo $detail_peternak['foto_user']?>"><br>
                                    <input type="file" class="form-control form-control-sm" name="foto_profile" accept="image/*,.jpg,.jpeg,.png">
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
                                                    value="<?php echo $detail_peternak['nama_user'];?>">
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
                                                    value="<?php echo $detail_peternak['email_user'];?>">
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
                                                <input type="tel" id="nama-user" class="form-control" name="no_hp"
                                                    placeholder="nama user"
                                                    value="<?php echo $detail_peternak['no_hp'];?>">
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
                                                <span class="text-black-50">
                                                    <?php if($detail_peternak['status'] == '0'){
                                                        echo '<span class="badge bg-danger">Tidak aktif</span>';
                                                    } elseif($detail_peternak['status'] == '1'){
                                                        echo '<span class="badge bg-success">Aktif</span>';
                                                    } else{
                                                        echo '<span class="badge bg-secondary">DiBlokir</span>';
                                                    } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: right;">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="/admin/master-peternak"><button type="button"
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