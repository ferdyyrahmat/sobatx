<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_Rekening extends Model
{
    protected $table = 'tbl_rekening';

      public function getDataRekening($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_rekening','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_rekening','ASC');
            return $query = $builder->get();
        }
      }
      public function getDataRekeningJoin($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_rekening.id_user', 'LEFT');
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_rekening.id_toko', 'LEFT');
            $builder->orderBy('tbl_rekening.id_rekening','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_rekening.id_user', 'LEFT');
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_rekening.id_toko', 'LEFT');
            $builder->orderBy('tbl_rekening.id_rekening','ASC');
            return $query = $builder->get();
        }
      }
      public function updateDataRekening($data, $where)
      {
          $builder = $this->db->table($this->table);
          $builder->where($where);
          return $builder->update($data);
      }
      public function saveDataRekening($data)
      {
          $builder = $this->db->table($this->table);
          return $builder->insert($data);
      }

      public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_rekening");
        $builder->orderBy("id_rekening", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
   
}
?>