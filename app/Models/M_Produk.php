<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_Produk extends Model
{
   protected $table = 'tbl_produk';
   protected $tableFoto = 'tbl_foto_produk';
   protected $tableHarga = 'tbl_harga';
    public function getDataProduk($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            // $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            // $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        }
    }
    public function getDataCariProduk($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            // $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            // $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        }
    }
    public function getDataProdukJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_produk.id_toko', 'LEFT');
            $builder->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'LEFT');
            // $builder->orderBy('tbl_produk.id_produk','ASC');
            // $builder->limit(1);
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_produk.id_toko', 'LEFT');
            $builder->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'LEFT');
            // $builder->orderBy('tbl_produk.id_produk','ASC'); 
            // $builder->limit(1);
            return $query = $builder->get();
        }
    }
    public function getDataProdukJoinAll($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_produk.id_toko', 'LEFT');
            $builder->join('tbl_foto_produk', 'tbl_foto_produk.id_produk = tbl_produk.id_produk', 'LEFT');
            $builder->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'LEFT');
            // $builder->orderBy('tbl_produk.id_produk','ASC');
            // $builder->limit(1);
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_produk.id_toko', 'LEFT');
            $builder->join('tbl_foto_produk', 'tbl_foto_produk.id_produk = tbl_produk.id_produk', 'LEFT INNER');
            $builder->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'LEFT');
            // $builder->orderBy('tbl_produk.id_produk','ASC'); 
            // $builder->limit(1);
            return $query = $builder->get();
        }
    }
    
    public function saveDataProduk($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
    public function saveHargaProduk($data)
    {
        $builder = $this->db->table($this->tableHarga);
        return $builder->insert($data);
    }

    public function updateDataProduk($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function deleteDataProduk($where = null)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->delete();
    }

    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_produk");
        $builder->orderBy("id_produk", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}

    public function getFotoProduk($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableFoto);
            $builder->select('*');
            $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableFoto);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        }
    }
    public function getFotoProdukJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableFoto);
            $builder->select('*');
            $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_foto_produk.id_produk', 'LEFT');
            $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableFoto);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_foto_produk.id_produk', 'LEFT');
            $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        }
    }
    public function saveFotoProduk($data)
    {
        $builder = $this->db->table($this->tableFoto);
        return $builder->insert($data);
    }
    public function autoNumber_foto() {
        $builder = $this->db->table($this->tableFoto);
        $builder->select("id_foto_produk");
        $builder->orderBy("id_foto_produk", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
}
?>