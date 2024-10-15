<!-- SECTION -->
<div class="section" style="padding: 15px 15px 0 15px;">
   <!-- container -->
   <div class="container">
      <h4>Profile</h4>
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <form action="3" method="post">
               <div class="row">
                  <div class="col-md-6 col-xs-12">
                     <div class="form-group">
                        Nama Lengkap
                        <input type="text" class="form-control" name="nama_user" value="<?= $profile['nama_user'] ?>" placeholder="Search for...">
                     </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                     <div class="form-group">
                        Email
                        <input type="text" class="form-control" name="email_user" value="<?= $profile['email_user'] ?>" placeholder="Search for..." disabled>
                     </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                     <div class="form-group">
                        No. Telpon
                        <input type="text" class="form-control" name="no_hp" value="<?= $profile['no_hp'] ?>" placeholder="Search for...">
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->