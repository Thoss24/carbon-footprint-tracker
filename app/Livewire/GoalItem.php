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
        '<div contenteditable="false" style="
        padding: 16px;
        border-radius: 10px;
        background: rgb(16 185 129);
        color: white;
        font-family: Arial, sans-serif;
        max-width: 420px;
        ">
            <h3 style="
                margin: 0 0 16px;
                font-size: 18px;
                font-weight: bold;
                color: white;
            ">
            CO₂e Summary
            </h3>
            <dl style="margin: 0;">
                <div style="
                    display: flex;
                    justify-content: space-between;
                    padding: 6px 0;
                    border-bottom: 1px solid rgba(255,255,255,0.3);
                ">
                    <dt style="font-weight: bold;">Original CO₂e</dt>
                    <dd style="margin: 0; font-weight: bold;">{$this->previousCo2e}</dd>
                </div>

                <div style="
                    display: flex;
                    justify-content: space-between;
                    padding: 6px 0;
                    border-bottom: 1px solid rgba(255,255,255,0.3);
                ">
                    <dt style="font-weight: bold;">Most Recent CO₂e</dt>
                    <dd style="margin: 0; font-weight: bold;">{$this->nextCo2e}</dd>
                </div>

                <div style="
                    display: flex;
                    justify-content: space-between;
                    padding: 6px 0;
                    border-bottom: 1px solid rgba(255,255,255,0.3);
                ">
                    <dt style="font-weight: bold;">Percentage Goal</dt>
                    <dd style="margin: 0; font-weight: bold;">{$this->percentageGoal}</dd>
                </div>

                <div style="
                    display: flex;
                    justify-content: space-between;
                    padding: 6px 0 0;
                ">
                    <dt style="font-weight: bold;">Type</dt>
                    <dd style="margin: 0; font-weight: bold;">{$this->type}</dd>
                </div>
            </dl>
        </div><br><br>';

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
