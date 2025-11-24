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
    public $sharedGoalDataAsHtml = "None";

    public function mount()
    {
        $this->solutions = Solution::where('goal_id', $this->goalId)->get();

        $this->sharedGoalDataAsHtml = 
        "<dl>
            <dt>Original CO₂e</dt>
            <dd>{$this->previousCo2e}</dd>

            <dt>Most Recent CO₂e</dt>
            <dd>{$this->nextCo2e}</dd>

            <dt>Percentage Goal</dt>
            <dd>{$this->percentageGoal}</dd>

            <dt>Type</dt>
            <dd>{$this->type}</dd>
        </dl>";

    }

    public function share()
    {

       # $this->dispatch('share-post', post: ['Original co2e' => $this->previousCo2e, 'Most recent co2e' => $this->nextCo2e, 'Percentage goal' => $this->percentageGoal, 'Type' => $this->type]);
    }

    public function render()
    {
        return view('livewire.goal-item', ['sharedGoalHtmlData' => $this->sharedGoalDataAsHtml]);
    }
}
