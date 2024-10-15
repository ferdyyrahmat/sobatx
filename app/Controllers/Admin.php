<?php 
namespace App\Controllers;

use App\Models\M_Admin;
use App\Models\M_User;
use App\Models\M_Toko;
use App\Models\UserModel;
use App\Models\M_PUsaha;

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
                         'enid' => sha1($dataAdmin['id_admin'])
                     ];
                     session()->set($dataSession);

                     return redirect()->to(base_url('/admin/dashboard'));
                }
            }
        }

    }
   public function dashboard_admin()
   {
       $data['akses'] = 'admin';
      echo view('Backend/master-admin/template/head');
      echo view('Backend/master-admin/template/sidebar');
      echo view('Backend/master-admin/dashboard');
      echo view('Backend/master-admin/template/footer');
   }
   public function dashboard_peternak()
   {
        $data['akses'] = 'peternak';
      echo view('Backend/master-admin/template/head');
      echo view('Backend/master-admin/template/sidebar', $data);
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
}