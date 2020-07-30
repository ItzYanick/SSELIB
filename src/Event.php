<?php

namespace ItzYanick\SSELIB;

class Event
{
    protected $id;
    protected $event;
    protected $data;
    protected $callbackFunction;
    protected $callbackVarsArray;

    public function __construct(callable $callbackFunction, $event = '')
    {
        $this->callbackFunction = $callbackFunction;
        $this->event = $event;
    }

    public function __construct(callable $callbackFunction, $event = '', $callbackVarsArray)
    {
        $this->callbackFunction = $callbackFunction;
        $this->event = $event;
        $this->vars = $callbackVarsArray;
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