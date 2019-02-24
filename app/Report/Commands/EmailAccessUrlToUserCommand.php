<?php

namespace App\Report\Commands;

use App\Mail\SendAccessUrlToUser;
use Illuminate\Support\Facades\Mail;

class EmailAccessUrlToUserCommand
{
    /**
     * @var string
     */
    private $toEmailAddress;

    /**
     * @var string
     */
    private $accessUrl;

    public function __construct(array $data)
    {
        $this->toEmailAddress = $data['email'];
        $this->accessUrl = $data['access_url'];
    }

    public function handle()
    {
        Mail::to($this->toEmailAddress)->send(new SendAccessUrlToUser($this->accessUrl));
    }
}