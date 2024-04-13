<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public $table = 'events';

    public $fillable = [
        'category',
        'name',
        'date',
        'uuid',
        'prefecture',
        'district'
    ];

    protected $casts = [
        'id' => 'integer',
        'category' => 'string',
        'name' => 'string',
        'date' => 'date',
        'uuid' => 'string',
        'prefecture' => 'string',
        'district' => 'string'
    ];

    public static array $rules = [
        'category' => 'required',
        'name' => 'required',
        'date' => 'required',
        // 'uuid' => 'required',
        // 'prefecture' => 'required',
        // 'district' => 'required'
    ];

    public static array $messages = [
        'category.required' => 'カテゴリを選択してください',
        'name.required' => 'イベント名を入力してください',
        'date.required' => '開催日を入力してください',
        // 'uuid' => 'required',
        // 'prefecture' => 'required',
        // 'district' => 'required'
    ];

    // relation
    public function participant()
    {
        return $this->hasOne(Participants::class, 'event_id', 'uuid');
    }
}
