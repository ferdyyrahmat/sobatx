<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_Transaksi extends Model
{
   protected $tableTemp = 'tbl_transaksi_temp';

   //Temporary Table
   public function getDataTemp($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_produk','ASC');
            return $query = $builder->get();
        }
    }
   public function getDataTempJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_transaksi_temp.id_produk', 'LEFT');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_transaksi_temp.id_user', 'LEFT');
            $builder->orderBy('tbl_transaksi_temp.id_produk','ASC');
            return $query = $builder->get();
         } else {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_transaksi_temp.id_produk', 'LEFT');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_transaksi_temp.id_user', 'LEFT');
            $builder->orderBy('tbl_transaksi_temp.id_produk','ASC');
            return $query = $builder->get();
        }
    }
    public function saveDataTemp($data)
    {
        $builder = $this->db->table($this->tableTemp);
        return $builder->insert($data);
    }

    public function updateDataTemp($data, $where)
    {
        $builder = $this->db->table($this->tableTemp);
        $builder->where($where);
        return $builder->update($data);
    }
    public function autoNumber() {
      $builder = $this->db->table($this->tableTemp);
      $builder->select("id_transaksi");
      $builder->orderBy("id_transaksi", "DESC");
      $builder->limit(1);
      return $query = $builder->get();
 }

}