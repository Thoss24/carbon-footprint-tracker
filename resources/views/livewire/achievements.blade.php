<div class="p-4 bg-gray-50 rounded-lg shadow-md">
    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-3 border-b-2 border-emerald-500 pb-2">Goal Achievements</h2>
        <div class="flex flex-row gap-6 flex-wrap">
            @foreach ($goals_achievements as $goal_achievement)
                <x:achievement 
                    id="{{$goal_achievement->id}}" 
                    icon="{{$goal_achievement->icon}}" 
                    met="{{$goal_achievement->met}}" 
                    count="{{$goal_achievement->count_requirement}}"
                    type="{{$goal_achievement->carbon_footprint_type}}" 
                    achieveType="{{$goal_achievement->achievement_type}}"
                />
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-xl font-semibold text-gray-800 mb-3 border-b-2 border-emerald-500 pb-2">Submit Data Achievements</h2>
        <div class="flex flex-row gap-6 flex-wrap">
            @foreach ($submit_data_achievements as $submit_data_achievement)
                <x:achievement 
                    id="{{$submit_data_achievement->id}}" 
                    icon="{{$submit_data_achievement->icon}}" 
                    met="{{$submit_data_achievement->met}}" 
                    count="{{$submit_data_achievement->count_requirement}}"
                    type="{{$submit_data_achievement->carbon_footprint_type}}" 
                    achieveType="{{$submit_data_achievement->achievement_type}}"
                />
            @endforeach
        </div>
    </section>
</div>