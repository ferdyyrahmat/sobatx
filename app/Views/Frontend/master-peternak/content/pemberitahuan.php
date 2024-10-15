<!-- SECTION -->
<div class="section" style="padding: 15px 15px 0 15px;">
   <!-- container -->
   <div class="container">
      <h4>Pemberitahuan</h4>
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <?php
            foreach ($notif as $data) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
               <strong><?= $data['head'];?></strong> <br>
               <small><?= $data['msg'];?></small>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
   <!-- /container -->
</div>
<!-- /SECTION -->