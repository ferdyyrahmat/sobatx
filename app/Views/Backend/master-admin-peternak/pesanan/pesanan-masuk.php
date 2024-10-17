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

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">List Pesanan</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Pesanan Masuk</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Di Kirim</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Selesai</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                                <table class="table">
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
                                                <form
                                                    action="<?= base_url('/admin/update-pesanan-peternak').'/'.$data['id_pesanan']?>"
                                                    method="post" enctype="multipart/form-data">
                                                    <button class="btn btn-info" type="submit">Kirim</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th data-sortable="true">No</th>
                                            <th data-sortable="true">Nama Pembeli</th>
                                            <th data-sortable="true">Nama Produk</th>
                                            <th data-sortable="true">Alamat Lengkap</th>
                                            <th data-sortable="true">Berat</th>
                                            <th data-sortable="true">Jumlah Beli</th>
                                            <th data-sortable="true">Total Harga</th>
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
                                        <?php if($data['status_pesanan'] == '2'){?>
                                        <tr>
                                            <td data-sortable="true"><?php echo $no=$no+1;?></td>
                                            <td data-sortable="true"><?php echo $data['nama_user']; ?></td>
                                            <td data-sortable="true"><?php echo $data['nama_produk']; ?></td>
                                            <td data-sortable="true"><?php echo $data['alamat_lengkap']; ?></td>
                                            <td data-sortable="true"><?php echo $data['berat']; ?></td>
                                            <td data-sortable="true"><?php echo $data['jumlah']; ?></td>
                                            <td data-sortable="true"><?php echo $data['total_harga']; ?></td>
                                            <td data-sortable="true">
                                                <?php if($data['metode'] == '0'){
                                                       echo '<span class="badge bg-success">COD</span>';
                                                    }else{
                                                        echo '<span>Pesanan Selesai</span>';
                                                    } ?>
                                            </td>
                                            <td data-sortable="true">
                                                <?php if($data['status_pesanan'] == '1'){
                                                       echo '<span class="badge bg-warning">Perlu Dikirim</span>';
                                                    } elseif($data['status_pesanan'] == '2'){
                                                       echo '<span class="badge bg-primary">Sedang Di Kirim</span>';
                                                    } else{
                                                        echo '<span class="badge bg-success">Selesai</span>';
                                                    } ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">Kirim</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th data-sortable="true">No</th>
                                            <th data-sortable="true">Nama Pembeli</th>
                                            <th data-sortable="true">Nama Produk</th>
                                            <th data-sortable="true">Alamat Lengkap</th>
                                            <th data-sortable="true">Berat</th>
                                            <th data-sortable="true">Jumlah Beli</th>
                                            <th data-sortable="true">Total Harga</th>
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
                                        <?php if($data['status_pesanan'] == '3'){?>
                                        <tr>
                                            <td data-sortable="true"><?php echo $no=$no+1;?></td>
                                            <td data-sortable="true"><?php echo $data['nama_user']; ?></td>
                                            <td data-sortable="true"><?php echo $data['nama_produk']; ?></td>
                                            <td data-sortable="true"><?php echo $data['alamat_lengkap']; ?></td>
                                            <td data-sortable="true"><?php echo $data['berat']; ?></td>
                                            <td data-sortable="true"><?php echo $data['jumlah']; ?></td>
                                            <td data-sortable="true"><?php echo $data['total_harga']; ?></td>
                                            <td data-sortable="true">
                                                <?php if($data['metode'] == '0'){
                                                       echo '<span class="badge bg-success">COD</span>';
                                                    }else{
                                                        echo '<span>Pesanan Selesai</span>';
                                                    } ?>
                                            </td>
                                            <td data-sortable="true">
                                                <?php if($data['status_pesanan'] == '1'){
                                                       echo '<span class="badge bg-warning">Perlu Dikirim</span>';
                                                    } elseif($data['status_pesanan'] == '2'){
                                                       echo '<span class="badge bg-primary">Sedang Di Kirim</span>';
                                                    } else{
                                                        echo '<span class="badge bg-success">Selesai</span>';
                                                    } ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">Kirim</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal Diterima -->

<div class="modal fade" id="diterima">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pesanan Sudah Di terima</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Pesanan Sudah Anda Terima...?
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <a href="#" class="btn btn-primary">YA</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Diterima -->


<script>
    $(document).ready(function () {
        $("#example").DataTable();
    });
</script>