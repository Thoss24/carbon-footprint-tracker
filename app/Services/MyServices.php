<?php

namespace App\Services;

class MyServices
{
    public function clearFlash()
    {
        if (session()->has('message')) {
            session()->forget('message');
        }
    }
}