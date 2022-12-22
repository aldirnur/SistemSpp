<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportTagihan implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    /**
     * @return int
     */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row )
    {

        $siswa = Siswa::where('nis', $row[1])->first();
        return new Tagihan([
            'jumlah' => $row[3],
            'id_siswa' => $siswa->id_siswa,
            'id_spp' => $row[4],
        ]);
    }
}

