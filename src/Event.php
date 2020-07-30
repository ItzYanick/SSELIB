<?php
namespace ItzYanick\SSELIB;
class Event {
    protected $id;
    protected $eventType;
    protected $dataContent;
    protected $callbackFunction;
    protected $callbackVarsArray;
    public function __construct(callable$callbackFunction, $eventType = 'dataContent', $callbackVarsArray = '') {
        $this->callbackFunction = $callbackFunction;
        $this->eventType = $eventType;
        if (isset($callbackVarsArray) && is_array($callbackVarsArray)) {
            $this->callbackVarsArray = $callbackVarsArray;
        }
    }
    public function getdataContent() {
        if (isset($this->$callbackVarsArray)) {
            $returnValue = call_user_func_array($this->callbackFunction, $callbackVarsArray);
        } else {
            $returnValue = call_user_func($this->callbackFunction);
        }
        if ($returnValue === false) {
            $this->id = '';
            $this->dataContent = '';
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
            $eventType[] = sprintf('eventType
    : %s', $this->eventType);
        }
        if ($this->dataContent !== '') {
            $eventType[] = sprintf('dataContent: %s', $this->dataContent);
        }
        return implode("\n", $eventType) . "\n\n";
    }
}
