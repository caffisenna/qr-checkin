<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View; //追加
use Maatwebsite\Excel\Concerns\FromView; //追加

class ExcelExport implements FromView //書き換え
{
    protected $members; //追加 変数名は適宜変更
    protected $headings; //追加 変数名は適宜変更

    function __construct($members, $headings)
    {
        $this->members = $members;
        $this->headings = $headings;
    }

    public function collection()
    {
        // return ExcelDatas::all()->makeHidden(['id', 'created_at', 'updated_at']);
    }

    public function view(): View //書き換え
    {
        return view('events.export_members', [
            'members' => $this->members,
            'headings' => $this->headings,
        ]);
    }
}
