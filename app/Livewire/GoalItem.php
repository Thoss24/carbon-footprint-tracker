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
    public $nextCo2e;
    public $percentageGoal;

    public function mount()
    {
        $this->solutions = Solution::where('goal_id', $this->goalId)->get();
    }

    public function share()
    {
        $this->dispatch('share-post', post: ['Original co2e' => $this->previousCo2e, 'Most recent co2e' => $this->nextCo2e, 'Percentage goal' => $this->percentageGoal, 'Type' => $this->type]);
    }

    public function render()
    {
        return view('livewire.goal-item');
    }
}
