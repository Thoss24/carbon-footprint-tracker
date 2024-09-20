<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Achievements as AchievementsModel;
use App\Models\AchievementMet;
use Illuminate\Support\Facades\Cache;

class Achievements extends Component
{

    public $user_id;
    public $goals_achievements;
    public $submit_data_achievements;
    public $met_achievements;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->goals_achievements = AchievementsModel::where('achievement_type', 'goals')->get();
        $this->submit_data_achievements = AchievementsModel::where('achievement_type', 'submit_data')->get();
        $this->met_achievements = AchievementMet::all();
        //$this->checkSubmitDataAchievements();

        $this->checkGoalsAchievements();
        $this->checkSubmitDataAchievements();
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
        foreach ($this->submit_data_achievements as $submit_data_achievement) {
            foreach ($this->met_achievements as $met_achievement) {
                if ($submit_data_achievement->id == $met_achievement->achievement_id) {
                    $submit_data_achievement->met = 1;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.achievements');
    }
}
