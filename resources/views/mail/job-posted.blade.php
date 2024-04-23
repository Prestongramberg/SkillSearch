<h2>{{ $job->title }}</h2>


<p>Congrats! Your job is now live on our website!</p>

<p>
    <a href="{{ url('/jobs/' . $job) }}">View Your Job Listing</a>
</p>
