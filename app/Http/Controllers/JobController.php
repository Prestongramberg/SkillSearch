<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJob;
use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use App\Repositories\JobRepositoryInterface;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    protected JobService $jobService;
    protected JobRepositoryInterface $jobRepository;

    /**
     * @param JobService $jobService
     * @param JobRepositoryInterface $jobRepository
     */
    public function __construct(JobService $jobService, JobRepositoryInterface $jobRepository)
    {
        $this->jobService = $jobService;
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $jobs = $this->jobRepository->findJobsWithEmployer();
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store(StoreJob $request)
    {
        $validated = $request->validated();
        $job = $this->jobRepository->create($validated);

        $job->load('employer.user');

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/jobs');
    }

    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        Gate::authorize('edit-job', $job);

        $job->delete();

        return redirect('/jobs');
    }
}
