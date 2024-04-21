<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository implements JobRepositoryInterface
{

    public function findJobsWithEmployer(int $numberPerPage = 4): \Illuminate\Contracts\Pagination\Paginator
    {
        return Job::with('employer')->latest()->simplePaginate($numberPerPage);
    }

//    public function create(array $attributes) {
//        return Job::create($attributes);
//    }
    public function create(array $attributes) {
        // Add the employer_id attribute to the array of attributes
        $attributes['employer_id'] = 1;

        // Create the Job model with the updated attributes
        return Job::create($attributes);
    }

}
