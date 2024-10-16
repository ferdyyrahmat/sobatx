<?php 
namespace App\Controllers;

use App\Models\M_Pesanan;
use App\Models\M_User;
use App\Models\M_Kategori;
use App\Models\M_Produk;
use App\Models\M_PUsaha;
use App\Models\FavoriteModel;
use App\Models\M_Transaksi;
use App\Models\M_Alamat;
use App\Models\M_Rekening;

class Marketplace extends BaseController
{
   private $apiKey = '5afbf385ee4ad96cfe0ab9f708445472';
   protected $favorite;
   public function __construct()
   {
      $this->favorite = new FavoriteModel;
   }
   public function antiinjection($data)
   {
      $filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
     return $filter_sql;
   }
   public function marketplace_user()
   {
      $modelUser = new M_User;
      $modelProduk = new M_Produk;
      $modelPaket = new M_PUsaha;
      $modelKategori = new M_Kategori;
      $modelFavorite = new FavoriteModel;

      $uri = service('uri');
      $data['activity'] = $uri->getSegment(3);
      $dataProduk = $modelProduk->getDataProdukJoin();
      //get data produk yg dicari
      $data['dataProduk'] = $dataProduk->getResultArray();
      //get jumlah produk yg ditemukan
      $data['jumlahDataProduk'] = $dataProduk->getNumRows();
      $dataKategori = $modelKategori->getDataKategori()->getResultArray();
      $data['dataKategori'] = $dataKategori;
      $dataPaket = $modelPaket->getDataPaket()->getResultArray();
      $data['dataPaket'] = $dataPaket;
      $dataFavorite = $modelFavorite->getFavorite(['id_user' => session('id')]);
      $data['dataFavorite'] = $dataFavorite->getResultArray();
      $data['jumlahDataFavorite'] = $dataFavorite->getNumRows();
      
      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;
      $data['menu'] = 'dashboard';

      echo view('Frontend/template/header-marketplace', $data);
      echo view('Frontend/master-pengguna/content/marketplace', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function load_product()
   {
      $modelProduk = new M_Produk;

      $uri = service('uri');
      $data['activity'] = $uri->getSegment(3);
      $pencarian =  $this->request->getPost('nama_produk');
      $data['pencarian'] =  $pencarian;

      $where = ['nama_produk LIKE' => '%'.$pencarian.'%'];
      $dataProduk = $modelProduk->getDataProdukJoin($where);
      //get data produk yg dicari
      $data['dataProduk'] = $dataProduk->getResultArray();
      //get jumlah produk yg ditemukan
      $data['jumlahDataProduk'] = $dataProduk->getNumRows();
      
      echo view('Frontend/master-pengguna/content/marketplace/featured-product', $data);

   }
   public function search_item()
   {
      $modelUser = new M_User;
      $modelProduk = new M_Produk;
      $modelPaket = new M_PUsaha;
      $modelKategori = new M_Kategori;
      $modelFavorite = new FavoriteModel;

      $pencarian =  $this->request->getPost('nama_produk');
      $data['pencarian'] =  $pencarian;

      $uri = service('uri');
      $data['activity'] = $uri->getSegment(3);
      $dataKategori = $modelKategori->getDataKategori()->getResultArray();
      $data['dataKategori'] = $dataKategori;
      $dataPaket = $modelPaket->getDataPaket()->getResultArray();
      $data['dataPaket'] = $dataPaket;

      $where = ['nama_produk LIKE' => '%'.$pencarian.'%'];
      $dataProduk = $modelProduk->getDataProdukJoin($where);
      //get data produk yg dicari
      $data['dataProduk'] = $dataProduk->getResultArray();
      //get jumlah produk yg ditemukan
      $data['jumlahDataProduk'] = $dataProduk->getNumRows();
      $dataFavorite = $modelFavorite->getFavorite(['id_user' => session('id')]);
      $data['dataFavorite'] = $dataFavorite->getResultArray();
      $data['jumlahDataFavorite'] = $dataFavorite->getNumRows();


      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;
      $data['menu'] = 'dashboard';

      if($pencarian == ''){
         return redirect()->to(base_url('/peternak/marketplace'));
      }
      else{
      echo view('Frontend/template/header-marketplace', $data);
      echo view('Frontend/master-pengguna/content/marketplace', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
      }
   }
   public function add_favorite()
   {
      $modelProduk = new M_Produk;
      $modelFavorite = new FavoriteModel;

      $uri = service('uri');

      $id =  $uri->getSegment(4);
      $cekId = $modelProduk->getDataProdukJoinAll(['sha1(tbl_produk.id_produk)' => $id])->getRowArray();
      // $data['activity'] = $uri->getSegment(3);
      $id_produk = $cekId['id_produk'];
      $id_user =  session('id');

      $sqlcek = $modelFavorite->getFavorite(['id_produk'=>$id_produk, 'id_user'=>$id_user])->getNumRows();
      if($sqlcek > 0){

      }else{
      $hasil = $modelFavorite->autoNumber(['substr(id_favorite,3,6)' => date("ymd")])->getRowArray();
      if(!$hasil){
          $id = "ITM".date("ymd")."0001";
      }
      else{
          $kode = $hasil['id_favorite'];
          $noUrut = (int) substr($kode, 9, 4);
          $noUrut++;
          $id = "ITM".date("ymd").sprintf("%04s", $noUrut);
      }
 
      $dataSimpan= [
         'id_favorite' => $id,
         'id_produk' => $id_produk,
         'id_user' => $id_user,
         'created_at' => date("Y-m-d H:i:s"),
      ];
      $modelFavorite->saveFavorite($dataSimpan);
   }

   }
   public function detail_product_marketplace()
   {
      session()->remove('ses_kotaAsal');
      $uri = service('uri');
      $modelUser = new M_User;
      $modelProduk = new M_Produk;
      $modelFavorite = new FavoriteModel;

      $idProduk = $uri->getSegment(4);

      $uri = service('uri');
      $data['activity'] = $uri->getSegment(3);

      $where = ['sha1(tbl_produk.id_produk)' => $idProduk];
      $dataProdukAsal = $modelProduk->getDataProdukJoinAll($where)->getRowArray();
      $dataProduk = $modelProduk->getDataProdukJoinAll($where);
      //get data produk yg dicari
      $data['dataFotoProduk'] = $dataProduk->getResultArray();
      $data['dataProduk'] = $dataProduk->getRowArray();

      $session_toko = [
         'ses_kotaAsal' => $dataProdukAsal['id_kota'],
      ];
      session()->set($session_toko);
      
      $dataFeaturedProduk = $modelProduk->getDataProdukJoin();
      $data['dataFeaturedProduk'] = $dataFeaturedProduk->getResultArray();
      
      $dataFavorite = $modelFavorite->getFavorite(['id_user' => session('id')]);
      $data['dataFavorite'] = $dataFavorite->getResultArray();
      $data['jumlahDataFavorite'] = $dataFavorite->getNumRows();

      $id_provinsi = $this->request->getPost('id_provinsi');
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi,
         CURLOPT_SSL_VERIFYHOST => 0,
         CURLOPT_SSL_VERIFYPEER => 0,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
           "key: $this->apiKey"
         ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      //   echo $response;
        $array_response = json_decode($response, true);

         $dataKota = $array_response['rajaongkir']['results'];

      $data['dataKota'] = $dataKota;
      }

      //default setting
      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;
      $data['menu'] = 'dashboard';

      echo view('Frontend/template/header-marketplace',$data);
      echo view('Frontend/master-pengguna/content/marketplace/detail-product',$data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer',$data);
   }
   public function load_fav()
   {
      $modelFavorite = new FavoriteModel;

      $dataFavorite = $modelFavorite->getFavorite(['id_user' => session('id')]);
      $data['dataFavorite'] = $dataFavorite->getResultArray();
      $data['jumlahDataFavorite'] = $dataFavorite->getNumRows();

      echo view('Frontend/template/count-fav',$data);
   }
   public function checkout_alamat()
   {
      $modelUser = new M_User;
      $modelAlamat = new M_Alamat;

      $dataAlamat = $modelAlamat->getDataAlamatJoin(['tbl_alamat.id_user' => session('id')]);
      $data['dataAlamat'] = $dataAlamat->getResultArray();

      //Pemanggilan Data Kota
      $id_provinsi = $this->request->getPost('id_provinsi');
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi,
         CURLOPT_SSL_VERIFYHOST => 0,
         CURLOPT_SSL_VERIFYPEER => 0,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
           "key: $this->apiKey"
         ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      //   echo $response;
        $array_response = json_decode($response, true);

         $dataKota = $array_response['rajaongkir']['results'];
         

      $data['dataKota'] = $dataKota;
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key: $this->apiKey"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      //   echo $response;
      $array_response = json_decode($response, true);
      
      $dataProvinsi = $array_response['rajaongkir']['results'];
      $data['dataProvinsi'] = $dataProvinsi;
      }

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Pilih Alamat Pengiriman';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header-checkout', $data);
      echo view('Frontend/master-pengguna/content/marketplace/alamat', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function checkout_alamat_input()
   {
      $modelUser = new M_User;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Alamat Baru';
      $data['profile'] = $dataPengguna;

      echo view('Frontend/template/header-checkout', $data);
      echo view('Frontend/master-pengguna/content/marketplace/input-alamat', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function save_checkout_alamat()
   {
      $modelAlamat = new M_Alamat;

      $nama_penerima = $this->antiinjection($this->request->getPost('nama_penerima'));
      $no_hp = $this->antiinjection($this->request->getPost('no_hp'));
      $provinsi = $this->antiinjection($this->request->getPost('provinsi'));
      $kota = $this->antiinjection($this->request->getPost('kota'));
      $alamat_lengkap = $this->antiinjection($this->request->getPost('alamat_lengkap'));
      $detail_alamat = $this->antiinjection($this->request->getPost('detail_alamat'));
      $kode_pos = $this->antiinjection($this->request->getPost('kode_pos'));

      $hasil = $modelAlamat->autoNumber(['substr(id_alamat,3,6)' => date("ymd")])->getRowArray();
      if(!$hasil){
         $id = "ALT".date("ymd")."0001";
     }
     else{
         $kode = $hasil['id_alamat'];
         $noUrut = (int) substr($kode, 9, 4);
         $noUrut++;
         $id = "ALT".date("ymd").sprintf("%04s", $noUrut);
     }

      $dataAlamat =[
         'id_alamat' => $id,
         'id_user' => session('id'),
         'id_provinsi' => $provinsi,
         'id_kota' => $kota,
         'nama_penerima' => $nama_penerima,
         'kode_pos' => $kode_pos,
         'alamat_lengkap' => $alamat_lengkap,
         'detail_alamat' => $detail_alamat,
         'no_hp_penerima' => $no_hp,
         'is_delete_alamat' => '0',
         'created_at' => date("Y-m-d H:i:s"),
         'updated_at' => date("Y-m-d H:i:s")
      ];
      $modelAlamat->saveDataAlamat($dataAlamat);
      ?>
      <script>
          document.location = "<?= base_url('/marketplace/checkout/alamat');?>";
      </script>
      <?php
   }

   public function pilih_alamat_checkout()
   {
      $modelAlamat = new M_Alamat;

      $uri = service('uri');

      $idAlamat = $uri->getSegment(4);

      //Mereset alamat terpilih menjadi 0
      $dataUnSelect =[
         'is_selected' => '0'
      ];
      $whereUpdateUnSelect = ['id_user' => session('id')];
      $modelAlamat->updateDataAlamat($dataUnSelect, $whereUpdateUnSelect);

      //Melakukan pemilihin Alamat
      $dataSelect =[
         'is_selected' => '1'
      ];
      $whereUpdateSelect = ['sha1(id_alamat)' => $idAlamat];
      $modelAlamat->updateDataAlamat($dataSelect, $whereUpdateSelect);
      ?>
      <script>
          document.location = "<?= base_url('/marketplace/checkout/proses/'.session('ses_idTransaksi'));?>";
      </script>
      <?php
   }

   public function checkout_1()
   {
      $modelTransaksi = new M_Transaksi;
      $modelProduk = new M_Produk;
      $uri = service('uri');

      $jumlah = $this->antiinjection($this->request->getPost('jumlah_beli'));
      $id_produk = $uri->getSegment(3);
      $dataProduk = $modelProduk->getDataProdukJoinAll(['sha1(tbl_produk.id_produk)' => $id_produk])->getRowArray();

      $total_harga = (int) str_replace('.','',$dataProduk['harga']) * $jumlah;
      $hasil = $modelTransaksi->autoNumber(['substr(id_transaksi,3,6)' => date("ymd")])->getRowArray();
      if(!$hasil){
         $id = "TRA".date("ymd")."0001";
     }
     else{
         $kode = $hasil['id_transaksi'];
         $noUrut = (int) substr($kode, 9, 4);
         $noUrut++;
         $id = "TRA".date("ymd").sprintf("%04s", $noUrut);
     }

      $dataTemp =[
         'id_transaksi' => $id,
         'id_produk' => $dataProduk['id_produk'],
         'id_toko' => $dataProduk['id_toko'],
         'id_user' => session('id'),
         'id_alamat' => '',
         'nama_produk' => $dataProduk['nama_produk'],
         'berat' => $dataProduk['berat'],
         'jumlah' => $jumlah,
         'total_harga' => $total_harga,
         'total_bayar' => '',
         'status' => '0',
         'created_at' => date("Y-m-d H:i:s"),
         'updated_at' => date("Y-m-d H:i:s")
      ];
      $modelTransaksi->saveDataTemp($dataTemp);
      ?>
      <script>
          document.location = "<?= base_url('/marketplace/checkout/proses/'.sha1($id));?>";
      </script>
      <?php
      
   }
   public function checkout_product_marketplace()
   {
      session()->remove('ses_idTransaksi');
      session()->remove('ses_kotaTujuan');
      session()->remove('ses_berat');
      session()->remove('ses_idAlamat');
      $modelUser = new M_User;
      $modelTransaksi = new M_Transaksi;
      $modelAlamat = new M_Alamat;
      $modelRekening = new M_Rekening;

      $uri = service('uri');

      $idTransaksi = $uri->getSegment(4);
      $dataTransaksi = $modelTransaksi->getDataTempJoin(['sha1(id_transaksi)' => $idTransaksi])->getRowArray();
      $data['dataTransaksi'] = $dataTransaksi;

      $dataAlamatAsal = $modelAlamat->getDataAlamatJoin(['tbl_alamat.id_user' => session('id'), 'is_selected' => '1'])->getRowArray();
      $dataAlamat = $modelAlamat->getDataAlamatJoin(['tbl_alamat.id_user' => session('id'), 'is_selected' => '1']);
      $data['dataAlamat'] = $dataAlamat->getRowArray();

      //Pemanggilan Data Kota
      $id_provinsi = $this->request->getPost('id_provinsi');
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi,
         CURLOPT_SSL_VERIFYHOST => 0,
         CURLOPT_SSL_VERIFYPEER => 0,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
           "key: $this->apiKey"
         ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      //   echo $response;
        $array_response = json_decode($response, true);

         $dataKota = $array_response['rajaongkir']['results'];
         

      $data['dataKota'] = $dataKota;
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key: $this->apiKey"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      //   echo $response;
      $array_response = json_decode($response, true);
      
      $dataProvinsi = $array_response['rajaongkir']['results'];
      $data['dataProvinsi'] = $dataProvinsi;
      }

      if(!isset($dataAlamatAsal['id_kota'])){
         $alamat = '';
         $id_alamat = '';
      }else{
         $alamat = $dataAlamatAsal['id_kota'];
         $id_alamat = $dataAlamatAsal['id_alamat'];
      }
      //Sesi Transaksi
      session()->set([
         'ses_idTransaksi' => $idTransaksi,
         'ses_kotaTujuan' => $alamat,
         'ses_berat' => $dataTransaksi['berat']*$dataTransaksi['jumlah'],
         'ses_idAlamat' => $id_alamat,
      ]);

      $dataRekening = $modelRekening->getDataRekening(['is_delete_rekening' => '0', 'id_toko' => $dataTransaksi['id_toko']])->getResultArray();
      $data['dataRekening'] = $dataRekening;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Checkout';

      echo view('Frontend/template/header-checkout', $data);
      echo view('Frontend/master-pengguna/content/marketplace/checkout', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   //prosesTransaksi
   public function buat_pesanan()
   {
      $uri = service('uri');
      $modelUser = new M_User;
      $modelTransaksi = new M_Transaksi;
      $modelPesanan = new M_Pesanan();

      $idTransaksi = $uri->getSegment(3);

      $dataUpdate = [
         'status' => '1',
         // 'total_bayar' => $totalBayar,
         'id_alamat' => session('ses_idAlamat'),
         'updated_at' => date("Y-m-d H:i:s")
      ];
      $whereUpdate = ['sha1(id_transaksi)' => $idTransaksi];
      $modelTransaksi->updateDataTemp($dataUpdate, $whereUpdate);

      $dataTransaksi = $modelTransaksi->getDataTempJoin(['sha1(id_transaksi)' => $idTransaksi])->getRowArray();

      $cekDataPesanan = $modelPesanan->getDataPesanan(['id_pesanan' => $idTransaksi])->getRowArray();
      if(!$cekDataPesanan) {
         $dataPesanan = [
            'id_pesanan' => $idTransaksi,
            'id_produk' => $dataTransaksi['id_produk'],
            'id_toko' => $dataTransaksi['id_toko'],
            'id_user' => $dataTransaksi['id_user'],
            'id_alamat' => $dataTransaksi['id_alamat'],
            'metode' => $dataTransaksi['metode'],
            'nama_produk' => $dataTransaksi['nama_produk'],
            'jumlah' => $dataTransaksi['jumlah'],
            'total_bayar' => $dataTransaksi['total_bayar'],
            'status_pesanan' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
         ];
         $modelPesanan->saveDataPesanan($dataPesanan);
      }else{
         $dataPesananUpdate = [
            'id_produk' => $dataTransaksi['id_produk'],
            'id_toko' => $dataTransaksi['id_toko'],
            'id_user' => $dataTransaksi['id_user'],
            'id_alamat' => $dataTransaksi['id_alamat'],
            'metode' => $dataTransaksi['metode'],
            'nama_produk' => $dataTransaksi['nama_produk'],
            'jumlah' => $dataTransaksi['jumlah'],
            'total_bayar' => $dataTransaksi['total_bayar'],
            'status_pesanan' => '1',
            'updated_at' => date("Y-m-d H:i:s")
         ];
         $whereUpdate = ['id_pesanan' => $idTransaksi];
         $modelPesanan->updateDataPesanan($dataPesananUpdate, $whereUpdate);
      }

      $dataPesanan = $modelPesanan->getDataPesananJoin(['id_pesanan' => $idTransaksi])->getRowArray();
      $data['dataPesanan'] = $dataPesanan;
      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Rincian Pesanan';

      echo view('Frontend/template/header-checkout', $data);
      echo view('Frontend/master-pengguna/content/marketplace/detail-buat-pesanan', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   //Update Total Bayar
   public function update_total_bayar()
   {
      $uri = service('uri');
      $modelTransaksi = new M_Transaksi;
      $total_bayar = $this->request->getPost('total_bayar');
      $metode = $this->request->getPost('metode');
      $idTransaksi = $uri->getSegment(3);

      $dataUpdate = [
         'total_bayar' => $total_bayar,
         'metode' => $metode,
         'updated_at' => date("Y-m-d H:i:s")
      ];
      $whereUpdate = ['sha1(id_transaksi)' => $idTransaksi];
      $modelTransaksi->updateDataTemp($dataUpdate, $whereUpdate);
   }

   //Pesanan Saya
   public function pesanan_saya()
   {
      $modelUser = new M_User;
      $modelTransaksi = new M_Transaksi;
      $modelAlamat = new M_Alamat;
      $modelRekening = new M_Rekening;
      $modelPesanan = new M_Pesanan;

      $uri = service('uri');
      $idUser = $uri->getSegment(3);

      $dataPesanan = $modelPesanan->getDataPesananJoin(['sha1(tbl_pesanan.id_user)' => $idUser])->getResultArray();
      $data['dataPesanan'] = $dataPesanan;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Checkout';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/master-pengguna/content/marketplace/pesanan-saya', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function detail_pesanan()
   {
      $modelUser = new M_User;
      $modelTransaksi = new M_Transaksi;
      $modelAlamat = new M_Alamat;
      $modelRekening = new M_Rekening;
      $modelPesanan = new M_Pesanan;

      $uri = service('uri');
      $idPesanan = $uri->getSegment(3);

      $dataPesanan = $modelPesanan->getDataPesananJoinAll(['tbl_pesanan.id_pesanan' => $idPesanan])->getRowArray();
      $data['dataPesanan'] = $dataPesanan;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Checkout';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/master-pengguna/content/marketplace/detail-pesanan-saya', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function kelola_pesanan()
   {
      $modelUser = new M_User;
      $modelPesanan = new M_Pesanan;

      $uri = service('uri');

      $dataPeternak = $modelUser->getDataPeternak(['tbl_user.id_user' => session('id')])->getRowArray();

      $dataPesanan = $modelPesanan->getDataPesananJoin(['tbl_pesanan.id_toko' => $dataPeternak['id_toko']])->getResultArray();
      $data['dataPesanan'] = $dataPesanan;

      // print_r($data[2]['status']);

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Checkout';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/master-pengguna/content/marketplace/kelola-pesanan', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }
   public function detail_pesanan_toko()
   {
      $modelUser = new M_User;
      $modelTransaksi = new M_Transaksi;
      $modelAlamat = new M_Alamat;
      $modelRekening = new M_Rekening;
      $modelPesanan = new M_Pesanan;

      $uri = service('uri');
      $idPesanan = $uri->getSegment(3);

      $dataPesanan = $modelPesanan->getDataPesananJoinAll(['tbl_pesanan.id_pesanan' => $idPesanan])->getRowArray();
      $data['dataPesanan'] = $dataPesanan;

      $dataPengguna = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
      $data['profile'] = $dataPengguna;
      $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
      $data['jumlahNotif'] = $jumlahNotif;
      $dataNotif = $modelUser->getNotif(['id_user' => session('id')])->getResultArray();
      $data['notif'] = $dataNotif;

      $data['menu'] = 'dashboard';
      $data['page'] = 'Checkout';

      echo view('Frontend/template/header', $data);
      echo view('Frontend/master-pengguna/content/marketplace/detail-kelola-pesanan', $data);
      echo view('Frontend/template/navigation', $data);
      echo view('Frontend/template/footer', $data);
   }

   public function kirim_pesanan()
   {
      $uri = service('uri');
      $idUpdate = $uri->getSegment(3);

      $modelPesanan = new M_Pesanan;
      $nama_kurir = $this->request->getPost('nama_kurir');
      $no_hp_kurir = $this->request->getPost('no_hp_kurir');

      $dataUpdate = [
         'status_pesanan' => '2',
         'nama_kurir' => $nama_kurir,
         'no_hp_kurir' => $no_hp_kurir,
         'updated_at' => date("Y-m-d H:i:s")
      ];
      $whereUpdate = ['id_pesanan' => $idUpdate];
      $modelPesanan->updateDataPesanan($dataUpdate, $whereUpdate);

      session()->setFlashdata('success', 'Pesanan Berhasil diKonfirmasi!, Segera Kirim!');
      ?>
      <script>
          document.location = "<?= base_url('/marketplace/kelola-pesanan')?>";
      </script>
      <?php
   }
}