<?php
class Accommodation extends Controller
{
    private $accoModel;
    private $accoPackageModel;
    public function __construct()
    {
        $this->accoModel = $this->Model("Accommodation_");
        $this->accoPackageModel = $this->Model("Accommodation_Package");
    }

    public function Index()
    {
        $accommo = $this->accoModel->getAllAccomo();
        $accoPackages = $this->accoPackageModel->getAllAccomoPackage();
        //SEARCH
        $search = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

            if (!empty($search)) {
                $accommo = $this->accoModel->search(strtoupper($search));
            }
        }
        //END SEARCH
        $data = [
            'controller' => 'Accommodation',
            'accoPackages' => $accoPackages,
            'Name' => '',
            'RoomN' => '',
            'Fee' => '',
            'Errors' => '',
            'search' => $search,
            'accommo' => $accommo,

        ];
        $this->View("Dashboard/Accommodation/Accommodation", $data);
    }
    public function Create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (!isset($_POST['AccommoPackage'])) {
                $data['Errors'] = "Select an accommodation package please";
            } else {
                $data = [
                    'AccommoPackage' => trim($_POST['AccommoPackage']),
                    'Name' =>  trim($_POST['Name']),
                    'Errors' => '',
                ];

                if (empty($data['Name'])) {
                    $data['Errors'] = "Name is required";
                }
                if (empty($data['Errors'])) {
                    if ($this->accoModel->Add($data)) {
                        header('location:' . URLROOT . '/Accommodation/');
                    } else {
                        //die("something went wrong");
                        $data["Errors"] = "somthing went wrong ,Please try one more time";
                    }
                }
            }
        }
        $this->View("Dashboard/Accommodation/Accommodation", $data);
    }
    public function Edit($id)
    {
        $accommo = $this->accoModel->getAccommoByID($id);
        $data = [
            'AccommoType' => $accommo->ACCOMMODATIONPACKAGE_ID,
            'Name' => $accommo->NAME,
            'Errors' => '',
        ];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'ID' => $accommo->ID,
                'AccommoPackage' => trim($_POST['AccommoPackage']),
                'Name' => trim($_POST['Name']),
                'Errors' => '',
            ];
            if (empty($data['AccommoPackage'])) {
                $data['Errors'] = "Accommodation should be selected,it's required";
            }
            if (empty($data['Name'])) {
                $data['Errors'] = "Name couldn't be empty,it's required";
            }

            if (empty($data['Errors'])) {
                if ($this->accoModel->update($data)) {
                    $data['Message'] = "Updated successfully";
                    header("Location:" . URLROOT . "/Accommodation");
                    // $this->View("Dashboard/AccommodationPackage/AccommodationPackage", $data);
                }
            }
        }

        $this->View("Dashboard/Accommodation/Accommodation", $data);
    }
    public function Delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->accoModel->delete($id)) {
                header("Location:" . URLROOT . "/Accommodation");
            } else {
                die();
            }
        }
    }
    public function getAccommodationsByPackageId($id)
    {
        print_r(json_encode($this->accoModel->getAccommodationsByPackage($id)));
    }
}
