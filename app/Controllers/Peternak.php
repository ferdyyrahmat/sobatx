<?php 
namespace App\Controllers;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\UserModel;

use App\Models\M_User;
use App\Models\M_PUsaha;
use App\Models\M_Toko;
use App\Models\M_Produk;
use App\Models\M_Kategori;
use App\Models\M_Rekening;

class Peternak extends BaseController
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
      $this->googleClient->setRedirectUri('http://localhost:8080/peternak/login-auth-google');
      // $this->googleClient->setRedirectUri('https://app.sobatx.id/peternak/login-auth-google');
      $this->googleClient->addScope('email');
      $this->googleClient->addScope('profile');
   }

   function compress($source, $destination, $quality) {
      $info = getimagesize($source);
      if ($info['mime'] == 'image/jpeg') 
      $image = imagecreatefromjpeg($source);
      elseif ($info['mime'] == 'image/gif')
      $image = imagecreatefromgif($source);
      elseif ($info['mime'] == 'image/png')
      $image = imagecreatefrompng($source);
      imagejpeg($image, $destination, $quality);
      return $destination;
  }

   public function antiinjection($data)
   {
      $filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
     return $filter_sql;
   }

   public function login_peternak_page()
   {
      $data['link'] = $this->googleClient->createAuthUrl();
      echo view('Frontend/Login/login_page/login_peternak', $data);
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
         session()->setFlashdata("error", "Email Tidak Terdaftar!<br>Silahkan Registrasi atau Login dengan Google!");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/peternak');?>";
         </script>
         <?php
      }
      elseif(!$aktif){
         session()->setFlashdata('info', "Silakan cek email Anda dan lakukan aktivasi akun terlebih dahulu!");
         ?>
         <script type="text/javascript">
             document.location="<?php echo base_url('/peternak');?>";
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
                 document.location="<?php echo base_url('/peternak');?>";
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
                  $notif = [
                     'id_user' => $cekUser['id_user'],
                     'head' => 'info',
                     'msg' => "Lengkapi Alamat dan No. Telpon Anda!"
                  ];
                  $modelUser->saveNotif($notif);
                  session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
               }
               ?>
               <script type="text/javascript">
                   document.location="<?php echo base_url('/peternak/dashboard');?>";
               </script>
               <?php
            }
         }
      }
      // session()->setFlashdata('error','<h5>Mohon Maaf,<br>Login Sementara Waktu Hanya Melalui Akun Google!<h5>');
      // return redirect()->to(base_url('/peternak/dashboard'));
   }

   public function login_checker_google()
   {
      $modelUser = new M_User;

      if ($this->request->getVar('code') == null) {
         session()->setFlashdata('info', "Silahkan Login!");
         return redirect()->to(base_url('/peternak/'));
      }
      $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
      if (!isset($token['error'])) {
         $this->googleClient->setAccessToken($token['access_token']);
         $googleService = new Google_Service_Oauth2($this->googleClient);
         $data = $googleService->userinfo->get();

         $emailUser = $data['email'];
         $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
         $ada = $sqlcek->getRowArray();

         if (!$ada) {
            $hasil = $modelUser->autoNumber(['substr(id_user,4,4)' => date("ymd")])->getRowArray();
            if (!$hasil) {
               $id = "USR" . date("ymd") . "0001";
            } else {
               $kode = $hasil['id_user'];

               $noUrut = (int) substr($kode, 8, 4);
               $noUrut++;
               $id = "USR" . date("ymd") . sprintf("%04s", $noUrut);
            }
            $dataPeternak = [
               'id_user' => $id,
               'id_google' => $data['id'],
               'nama_user' => $data['name'],
               'email_user' => $data['email'],
               'no_hp' => '-',
               'password' => '-',
               'foto_user' => $data['picture'],
               'akses_level' => '1',
               'status' => '1',
               'is_delete_user' => '0'
            ];
            $this->user->save($dataPeternak);

            $dataSes = [
               'id' => $id,
               'email' => $data['email'],
               'nama' => $data['name'],
               'profile' => $data['picture']
            ];

            $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
            $ada = $sqlcek->getRowArray();

            if ($ada['no_hp'] == '-') {
               session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
            }

            session()->set($dataSes);
            return redirect()->to(base_url('/peternak/dashboard'));
         } else {

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

            if ($ada['no_hp'] == '-') {
               $notif = [
                  'id_user' => $ada['id_user'],
                  'head' => 'info',
                  'msg' => "Lengkapi Alamat dan No. Telpon Anda!"
               ];
               $modelUser->saveNotif($notif);
               session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
            }

            session()->set($dataSes);
            return redirect()->to(base_url('/peternak/dashboard'));
         }

      } else {
         return redirect()->to(base_url('/user-login'));
      }
   }
   public function login_checker_google_old()
   {
      $modelUser = new M_User;

      if($this->request->getVar('code') == null){
         session()->setFlashdata('info', "Silahkan Login!");
         return redirect()->to(base_url('/peternak/'));
      }
      // dd($this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code')));
      $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
      if(!isset($token['error'])) {
         $this->googleClient->setAccessToken($token['access_token']);
         $googleService = new Google_Service_Oauth2($this->googleClient);
         $data = $googleService->userinfo->get();

         $emailUser = $data['email'];
         $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
         $ada = $sqlcek->getRowArray();

         if(!$ada) {
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
               'id_google' => $data['id'],
               'nama_user' => $data['name'],
               'email_user' => $data['email'],
               'no_hp' => '-',
               'password' => '-',
               'foto_user' => $data['picture'],
               'akses_level' => '1',
               'status' => '1',
               'is_delete_user' => '0'
            ];
            $this->user->save($dataPeternak);

            $dataSes =[
               'id' => $id,
               'email' => $data['email'],
               'nama' => $data['name'],
               'profile' => $data['picture']
            ];
            session()->set($dataSes);

            $sqlcek = $modelUser->getDataUser(['email_user' => $emailUser]);
            $ada = $sqlcek->getRowArray();

            if($ada['no_hp']=='-'){
               session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
            }

            if($ada['akses_level'] != '1')
            {
               return redirect()->to(base_url('/user/dashboard'));
            }else{
               return redirect()->to(base_url('/peternak/dashboard'));  
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

            $dataSes =[
               'id' => $ada['id_user'],
               'profile' => $data['picture'],
               'email' => $data['email'],
               'nama' => $data['name'],
            ];
            session()->set($dataSes);
            
            if($ada['no_hp']=='-'){
               $notif = [
                  'id_user' => $ada['id_user'],
                  'head' => 'info',
                  'msg' => "Lengkapi Alamat dan No. Telpon Anda!"
               ];
               $modelUser->saveNotif($notif);
               // session()->setFlashdata('info', "Lengkapi Alamat dan No. Telpon Anda!");
            }
            
            return redirect()->to(base_url('/peternak/dashboard'));
         }

      }else{
         return redirect()->to(base_url('/user-login'));
      }
   }
   
   public function logout()
   {
      $modelUser = new M_User;
      $modelUser->hapusNotif(['id_user' => session('id')]);  
      session()->destroy();
      return redirect()->to(base_url('/'));
   }

   public function dashboard_peternak()
   {
      $modelUser = new M_User;
      $modelPaket = new M_PUsaha;
      $modelToko = new M_Toko;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $dataBeliPaket = $modelPaket->getDataBeliPaket(['id_user' => session('id')])->getNumRows();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
      $data['cekToko'] = $cekToko;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;
      $data['cekBeliPaket'] = $dataBeliPaket;
      $data['notif'] = $dataNotif;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/content/menu1', $data);
      echo view('Frontend/master-peternak/content/top-selling', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function tentang_kami_peternak()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/tentang-kami', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function pemberitahuan_peternak()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();

      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/pemberitahuan', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function profil_peternak()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/profil', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   
   public function mulai_usaha_peternak()
   {
      $modelUser = new M_User;
      $modelPaket = new M_PUsaha;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $dataPaket = $modelPaket->getDataPaket(['is_delete_paket' => '0'])->getResultArray();

      $data['dataPaket'] = $dataPaket;
      $data['profile'] = $dataPeternak;
      $data['menu'] = 'mulai-usaha';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/mulai-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function detail_usaha_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelPaket = new M_PUsaha;

      $idView= $uri->getSegment(3);
      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPeternak;
      $dataPaket = $modelPaket->getDataPaket(['sha1(id_paket)' => $idView,'is_delete_paket' => '0'])->getRowArray();
      $data['dataPaket'] = $dataPaket;
      $dataPaket = $modelPaket->getDataBeliPaket(['sha1(id_paket)' => $idView])->getNumRows();
      $data['dataBeliPaket'] = $dataPaket;
      session()->set(['idPaket' => $idView]);

      $dataUserBeliPaket = $modelPaket->getDataBeliPaket(['id_user' => session('id')])->getNumRows();
      $data['cekUserBeliPaket'] = $dataUserBeliPaket;
      $dataBeliPaket = $modelPaket->getDataBeliPaket(['id_user' => session('id')])->getRowArray();
      $data['cekBeliPaket'] = $dataBeliPaket;
      
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $data['menu'] = 'mulai-usaha';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/detail-mulai-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function beli_paket_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelPaket = new M_PUsaha;

      $idView= $uri->getSegment(2);
      $idPaket= $uri->getSegment(3);
      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPeternak;
      $dataPaket = $modelPaket->getDataPaket(['sha1(id_paket)' => $idView,'is_delete_paket' => '0'])->getRowArray();
      $data['dataPaket'] = $dataPaket;
      $dataPaket = $modelPaket->getDataBeliPaket(['sha1(id_paket)' => $idView])->getNumRows();
      $data['dataBeliPaket'] = $dataPaket;

      $cekBeliPaket = $modelPaket->getDataBeliPaket(['id_paket' => session('idPaket'), 'id_user' => session('id')])->getRowArray();
      if(!$cekBeliPaket){
         $paket = [
            'id_paket' => $idView,
            'id_user' => session()->get('id'),
            'tgl_pembelian' => date('Y-m-d H:i:s'),
            'status_pengajuan' => '1',
         ];
         $modelPaket->saveDataBeliPaket($paket);
         session()->setFlashdata('success', "Pembelian Paket Berhasil!");
      }else{
         session()->setFlashdata('error', "Paket Sudah Pernah diBeli!");
      };

      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $data['menu'] = 'mulai-usaha';

      return redirect()->to(base_url('/peternak/dashboard'));
   }

   public function status_pengajuan_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelPaket = new M_PUsaha;

      $idView= $uri->getSegment(3);
      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPeternak;

      // $dataUserBeliPaket = $modelPaket->getDataBeliPaket(['id_user' => session('id')])->getNumRows();
      // $data['cekUserBeliPaket'] = $dataUserBeliPaket;
      // $dataBeliPaket = $modelPaket->getDataBeliPaket(['id_user' => session('id')])->getRowArray();
      // $data['cekBeliPaket'] = $dataBeliPaket;
      
      $dataBeliPaket = $modelPaket->getBeliPaketJoin(['tbl_beli_paket.id_user' => session('id')])->getResultArray();
      $data['cekBeliPaket'] = $dataBeliPaket;
      
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $data['menu'] = 'mulai-usaha';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/status-pengajuan', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function pelatihan_usaha_peternak()
   {
      $modelUser = new M_User;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/pelatihan-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function produk_saya_usaha_peternak()
   {
      $modelUser = new M_User;
      $modelProduk = new M_Produk;

      $dataProduk = $modelProduk->getDataProduk(['is_delete_produk' => '0'])->getResultArray();
      $data['dataProduk'] = $dataProduk;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/produk-saya-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function tambah_produk_saya_usaha_peternak()
   {
      $modelUser = new M_User;
      $modelKategori = new M_Kategori;
      $modelProduk = new M_Produk;

      $dataKategori = $modelKategori->getDataKategori()->getResultArray();
      $data['dataKategori'] = $dataKategori;
      $dataToko = $modelUser->getDataPeternak(['tbl_toko.id_user' => session('id')])->getRowArray();
      $data['dataToko'] = $dataToko;

      $hasil = $modelProduk->autoNumber()->getRowArray();
      if (!$hasil) {
          $id = "PRD".date('Ymd').'00001';
      } else {
          $kode = $hasil['id_produk'];

          $noUrut = (int) substr($kode, -5);
          $noUrut++;
          $id = "PRD" .date('Ymd'). sprintf("%04s", $noUrut);
      }
      $data['id_produk'] = $id;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/tambah-produk-saya-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function simpan_produk_saya_usaha_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelKategori = new M_Kategori;
      $modelProduk = new M_Produk;
      $modelToko = new M_Toko;

      $idUser= session('id');
      $nama_produk =  $this->request->getPost('nama_produk');
      $id_toko =  $this->request->getPost('id_toko');
      $id_kategori =  $this->request->getPost('kategori_produk');
      $stok =  $this->request->getPost('stok');
      $berat =  $this->request->getPost('berat');
      $deskripsi_produk =  $this->request->getPost('deskripsi_produk');
      $harga =  $this->request->getPost('harga');

      if(!$this->validate([
         'foto_produk1' => 'uploaded[foto_produk1]|max_size[foto_produk1, 10240]','foto_produk2' => 'uploaded[foto_produk2]|max_size[foto_produk2, 10240]', 'foto_produk3' => 'uploaded[foto_produk3]|max_size[foto_produk3, 10240]'
      ])){
         session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 10 MB");
         return redirect()->to('/peternak/produk-s/add')->withInput();
      }

      $formatNama= "PRD".date("ymdHis");
      //upload produk1
      $foto_produk1 = $this->request->getFile('foto_produk1');
      $ext = $foto_produk1->getClientExtension();
      $namaFile = $formatNama."-1.".'png';
      $path1 = 'Assets/img/toko/produk/';
      $namaFilepath1 = $path1.$namaFile;
      move_uploaded_file($this->compress($foto_produk1, $namaFilepath1, 65), $path1);
      //upload produk2
      $foto_produk2 = $this->request->getFile('foto_produk2');
      $ext = $foto_produk2->getClientExtension();
      $namaFile = $formatNama."-2.".'png';
      $path2 = 'Assets/img/toko/produk/';
      $namaFilepath2 = $path2.$namaFile;
      move_uploaded_file($this->compress($foto_produk2, $namaFilepath2, 65), $path2);
      //upload produk1
      $foto_produk3 = $this->request->getFile('foto_produk3');
      $ext = $foto_produk3->getClientExtension();
      $namaFile = $formatNama."-3.".'png';
      $path3 = 'Assets/img/toko/produk/';
      $namaFilepath3 = $path3.$namaFile;
      move_uploaded_file($this->compress($foto_produk3, $namaFilepath3, 65), $path3);

      //read id_produk (tbl_produk)
      $hasil = $modelProduk->autoNumber()->getRowArray();
      if (!$hasil) {
          $id = "PRD".date('Ymd').'00001';
      } else {
          $kode = $hasil['id_produk'];

          $noUrut = (int) substr($kode, -5);
          $noUrut++;
          $id = "PRD" .date('Ymd'). sprintf("%05s", $noUrut);
      }
      $dataSimpan = [
         'id_produk' => $id,
         'nama_produk' => $nama_produk,
         'id_toko' => $id_toko,
         'id_kategori' => $id_kategori,
         'nm_foto' => $formatNama."-1.".'png',
         'stok' => $stok,
         'berat' => $berat,
         'deskripsi_produk' => $deskripsi_produk,
         'harga' => $harga,
         'is_delete_produk' => '0',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s')
     ];
     $modelProduk->saveDataProduk($dataSimpan);

     //read id_foto_produk (tbl_foto_produk)
     $idfoto = $modelProduk->autoNumber_foto()->getRowArray();
     if (!$idfoto) {
         $id_foto_produk = "F-PRD".date('Ymd').'00001';
     } else {
         $kode = $idfoto['id_foto_produk'];

         $noUrut = (int) substr($kode, -5);
         $noUrut++;
         $id_foto_produk = "F-PRD" .date('Ymd'). sprintf("%05s", $noUrut);
     }

     $i = 1; 
     while($i <= 3){
         $dataSimpan_foto = [
            'id_foto_produk' => $id_foto_produk,
            'nm_foto' => $formatNama.'-'.$i.'.png',
            'id_produk' => $id,
            'is_delete_foto_produk' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
         ];
         $modelProduk->saveFotoProduk($dataSimpan_foto);
         $i++;
     }

      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $data['menu'] = 'mulai-usaha';

      session()->setFlashdata('success','Produk Berhasil DiBuat!');

      return redirect()->to(base_url('/peternak/produk-s'));
   }
   public function edit_produk_saya_usaha_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelProduk = new M_Produk;
      $modelKategori = new M_Kategori;

      $idView= $uri->getSegment(4);
      $dataProduk = $modelProduk->getDataProdukJoin(['sha1(tbl_produk.id_produk)' => $idView])->getRowArray();
      $data['dataProduk'] = $dataProduk;
      $dataFotoProduk = $modelProduk->getFotoProduk(['sha1(id_produk)' => $idView])->getResultArray();
      $data['dataFotoProduk'] = $dataFotoProduk;
      $dataKategori = $modelKategori->getDataKategori()->getResultArray();
      $data['dataKategori'] = $dataKategori;
      $dataToko = $modelUser->getDataPeternak(['tbl_toko.id_user' => session('id')])->getRowArray();
      $data['dataToko'] = $dataToko;
      session()->set(['idUpdate' => $idView]);

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/edit-produk-saya-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function update_produk_saya_usaha_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelKategori = new M_Kategori;
      $modelProduk = new M_Produk;
      $modelToko = new M_Toko;

      $idUpdate = session()->get('idUpdate');
      $nama_produk =  $this->request->getPost('nama_produk');
      $id_kategori =  $this->request->getPost('kategori_produk');
      $stok =  $this->request->getPost('stok');
      $berat =  $this->request->getPost('berat');
      $deskripsi_produk =  $this->request->getPost('deskripsi_produk');
      $harga =  $this->request->getPost('harga');
      $foto_produk1 = $this->request->getFile('foto_produk1');
      $foto_produk2 = $this->request->getFile('foto_produk2');
      $foto_produk3 = $this->request->getFile('foto_produk3');

      if($foto_produk1 != '' || $foto_produk2 != '' || $foto_produk3 != ''){
         // if(!$this->validate([
         //    'foto_produk1' => 'uploaded[foto_produk1]|max_size[foto_produk1, 10240]','foto_produk2' => 'uploaded[foto_produk2]|max_size[foto_produk2, 10240]', 'foto_produk3' => 'uploaded[foto_produk3]|max_size[foto_produk3, 10240]'
         // ])){
         //    session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 10 MB");
         //    return redirect()->to('/peternak/produk-s/add')->withInput();
         // }
         $foto_produk1_old = $this->request->getPost('foto_produk1_old');
         $foto_produk2_old = $this->request->getPost('foto_produk2_old');
         $foto_produk3_old = $this->request->getPost('foto_produk3_old');

         if($foto_produk1 != ''){
            //upload produk1
            $foto_produk1 = $this->request->getFile('foto_produk1');
            $ext = $foto_produk1->getClientExtension();
            $namaFile = $foto_produk1_old;
            $path1 = 'Assets/img/toko/produk/';
            $namaFilepath1 = $path1.$namaFile;
            move_uploaded_file($this->compress($foto_produk1, $namaFilepath1, 65), $path1);
         }elseif($foto_produk2 != ''){
            //upload produk2
            $foto_produk2 = $this->request->getFile('foto_produk2');
            $ext = $foto_produk2->getClientExtension();
            $namaFile = $foto_produk2_old;
            $path2 = 'Assets/img/toko/produk/';
            $namaFilepath2 = $path2.$namaFile;
            move_uploaded_file($this->compress($foto_produk2, $namaFilepath2, 65), $path2);
         }elseif($foto_produk3 != ''){
            //upload produk1
            $foto_produk3 = $this->request->getFile('foto_produk3');
            $ext = $foto_produk3->getClientExtension();
            $namaFile = $foto_produk3_old;
            $path3 = 'Assets/img/toko/produk/';
            $namaFilepath3 = $path3.$namaFile;
            move_uploaded_file($this->compress($foto_produk3, $namaFilepath3, 65), $path3);
         }
         $dataUpdate = [
            'nama_produk' => $nama_produk,
            'id_kategori' => $id_kategori,
            'nm_foto' => $foto_produk1_old,
            'stok' => $stok,
            'berat' => $berat,
            'deskripsi_produk' => $deskripsi_produk,
            'harga' => $harga,
            'updated_at' => date('Y-m-d H:i:s')
         ];
      }else{
         $dataUpdate = [
            'nama_produk' => $nama_produk,
            'id_kategori' => $id_kategori,
            'stok' => $stok,
            'berat' => $berat,
            'deskripsi_produk' => $deskripsi_produk,
            'harga' => $harga,
            'updated_at' => date('Y-m-d H:i:s')
         ];
      }
         $whereUpdate = ['sha1(id_produk)' => $idUpdate];
         $modelProduk->updateDataProduk($dataUpdate, $whereUpdate);
         session()->remove('idUpdate');
         session()->setFlashdata('success','Produk Berhasil Diperbarui!!');

      return redirect()->to(base_url('/peternak/produk-s'));
   }
   public function hapus_produk_saya_usaha_peternak()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelKategori = new M_Kategori;
      $modelProduk = new M_Produk;
      $modelToko = new M_Toko;

      $idDelete = $uri->getSegment(4);

      $dataUpdate = [
         'is_delete_produk' => '1',
         'updated_at' => date('Y-m-d H:i:s')
      ];
      $whereUpdate = ['sha1(id_produk)' => $idDelete];
      $modelProduk->updateDataProduk($dataUpdate, $whereUpdate);
      session()->setFlashdata('success','Produk Berhasil Dihapus!');

      return redirect()->to(base_url('/peternak/produk-s'));
   }
   public function toko_saya_usaha_peternak()
   {
      $modelUser = new M_User;
      $modelToko = new M_Toko;
      $modelRekening = new M_Rekening;

      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
      $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
      if($cekToko != 0){
         $toko = [
            'id_toko' => $dataToko['id_toko'],
         ];
         session()->set($toko);
      }

      $dataRekening = $modelRekening->getDataRekening(['id_toko' => session('id_toko'), 'is_delete_rekening' => '0'])->getResultArray();
      $data['dataRekening'] = $dataRekening;

      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;
      $data['dataToko'] = $dataToko;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/tentang-toko-usaha', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function buat_toko_peternak()
   {
      $modelUser = new M_User;
      $modelToko = new M_Toko;

      $idUser= session('id');
      $nama_toko =  $this->request->getPost('nama_toko');
      $alamat_toko =  $this->request->getPost('alamat_toko');
      $id_provinsi =  $this->request->getPost('provinsi');
      $id_kota =  $this->request->getPost('kota');

      $nama_toko_edit =  $this->request->getPost('nama_toko_edit');
      $alamat_toko_edit =  $this->request->getPost('alamat_toko_edit');
      $id_provinsi_edit =  $this->request->getPost('provinsi_edit');
      $id_kota_edit =  $this->request->getPost('kota_edit');
      $foto_toko = $this->request->getFile('foto_toko');
      $idToko = session('id_toko');

      if($foto_toko != ''){
         if(!$this->validate([
            'foto_toko' => 'uploaded[foto_toko]|max_size[foto_toko, 10240]',
         ])){
            session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 10 MB");
            return redirect()->to('/peternak/toko-s')->withInput();
         }

         $foto_toko = $this->request->getFile('foto_toko');
         $ext = $foto_toko->getClientExtension();
         $namaFile = "FTK".date("ymdHis").".".$ext;
         $path = 'Assets/img/toko/';
         $namaFilepath = $path.$namaFile;
         move_uploaded_file($this->compress($foto_toko, $namaFilepath, 65), $path);
      }
      if($idToko == ''){
         $hasil = $modelToko->autoNumber()->getRowArray();
         if (!$hasil) {
             $id = "TKO0001";
         } else {
             $kode = $hasil['id_toko'];

             $noUrut = (int) substr($kode, -4);
             $noUrut++;
             $id = "TKO" . sprintf("%04s", $noUrut);
         }

         $dataSimpan = [
            'id_toko' => $id,
            'id_user' => $idUser,
            'nama_toko' => $nama_toko,
            'id_provinsi' => $id_provinsi,
            'id_kota' => $id_kota,
            'alamat_toko' => $alamat_toko,
            'status_toko' => '0',
            'foto_toko' => $namaFile,
            'is_delete_toko' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
         ];
         $modelToko->saveDataToko($dataSimpan);
      }else{
         $dataUpdate = [
            'nama_toko' => $nama_toko_edit,
            'id_provinsi' => $id_provinsi_edit,
            'id_kota' => $id_kota_edit,
            'alamat_toko' => $alamat_toko_edit,
            // 'foto_toko' => $namaFile,
            'updated_at' => date('Y-m-d H:i:s')
         ];
         $whereUpdate = ['id_toko' => session('id_toko')];
         $modelToko->updateDataToko($dataUpdate, $whereUpdate);
         session()->remove('idToko');
      }
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $data['menu'] = 'mulai-usaha';

      session()->setFlashdata('success','Toko Berhasil DiBuat!');

      return redirect()->to(base_url('/peternak/dashboard'));
   }
   public function aktivasi_toko()
   {
      $uri = service('uri');
      $modelToko = new M_Toko;

      $idToko= $uri->getSegment(3);

      $dataUpdate = [
         'status_toko' => '1',
         'updated_at' => date('Y-m-d H:i:s')
      ];

      $whereUpdate = ['sha1(id_toko)' => $idToko];
      $modelToko->updateDataToko($dataUpdate, $whereUpdate);
      session()->setFlashdata('success','Toko Anda Berhasil diAktifkan');
      ?>
      <script>
          document.location = "<?= base_url('/peternak/toko-s');?>";
      </script>
      <?php
   }
   public function tambah_rekening()
   {
      $modelRekening = new M_Rekening;
      $modelUser = new M_User;
      $modelToko = new M_Toko;
      
      $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
      $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
      if($cekToko != 0){
         $toko = [
            'id_toko' => $dataToko['id_toko'],
         ];
         session()->set($toko);
      }

      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;

      $data['menu'] = 'dashboard';
      $data['profile'] = $dataPeternak;
      $data['dataToko'] = $dataToko;

      echo view('Frontend/template/header', $data);
      echo view('Frontend/template/head-content', $data);
      echo view('Frontend/master-peternak/content/menu/tambah-rekening', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function simpan_rekening()
   {
      $modelRekening = new M_Rekening;
      $modelUser = new M_User;
      $modelToko = new M_Toko;

      $idUser = session('id');
      $idToko = session('id_toko');
      $nama_pemilik = $this->request->getPost('nama_pemilik');
      $no_rekening = $this->request->getPost('no_rekening');
      $nama_bank = $this->request->getPost('nama_bank');

      $cekRekening = $modelRekening->getDataRekening(['no_rekening' => $no_rekening, 'nama_pemilik' => $nama_pemilik, 'is_delete_rekening' => '0'])->getNumRows();
      if($cekRekening != '0'){
         session()->setFlashdata('error','Rekening Sudah ada!');
         return redirect()->to(base_url('/peternak/tambah-rekening'));
      }else{
         $hasil = $modelRekening->autoNumber(['substr(id_rekening,3,6)' => date("ymd")])->getRowArray();
         if(!$hasil){
            $id = "RKN".date("ymd")."0001";
         }
         else{
            $kode = $hasil['id_rekening'];
            $noUrut = (int) substr($kode, 9, 4);
            $noUrut++;
            $id = "RKN".date("ymd").sprintf("%04s", $noUrut);
         }

         $dataSimpan = [
            'id_rekening' => $id,
            'nama_pemilik' => $nama_pemilik,
            'no_rekening' => $no_rekening,
            'id_user' => $idUser,
            'id_toko' => $idToko,
            'nama_bank' => $nama_bank,
            'is_delete_rekening' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
         ];
         $modelRekening->saveDataRekening($dataSimpan);
         session()->setFlashdata('success','Rekening Berhasil Ditambahkan');
         return redirect()->to(base_url('/peternak/toko-s'));
      }
   }
   public function hapus_rekening()
   {
      $uri = service('uri');
      $modelRekening = new M_Rekening;

      $idHapus = $uri->getSegment(3);

      $dataHapus =[
         'is_delete_rekening' => '1',
         'updated_at' => date('Y-m-d H:i:s')
      ];
      $whereUpdate = ['sha1(id_rekening)' => $idHapus];
      $modelRekening->updateDataRekening($dataHapus, $whereUpdate);
      session()->setFlashdata('success','Rekening Berhasil diHapus!');
      return redirect()->to(base_url('/peternak/toko-s'));
   }

   
}