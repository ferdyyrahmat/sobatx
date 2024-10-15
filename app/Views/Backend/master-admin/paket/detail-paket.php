<div class="page-heading">
   <div class="page-title">
      <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">

            <!-- <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery required).</p> -->
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin/master-paket">Master Paket</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail </li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <section class="section">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">
               Data Pengajuan <?= $dataPaket['nama_paket']; ?>
            </h5>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table" id="table1">
                  <thead>
                     <tr>
                        <th data-sortable="true">No</th>
                        <th data-sortable="true">Name</th>
                        <th data-sortable="true">Tanggal Pengajuan</th>
                        <th data-sortable="true">Paket Usaha</th>
                        <th data-sortable="true">Status</th>
                        <th data-sortable="true">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $no = 0;
                        //variable dari GetResultArray
                        foreach($dataBeliPaket as $data){
                        ?>
                     <tr>
                        <td data-sortable="true"><?php echo $no=$no+1;?></td>
                        <td data-sortable="true"><?php echo $data['nama_user'];?></td>
                        <td data-sortable="true"><?php echo $data['tgl_pembelian'];?></td>
                        <td data-sortable="true"><?php echo $data['nama_paket'];?></td>
                        <td data-sortable="true">
                           <?php if($data['status_pengajuan'] == '1'){
                              echo '<span class="badge bg-warning">Menunggu diSetujui</span>';
                           } elseif($data['status_pengajuan'] == '2'){
                              echo '<span class="badge bg-success">Disetujui</span>';
                           } else{
                              echo '<span class="badge bg-secondary">Error!</span>';
                           } ?>
                        </td>
                        <td>
                           <?php 
                           if ($data['status_pengajuan'] != '1') {
                              echo '<i>Sudah disetujui!</i>';
                           }else{
                           ?>
                           <a href="/admin/verifying-paket/<?php echo sha1($data['id_paket'])?>/<?php echo sha1($data['id_user'])?>" class="btn btn-sm btn-success">
                              <i class="bi bi-check"></i> Setujui Pengajuan
                           </a>
                           <?php } ?>
                        </td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>