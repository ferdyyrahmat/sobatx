<?php
namespace App\Models;
 
use CodeIgniter\Model;
 
class M_User extends Model
{
    protected $table = 'tbl_user';
    protected $tableNotif = 'tbl_notif';

      public function getDataUser($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_user','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_user','ASC');
            return $query = $builder->get();
        }
      }

      public function saveDataUser($data)
      {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
      }

      public function updateDataUser($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
 
    public function hapusDataUser($where = null)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->delete();
    }

    public function autoNumber() {
      $builder = $this->db->table($this->table);
      $builder->select("id_user");
      $builder->orderBy("id_user", "DESC");
      $builder->limit(1);
      return $query = $builder->get();
    }
    
    public function getNotif($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->tableNotif);
            $builder->select('*');
            $builder->orderBy('id_user','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableNotif);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_user','ASC');
            return $query = $builder->get();
        }
      }
    public function saveNotif($data)
      {
        $builder = $this->db->table($this->tableNotif);
        return $builder->insert($data);
      }

      public function hapusNotif($where = null)
    {
        $builder = $this->db->table($this->tableNotif);
        $builder->where($where);
        return $builder->delete();
    }

    public function getDataPeternak($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('tbl_toko', 'tbl_toko.id_user = tbl_user.id_user', 'LEFT');
            $builder->orderBy('tbl_user.id_user','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_toko', 'tbl_toko.id_user = tbl_user.id_user', 'LEFT');
            $builder->orderBy('tbl_user.id_user','ASC');
            return $query = $builder->get();
        }
      }

      public function getDataPengguna($where = false)
      {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_user','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_user','ASC');
            return $query = $builder->get();
        }
      }
    // public function getDataUserGoogle($where = false)
    //   {
    //     if ($where === false) {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->orderBy('id_user','ASC');
    //         return $query = $builder->get();
    //     } else {
    //         $builder = $this->db->table($this->table);
    //         $builder->select('*');
    //         $builder->where($where);
    //         $builder->orderBy('id_user','ASC');
    //         return $query = $builder->get();
    //     }
    //   }
}
?>