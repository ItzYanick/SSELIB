<?php

namespace ItzYanick\SSELIB;

class Event
{
    protected $id;
    protected $event;
    protected $data;
    protected $callbackFunction;
    protected $callbackVarsArray;

    public function __construct(callable $callbackFunction, $event = 'data', $callbackVarsArray = '')
    {
        $this->callbackFunction = $callbackFunction;
        $this->event = $event;
        if(is_array($callbackVarsArray)) {
            $this->vars = $callbackVarsArray;
        }
    }

    public function getData()
    {
        if(isset($this->$callbackVarsArray)){
            $returnValue = call_user_func_array($this->callbackFunction, $callbackVarsArray);
        } else {
            $returnValue = call_user_func($this->callbackFunction);
        }
        if ($returnValue === false) {
            $this->id = '';
            $this->data = '';
        } else {
            $this->id = uniqid('', true);
            $this->data = $returnValue;
        }
        return $this;
    }
}