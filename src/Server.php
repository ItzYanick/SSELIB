<?php

namespace ItzYanick\SSELIB;

class Server
{
    protected $event;
    protected $prevData = '{}';

    public function __construct(Event $event)
    {
        $this->event = $event;
    }
    public function sendEvent()
    {
        $data = $this->event->getDataContent($this->prevData);

        if ($data->id != '') {
            echo $data;
            ob_flush();
            flush();
        }

        $this->prevData = $data->dataContent[1];
    }
    public function startServer($interval = 5)
    {
        while (true) {
            $this->sendEvent();
            if (connection_aborted()) {
                $this->event->executeStopMethod();
                return;
            }
            sleep($interval);
        }
    }
}
