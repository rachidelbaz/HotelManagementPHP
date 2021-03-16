<?php
class Role extends Controller
{
    private $roleModel;
    private $search;
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

            if (!empty($this->search)) {
                $roles = $this->roleModel->search(strtoupper($this->search));
            }
        }
        //END SEARCH
        $data = [
            'controller' => 'Role',
            'Role' => '',
            'Errors' => '',
            'search' => $this->search,
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
            } else {
                $data['Privileges'] = $_POST['Privileges'];
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
    public function Edit($id)
    {
        $role = $this->roleModel->getRoleByID($id);
        $data = [
            'ID' => $role->ID,
            'Role' => $role->NAME,
            'Privileges' => [],
            'Errors' => '',
        ];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['Privileges'])) {
                $data['Privileges'] = $_POST['Privileges'];
            }

            $data = [
                'ID' => $role->ID,
                'Role' => $_POST['Role'],
                'Privileges' => $_POST['Privileges'],
                'Errors' => ''
            ];

            if (empty($data['Role'])) {
                $data['Errors'] = "Role couldn't be empty,it's required";
            }

            if (empty($data['Errors'])) {
                if ($this->roleModel->update($data)) {
                    $data['Message'] = "Updated successfully";
                    header("Location:" . URLROOT . "/Role");
                }
            }
        }
        header('location:' . URLROOT . '/Role');
        //$this->View("Dashboard/Role/Role", $data);
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
