<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

	/**
     * @param $key
     * @return \Phalcon\Session\Bag
     */
    protected function _getBag($key){
        return new Phalcon\Session\Bag($key);
    }

}
