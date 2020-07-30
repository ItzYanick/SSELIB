<?php
namespace ItzYanick\SSELIB;
class Server {
    protected $event;
    public function __construct(Event $event) {
        $this->event = $event;
    }
    public function sendEvent() {
        echo $this->event->getDataContent();
        ob_flush();
        flush();
    }
    public function startServer($interval = 5) {
        while (true) {
            $this->sendEvent();
            if (connection_aborted()) {
                return;
            }
            sleep($interval);
        }
    }
}
