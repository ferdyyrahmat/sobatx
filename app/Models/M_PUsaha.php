<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_PUsaha extends Model
{
   protected $table = 'tbl_paket_usaha';
   protected $tableBeli = 'tbl_beli_paket';
 
    public function getDataPaket($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_paket','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_paket','ASC');
            return $query = $builder->get();
        }
    }
    public function getDataPaketJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_beli_paket', 'tbl_beli_paket.id_paket = tbl_paket_usaha.id_paket', 'LEFT');
            $builder->orderBy('id_paket','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_beli_paket', 'tbl_beli_paket.id_paket = tbl_paket_usaha.id_paket', 'LEFT');
            $builder->orderBy('id_paket','ASC');
            return $query = $builder->get();
        }
    }
    
    public function saveDataPaket($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataPaket($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function deleteDataPaket($where = null)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->delete();
    }

    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_paket");
        $builder->orderBy("id_paket", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}

    public function getDataBeliPaket($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableBeli);
            $builder->select('*');
            $builder->orderBy('id_paket','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableBeli);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_paket','ASC');
            return $query = $builder->get();
        }
    }
    public function saveDataBeliPaket($data)
    {
        $builder = $this->db->table($this->tableBeli);
        return $builder->insert($data);
    }

    public function getBeliPaketJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableBeli);
            $builder->select('*');
            $builder->join('tbl_paket_usaha', 'tbl_paket_usaha.id_paket = tbl_beli_paket.id_paket', 'LEFT');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_beli_paket.id_user', 'LEFT');
            $builder->orderBy('tgl_pembelian','DESC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableBeli);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_paket_usaha', 'tbl_paket_usaha.id_paket = tbl_beli_paket.id_paket', 'LEFT');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_beli_paket.id_user', 'LEFT');
            $builder->orderBy('tgl_pembelian','DESC');
            return $query = $builder->get();
        }
    }
    public function setujuiBeliPaket($data, $where)
    {
        $builder = $this->db->table($this->tableBeli);
        $builder->where($where);
        return $builder->update($data);
    }
}
?>