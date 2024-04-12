<?php

namespace App\Repositories;

use App\Models\Events;
use App\Repositories\BaseRepository;

class EventsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'category',
        'name',
        'date',
        'uuid',
        'prefecture',
        'district'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Events::class;
    }
}
