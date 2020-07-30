<?php

namespace ItzYanick\SSELIB;

class Server
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function sendEvent()
    {
        echo $this->event->getData();
        ob_flush();
        flush();
    }

    public function startServer($interval = 5)
    {
        while (true) {
            sendEvent();

            if (connection_aborted()) {
                return;
            }
            sleep($interval);
        }
    }

}
