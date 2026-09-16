<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixMedia extends Seeder
{
    public function run(): void
    {
        // Properties 1-3: apartment-rent (sample_1, sample_2, sample_3)
        // Properties 4-6: apartment-sale (sample_1, sample_2, sample_3)
        // Properties 7-9: villa-sale (sample_1, sample_2, sample_3)
        // Properties 10-12: villa-short-rent (sample_1, sample_2, sample_3)
        // Properties 13-15: commercial-rent (sample_1, sample_2, sample_3)
        // Properties 16-18: commercial-sale (sample_1, sample_2, sample_3)
        // Properties 19-21: land (sample_1, sample_2, sample_3)
        // Properties 22-24: pre-sale (sample_1, sample_2, sample_3)
        // Properties 25-27: other (sample_1, sample_2, sample_3)

        for ($id = 1; $id <= 27; $id++) {
            $num = (($id - 1) % 3) + 1;
            $media = json_encode(["sample_{$num}.jpg"]);
            DB::table('property')->where('id', $id)->update(['media' => $media]);
        }

        $this->command->info('Fixed media filenames for all 27 properties!');
    }
}
