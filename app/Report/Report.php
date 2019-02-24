<?php

namespace App\Report;

use Illuminate\Database\Eloquent\Model;

class Report extends Model implements ReportInterface
{
    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function setUrl(string $url)
    {
        $this->setAttribute('url', $url);
    }

    public function getUrl(): string
    {
        return $this->getAttribute('url');
    }

    public function setActivities(string $activities)
    {
        $this->setAttribute('activities_ids', $activities);
    }

    public function getActivities(): string
    {
        return $this->getAttribute('activities_ids');
    }
}