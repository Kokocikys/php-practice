<?php

namespace App\Action;

class Date
{
    public function showDate()
    {
        echo "Current date: ".date("jS \of F, Y");
    }
}