<?php

namespace App\Activity;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model implements ActivityInterface
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user()->associate($user);
    }

    public function setDescription(string $description)
    {
        $this->setAttribute('description', $description);
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }

    public function setFromDatetime(int $fromDateTime)
    {
        $this->setAttribute('from_datetime', $fromDateTime);
    }

    public function getFromDatetime(): int
    {
        return $this->getAttribute('from_datetime');
    }

    public function setToDateTime(int $toDateTime)
    {
        $this->setAttribute('to_datetime', $toDateTime);
    }

    public function getToDatetime(): int
    {
        return $this->getAttribute('to_datetime');
    }

    public function setTimeSpent(string $timeSpent)
    {
        $this->setAttribute('time_spent', $timeSpent);
    }

    public function getTimeSpent(): string
    {
        return $this->getAttribute('time_spent');
    }

    public function jsonSerialize()
    {
        return [
            'description' => $this->getDescription(),
            'started_at' => Carbon::createFromTimestampUTC($this->getFromDatetime())->toDateTimeString(),
            'finished_at' => Carbon::createFromTimestampUTC($this->getToDatetime())->toDateTimeString(),
            'time_spent' => $this->getTimeSpent()
        ];
    }
}