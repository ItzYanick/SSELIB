<?php
namespace ItzYanick\SSELIB;
class Event {
    protected $id;
    protected $eventType;
    protected $dataContent;
    protected $callbackFunction;
    protected $callbackVar;
    protected $stopMethod;

    public function __construct(callable $callbackFunction, $eventType, $callbackVar, callable $stopMethod) {
        $this->callbackFunction = $callbackFunction;
        $this->eventType = $eventType;
        $this->callbackVar = $callbackVar;
        $this->stopMethod = $stopMethod;
    }
    public function getDataContent() {
        if (isset($this->$callbackVar)) {
            $returnValue = call_user_func_array($this->callbackFunction, $callbackVar);
        } else {
            $returnValue = call_user_func($this->callbackFunction);
        }
        if ($returnValue === false) {
            $this->id = '';
            $this->dataContent = 'no data';
        } else {
            $this->id = uniqid('', true);
            $this->dataContent = $returnValue;
        }
        return $this;
    }
    public function __toString() {
        $eventType = [];
        if ($this->id !== '') {
            $eventType[] = sprintf('id: %s', $this->id);
        }
        if ($this->eventType !== '') {
            $eventType[] = sprintf('event: %s', $this->eventType);
        }
        if ($this->dataContent !== '') {
            $eventType[] = sprintf('data: %s', $this->dataContent);
        }
        return implode("\n", $eventType) . "\n\n";
    }
    public function executeStopMethod() {
        call_user_func($this->stopMethod);
    }
}
