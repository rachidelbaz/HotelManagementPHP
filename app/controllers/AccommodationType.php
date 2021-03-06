<?php
class AccommodationType extends Controller
{
  private $accoTypeModel;
  public function __construct()
  {
    $this->accoTypeModel = $this->Model('Accommodation_Type');
  }

  public function Index()
  {
    $accoTypes = $this->accoTypeModel->getAllAccomoType();
    //SEARCH
    $search = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

      if (!empty($search)) {
        $accoTypes = $this->accoTypeModel->search(strtoupper($search));
      }
    }
    //END SEARCH
    $data = [
      'controller' => 'AccommodationType',
      'Name' => '',
      'Description' => '',
      'Errors' => '',
      'search' => $search,
      'AccoTypes' => $accoTypes
    ];
    $this->View("Dashboard/AccommodationType/AccommodationType", $data);
  }

  public function Create()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'Name' => trim($_POST['Name']),
        'Description' => trim($_POST['Description']),
        'NameError' => '',
      ];

      if (empty($data['Name'])) {
        $data['Errors'] = "Name is required";
      }
      if (empty($data['Errors'])) {
        if ($this->accoTypeModel->Add($data)) {
          header('location:' . URLROOT . '/AccommodationType');
        } else {
          die("somthing went wrong");
          //$data["NameError"]="somthing went wrong";
        }
      }
    }
    header('location:' . URLROOT . '/AccommodationType');
  }

  public function Edit($id)
  {
    $accoType = $this->accoTypeModel->getAccoTypeByID($id);
    $data = [
      'ID' => $accoType->ID,
      'Name' => $accoType->Name,
      'Description' => $accoType->Description,
      'Errors' => '',
      'Message' => ''
    ];
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'ID' => $accoType->ID,
        'Name' => trim($_POST['Name']),
        'Description' => trim($_POST['Description']),
        'Errors' => '',
        'Message' => ''
      ];
      if (empty($data['Name'])) {
        $data['Errors'] = "Name couldn't be empty,it's required";
      }

      if (empty($data['Errors'])) {
        if ($this->accoTypeModel->update($data)) {
          $data['Message'] = "Updated successfully";
          header('Location:' . URLROOT . "/AccommodationType");
        }
      }
    }

    $this->View("Dashboard/AccommodationType/Edit", $data);
  }

  public function Delete($id)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($this->accoTypeModel->delete($id)) {
        header("Location:" . URLROOT . "/AccommodationType");
      } else {
        die();
      }
    }
  }
}
