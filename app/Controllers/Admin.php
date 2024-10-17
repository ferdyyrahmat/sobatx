<?php 
namespace App\Controllers;

use App\Models\M_Admin;
use App\Models\M_User;
use App\Models\M_Toko;
use App\Models\UserModel;
use App\Models\M_PUsaha;
use App\Models\M_Transaksi;
use App\Models\M_Pesanan;
use App\Models\M_Produk;
use App\Models\M_Rekening;
use App\Models\M_Kategori;

class Admin extends BaseController
{
    public function antiinjection($data)
    {
        $filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
        return $filter_sql;
    }
    public function index()
    {
      echo view('Backend/auth/login');
    }
   public function login_checker()
    {
        $modeladmin = new M_Admin;

        $username = $this->antiinjection($this->request->getPost('username'));
        $password = $this->antiinjection($this->request->getPost('password'));

        $sqlCek = $modeladmin->getDataAdmin(['username' => $username]);
        $ada = $sqlCek->getNumRows();

        if($ada == 0) {
            session()->setFlashdata('error','Gagal... Username Tidak Ada!!');
            return redirect()->to(base_url('/admin'));
        }
        else{
            if($ada == 0) {
               session()->setFlashdata('error','Gagal... Username Tidak Ada!!');
               return redirect()->to(base_url('/admin'));
               }
            else{
                $dataAdmin = $sqlCek->getRowArray();
                
                $verifyPass1 = password_verify($password, $dataAdmin['password']);
                
                if (!$verifyPass1) {
                    session()->setFlashdata('error','Gagal... Cek Kombinasi Username dan Password!!');
                    return redirect()->to(base_url('/admin'));
                }
                else{
                     $dataSession =[
                         'ses_id' => $dataAdmin['id_admin'],                
                         'ses_admin' => $dataAdmin['nama_admin'],
                         'ses_username' => $dataAdmin['username'], 
                         'enid' => sha1($dataAdmin['id_admin'])
                     ];
                     session()->set($dataSession);

                     return redirect()->to(base_url('/admin/dashboard'));
                }
            }
        }
    }

    public function logout()
    {
         session()->remove('ses_id');
         session()->remove('ses_admin');
         session()->remove('ses_username');
         session()->remove('enid');
       //   session()->destroy();
         session()->setFlashdata('info', 'Keluar dari Sistem!!');
         ?>
    <script>
     document.location = "<?= base_url('admin');?>";
    </script>
    <?php 
    }

   public function dashboard_admin()
   {
      $data['akses'] = 'admin';
      echo view('Backend/master-admin/template/head');
      echo view('Backend/master-admin/template/sidebar');
      echo view('Backend/master-admin/dashboard');
      echo view('Backend/master-admin/template/footer');
   }

//start master_peternak
    public function master_peternak()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);

        $modelUser = new M_User;
        // Mengambil data keseluruhan kategori dari table kategori di database
        $dataUser = $modelUser->getDataUser(['is_delete_user' => '0','akses_level'=> '1'])->getResultArray();
        

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['dataUser'] = $dataUser; // mengirim array data kategori ke view //var pemanggil foreach baris32 master

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/peternak/master-peternak', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }
        
    public function view_peternak()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
        $idView = $uri->getSegment(3);

        $modelUser = new M_User;
        $modelToko = new M_Toko;
        // Mengambil data keseluruhan kategori dari table kategori di database
        $dataUser = $modelUser->getDataPeternak(['tbl_user.id_user' => $idView])->getRowArray();
        $dataToko = $modelToko->getDataToko(['tbl_toko.id_user'=> $idView])->getRowArray();
        //session()->set(['idUpdate' => $dataAdmin['id_admin']]);

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['detail_peternak'] = $dataUser; // mengirim array data kategori ke view
        $data['dataToko'] = $dataToko; // mengirim array data kategori ke view

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/peternak/detail-peternak', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }

    public function edit_peternak()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
        $idEdit = $uri->getSegment(3);

        $modelUser = new M_User;
        $modelToko = new M_Toko;
        // Mengambil data keseluruhan kategori dari table kategori di database
        $dataUser = $modelUser->getDataPeternak(['tbl_user.id_user' => $idEdit])->getRowArray();
        $dataToko = $modelToko->getDataToko(['tbl_toko.id_user'=> $idEdit])->getRowArray();
        session()->set(['idUpdate' => $idEdit]);

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['detail_peternak'] = $dataUser;
        $data['idUser'] = $idEdit;
        $data['dataToko'] = $dataToko;

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/peternak/edit-peternak', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }

    public function update_peternak()
    {
        $modelUser = new M_User;
        $this->user = new UserModel;
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);

        $idUpdate = session()->get('idUpdate');
        $nama_user =  $this->request->getPost('nama_user');
        $email_user =  $this->request->getPost('email_user');
        $no_hp =  $this->request->getPost('no_hp');
        $foto_profile = $this->request->getFile('foto_profile');
        
        if($foto_profile != ''){
            if(!$this->validate([
                'foto_user' => 'uploaded[foto_profile]|max_size[foto_profile, 10240]',
            ])){
                session()->setFlashdata('error', "Format file yang diizinkan : foto maksimal ukuran 10 MB");
                return redirect()->to('/admin/master-peternak')->withInput();
            }

            $foto_user1 = $this->request->getPost('foto_user_old');
            $foto_profile = $this->request->getFile('foto_profile');
            $ext1 = $foto_profile->getClientExtension();
            if (!file_exists("Assets/img/profile/".$foto_user1)) {
                $namaFile1 = "PP-".date("ymdHis").".".$ext1;
                $foto_profile->move('Assets/img/profile/', $namaFile1);
            }else{
                if ($foto_user1 == '' or $foto_user1 == '-') {
                    $namaFile1 = "PP-".date("ymdHis").".".$ext1;
                    $foto_profile->move('Assets/img/profile/', $namaFile1);
                }else{
                    $namaFile1 = $foto_user1;
                    $foto_profile->move('Assets/img/profile/', $namaFile1, true);
                }   
            }

        $dataUpdate = [
            'nama_user' => $nama_user,
            'email_user' => $email_user,
            'no_hp' => $no_hp,
            'foto_user' => $namaFile1,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        }else{
            $dataUpdate = [
                'nama_user' => $nama_user,
                'email_user' => $email_user,
                'no_hp' => $no_hp,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
            $whereUpdate = ['id_user' => $idUpdate];
            $modelUser->updateDataUser($dataUpdate, $whereUpdate);
            session()->remove('idUpdate');
            session()->setFlashdata('success','Data Peternak Berhasil Diperbarui!!');
            ?>
<script>
    document.location = "<?= base_url('admin/master-peternak');?>";
</script>
<?php
    }


//end master_peternak

//master toko
    public function master_toko()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
    
         $modelToko = new M_Toko;
         // Mengambil data keseluruhan kategori dari table kategori di database
         $dataToko = $modelToko->getDataToko(['is_delete_toko'=> '0','akses_level' =>'1'])->getResultArray();
    
        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['dataToko'] = $dataToko; // mengirim array data kategori ke view
    
        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/toko/master-toko', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }

    public function view_toko()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
        $idView = $uri->getSegment(3);

        $modelUser = new M_User;
        $modelToko = new M_Toko;
        // Mengambil data keseluruhan kategori dari table kategori di database
        $dataUser = $modelUser->getDataPeternak(['tbl_user.id_user' => $idView])->getRowArray();
        $dataToko = $modelToko->getDataToko(['tbl_toko.id_user'=> $idView])->getRowArray();
        //session()->set(['idUpdate' => $dataAdmin['id_admin']]);

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['detail_peternak'] = $dataUser; // mengirim array data kategori ke view
        $data['dataToko'] = $dataToko; // mengirim array data kategori ke view

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/toko/detail-toko', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }

    public function simpan_toko()
    {
        $modelToko = new M_Toko;

        $nama_toko = $this->request->getPost('nama_toko');
        $alamat_toko = $this->request->getPost('alamat_toko');
        $status_toko = $this->request->getPost('status_toko');

        if(!$this->validate([
            'foto_toko' => 'uploaded[foto_toko]|max_size[foto_toko, 10240]|ext_in[foto_toko,png,jpg,jpeg]',
        ])){
            session()->setFlashdata('error', "Format file yang diizinkan : foto maksimal ukuran 10 MB");
            return redirect()->to('/admin/master-toko')->withInput();
        }

        $foto_toko = $this->request->getFile('foto_toko');
        $ext1 = $foto_toko->getClientExtension();
        $file1 = "foto_toko-".date("ymdHis").".".$ext1;
        $foto_toko->move('Assets/img/profile',$file1);

        $sqlCek1 = $modelToko->getDataToko(['nama_toko' => $nama_toko]);
        $sqlCek2 = $modelToko->getDataToko(['status_toko' => $status_toko]);
        $cekuser = $sqlCek1->getNumRows();
        $cektingkat = $sqlCek2->getNumRows();

        if($nama_toko ==""){
            session()->setFlashdata('error','Inputan Tidak Boleh Kosong!')
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        }else{
        $dataSimpan = [
            'nama_toko' => $nama_toko,
            'alamat_toko' => $alamat_toko,
            'status_toko' => $status_toko,
            'foto_toko' => $file1,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $modelToko->saveDataToko($dataSimpan);

        // session()->setFlashdata('success','Data Toko berhasil ditambahkan!!')
        ?>
        <script>
            document.location = "<?= base_url('admin/master-toko');?>";
        </script>
        <?php
        }
    }

    public function edit_toko()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
        $idEdit = $uri->getSegment(3);

        $modelUser = new M_User;
        $modelToko = new M_Toko;
        // Mengambil data keseluruhan kategori dari table kategori di database
        $dataUser = $modelUser->getDataPeternak(['tbl_user.id_user' => $idEdit])->getRowArray();
        $dataToko = $modelToko->getDataToko(['tbl_toko.id_user'=> $idEdit])->getRowArray();
        session()->set(['idUpdate' => $dataUser['id_user']]);

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['detail_peternak'] = $dataUser;
        $data['dataToko'] = $dataToko;

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/toko/edit-toko', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }

    public function update_toko()
    {
        $modelUser = new M_User;
        $modelToko = new M_Toko;

        $idUpdate = session()->get('idUpdate');
        $nama_toko =  $this->request->getPost('nama_toko');
        $alamat_toko =  $this->request->getPost('alamat_toko');
        $status_toko =  $this->request->getPost('status_toko');
        $foto_toko = $this->request->getFile('foto_toko');
        
        if($foto_toko != ''){
            if(!$this->validate([
                'foto_toko' => 'uploaded[foto_toko]|max_size[foto_toko, 10240]|ext_in[foto_toko,png,jpg,jpeg]',
            ])){
                session()->setFlashdata('error', "Format file yang diizinkan : foto maksimal ukuran 10 MB");
                return redirect()->to('/admin/master-toko')->withInput();
            }

            $foto_toko1 = $this->request->getPost('foto_toko_old');
            $foto_toko = $this->request->getFile('foto_toko');
            $ext1 = $foto_toko->getClientExtension();
            $namaFile1 = $foto_toko1;
            $foto_toko->move('Assets/img/profile', $namaFile1, true);

        $dataUpdate = [
            'nama_toko' => $nama_toko,
            'alamat_toko' => $alamat_toko,
            'status_toko' => $status_toko,
            'foto_toko' => $namaFile1,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        }else{
            $dataUpdate = [
                'nama_toko' => $nama_toko,
                'alamat_toko' => $alamat_toko,
                'status_toko' => $status_toko,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
            $whereUpdate = ['id_toko' => $idUpdate];
            $modelToko->updateDataToko($dataUpdate, $whereUpdate);
            session()->remove('idUpdate');
            session()->setFlashdata('success','Data Toko Berhasil Diperbarui!!');
            ?>
<script>
    document.location = "<?= base_url('admin/master-toko');?>";
</script>
<?php
        
    }
//end master toko

//master pengguna
   public function master_pengguna()
   {
    $uri = service('uri');
    $page = $uri->getSegment(2);

    $modelUser = new M_User;
    // Mengambil data keseluruhan kategori dari table kategori di database
    $dataUser = $modelUser->getDataPengguna(['is_delete_user' => '0','akses_level'=> '2'])->getResultArray();
    

    $data['page'] = $page;
    $data['web_title'] = "SobatX";
    $data['dataUser'] = $dataUser; // mengirim array data kategori ke view 

      echo view('Backend/master-admin/template/head', $data);
      echo view('Backend/master-admin/template/sidebar', $data);
      echo view('Backend/master-admin/pengguna/master-pengguna', $data);
      echo view('Backend/master-admin/template/footer', $data);
   }

   public function view_pengguna()
   {
    $uri = service('uri');
    $page = $uri->getSegment(2);
    $idView = $uri->getSegment(3);

    $modelUser = new M_User;
    // Mengambil data keseluruhan kategori dari table kategori di database
    $dataUser = $modelUser->getDataPengguna(['id_user' => $idView])->getRowArray();
    //session()->set(['idUpdate' => $dataAdmin['id_admin']]);

    $data['page'] = $page;
    $data['web_title'] = "SobatX";
    $data['detail_pengguna'] = $dataUser; // mengirim array data kategori ke view

    echo view('Backend/master-admin/template/head', $data);
    echo view('Backend/master-admin/template/sidebar', $data);
    echo view('Backend/master-admin/pengguna/detail-pengguna', $data);
    echo view('Backend/master-admin/template/footer', $data);
   }

   public function edit_pengguna()
   {
       $uri = service('uri');
       $page = $uri->getSegment(2);
       $idEdit = $uri->getSegment(3);

       $modelUser = new M_User;
       // Mengambil data keseluruhan kategori dari table kategori di database
       $dataUser = $modelUser->getDataPengguna(['id_user' => $idEdit])->getRowArray();
       session()->set(['idUpdate' => $dataUser['id_user']]);

       $data['page'] = $page;
       $data['web_title'] = "SobatX";
       $data['detail_pengguna'] = $dataUser;

       echo view('Backend/master-admin/template/head', $data);
       echo view('Backend/master-admin/template/sidebar', $data);
       echo view('Backend/master-admin/pengguna/edit-pengguna', $data);
       echo view('Backend/master-admin/template/footer', $data);
   }

   public function update_pengguna()
   {
    $modelUser = new M_User;

    $idUpdate = session()->get('idUpdate');
    $nama_user =  $this->request->getPost('nama_user');
    $email_user =  $this->request->getPost('email_user');
    $no_hp =  $this->request->getPost('no_hp');
    $status =  $this->request->getPost('status');
    $foto_user = $this->request->getFile('foto_user');
    
    if($foto_user != ''){
        if(!$this->validate([
            'foto_user' => 'uploaded[foto_user]|max_size[foto_user, 10240]|ext_in[foto_user,png,jpg,jpeg]',
        ])){
            session()->setFlashdata('error', "Format file yang diizinkan : foto maksimal ukuran 10 MB");
            return redirect()->to('/admin/master-peternak')->withInput();
        }

        $foto_user1 = $this->request->getPost('foto_user_old');
        $foto_user = $this->request->getFile('foto_user');
        $ext1 = $foto_user->getClientExtension();
        $namaFile1 = $foto_user1;
        $foto_user->move('Assets/img/profile', $namaFile1, true);

    $dataUpdate = [
        'nama_user' => $nama_user,
        'email_user' => $email_user,
        'no_hp' => $no_hp,
        'status' => $status,
        'foto_user' => $namaFile1,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    }else{
        $dataUpdate = [
            'nama_user' => $nama_user,
            'email_user' => $email_user,
            'no_hp' => $no_hp,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
        $whereUpdate = ['id_user' => $idUpdate];
        $modelUser->updateDataUser($dataUpdate, $whereUpdate);
        session()->remove('idUpdate');
        session()->setFlashdata('success','Data Peternak Berhasil Diperbarui!!');
        ?>
        <script>
        document.location = "<?= base_url('admin/master-pengguna');?>";
        </script>
        <?php
    }
    //end master pengguna

    //paket
    public function master_paket()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);

        $modelPaket = new M_PUsaha;

        $dataPaket = $modelPaket->getDataPaket(['is_delete_paket' => '0'])->getResultArray();

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['dataPaket'] = $dataPaket;

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/paket/master-paket', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }

    public function detail_data_paket()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
        $idPaket = $uri->getSegment(4);

        $modelPaket = new M_PUsaha;

        $dataPaket = $modelPaket->getDataPaket(['is_delete_paket' => '0', 'sha1(id_paket)' => $idPaket])->getRowArray();
        $dataBeliPaket = $modelPaket->getBeliPaketJoin(['sha1(tbl_paket_usaha.id_paket)' => $idPaket])->getResultArray();

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['dataPaket'] = $dataPaket;
        $data['dataBeliPaket'] = $dataBeliPaket;

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/paket/detail-paket', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }
    public function setujui_Paket()
    {
        $uri = service('uri');
        $idPaket = $uri->getSegment(3);
        $idUser = $uri->getSegment(4);

        $modelPaket = new M_PUsaha;

        $dataUpdate = [
            'status_pengajuan' => '2'
        ];
        $whereUpdate = ['sha1(id_paket)' => $idPaket, 'sha1(id_user)' => $idUser];
        $modelPaket->setujuiBeliPaket($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Berhasil diSetujui!');
        ?>
        <script>
            document.location = "<?= base_url('/admin/pkt/detail/'.$idPaket); ?>";
        </script>
        <?php
    }

    public function input_data_paket()
    {
        
        echo view('Backend/master-admin/template/head');
        echo view('Backend/master-admin/template/sidebar');
        echo view('Backend/master-admin/paket/input-paket');
        echo view('Backend/master-admin/template/footer');
    }
    public function simpan_data_paket()
    {
        $modelPaket = new M_PUsaha;

        $nama_paket =  $this->request->getPost('nama_paket');
        $keterangan =  $this->request->getPost('keterangan');
        $tgl_tersedia =  $this->request->getPost('tgl_tersedia');
        $tgl_berakhir =  $this->request->getPost('tgl_berakhir');
        $kuota =  $this->request->getPost('kuota');
        $harga =  $this->request->getPost('harga');

        if(!$this->validate([
            'foto_paket' => 'uploaded[foto_paket]|max_size[foto_paket, 10240]',
        ])){
            session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 10 MB");
            return redirect()->to('/admin/input-paket')->withInput();
        }

        $foto_paket = $this->request->getFile('foto_paket');
        $ext = $foto_paket->getClientExtension();
        $namaFile = "PKU-".date("ymdHis").".".$ext;
        $foto_paket->move('Assets/img/paket_usaha/',$namaFile);

        $hasil = $modelPaket->autoNumber()->getRowArray();
        if (!$hasil) {
            $id = "pku0001";
        } else {
            $kode = $hasil['id_paket'];

            $noUrut = (int) substr($kode, -4);
            $noUrut++;
            $id = "pku" . sprintf("%04s", $noUrut);
        }

        $dataInsert = [
            'id_paket' => $id,
            'nama_paket' => $nama_paket,
            'keterangan' => $keterangan,
            'foto_paket' => $namaFile,
            'tgl_tersedia' => $tgl_tersedia,
            'tgl_berakhir' => $tgl_berakhir,
            'kuota' => $kuota,
            'harga' => $harga,
            'is_delete_paket' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $modelPaket->saveDataPaket($dataInsert);
        session()->setFlashdata('success', 'Paket Usaha Berhasil Ditambahkan!!');

        ?>
        <script>
            document.location = "<?= base_url('/admin/master-paket'); ?>";
        </script>
        <?php
    }
    public function edit_data_paket()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);
        $idPaket = $uri->getSegment(3);

        $modelPaket = new M_PUsaha;

        $dataPaket = $modelPaket->getDataPaket(['is_delete_paket' => '0', 'sha1(id_paket)' => $idPaket])->getRowArray();
        session()->set(['idUpdate' => $idPaket]);

        $data['page'] = $page;
        $data['web_title'] = "SobatX";
        $data['dataPaket'] = $dataPaket;

        echo view('Backend/master-admin/template/head', $data);
        echo view('Backend/master-admin/template/sidebar', $data);
        echo view('Backend/master-admin/paket/edit-paket', $data);
        echo view('Backend/master-admin/template/footer', $data);
    }
    public function update_data_paket()
    {
        $modelPaket = new M_PUsaha;

        $idUpdate = session()->get('idUpdate');
        $nama_paket =  $this->request->getPost('nama_paket');
        $keterangan =  $this->request->getPost('keterangan');
        $tgl_tersedia =  $this->request->getPost('tgl_tersedia');
        $tgl_berakhir =  $this->request->getPost('tgl_berakhir');
        $kuota =  $this->request->getPost('kuota');
        $harga =  $this->request->getPost('harga');
        
        $foto_paket =  $this->request->getPost('foto_paket');

        if($foto_paket != ''){
            if(!$this->validate([
                'foto_user' => 'uploaded[foto_user]|max_size[foto_user, 10240]|ext_in[foto_user,png,jpg,jpeg]',
            ])){
                session()->setFlashdata('error', "Format file yang diizinkan : foto maksimal ukuran 10 MB");
                return redirect()->to('/admin/master-paket')->withInput();
            }
    
            $nmfoto_paket =  $this->request->getPost('nama_foto_paket');
            $foto_paket = $this->request->getFile('foto_paket');
            $ext1 = $foto_paket->getClientExtension();
            $namaFile = $nmfoto_paket;
            $foto_paket->move('Assets/img/paket_usaha/', $namaFile, true);
    
            $dataUpdate = [
                'nama_paket' => $nama_paket,
                'keterangan' => $keterangan,
                'foto_paket' => $namaFile,
                'tgl_tersedia' => $tgl_tersedia,
                'tgl_berakhir' => $tgl_berakhir,
                'kuota' => $kuota,
                'harga' => $harga,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }else{
            $dataUpdate = [
                'nama_paket' => $nama_paket,
                'keterangan' => $keterangan,
                'tgl_tersedia' => $tgl_tersedia,
                'tgl_berakhir' => $tgl_berakhir,
                'kuota' => $kuota,
                'harga' => $harga,
                'updated_at' => date('Y-m-d H:i:s')
                ];
        }

        $whereUpdate = ['sha1(id_paket)' => $idUpdate];
        $modelPaket->updateDataPaket($dataUpdate, $whereUpdate);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Paket Usaha Berhasil Diperbarui!!');
        ?>
            <script>
                document.location = "<?= base_url('/admin/master-paket'); ?>";
            </script>
        <?php
    }

    public function hapus_data_Paket()
    {
        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        $modelPaket = new M_PUsaha;

        $dataUpdate = [
            'is_delete_paket' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $whereUpdate = ['sha1(id_paket)' => $idHapus];
        $modelPaket->updateDataPaket($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Paket Usaha Berhasil dihapus!!');
        ?>
        <script>
            document.location = "<?= base_url('/admin/master-paket'); ?>";
        </script>
        <?php
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// Admin Peternak //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function login_checker_admin()
    {
       $modelUser = new M_User;

       $email = $this->antiinjection($this->request->getPost('email'));
       $password = $this->antiinjection($this->request->getPost('password'));

       $sqlCek = $modelUser->getDataUser(['email_user' => $email, 'status' => '1']);
       $aktif = $sqlCek->getNumRows();
       $adaEmail = $modelUser->getDataUser(['email_user' => $email])->getRowArray();

       if(!$adaEmail){
          session()->setFlashdata("error", "Email Tidak Terdaftar! Silahkan Registrasi atau Login dengan Google Pada Aplikasi Kami!");
          ?>
          <script type="text/javascript">
              document.location="<?php echo base_url('/admin/login-peternak');?>";
          </script>
          <?php
       }
       elseif(!$aktif){
          session()->setFlashdata('info', "Silakan cek email Anda dan lakukan aktivasi akun terlebih dahulu!");
          ?>
          <script type="text/javascript">
              document.location="<?php echo base_url('/admin/login-peternak');?>";
          </script>
          <?php
       }
       else{
          $sql = $modelUser->getDataUser(['email_user' => $email]);
          $cekUser = $sql->getRowArray();
          $aksesLevel = $cekUser['akses_level'];
          if(!$cekUser){
              session()->setFlashdata('error', "Email Tidak Terdaftar! Silahkan Registrasi atau Login dengan Google Pada Aplikasi Kami!");
              ?>
              <script type="text/javascript">
                  document.location="<?php echo base_url('/admin/login-peternak');?>";
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
                  if ($aksesLevel == "1") {
                      $data = [
                         'id' => $cekUser['id_user'],
                         'email' => $cekUser['email_user'],
                         'nama' => $cekUser['nama_user'],
                         'profile' => $cekUser['foto_user'],
                         'enid' => sha1($cekUser['id_user'])
                      ];
                      session()->set($data);
                      ?>
                      <script type="text/javascript">
                          document.location="<?php echo base_url('/admin/dashboard-peternak');?>";
                      </script>
                      <?php
                  } else {  
                    session()->setFlashdata('error', "Maaf Akses Di Tolak !!");
                    ?>
                    <script type="text/javascript">
                        history.go(-1);
                    </script>
                    <?php
                }
             }
          }
       }
    }
    public function login_peternak_admin()
    {
    //    $data['link1'] = $this->googleClient->createAuthUrl();
       echo view('Backend/master-admin-peternak/auth/login');
    }
    public function logout_admin()
    {
         session()->remove('id');
         session()->remove('email');
         session()->remove('nama');
         session()->remove('profile');
         session()->remove('enid');
       //   session()->destroy();
         session()->setFlashdata('info', 'Keluar dari Sistem!!');
         ?>
    <script>
     document.location = "<?= base_url('admin/login-peternak');?>";
    </script>
    <?php 
    }

    public function dashboard_admin_peternak()
    {
       $modelUser = new M_User;

       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getResultArray();
       $data['dataPeternak'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/dashboard', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    ////////// Admin Peternak Toko   
    public function toko_usaha_peternak()
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

    echo view('Backend/master-admin-peternak/template/head', $data);
    echo view('Backend/master-admin-peternak/template/sidebar', $data);
    echo view('Backend/master-admin-peternak/toko/tambah-toko', $data);
    echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    public function buat_toko()
    {
       $uri = service('uri');
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
       $foto_toko_edit = $this->request->getPost('foto_toko_edit');
       $foto_toko = $this->request->getFile('foto_toko');
       $idToko = session('id_toko');

       if($foto_toko != ''){
          if(!$this->validate([
             'foto_toko' => 'uploaded[foto_toko]|max_size[foto_toko, 10240]',
          ])){
             session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 10 MB");
             return redirect()->to('/admin/toko-saya-peternak')->withInput();
          }

          // $foto_toko1 = $this->request->getPost('foto_toko_old');
          $foto_toko = $this->request->getFile('foto_toko');
          $ext = $foto_toko->getClientExtension();
          $namaFile = "FTK".date("ymdHis").".".$ext;
          $foto_toko->move('Assets/img/toko/', $namaFile);

       }
       if($idToko ==''){
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
             // 'foto_toko' => $foto_toko_edit,
             'updated_at' => date('Y-m-d H:i:s')
          ];
          $whereUpdate = ['id_toko' => session('id_toko')];
          $modelToko->updateDataToko($dataUpdate, $whereUpdate);
          session()->remove('idToko');
       }

       session()->setFlashdata('success','Toko Berhasil DiBuat!');
       return redirect()->to(base_url('/admin/toko-saya-peternak'));
    }

    public function aktivasi_toko_admin()
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
           document.location = "<?= base_url('/admin/toko-saya-peternak');?>";
       </script>
       <?php
    }

    public function tambah_rekening_admin()
    {
       $modelRekening = new M_Rekening;
       $modelUser = new M_User;
       $modelToko = new M_Toko;
    
       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
       $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
       $dataRekening = $modelRekening->getDataRekeningJoin(['tbl_rekening.id_toko' => session('id')])->getRowArray();
       $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
       if($cekToko != 0){
          $toko = [
             'id_toko' => $dataToko['id_toko'],
          ];
          session()->set($toko);
       }

       // $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
       // $data['jumlahNotif'] = $jumlahNotif;

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;
       $data['dataToko'] = $dataToko;
       $data['dataRekening'] = $dataRekening;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/toko/tambah-rekening-admin', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);

    }

    public function simpan_rekening_admin()
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
          return redirect()->to(base_url('/admin/tambah-rekening-peternak'));
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
          return redirect()->to(base_url('/admin/toko-saya-peternak'));
       }
    }

    public function hapus_rekening_admin()
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
       return redirect()->to(base_url('/admin/toko-saya-peternak'));
    }


    //// Akhir Admin Peternak Toko

    public function produk_saya_peternak()
    {
       $modelUser = new M_User;
       $modelToko = new M_Toko;
       $modelProduk = new M_Produk;

       $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
       $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
    if($cekToko != 0){
       $toko = [
          'id_toko' => $dataToko['id_toko'],
       ];
       session()->set($toko);
    }
       $dataProduk = $modelProduk->getDataProduk(['id_toko' => session('id_toko'),'is_delete_produk' => '0'])->getResultArray();
       $data['dataProduk'] = $dataProduk;

       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
       $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
       $data['jumlahNotif'] = $jumlahNotif;

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/produk/produk-saya-peternak', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    public function tambah_produk_peternak()
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

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/produk/tambah-produk-peternak', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    public function simpan_produk_peternak()
    {
       $uri = service('uri');
       $modelUser = new M_User;
       $modelKategori = new M_Kategori;
       $modelProduk = new M_Produk;
       $modelToko = new M_Toko;

       $idUser= session('id');
       $id_toko = $this->request->getPost('id_toko');
       $nama_produk =  $this->request->getPost('nama_produk');
       $id_kategori =  $this->request->getPost('kategori_produk');
       $stok =  $this->request->getPost('stok');
       $berat =  $this->request->getPost('berat');
       $deskripsi_produk =  $this->request->getPost('deskripsi_produk');
       $harga =  $this->request->getPost('harga');

       if(!$this->validate([
          'foto_produk1' => 'uploaded[foto_produk1]|max_size[foto_produk1, 10240]','foto_produk2' => 'uploaded[foto_produk2]|max_size[foto_produk2, 10240]', 'foto_produk3' => 'uploaded[foto_produk3]|max_size[foto_produk3, 10240]'
       ])){
          session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 10 MB");
          return redirect()->to('/admin/tambah-produk-peternak')->withInput();
       }

       $formatNama= "PRD".date("ymdHis");
       //upload produk1
       $foto_produk1 = $this->request->getFile('foto_produk1');
       $ext = $foto_produk1->getClientExtension();
       $namaFile = $formatNama."-1.".'png';
       $foto_produk1->move('Assets/img/toko/produk/', $namaFile);
    // $path1->move('Assets/img/toko/produk/');
    // $namaFilepath1 = $path1.$namaFile;
    // move_uploaded_file($this->compress($foto_produk1, $namaFilepath1, 65), $path1);

       //upload produk2
       $foto_produk2 = $this->request->getFile('foto_produk2');
       $ext = $foto_produk2->getClientExtension();
       $namaFile = $formatNama."-2.".'png';
       $foto_produk2->move('Assets/img/toko/produk/', $namaFile);
    // $path2 = 'Assets/img/toko/produk/';
    // $namaFilepath2 = $path2.$namaFile;
    // move_uploaded_file($this->compress($foto_produk2, $namaFilepath2, 65), $path2);

       //upload produk3
       $foto_produk3 = $this->request->getFile('foto_produk3');
       $ext = $foto_produk3->getClientExtension();
       $namaFile = $formatNama."-3.".'png';
       $foto_produk3->move('Assets/img/toko/produk/', $namaFile);
    // $path3 = 'Assets/img/toko/produk/';
    // $namaFilepath3 = $path3.$namaFile;
    // move_uploaded_file($this->compress($foto_produk3, $namaFilepath3, 65), $path3);

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

       session()->setFlashdata('success','Produk Berhasil Di Tambahkan!');

       return redirect()->to(base_url('/admin/produk-saya-peternak'));
    }

    public function detail_produk_peternak()
    {
       $uri = service('uri');
       $modelUser = new M_User;
       $modelProduk = new M_Produk;
       $modelKategori = new M_Kategori;

       $idView= $uri->getSegment(3);
       $dataProduk = $modelProduk->getDataProdukJoin(['sha1(tbl_produk.id_produk)' => $idView])->getRowArray();
       $data['dataProduk'] = $dataProduk;
       $dataFotoProduk = $modelProduk->getFotoProduk(['sha1(id_produk)' => $idView])->getResultArray();
       $data['dataFotoProduk'] = $dataFotoProduk;
       $dataKategori = $modelKategori->getDataKategori()->getResultArray();
       $data['dataKategori'] = $dataKategori;

       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/produk/detail-produk-peternak', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    public function edit_produk_peternak()
    {
       $uri = service('uri');
       $modelUser = new M_User;
       $modelProduk = new M_Produk;
       $modelKategori = new M_Kategori;

       $idView= $uri->getSegment(3);
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

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/produk/edit-produk-peternak', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

       public function update_produk_peternak()
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
             $foto_produk1->move('Assets/img/toko/produk/', $namaFile);

          }elseif($foto_produk2 != ''){
             //upload produk2
             $foto_produk2 = $this->request->getFile('foto_produk2');
             $ext = $foto_produk2->getClientExtension();
             $namaFile = $foto_produk2_old;
             $foto_produk2->move('Assets/img/toko/produk/', $namaFile);

          }elseif($foto_produk3 != ''){
             //upload produk1
             $foto_produk3 = $this->request->getFile('foto_produk3');
             $ext = $foto_produk3->getClientExtension();
             $namaFile = $foto_produk3_old;
             $foto_produk3->move('Assets/img/toko/produk/', $namaFile);

          }
          $dataUpdate = [
             'nama_produk' => $nama_produk,
             'id_kategori' => $id_kategori,
             'nm_foto' => $foto_produk1_old . $foto_produk2_old . $foto_produk3_old,
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

       return redirect()->to(base_url('/admin/produk-saya-peternak'));
    }

    public function hapus_produk_peternak()
    {
       $uri = service('uri');
       $modelUser = new M_User;
       $modelKategori = new M_Kategori;
       $modelProduk = new M_Produk;
       $modelToko = new M_Toko;

       $idHapus = $uri->getSegment(3);

       $dataHapus = [
          'is_delete_produk' => '1',
          'updated_at' => date('Y-m-d H:i:s')
       ];
       $whereUpdate = ['sha1(id_produk)' => $idHapus];
       $modelProduk->updateDataProduk($dataHapus, $whereUpdate);
       session()->setFlashdata('success','Produk Berhasil Dihapus!');
       return redirect()->to(base_url('/admin/produk-saya-peternak'));
    }

    public function pesanan_masuk()
    {
       $modelUser = new M_User;
       $modelToko = new M_Toko;
       $modelProduk = new M_Produk;
       $modelTransaksi = new M_Transaksi;
       $modelPesanan = new M_Pesanan;

       $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
       $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
    if($cekToko != 0){
       $toko = [
          'id_toko' => $dataToko['id_toko'],
       ];
       session()->set($toko);
    }
       $dataPesanan = $modelPesanan->getDataPesananJoinAll(['tbl_pesanan.id_toko' => session('id_toko')])->getResultArray();
       $data['dataPesanan'] = $dataPesanan;

       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
       $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
       $data['jumlahNotif'] = $jumlahNotif;

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/pesanan/pesanan-masuk', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    public function update_pesanan()
    {
       $modelTransaksi = new M_Transaksi;
       $modelPesanan = new M_Pesanan;

       $uri = service('uri');
       $idView = $uri->getSegment(3);

       $nama_kurir =  $this->request->getPost('nama_kurir');
       $no_hp_kurir =  $this->request->getPost('no_hp_kurir');

       $dataPesanan= $modelPesanan->getDataPesanan(['id_pesanan' => $idView])->getRowArray();

       $idUpdate = $dataPesanan['id_pesanan'];

       $dataUpdate = [
          'nama_kurir' => $nama_kurir,
          'no_hp_kurir' => $no_hp_kurir,
          'status_pesanan' => '2',
          'updated_at' => date('Y-m-d H:i:s')
       ];
       $whereUpdate = ['id_pesanan' => $idUpdate];
       $modelPesanan->updateDataPesanan($dataUpdate, $whereUpdate);
       session()->setFlashdata('success','Data Berhasil Dikonfirmasi ');
       return redirect()->to(base_url('/admin/pesanan-berlangsung'));

    }

    public function pesanan_berlangsung()
    {
       $modelUser = new M_User;
       $modelToko = new M_Toko;
       $modelProduk = new M_Produk;
       $modelTransaksi = new M_Transaksi;
       $modelPesanan = new M_Pesanan;

       $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
       $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
    if($cekToko != 0){
       $toko = [
          'id_toko' => $dataToko['id_toko'],
       ];
       session()->set($toko);
    }
       $dataPesanan = $modelPesanan->getDataPesananJoinAll(['tbl_pesanan.id_toko' => session('id_toko')])->getResultArray();
       $data['dataPesanan'] = $dataPesanan;

       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
       $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
       $data['jumlahNotif'] = $jumlahNotif;

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/pesanan/pesanan-berlangsung', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }

    public function riwayat_pesanan()
    {
       $modelUser = new M_User;
       $modelToko = new M_Toko;
       $modelProduk = new M_Produk;
       $modelTransaksi = new M_Transaksi;
       $modelPesanan = new M_Pesanan;

       $dataToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getRowArray();
       $cekToko = $modelToko->getDataToko(['tbl_toko.id_user' => session('id')])->getNumRows();
    if($cekToko != 0){
       $toko = [
          'id_toko' => $dataToko['id_toko'],
       ];
       session()->set($toko);
    }
       $dataPesanan = $modelPesanan->getDataPesananJoinAll(['tbl_pesanan.id_toko' => session('id_toko')])->getResultArray();
       $data['dataPesanan'] = $dataPesanan;

       $dataPeternak = $modelUser->getDataUser(['id_user' => session('id')])->getRowArray();
       $jumlahNotif = $modelUser->getNotif(['id_user' => session('id')])->getNumRows();
       $data['jumlahNotif'] = $jumlahNotif;

       $data['menu'] = 'dashboard';
       $data['profile'] = $dataPeternak;

       echo view('Backend/master-admin-peternak/template/head', $data);
       echo view('Backend/master-admin-peternak/template/sidebar', $data);
       echo view('Backend/master-admin-peternak/pesanan/riwayat-pesanan', $data);
       echo view('Backend/master-admin-peternak/template/footer', $data);
    }
}