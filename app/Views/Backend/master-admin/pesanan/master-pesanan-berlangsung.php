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
                        <h5>Pesanan Berlangsung</h5>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div> <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table1">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 0;
                                //variable dari GetResultArray
                                foreach($dataPesanan as $data){
                            ?>
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
                                       echo '<span class="badge bg-info">Sedang Di Kirim</span>';
                                    } else{
                                        echo '<span>Selesai</span>';
                                    } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>