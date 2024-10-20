<!-- SECTION -->
<div class="section" style="padding: 15px 15px 0 15px;">
   <!-- container -->
   <div class="container">
      <h4>Profile</h4>
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="panel panel-default">
               <div class="panel-body"
                  style="background-color: #FD873F; border: 2px solid #167B60; color: #fff; border-radius: 10px;">
                  <table border="0">
                     <tbody>
                        <tr>
                           <td style="width: 30px;"><i class="fa-solid fa-user"></i></td>
                           <td><?= $profile['nama_user'] ?></td>
                        </tr>
                        <tr>
                           <td style="width: 30px;"><i class="fa-solid fa-briefcase"></i></td>
                           <td>Pengguna</td>
                        </tr>
                        <tr>
                           <td style="width: 30px;"><i class="fa-solid fa-phone"></i></td>
                           <td><?= $profile['no_hp'] ?></td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="row">
                     <div class="col-md-12">
                        <a href="<?= base_url()?>user/edit/<?= sha1($profile['id_user'])?>" class="btn btn-default btn-sm"
                           style="background-color: #167B60; color: #fff; float: right;">
                           <i class="fa-solid fa-pen-to-square"></i> edit
                        </a>
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