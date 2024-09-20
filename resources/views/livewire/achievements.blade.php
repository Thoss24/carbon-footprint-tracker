<div class="p-2">
    <section class="mb-4">
        <h2 class="mb-2 text-lg underline">Goal Achievements</h2>
        <div class="flex flex-row gap-8 flex-wrap">
            @foreach ($goals_achievements as $goal_achievement)
                <x:achievement id="{{$goal_achievement->id}}" icon="{{$goal_achievement->icon}}" met="{{$goal_achievement->met}}" count="{{$goal_achievement->count_requirement}}"
                    type="{{$goal_achievement->carbon_footprint_type}}" achieveType="{{$goal_achievement->achievement_type}}"  
                />
            @endforeach
        </div>
    </section>

    <section class="mb-4">
        <h2 class="mb-2 text-lg underline">Submit Data Achievements</h2>
        <div class="flex flex-row gap-8 flex-wrap">
            @foreach ($submit_data_achievements as $submit_data_achievement)
                <x:achievement id="{{$submit_data_achievement->id}}" icon="{{$submit_data_achievement->icon}}" met="{{$submit_data_achievement->met}}" count="{{$submit_data_achievement->count_requirement}}"
                    type="{{$submit_data_achievement->carbon_footprint_type}}" achieveType="{{$submit_data_achievement->achievement_type}}"
                />
            @endforeach
        </div>
    </section>
</div>