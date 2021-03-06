<?php
class AccommodationPackage extends Controller
{
    private $accoPackageModel;
    private $accoTypeModel;
    public function __construct()
    {
        $this->accoPackageModel = $this->Model("Accommodation_Package");
        $this->accoTypeModel = $this->Model("Accommodation_Type");
    }
    public function Index()
    {
        $accoPackages = $this->accoPackageModel->getAllAccomoPackage();
        $accoTypes = $this->accoTypeModel->getAllAccomoType();
        //SEARCH
        $search = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

            if (!empty($search)) {
                $accoPackages = $this->accoPackageModel->search(strtoupper($search));
            }
        }
        //END SEARCH
        $data = [
            'controller' => 'AccommodationPackage',
            'accoTypes' => $accoTypes,
            'Name' => '',
            'RoomN' => '',
            'Fee' => '',
            'Errors' => '',
            'search' => $search,
            'AccoPackages' => $accoPackages
        ];

        $this->View("Dashboard/AccommodationPackage/AccommodationPackage", $data);
    }
    public function Create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (!isset($_POST['AccommoType'])) {
                $data['Errors'] = "Select an accommodation type please";
            } else {
                $data = [
                    'AccommoType' => trim($_POST['AccommoType']),
                    'Name' =>  trim($_POST['Name']),
                    'RoomN' =>  trim($_POST['RoomN']),
                    'Fee' =>  trim($_POST['Fee']),
                    'Errors' => '',
                ];

                if (empty($data['Name'])) {
                    $data['Errors'] = "Name is required";
                }
                if (empty($data['RoomN'])) {
                    $data['Errors'] = "Specify number of Rooms ";
                }
                if (empty($data['Fee'])) {
                    $data['Errors'] = "Specify fee per night ,please";
                }
                if (empty($data['Errors'])) {
                    if ($this->accoPackageModel->Add($data)) {
                        $this->View("Dashboard/AccommodationPackage/AccommodationPackage", $data);
                    } else {
                        //die("something went wrong");
                        $data["Errors"] = "somthing went wrong ,Please try one more time";
                    }
                }
            }
        }
        $this->View("Dashboard/AccommodationPackage/AccommodationPackage", $data);
    }

    public function Edit($id)
    {
        $accoPackage = $this->accoPackageModel->getAccoPackageByID($id);
        $data = [
            'AccommoType' => $accoPackage->ACCOMMODATIONTYPE_ID,
            'Name' => $accoPackage->NAME,
            'RoomN' => $accoPackage->NOFROOM,
            'Fee' => $accoPackage->FEEPERNIGHT,
            'Errors' => '',
        ];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'ID' => $accoPackage->ID,
                'AccommoType' => trim($_POST['AccommoType']),
                'Name' => trim($_POST['Name']),
                'RoomN' => trim($_POST['RoomN']),
                'Fee' => trim($_POST['Fee']),
                'Errors' => '',
            ];
            if (empty($data['AccommoType'])) {
                $data['Errors'] = "Accommodation type should be selected,it's required";
            }
            if (empty($data['Name'])) {
                $data['Errors'] = "Name couldn't be empty,it's required";
            }
            if (empty($data['RoomN'])) {
                $data['Errors'] = "Specify number of Rooms,it's required";
            }
            if (empty($data['Fee'])) {
                $data['Errors'] = "Specify fee per night ,please";
            }

            if (empty($data['Errors'])) {
                if ($this->accoPackageModel->update($data)) {
                    $data['Message'] = "Updated successfully";
                    $this->View("Dashboard/AccommodationPackage/AccommodationPackage", $data);
                }
            }
        }

        $this->View("Dashboard/AccommodationPackage/AccommodationPackage", $data);
    }
    public function Delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->accoPackageModel->delete($id)) {
                header("Location:" . URLROOT . "/AccommodationPackage");
            } else {
                die();
            }
        }
    }
}
