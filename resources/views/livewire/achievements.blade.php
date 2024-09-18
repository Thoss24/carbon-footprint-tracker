<div>
    <h2>Goal Achievements</h2>
    @foreach ($goals_achievements as $goal_achievement)
        {{$goal_achievement}}
    @endforeach


@if ($isCached)
    <p>Data is cached.</p>
@else
    <p>Data is not cached, fetching now...</p>
@endif

</div>
