<?php 
namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Google_Client;
use Google_Service_Oauth2;
use App\Models\UserModel;
use App\Models\M_User;

class Register extends BaseController
{
   protected $user;

   public function __construct()
   {
      $this->user = new UserModel;
      $this->uri = service('uri');
   }

   public function antiinjection($data)
   {
      $filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
     return $filter_sql;
   }

   public function register_peternak()
   {
      echo view('Frontend/Register/register-peternak');
   }
   public function register_user()
   {
      echo view('Frontend/Register/register-user');
   }

   public function registering_account_peternak()
   {
      $modelUser = new M_User;

      $nama = $this->antiinjection($this->request->getPost('nama_lengkap'));
      $email = $this->request->getPost('email');
      $no_hp = $this->antiinjection($this->request->getPost('no_hp'));
      $password = $this->antiinjection($this->request->getPost('password'));
      $password_konfirm = ($this->request->getPost('konfirm_password'));

      $sqlCekEmail = $modelUser->getDataUser(['email_user' => $email]);
      $cekEmail = $sqlCekEmail->getRowArray();

      if ($cekEmail) {
         session()->setFlashdata('info','<h4>Email Sudah terdaftar!</h4>');
         ?>
            <script type="text/javascript">
                history.go(-1);
            </script>
         <?php
      }
      elseif(strlen($password) < 8) {
         session()->setFlashdata('error','<h5>GAGAL!!</h5><br>Password minimal 8 digit!');
         ?>
            <script type="text/javascript">
                history.go(-1);
            </script>
         <?php
      }
      elseif(!preg_match("/^[a-zA-Z0-9]*$/",$password)){
         session()->setFlashdata('error', "GAGAL!! Password Hanya Huruf dan Angka yang diijinkan!!");
         ?>
         <script type="text/javascript">
             history.go(-1);
         </script>
         <?php
      }
      elseif($password!=$password_konfirm){
         session()->setFlashdata('error', "GAGAL.. Password dan Konfirmasi Password Tidak Sama!");
         ?>
         <script type="text/javascript">
             history.go(-1);
         </script>
         <?php
      }
      else{
         $hasil = $modelUser->autoNumber(['substr(id_user,4,4)' => date("ymd")])->getRowArray();
         if(!$hasil){
             $id = "USR".date("ymd")."0001";
         }
         else{
             $kode = $hasil['id_user'];

             $noUrut = (int) substr($kode, 8, 4);
             $noUrut++;
             $id = "USR".date("ymd").sprintf("%04s", $noUrut);
         }
         $dataPeternak = [
            'id_user' => $id,
            'id_google' => '-',
            'nama_user' => $nama,
            'email_user' => $email,
            'no_hp' => $no_hp,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'foto_user' => '-',
            'akses_level' => '1',
            'status' => '0',
            'is_delete_user' => '0'
         ];
         $this->user->save($dataPeternak);
         
         $sqlCekSimpan = $modelUser->getDataUser(['id_user' => $id]);
         $cekSimpan = $sqlCekSimpan->getRowArray();

         if($cekSimpan)
         {
            $encripID = sha1($id);
            $email= $email;
            $nama = $nama;

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "mail.sobatx.id"; //host mail server
            $mail->SMTPAuth = true;
            //Provide username and password
            $mail->Username = "noreply@sobatx.id";   //nama-email smtp
            $mail->Password = "m4k8hywh42";           //password email smtp
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("noreply@sobatx.id","Aktivasi SobatX");
            $mail->AddAddress($email,$nama);
            $mail->IsHTML(true);
            $mail->Subject = "SobatX | Aktivasi Akun Peternak";
            $mail->Body = "
            Hai $nama...<br/>
            <br/>
            Saat ini Anda telah terdaftar pada Aplikasi <b>SobatX</b> sebagai Peternak. Silahkan Aktifkan Akun anda dengan mengakses link dibawah ini:<br>
            <a href='http://localhost:8080/aktivasi-akun/$encripID' target='_blank' title='Aktivasi Akun SobatX'><h4>AKTIFKAN AKUN</h4></a><br/>
            <br/>
            Namun jika Anda <b>tidak merasa melakukan pendaftaran akun</b>, silakan klik link di bawah ini untuk membatalkan proses registrasi.<br />
            <a href='http://localhost:8080/batalkan-akun/$encripID' target='_blank' title='Hapus Akun SobatX'>Hapus Akun SobatX!!</a><br /><br />
            Thanks..."; 
            $mail->send();  
            
            session()->setFlashdata('info','<h4>Silahkan Aktivasi Akun Anda dan Lengkapi Data Anda!</h4>');
            return redirect()->to(base_url('/peternak'));
         }
         else
         {
            session()->setFlashdata('error', "Pendaftaran Gagal, Sistem Maintenance!");
            ?>
            <script type="text/javascript">
                history.go(-1);
            </script>
            <?php
         }
      }
   }

   public function registering_account_user()
   {
      $modelUser = new M_User;

      $nama = $this->antiinjection($this->request->getPost('nama_lengkap'));
      $email = $this->request->getPost('email');
      $no_hp = $this->antiinjection($this->request->getPost('no_hp'));
      $password = $this->antiinjection($this->request->getPost('password'));
      $password_konfirm = ($this->request->getPost('konfirm_password'));

      $sqlCekEmail = $modelUser->getDataUser(['email_user' => $email]);
      $cekEmail = $sqlCekEmail->getRowArray();

      if ($cekEmail) {
         session()->setFlashdata('info','<h4>Email Sudah terdaftar!</h4>');
         ?>
            <script type="text/javascript">
                history.go(-1);
            </script>
         <?php
      }
      elseif(strlen($password) < 8) {
         session()->setFlashdata('error','<h5>GAGAL!!</h5><br>Password minimal 8 digit!');
         ?>
            <script type="text/javascript">
                history.go(-1);
            </script>
         <?php
      }
      elseif(!preg_match("/^[a-zA-Z0-9]*$/",$password)){
         session()->setFlashdata('error', "GAGAL!! Password Hanya Huruf dan Angka yang diijinkan!!");
         ?>
         <script type="text/javascript">
             history.go(-1);
         </script>
         <?php
      }
      elseif($password!=$password_konfirm){
         session()->setFlashdata('error', "GAGAL.. Password dan Konfirmasi Password Tidak Sama!");
         ?>
         <script type="text/javascript">
             history.go(-1);
         </script>
         <?php
      }
      else{
         $hasil = $modelUser->autoNumber(['substr(id_user,4,4)' => date("ymd")])->getRowArray();
         if(!$hasil){
             $id = "USR".date("ymd")."0001";
         }
         else{
             $kode = $hasil['id_user'];

             $noUrut = (int) substr($kode, 8, 4);
             $noUrut++;
             $id = "USR".date("ymd").sprintf("%04s", $noUrut);
         }
         $dataUser = [
            'id_user' => $id,
            'id_google' => '-',
            'nama_user' => $nama,
            'email_user' => $email,
            'no_hp' => $no_hp,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'foto_user' => '-',
            'akses_level' => '2',
            'status' => '0',
            'is_delete_user' => '0'
         ];
         $this->user->save($dataUser);
         
         $sqlCekSimpan = $modelUser->getDataUser(['id_user' => $id]);
         $cekSimpan = $sqlCekSimpan->getRowArray();

         if($cekSimpan)
         {
            $encripID = sha1($id);
            $email= $email;
            $nama = $nama;

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "mail.sobatx.id"; //host mail server
            $mail->SMTPAuth = true;
            //Provide username and password
            $mail->Username = "noreply@sobatx.id";   //nama-email smtp
            $mail->Password = "m4k8hywh42";           //password email smtp
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("noreply@sobatx.id","Aktivasi SobatX");
            $mail->AddAddress($email,$nama);
            $mail->IsHTML(true);
            $mail->Subject = "SobatX | Aktivasi Akun Pengguna";
            $mail->Body = "
            Hai $nama...<br/>
            <br/>
            Saat ini Anda telah terdaftar pada Aplikasi <b>SobatX</b> sebagai Pengguna. Silahkan Aktifkan Akun anda dengan mengakses link dibawah ini:<br>
            <a href='http://localhost:8080/aktivasi-akun/$encripID' target='_blank' title='Aktivasi Akun SobatX'><h4>AKTIFKAN AKUN</h4></a><br/>
            <br/>
            Namun jika Anda <b>tidak merasa melakukan pendaftaran akun</b>, silakan klik link di bawah ini untuk membatalkan proses registrasi.<br />
            <a href='http://localhost:8080/batalkan-akun/$encripID' target='_blank' title='Hapus Akun SobatX'>Hapus Akun SobatX!!</a><br /><br />
            Thanks..."; 
            $mail->send();  
            
            session()->setFlashdata('info','<h4>Silahkan Aktivasi Akun Anda dan Lengkapi Data Anda!</h4>');
            return redirect()->to(base_url('/user'));
         }
         else
         {
            session()->setFlashdata('error', "Pendaftaran Gagal, Sistem Maintenance!");
            ?>
            <script type="text/javascript">
                history.go(-1);
            </script>
            <?php
         }
      }
   }

   public function aktivasi_akun()
   {
      $modelUser = new M_User;

      $uri = service('uri');
      $idUser = $uri->getSegment(2);
      
      $where = ['sha1(id_user)' => $this->antiinjection($idUser)];
      $dataAktivasi = $modelUser->getDataUser($where)->getRowArray();

      if(!$dataAktivasi or $dataAktivasi['status'] != 0){
         session()->setFlashdata('error', "Token Aktivasi Tidak Ditemukan!!");
         return redirect()->to(base_url('/404-page'));
      }
      else{
         $dataUpdate = [
             'status' => '1',
             'updated_at' => date("Y-m-d H:i:s")
         ];
         $modelUser->updateDataUser($dataUpdate, $where);
         session()->setFlashdata('success', "Aktivasi Akun Berhasil!<br>Silahkan Login pada Aplikasi");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/success-page');?>";
         </script>
         <?php
      }
   }

   public function batalkan_akun()
   {
      $modelUser = new M_User;
      $uri = service('uri');
      $idUser = $uri->getSegment(2);
      
      $where = ['sha1(id_user)' => $this->antiinjection($idUser)];
      $dataAktivasi = $modelUser->getDataUser($where)->getRowArray();

      if(!$dataAktivasi or $dataAktivasi['status'] != 0){
         session()->setFlashdata('error', "Token Aktivasi Tidak Ditemukan!!");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/404-page');?>";
         </script>
         <?php
      }
      else{
         $modelUser->hapusDataUser($where);
         session()->setFlashdata('info', "Akun Telah Dihapus!!");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/success-page');?>";
         </script>
         <?php
      }
   }
}