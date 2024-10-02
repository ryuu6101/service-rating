<?php

namespace App\Repositories\_Samples;

use App\Models\_Sample;
use App\Repositories\BaseRepository;

class _SampleRepository extends BaseRepository implements _SampleRepositoryInterface
{
    public function getModel() {
        return _Sample::class;
    }
}