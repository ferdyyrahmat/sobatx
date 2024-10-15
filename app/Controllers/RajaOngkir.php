<?php 
namespace App\Controllers;

class RajaOngkir extends BaseController
{
   //API-key RajaOngkir
   private $apiKey = '5afbf385ee4ad96cfe0ab9f708445472';

   public function provinsi()
   {
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
      echo '<option value="">--Pilih Provinsi--</option>';
      foreach($dataProvinsi as $data){
         echo '<option value="' . $data['province_id'] . '" id_provinsi="'. $data['province_id'] .'">' . $data['province'] . '</option>';
      }
      }
   }

   public function kota()
   {
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
         echo '<option value="">--Pilih Kota--</option>';
         foreach($dataKota as $data){
            echo '<option value="' . $data['city_id'] . '">' . $data['city_name'] . '</option>';
         }
      }
   }

   public function ekspedisi()
   {
      echo '<option value="">Pilih ekspedisi</option>';
      // echo '<option value="jne">JNE</option>';
      // echo '<option value="tiki">TIKI</option>';
      // echo '<option value="pos">Pos Indonesia</option>';
      echo '<option value="cod">Kurir Internal</option>';
   }

   public function paket()
   {
      $ekspedisi = $this->request->getPost('ekspedisi');

      if($ekspedisi == 'cod')
      {
         echo '<option>pilih service</option>';
         echo '<option value="cod" a_ongkir="15000" b_ongkir="15000" metode="cod">COD - Bayar di Tempat |  Rp. 15.000</option>';
      }
   }
   public function paket_old()
   {
      $kota_asal = session('ses_kotaAsal');
      $kota_tujuan = session('ses_kotaTujuan');
      $berat = session('ses_berat');
      $ekspedisi = $this->request->getPost('ekspedisi');

      $curl = curl_init();

      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
         CURLOPT_SSL_VERIFYHOST => 0,
         CURLOPT_SSL_VERIFYPEER => 0,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_POSTFIELDS => "origin=".$kota_asal."& destination=".$kota_tujuan."& weight=".$berat."& courier=".$ekspedisi,
         CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: $this->apiKey"
         ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
         echo "cURL Error #:" . $err;
      } else {
         // echo $response;
         $array_response = json_decode($response, true);

         $dataPaket = $array_response['rajaongkir']['results'][0]['costs'];
         echo '<option>pilih service</option>';
         foreach($dataPaket as $data){
            echo '<option value="'.$data['service'].'" a_ongkir="'.number_format($data['cost'][0]['value'], 2, ",", ".").'" b_ongkir="'.$data['cost'][0]['value'].'">'.$data['service'].'  |  Rp.'.$data['cost'][0]['value'].'   |   '.$data['cost'][0]['etd'].' hari</option>';
         }
      }
   }
}