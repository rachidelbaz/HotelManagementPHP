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
    public function Create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'CIN' => trim($_POST['CIN']),
                'Fullname' => trim($_POST['Fullname']),
                'Email' => trim($_POST['Email']),
                'ConfirmEmail' => trim($_POST['ConfirmEmail']),
                'Phonenumber' => trim($_POST['Phonenumber']),
                'Errors' => '',
            ];

            if (empty($data['CIN'])) {
                $data['Errors'] = "CIN is required";
            }

            if (empty($data['Fullname'])) {
                $data['Errors'] = "Full name is required";
            }

            if (empty($data['ConfirmEmail'])) {
                $data['Errors'] = "Confirm Email is required";
            }

            if (empty($data['Phonenumber'])) {
                $data['Errors'] = "Phone number is required";
            }

            if (empty($data['Email'])) {
                $data['Errors'] = "Email is Required";
            } elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
                $data['Errors'] = "Enter a valid email adress";
            } elseif ($data["ConfirmEmail"] != $data["Email"]) {
                $data["Errors"] = "Email addresses didn't match";
            }
            if ($this->userModel->getUserByEmail($data['Email'])) {
                $data['Errors'] = "Email is already taken";
            }
            if ($this->userModel->getUserByCIN($data['CIN'])) {
                $data['Errors'] = "CIN is already taken";
            }

            if (empty($data['Errors'])) {
                if ($this->userModel->Add($data)) {
                    header('location:' . URLROOT . '/User');
                } else {
                    die("somthing went wrong");
                    //$data["NameError"]="somthing went wrong";
                }
            }
        }
        header('location:' . URLROOT . '/User');
    }
    public function Edit($id)
    {
        $user = $this->userModel->getUserByID($id);
        print_r($user);
        $data = [
            'CIN' => $user->CIN,
            'Fullname' => $user->Fullname,
            'Email' => $user->Email,
            'Phonenumber' => $user->NumberPhone,
            'Errors' => '',
        ];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'CIN' => trim($_POST['CIN']),
                'Fullname' => trim($_POST['Fullname']),
                'Email' => trim($_POST['Email']),
                'ConfirmEmail' => trim($_POST['ConfirmEmail']),
                'Phonenumber' => trim($_POST['Phonenumber']),
                'Errors' => '',
            ];

            if (empty($data['CIN'])) {
                $data['Errors'] = "CIN couldn't be empty,it's required";
            }
            if (empty($data['Fullname'])) {
                $data['Errors'] = "FULL NAME couldn't be empty,it's required";
            }
            if (empty($data['Phonenumber'])) {
                $data['Errors'] = "Phonenumber couldn't be empty,it's required";
            }
            if (empty($data['Email'])) {
                $data['Errors'] = "Email is Required";
            } elseif (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
                $data['Errors'] = "Enter a valid email adress";
            } elseif ($data["ConfirmEmail"] != $data["Email"]) {
                $data["Errors"] = "Email addresses didn't match";
            }

            if (empty($data['Errors'])) {
                if ($this->userModel->update($data)) {
                    $data['Errors'] = "Updated successfully";
                    header("Location:" . URLROOT . "/User");
                }
            }
        }
        header('location:' . URLROOT . '/User');
        //$this->View("Dashboard/Role/Role", $data);
    }
}
