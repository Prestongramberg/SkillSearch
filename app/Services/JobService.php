<?php

namespace App\Services;

use App\Models\Job;

class JobService
{
    public function createJob(array $formData): void
    {
        Job::create($formData);
    }

}
