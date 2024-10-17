<!-- SECTION -->
<div class="section" style="padding: 15px 15px 10vb 15px;">
    <!-- container -->
    <div class="container">
        <h4>Toko Saya</h4>
        <?php 
         if (!isset($dataToko['id_user'])) { ?>
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit</h4>
                        </div>
                        <form action="/admin/simpan-toko-peternak/" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <input type="hidden" name="id_produk">
                                            <div class="form-group">
                                                <label for="foto_toko">Foto Toko</label>
                                                <input type="file" class="form-control" id="foto_toko" name="foto_toko"
                                                    accept="image/*,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="nama_toko">Nama Toko</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <input type="text" class="form-control" id="nama_toko"
                                                            name="nama_toko">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="nama_toko">Provinsi</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <select class="form-control" name="provinsi"
                                                            id="provinsi"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="nama_toko">Kota</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <select class="form-control" name="kota" id="kota"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="tentang_toko">Alamat</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <textarea class="form-control" name="alamat_toko"
                                                            id="tentang_toko" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="text-align: right;">
                                                <button class="btn btn-success" type="submit">Simpan</button>
                                                <button type="reset" class="btn btn-warning">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php 
         } else { ?>
                    <div class="col-sm-12 col-md-12">
                        <div class="thumbnail" style="border: 0;">
                            <center>
                                <img src="<?= base_url()?>Assets/img/toko/<?php echo $dataToko['foto_toko']; ?>"
                                    alt="sobatx"
                                    style="width: 100%; max-width: 15vb; border-radius: 50%; margin: 10px; border: 3px solid seagreen; box-shadow: 0px 0px 4px 0px;">
                                <br>
                                <?php if ($dataToko['status_toko'] == '0') { ?>
                                <button class="btn btn-danger btn-sm"> Toko Belum Aktif</button>
                                <?php } elseif($dataToko['status_toko'] == '1') { ?>
                                <button class="btn btn-success btn-sm"> Toko Aktif</button>
                                <?php } ?>
                            </center>
                        </div>
                    </div>
                    <hr />
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit</h4>
                        </div>
                        <form action="/admin/simpan-toko-peternak/" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="<?= base_url()?>Assets/img/toko/<?php echo $dataToko['foto_toko']; ?>"
                                                alt="sobatx"
                                                style="width: 100%; max-width: 15vb; border-radius: 50%; margin: 10px; border: 3px solid seagreen; box-shadow: 0px 0px 4px 0px;">
                                            <input type="hidden" name="id_produk">
                                            <div class="form-group">
                                                <label for="foto_toko">Edit Foto Toko</label>
                                                <input type="file" class="form-control" id="foto_toko"
                                                    name="foto_toko_edit" accept="image/*,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="nama_toko">Nama Toko</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <input type="text" class="form-control" id="nama_toko"
                                                            name="nama_toko_edit" value="<?= $dataToko['nama_toko']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="nama_toko">Provinsi</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <select class="form-control" name="provinsi_edit"
                                                            id="provinsi"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="nama_toko">Kota</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <select class="form-control" name="kota_edit"
                                                            id="kota"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-3 col-4">
                                                        <label for="tentang_toko">Alamat</label>
                                                    </div>
                                                    <div class="col-lg-1 col-1">
                                                        <label class="col-form-label" for="nama-user">:</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-7">
                                                        <textarea class="form-control" name="alamat_toko_edit"
                                                            id="tentang_toko" cols="30"
                                                            rows="4"><?= $dataToko['alamat_toko']?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="text-align: right;">
                                                <button class="btn btn-success" type="submit">Simpan</button>
                                                <button type="reset" class="btn btn-warning">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <?php
                                    if($dataToko['status_toko'] == '0'){ ?>
                                        <a class="btn btn-default btn-sm"
                                            href="/admin/aktivasi-toko-peternak/<?= sha1($dataToko['id_toko']); ?>">Aktifkan
                                            toko</a>
                                        <?php } elseif($dataToko['status_toko'] == '1'){ ?>
                                        <a class="btn btn-danger btn-sm"
                                            href="/admin/nonaktifkan-toko-peternak<?= sha1($dataToko['id_toko']); ?>">Non-Aktifkan
                                            toko</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                    <hr>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="card">
                                <div class="card-body">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-6 col-md-6 col-sm-6 col-xs-6">
                                                <h3 class="panel-title">Daftar Rekening</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto ms-auto text-end mt-n1 col-10" style="text-align: right;">
                                        <a class="btn btn-primary btn-sm" href="/admin/tambah-rekening-peternak">
                                            <i class="fa-solid fa-plus"></i> Tambah
                                        </a>
                                    </div><br />
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <td>#</td>
                                                <td>Pemilik</td>
                                                <td>No. Rek</td>
                                                <td>Bank</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                                <?php
                                        $no=1;
                                        foreach($dataRekening as $data){?>
                                                <tr>
                                                    <td><?= $no++?></td>
                                                    <td><?= $data['nama_pemilik']?></td>
                                                    <td><?= $data['no_rekening']?></td>
                                                    <td><?= strtoupper($data['nama_bank'])?></td>
                                                    <td><a href="/admin/hapus-rekening-peternak/<?= sha1($data['id_rekening'])?>"
                                                            class="btn btn-danger btn-xs"><i
                                                                class="bi bi-trash"></i></a></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
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
<!-- /container -->
</div>
<!-- /SECTION -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/rajaongkir/provinsi')?>',
            success: function (hasil_provinsi) {
                $("select[id=provinsi]").html(hasil_provinsi);
                // console.log(hasil_provinsi);
            }
        });

        $('select[id=provinsi]').on("change", function () {
            var id_provinsi = $('option:selected', this).attr('id_provinsi');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('/rajaongkir/kota')?>',
                data: 'id_provinsi=' + id_provinsi,
                success: function (hasil_kota) {
                    // console.log(hasil_kota);
                    $("select[id=kota]").html(hasil_kota);
                }
            })
        })
    });
</script>