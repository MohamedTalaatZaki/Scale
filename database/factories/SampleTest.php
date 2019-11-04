<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;


$factory->defineAs(App\Models\QC\SampleTestHeader::class, 'demo_faker',function (Faker $faker) {
    return [
      'id' => 1000,
      'transport_detail_id' => 1000,
      'qc_test_header_id' => 1000,
      'result' => 'rejected',
      'created_by' => 1,
      'test_type' => 't',
      'created_at' => \Carbon\Carbon::now(),
    ];
});
