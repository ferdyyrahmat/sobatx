<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table = 'tbl_favorite';

    public function getFavorite($where = false)
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
    public function saveFavorite($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_favorite");
        $builder->orderBy("id_favorite", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
}
