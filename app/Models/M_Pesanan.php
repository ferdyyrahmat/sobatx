<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pesanan extends Model
{
    protected $tableTemp = 'tbl_pesanan';

    //Temporary Table
    public function getDataPesanan($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->orderBy('id_pesanan', 'ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('id_pesanan', 'ASC');
            return $query = $builder->get();
        }
    }
    public function getDataPesananJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_pesanan.id_produk', 'LEFT');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_pesanan.id_user', 'LEFT');
            $builder->join('tbl_alamat', 'tbl_alamat.id_alamat = tbl_pesanan.id_alamat', 'LEFT');
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_pesanan.id_toko', 'LEFT');
            $builder->join('tbl_transaksi_temp', 'sha1(tbl_transaksi_temp.id_transaksi) = tbl_pesanan.id_pesanan', 'LEFT');
            $builder->orderBy('tbl_pesanan.id_produk', 'ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->tableTemp);
            $builder->select('*');
            $builder->where($where);
            $builder->join('tbl_produk', 'tbl_produk.id_produk = tbl_pesanan.id_produk', 'LEFT');
            $builder->join('tbl_user', 'tbl_user.id_user = tbl_pesanan.id_user', 'LEFT');
            $builder->join('tbl_alamat', 'tbl_alamat.id_alamat = tbl_pesanan.id_alamat', 'LEFT');
            $builder->join('tbl_toko', 'tbl_toko.id_toko = tbl_pesanan.id_toko', 'LEFT');
            $builder->join('tbl_transaksi_temp', 'sha1(tbl_transaksi_temp.id_transaksi) = tbl_pesanan.id_pesanan', 'LEFT');
            $builder->orderBy('tbl_pesanan.id_produk', 'ASC');
            return $query = $builder->get();
        }
    }
    public function saveDataPesanan($data)
    {
        $builder = $this->db->table($this->tableTemp);
        return $builder->insert($data);
    }

    public function updateDataPesanan($data, $where)
    {
        $builder = $this->db->table($this->tableTemp);
        $builder->where($where);
        return $builder->update($data);
    }
    public function autoNumber()
    {
        $builder = $this->db->table($this->tableTemp);
        $builder->select("id_pesanan");
        $builder->orderBy("id_pesanan", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
    }
}
