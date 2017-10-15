<?php
/**
 * Created by PhpStorm.
 * User: chico_percedes
 * Date: 2017-10-12
 * Time: 3:48 PM
 */
class Tasks extends CSV_Model {

    public function __construct()
    {
        parent::__construct(APPPATH . '../data/tasks.csv', 'id');
    }

}