<?php

namespace App\Repositories;

use App\Models\Participants;
use App\Repositories\BaseRepository;

class ParticipantsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'uuid',
        'prefecture',
        'district',
        'role',
        'field1',
        'field2',
        'field3',
        'event_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Participants::class;
    }
}
