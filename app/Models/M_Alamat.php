<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_Alamat extends Model
{
   protected $table = 'tbl_alamat';

   //Temporary Table
   public function getDataAlamat($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_alamat','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_alamat','ASC');
            return $query = $builder->get();
        }
    }
   public function getDataAlamatJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_alamat.id_user', 'LEFT');
            $builder->orderBy('id_alamat','ASC');
            return $query = $builder->get();
         } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_alamat.id_user', 'LEFT');
            $builder->orderBy('id_alamat','ASC');
            return $query = $builder->get();
        }
    }
    public function saveDataAlamat($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataAlamat($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    public function autoNumber() {
      $builder = $this->db->table($this->table);
      $builder->select("id_alamat");
      $builder->orderBy("id_alamat", "DESC");
      $builder->limit(1);
      return $query = $builder->get();
 }

}