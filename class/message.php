<?php

class Message
{
    public $state;
    public $content;
    public $response;


    public function __construct($state, $content, $response)
    {
        $this->state = $state;
        $this->content = $content;
        $this->response = $response;
    }
    // function set_state($state)
    // {
    //     $this->state = $state;
    // }
    // function set_content($content)
    // {
    //     $this->content = $content;
    // }
    // function set_response($response)
    // {
    //     $this->response = $response;
    // }
}
