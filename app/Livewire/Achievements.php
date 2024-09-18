<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Achievements as AchievementsModel;
use App\Models\AchievementMet;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Cache;

class Achievements extends Component
{

    public $user_id;
    public $isCached;
    public $goals_achievements;
    public $submit_data_achievements;
    public $met_achievements;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        // $this->goals_achievements = AchievementsModel::where('achievement_type', 'goals')->get();

        if (Cache::has('goals_data_key')) {
            $this->goals_achievements = Cache::get('goals_data_key');
            $this->isCached = true;
        } else {
            $this->goals_achievements = Cache::remember('goals_data_key', 60, function () {
                return AchievementsModel::where('achievement_type', 'goals')->get();
            });
            $this->isCached = false;
        }
        
        $this->submit_data_achievements = AchievementsModel::where('achievement_type', 'submit_data')->get();
        $this->met_achievements = AchievementMet::all();
        //$this->checkSubmitDataAchievements();

        $this->checkGoalsAchievements();

        // get all achievements and list them out - if achievement has been met by user add property to identify it has been met
    }

    public function checkGoalsAchievements()
    {
        foreach ($this->goals_achievements as $goal_achievement) {
            foreach ($this->met_achievements as $met_achievement) {
                if ($goal_achievement->id == $met_achievement->achievement_id) {
                    $goal_achievement->met = 1;
                }
            }
        }
    }

    
    public function checkSubmitDataAchievements()
    {
        
    }

    public function render()
    {
        return view('livewire.achievements');
    }
}
