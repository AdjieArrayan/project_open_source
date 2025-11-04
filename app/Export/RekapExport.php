<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RekapExport implements FromView
{
    protected $rekapData;
    protected $favorit;
    protected $title;

    public function __construct($rekapData, $favorit, $title)
    {
        $this->rekapData = $rekapData;
        $this->favorit = $favorit;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('exports.rekap', [
            'rekapData' => $this->rekapData,
            'favorit' => $this->favorit,
            'title' => $this->title,
        ]);
    }
}