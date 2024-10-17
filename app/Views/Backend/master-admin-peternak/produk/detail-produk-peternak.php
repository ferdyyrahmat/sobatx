<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Master Pelanggan</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="row">
        <div class="">
            <div class="card-header">
                <h4>Detail Produk</h4>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <center>
                                            <div class="col-md-4">
                                                <div id="carouselExampleControls" class="carousel slide"
                                                    data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <?php 
                                                        $i=1;
                                                        foreach($dataFotoProduk as $data){ ?>
                                                        <div class="carousel-item <?php if($i==1){echo 'active';};?>">
                                                            <img src="<?= base_url()?>Assets/img/toko/produk/<?= $data['nm_foto']?>"
                                                                class="d-block w-100" alt="<?= $data['nm_foto']?>">
                                                        </div>
                                                        <?php $i++; } ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls"
                                                        role="button" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"
                                                            style="color:#FD873F ;"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls"
                                                        role="button" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </center>
                                        <div class="col-md-12" style="padding-top: 10px;">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nama_produk"
                                                    name="nama_produk" style="text-align: center;"
                                                    value="<?= $dataProduk['nama_produk'];?>" disabled>
                                            </div>
                                        </div>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-deskripsi"
                                                        aria-expanded="false" aria-controls="flush-deskripsi">
                                                        Deskripsi
                                                    </button>
                                                </h2>
                                                <div id="flush-deskripsi" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body" style="">
                                                        <span
                                                            style="font-size: 14px;"><?= $dataProduk['deskripsi_produk'];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="harga_produk">Harga :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        <input type="text" name="harga" class="form-control"
                                                            id="dengan-rupiah" aria-label="Harga"
                                                            style="text-align: right;" min="0"
                                                            aria-describedby="basic-addon1" placeholder="0"
                                                            value="<?= $dataProduk['harga'];?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="harga_produk">berat :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">gram</span>
                                                        <input type="number" name="berat" class="form-control"
                                                            style="text-align: right;" placeholder="1000"
                                                            value="<?= $dataProduk['berat'];?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stok">Stok Tersedia :</label>
                                                    <input type="number" class="form-control" name="stok"
                                                        value="<?= $dataProduk['stok'];?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kategori">Kategori :</label>
                                                    <input type="text" class="form-control" name="kategori"
                                                        value="<?= $dataProduk['nama_kategori'];?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="/admin/produk-saya-peternak"><button type="button"
                                                    class="btn btn-warning">Kembali</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>