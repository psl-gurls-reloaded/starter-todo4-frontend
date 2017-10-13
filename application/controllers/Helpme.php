<?php
/**
 * Created by PhpStorm.
 * User: chico_percedes
 * Date: 2017-10-12
 * Time: 5:42 PM
 */
class Helpme extends Application
{

    public function index()
    {
        $this->data['pagetitle'] = 'Help Wanted!';
        $stuff = file_get_contents('../data/jobs.md');
        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->render();
    }

}