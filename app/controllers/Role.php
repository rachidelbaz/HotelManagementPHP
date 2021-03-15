<?php
class Role extends Controller
{
    private $roleModel;
    public function __construct()
    {
        $this->roleModel = $this->Model('Role_');
    }

    public function Index()
    {
        $Privileges = $this->roleModel->getAllPrivileges();
        $datPrivileges = $this->roleModel->getPrivileges();
        $roles = $this->roleModel->getAllRole();
        //SEARCH
        $search = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

            if (!empty($search)) {
                $roles = $this->roleModel->search(strtoupper($search));
            }
        }
        //END SEARCH
        $data = [
            'controller' => 'Role',
            'Role' => '',
            'Errors' => '',
            'search' => $search,
            'Roles' => $roles,
            'Privileges' => $Privileges,
            'datPrivileges' => $datPrivileges
        ];
        $this->View("Dashboard/Role/Role", $data);
    }

    public function Create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'Role' => trim($_POST['Role']),
                'Privileges' => '',
                'Errors' => '',
            ];
            if (!isset($_POST['Privileges'])) {
                $data['Errors'] = "One of Privileges should be selected";
            }
            if (empty($data['Role'])) {
                $data['Errors'] = "Role is required";
            }
            if (empty($data['Errors'])) {
                if ($this->roleModel->Add($data)) {
                    header('location:' . URLROOT . '/Role');
                } else {
                    die("somthing went wrong");
                    //$data["NameError"]="somthing went wrong";
                }
            }
        }
        header('location:' . URLROOT . '/Role');
    }


    public function Delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->roleModel->delete($id)) {
                header("Location:" . URLROOT . "/Role");
            } else {
                die();
            }
        }
    }
}
