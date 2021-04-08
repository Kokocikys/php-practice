<?php

namespace Koko\Fakes;

use Koko\Mailer\Mailer;

class FakeMailer implements Mailer
{
    public function send(): void
    {
    }
}