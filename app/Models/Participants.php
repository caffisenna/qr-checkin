<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    public $table = 'participants';

    public $fillable = [
        'name',
        'uuid',
        'prefecture',
        'district',
        'role',
        'field1',
        'field2',
        'field3',
        'event_id',
        'bsid',
        'checked_in_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'uuid' => 'string',
        'prefecture' => 'string',
        'district' => 'string',
        'role' => 'string',
        'field1' => 'string',
        'field2' => 'string',
        'field3' => 'string',
        'event_id' => 'string',
        'bsid' => 'string',
        'checked_in_at' => 'date',
    ];

    public static array $rules = [
        'name' => 'required',
        // 'uuid' => 'required',
        'prefecture' => 'required',
        'district' => 'required',
        'role' => 'required',
        'bsid' => 'required',
    ];

    public static $messages = [
        'bsid.required' => '登録番号なし',
    ];

    // relation
    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id', 'uuid');
    }

}
