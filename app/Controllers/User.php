<?php 
namespace App\Controllers;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\UserModel;

use App\Models\M_User;

class User extends BaseController
{
   protected $googleClient;
   protected $user;

   public function __construct()
   {
      session();
      $this->user = new UserModel;
      $this->googleClient = new Google_Client();

      $this->googleClient->setClientId('352430909735-lsl5d2ibcti8b9undf2b1h63ocke9anj.apps.googleusercontent.com');
      $this->googleClient->setClientSecret('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');
      $this->googleClient->setRedirectUri('http://localhost:8080/user/login-auth-google');
      // $this->googleClient->setRedirectUri('https://app.sobatx.id/peternak/login-auth-google');
      $this->googleClient->addScope('email');
      $this->googleClient->addScope('profile');
   }

   public function antiinjection($data)
   {
      $filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
     return $filter_sql;
   }

   public function login_user_page()
   {
      $data['link'] = $this->googleClient->createAuthUrl();
      echo view('Frontend/Login/login_page/login_user', $data);
   }

   public function login_checker()
   {
      $modelUser = new M_User;

      $email = $this->antiinjection($this->request->getPost('email'));
      $password = $this->antiinjection($this->request->getPost('password'));

      $sqlCek = $modelUser->getDataUser(['email_user' => $email, 'status' => '1']);
      $aktif = $sqlCek->getNumRows();
      $adaEmail = $modelUser->getDataUser(['email_user' => $email])->getRowArray();

      if(!$adaEmail){
         session()->setFlashdata("error", "Email Tidak Terdaftar!<br>Silahkan Registrasi atau Login dengan Google!99");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/user');?>";
         </script>
         <?php
      }
      elseif(!$aktif){
         session()->setFlashdata('info', "Silakan cek email Anda dan lakukan aktivasi akun terlebih dahulu!");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/user');?>";
         </script>
         <?php
      }
      else{
         $sql = $modelUser->getDataUser(['email_user' => $email]);
         $cekUser = $sql->getRowArray();
         if(!$cekUser){
             session()->setFlashdata('error', "Email Tidak Terdaftar!<br>Silahkan Registrasi atau Login dengan Google!");
             ?>
             <script type="text/javascript">
                 document.location="<?php echo base_url('/user');?>";
             </script>
             <?php
         }
         else{
            $verifyPass = password_verify($password, $cekUser['password']);
            if(!$verifyPass){
               session()->setFlashdata('error', "Password Salah!!");
               ?>
               <script type="text/javascript">
                   history.go(-1);
               </script>
               <?php
            }
            else{
               $data = [
                  'id' => $cekUser['id_user'],
                  'email' => $cekUser['email_user'],
                  'nama' => $cekUser['nama_user'],
                  'profile' => $cekUser['foto_user'],
                  'enid' => sha1($cekUser['id_user'])
               ];
               session()->set($data);
               $where = ['id_user' => session('id')];
               $dataUpdate = [
                   'updated_at' => date("Y-m-d H:i:s")
               ];
               $simpan = $modelUser->updateDataUser($dataUpdate, $where);

               if($cekUser['no_hp']=='-'){
                  session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
               }

               ?>
               <script type="text/javascript">
                   document.location="<?php echo base_url('/user/dashboard');?>";
               </script>
               <?php
            }
         }
      }
      // session()->setFlashdata('error','<h5>Mohon Maaf,<br>Login Sementara Waktu Hanya Melalui Akun Google!<h5>');
      // return redirect()->to(base_url('/user/dashboard'));
   }

   public function login_checker_google()
   {
      $modelUser = new M_User;

      if($this->request->getVar('code') == null) {
         session()->setFlashdata('info', "Silahkan Login!");
         return redirect()->to(base_url('/user/'));
      }
      $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
      if(!isset($token['error'])) {
         $this->googleClient->setAccessToken($token['access_token']);
         $googleService = new Google_Service_Oauth2($this->googleClient);
         $data = $googleService->userinfo->get();

         $emailUser = $data['email'];
         $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
         $ada = $sqlcek->getRowArray();

         if(!$ada){
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
               'id_google' => $data['id'],
               'nama_user' => $data['name'],
               'email_user' => $data['email'],
               'no_hp' => '-',
               'password' => '-',
               'foto_user' => $data['picture'],
               'akses_level' => '2',
               'status' => '1',
               'is_delete_user' => '0'
            ];
            $this->user->save($dataUser);

            $dataSes =[
               'id' => $id,
               'email' => $data['email'],
               'nama' => $data['name'],
               'profile' => $data['picture']
            ];

            $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
            $ada = $sqlcek->getRowArray();

            if($ada['no_hp'] == '-') {
               session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
            };

            if($ada['akses_level'] == '1') {
               session()->set($dataSes);
               return redirect()->to(base_url('/peternak/dashboard'));
            }else{
               session()->set($dataSes);
               return redirect()->to(base_url('/user/dashboard'));
            }
         }
         else{
            $emailUser = $data['email'];
            $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
            $ada = $sqlcek->getRowArray();
            $dataPeternak = [
               'id_user' => $ada['id_user'],
               'id_google' => $data['id'],
               'nama_user' => $data['name'],
               'email_user' => $data['email']
            ];
            $this->user->save($dataPeternak);

            $dataSes = [
               'id' => $ada['id_user'],
               'profile' => $data['picture'],
               'email' => $data['email'],
               'nama' => $data['name'],
            ];
            session()->set($dataSes);
            
            if($ada['no_hp'] == '-') {
               $notif = [
                  'id_user' => $ada['id_user'],
                  'head' => 'info',
                  'msg' => "Lengkapi Alamat dan No. Telpon Anda!"
               ];
               $modelUser->saveNotif($notif);
               session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
            }
            
            return redirect()->to(base_url('/user/dashboard'));
         }

      }
   }

   public function logout()
   {
      session()->destroy();
      return redirect()->to(base_url('/'));
   }

   public function dashboard_user()
   {
      $modelUser = new M_User;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-pengguna/menu', $data);
      echo view('Frontend/master-pengguna/content/top-selling', $data);
      echo view('Frontend/master-pengguna/content/featured-product', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function tentang_kami_pengguna()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-pengguna/content/tentang-kami', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function pemberitahuan_pengguna()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-pengguna/content/pemberitahuan', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function profil_pengguna()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-pengguna/content/profil', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function edit_profil_pengguna()
   {
      $uri = service('uri');
      $page = $uri->getSegment(2);
      $idEdit = $uri->getSegment(3);

      $modelUser = new M_User;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      session()->set(['idUpdate' => session('id')]);

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-pengguna/content/edit-profile', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function marketplace_user()
   {
      $modelUser = new M_User;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header-marketplace');
      echo view('Frontend/master-pengguna/content/marketplace');
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer');
   }

   public function detail_product_marketplace()
   {
      $modelUser = new M_User;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header-marketplace2');
      echo view('Frontend/master-pengguna/content/marketplace/detail-product');
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer');
   }

   public function checkout_product_marketplace()
   {
      $modelUser = new M_User;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header-checkout');
      echo view('Frontend/master-pengguna/content/marketplace/checkout');
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer');
   }

   public function checkout_alamat()
   {
      $modelUser = new M_User;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header-checkout');
      echo view('Frontend/master-pengguna/content/marketplace/alamat');
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer');
   }
}