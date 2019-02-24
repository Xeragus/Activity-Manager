<?php

namespace App\Report\Repositories;

use App\Report\ReportInterface;

interface ReportRepositoryInterface
{
    public function all();

    public function get(int $id);

    public function getByAccessUrl(string $url);

    public function store(ReportInterface $report);
}