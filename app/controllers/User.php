<?php
class User extends Controller
{
    private $userModel;
    private $search;
    public function __construct()
    {
        $this->userModel = $this->Model('User_');
    }
    public function Index()
    {
        $users = $this->userModel->getAllClients();
        //SEARCH
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

            if (!empty($this->search)) {
                $users = $this->userModel->search(strtoupper($this->search));
            }
        }
        //END SEARCH
        $data = [
            'controller' => 'User',
            'CIN' => '',
            'Fullname' => '',
            'Email' => '',
            'ConfirmEmail' => '',
            'PhoneNumber' => '',
            'search' => $this->search,
            'Errors' => '',
            'Users' => $users
        ];
        $this->View("Dashboard/User/User", $data);
    }
}
