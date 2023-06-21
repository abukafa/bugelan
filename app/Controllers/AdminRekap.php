<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminRekap extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function absensi()
    {
        $tgl_awal = $this->request->getVar('tgl_awal');
        $tgl_ahir = $this->request->getVar('tgl_ahir');
        $query = $this->db->table('member')
            ->select('member.nama, member.tahun, COUNT(IF(absensi.absen = "i", 1, NULL)) as ijin, COUNT(IF(absensi.absen = "s", 1, NULL)) as sakit, COUNT(IF(absensi.absen = "a", 1, NULL)) as alpa')
            ->join('absensi', 'absensi.idm = member.id', 'left')
            ->where("absensi.tanggal BETWEEN '{$tgl_awal}' AND '{$tgl_ahir}'")
            ->groupBy('member.nama')
            ->orderBy('member.tahun', 'DESC')
            ->orderBy('member.nama', 'ASC')
            ->get();

        $data = [
            'tgl_awal' => $tgl_awal,
            'tgl_ahir' => $tgl_ahir,
            'absen' => $query->getResult()
        ];
        // var_dump($data);
        return view('report/absensi', $data);
    }
}
