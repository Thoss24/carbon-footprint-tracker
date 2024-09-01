<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Solution;

class GoalItem extends Component
{

    public $targetDate;
    public $goalAchieved;
    public $previousCo2e;
    public $type;
    public $goalId;
    public $solutions;
    public $goalSeen;

    public function mount()
    {
        $this->solutions = Solution::where('goal_id', $this->goalId)->get();
    }

    public function render()
    {
        return view('livewire.goal-item');
    }
}
