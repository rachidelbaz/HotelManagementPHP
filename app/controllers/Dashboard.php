<?php
class Dashboard extends Controller
{

    public function __construct()
    {
    }

    public function Index()
    {
        $this->View("Dashboard/Accommodation");
    }
}
