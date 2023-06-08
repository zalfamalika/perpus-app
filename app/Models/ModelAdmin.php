<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
   public function TotalBuku()
   {
    return $this->db->table('tbl_buku')->countAll();
   }

   public function TotalAnggota()
   {
     return $this->db->table('tbl_anggota')->countAll();
   }

   public function TotalUser()
   {
     return $this->db->table('tbl_user')->countAll();
   }
}
