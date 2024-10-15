<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_Toko extends Model
{
    protected $table = 'tbl_toko';

      public function getToko($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('tbl_toko.id_user','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('tbl_toko.id_user','ASC');
            return $query = $builder->get();
        }
      }
      public function getDataToko($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_toko.id_user', 'LEFT');
            $builder->orderBy('tbl_toko.id_user','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_toko.id_user', 'LEFT');
            $builder->orderBy('tbl_toko.id_user','ASC');
            return $query = $builder->get();
        }
      }
      public function updateDataToko($data, $where)
      {
          $builder = $this->db->table($this->table);
          $builder->where($where);
          return $builder->update($data);
      }
      public function saveDataToko($data)
      {
          $builder = $this->db->table($this->table);
          return $builder->insert($data);
      }

      public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_toko");
        $builder->orderBy("id_toko", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
   
}
?>