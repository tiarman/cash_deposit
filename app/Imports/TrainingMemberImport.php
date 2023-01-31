<?php

namespace App\Imports;

use App\Models\TrainingMember;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithStartRow;

class TrainingMemberImport implements ToCollection, WithStartRow
{

    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @param Collection $collection
    */
        public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            TrainingMember::create([
                'training_id' => $this->id,
                'name' => $row[0],
                'email' => $row[1],
                'phone' => $row[2],
            ]);
        }

    }
    public function startRow(): int
    {
        return 2;
    }
}

