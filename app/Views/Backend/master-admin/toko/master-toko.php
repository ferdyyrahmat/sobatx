<div class="page-heading">
   <div class="page-title">
      <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Toko</h3>
            <!-- <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery required).</p> -->
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Toko</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <section class="section">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title">
               Toko
            </h5>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table" id="table1">
                  <thead>
                     <tr>
                        <th data-sortable="true">No</th>
                        <th data-sortable="true">Nama Toko</th>
                        <th data-sortable="true">Owner</th>
                        <th data-sortable="true">Status</th>
                        <th data-sortable="true">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $no = 0;
                        //variable dari GetResultArray
                        foreach($dataToko as $data){
                        ?>
                     <tr>
                        <td data-sortable="true"><?php echo $no=$no+1;?></td>
                        <td data-sortable="true"><?php echo $data['nama_toko'];?></td>
                        <td data-sortable="true"><?php echo $data['nama_user'];?></td>
                        <td data-sortable="true">
                           <?php if($data['status_toko'] == '0'){
                              echo '<span class="badge bg-danger">Tidak aktif</span>';
                           } elseif($data['status_toko'] == '1'){
                              echo '<span class="badge bg-success">Aktif</span>';
                           } else{
                              echo '<span class="badge bg-secondary">DiBlokir</span>';
                           } ?>
                        </td>
                        <td>
                           <a href="/admin/edit-toko/<?php echo $data['id_user']?>" class="btn btn-sm btn-warning">
                              <i class="bi bi-pencil-square"></i>
                           </a>
                           <a href="/admin/detail-toko/<?php echo $data['id_user']?>" class="btn btn-sm btn-info ">
                              <i class="bi bi-search"></i>
                           </a>
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