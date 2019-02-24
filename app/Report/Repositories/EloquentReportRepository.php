<?php

namespace App\Report\Repositories;

use App\Report\Report;
use App\Report\ReportInterface;

class EloquentReportRepository implements ReportRepositoryInterface
{
    public function all()
    {
        return Report::all() ?? [];
    }

    public function get(int $id)
    {
        return Report::find($id);
    }

    public function getByAccessUrl(string $url)
    {
        return Report::where('url', $url)->first();
    }

    public function store(ReportInterface $report)
    {
        return $report->save();
    }
}