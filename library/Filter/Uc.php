<?php

class Filter_Uc implements Zend_Filter_Interface
{
    public function filter($value)
    {
        $valueFiltered= ucwords($value);
        return $valueFiltered;
    }
}

