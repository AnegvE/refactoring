<?php

namespace Refactoring;

class Sender
{

    public function send($value)
    {
        // notify if
        if ($value >= 3 && $value < 6) {
            $this->sendEmail('test@gmail.com', 'mr.anegve@gmail.com', 'Your Value is too low');
        } elseif ($value > 6) {
            if ($value == 7) {
                $this->sendEmail('test@gmail.com', 'mr.anegve@gmail.com', 'Your Value equals to 7');
            }
        }
        return true;
    }

    private function sendEmail($to, $from, $body)
    {
        printf("Email has been send to %s From %s.\r\n\r\n Notify you about %s", $to, $from, $body);
    }

}
