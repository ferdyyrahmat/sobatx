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
                    <h4>Detail Peternak</h4>
                </div>
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
                                <br />
                                <span class="text-black-50">
                                    <?php if($detail_peternak['status'] == '0'){
                                      echo '<span class="badge bg-danger">Akun Tidak aktif</span>';
                                    } elseif($detail_peternak['status'] == '1'){
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
                                            <label class="col-form-label" for="nama-user">Alamat</label>
                                        </div>
                                        <div class="col-lg-1 col-1">
                                            <label class="col-form-label" for="nama-user">:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider">
                            <div class="divider-text">Informasi Toko</div>
                        </div>
                        <div class="row">
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
                                        <?php if($dataToko['status_toko'] = null){
                                          echo '<span class="badge bg-black">Toko Tidak Tersedia/Belum diBuat</span>';
                                        }
                                        elseif($dataToko['status_toko'] == '0'){
                                          echo '<span class="badge bg-danger">Toko Tidak aktif</span>';
                                        } elseif($dataToko['status_toko'] == '1'){
                                          echo '<span class="badge bg-success">Toko Aktif</span>';
                                        } elseif($dataToko['status_toko'] == '2'){
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
                                            placeholder="nama toko" 
                                            value="
                                            <?php if($dataToko['nama_toko']= null){
                                                echo '<span class="badge bg-black">Toko Tidak Tersedia/Belum diBuat</span>';
                                            }else{
                                                 echo $dataToko['nama_toko'];
                                            } ?>" 
                                            disabled>
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
                                            disabled><?php if($dataToko['alamat_toko']= null){
                                                echo '<span class="badge bg-black">Toko Tidak Tersedia/Belum diBuat</span>';
                                            }else{
                                                 echo $dataToko['alamat_toko'];
                                            } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>