<?php
class Info
{
    // Properties
    public $success;
    public $message;
    public $msv;
    public $mhp;
    public $a;
    public $b;
    public $c;

    // Methods
    function set_success($success)
    {
        $this->success = $success;
    }
    function set_message($message)
    {
        $this->message = $message;
    }
    function set_msv($msv)
    {
        $this->msv = $msv;
    }
    function set_mhp($mhp)
    {
        $this->mhp = $mhp;
    }
    function set_a($a)
    {
        $this->a = $a;
    }
    function set_b($b)
    {
        $this->b = $b;
    }
    function set_c($c)
    {
        $this->c = $c;
    }
}
