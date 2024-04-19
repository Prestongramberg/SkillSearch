<?php

namespace App\Repositories;

interface JobRepositoryInterface
{
    public function findJobsWithEmployer(int $numberPerPage);
    public function create(array $attributes);


}
