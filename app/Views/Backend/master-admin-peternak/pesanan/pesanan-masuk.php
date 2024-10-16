<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Peternak</h3>
                <!-- <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery required).</p> -->
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan Masuk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- /.content-wrapper -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Pesanan Masuk</h5>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div> <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table2">
                        <thead>
                            <tr>
                                <th data-sortable="true">No</th>
                                <th data-sortable="true">Nama Pembeli</th>
                                <th data-sortable="true">Nama Produk</th>
                                <th data-sortable="true">Alamat Lengkap</th>
                                <th data-sortable="true">Berat</th>
                                <th data-sortable="true">Jumlah Beli</th>
                                <th data-sortable="true">Total Bayar</th>
                                <th data-sortable="true">Metode Pembayaran</th>
                                <th data-sortable="true">Status</th>
                                <th data-sortable="true">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 0;
                                //variable dari GetResultArray
                                foreach($dataPesanan as $data){
                            ?>
                            <?php if($data['status_pesanan'] == '1'){?>
                            <tr>
                                <td data-sortable="true"><?php echo $no=$no+1;?></td>
                                <td data-sortable="true"><?php echo $data['nama_user']; ?></td>
                                <td data-sortable="true"><?php echo $data['nama_produk']; ?></td>
                                <td data-sortable="true"><?php echo $data['alamat_lengkap']; ?></td>
                                <td data-sortable="true"><?php echo $data['berat']; ?></td>
                                <td data-sortable="true"><?php echo $data['jumlah']; ?></td>
                                <td data-sortable="true"><?php echo $data['total_bayar']; ?></td>
                                <td data-sortable="true"><?php echo $data['metode'];?></td>
                                <td data-sortable="true">
                                    <?php if($data['status_pesanan'] == '1'){
                                       echo '<span class="badge bg-warning">Perlu Dikirim</span>';
                                    } elseif($data['status_pesanan'] == '2'){
                                       echo '<span>Sedang Di Kirim</span>';
                                    } else{
                                        echo '<span>Selesai</span>';
                                    } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#inlineForm<?php echo $data['id_pesanan'];?>">
                                        Kirim
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>

<!-- Modal -->
<?php
    foreach($dataPesanan as $data){
?>
<div class="modal fade text-left" id="inlineForm<?php echo $data['id_pesanan'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="<?= base_url('/admin/update-pesanan-peternak').'/'.$data['id_pesanan']?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="email">Masukan Nama Kurir</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama_kurir" placeholder=" masukkan nama kurir">
                    </div>
                    <label for="password">No Handphone</label>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="no_hp_kurir" placeholder="08...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kirim Pesanan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>