<?php
class Booking extends Controller
{

    private $bookingModel;
    private $accommoModel;
    private $accommoTypeModel;
    private $status;
    public function __construct()
    {
        $this->bookingModel = $this->Model("Booking_");
        $this->accommoModel = $this->Model("Accommodation_");
        $this->accommoTypeModel = $this->Model("Accommodation_Type");
        $this->status = new enum;
    }
    public function Index()
    {
        $bookings = $this->bookingModel->getAllBooking();
        $accommo = $this->accommoModel->getAllAccomo();
        $accoTypes = $this->accommoTypeModel->getAllAccomoType();
        //SEARCH
        $search = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $search = filter_var(trim($_POST["search"]), FILTER_SANITIZE_STRING);

            if (!empty($search)) {
                $bookings = $this->bookingModel->search(strtoupper($search));
            }
        }
        //END SEARCH
        $data = [
            'controller' => 'Booking',
            'bookings' => $bookings,
            'Accommodation' => '',
            'Date' => '',
            'Duration' => '',
            'Errors' => '',
            'search' => $search,
            'accommo' => $accommo,
            'accoTypes' => $accoTypes,
            'Status' => $this->status->getEnumValues()
        ];
        $this->View("Dashboard/Booking/Booking", $data);
    }
    public function Create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (!isset($_POST['Accommodation'])) {
                $data['Errors'] = "Select an accommodation please";
            } else {
                $status = 1;
                if (isset($_POST['Status'])) {
                    $status = trim($_POST['Status']);
                }
                $data = [
                    'Accommodation' => trim($_POST['Accommodation']),
                    'CIN' => trim($_POST['CIN']),
                    'Date' => trim($_POST['Date']),
                    'Duration' => trim($_POST['Duration']),
                    'Status' => $status,
                    'Errors' => '',
                ];

                if (empty($data['Accommodation'])) {
                    $data['Errors'] = "Accommodation is required";
                }
                if (empty($data['CIN'])) {
                    $data['Errors'] = "CIN is required";
                }
                if (empty($data['Date'])) {
                    $data['Errors'] = "Name is required";
                }
                if (empty($data['Duration'])) {
                    $data['Errors'] = "Name is required";
                }


                if (empty($data['Errors'])) {
                    if ($this->bookingModel->Add($data)) {
                        header('location:' . URLROOT . '/Booking/');
                    } else {
                        //die("something went wrong");
                        $data["Errors"] = "somthing went wrong ,Please try one more time";
                    }
                }
            }
        }
        $this->View("Dashboard/Booking/Booking", $data);
    }
    public function Edit($id)
    {
        $booking = $this->bookingModel->getBookingByID($id);
        $data = [
            'Accommodation' => $booking->ACCOMMODATION_ID,
            'CIN' => $booking->CIN,
            'Date' => $booking->FROMDATE,
            'Duration' => $booking->DURATION,
            'Status' => $booking->STATUS,
            'Errors' => '',
        ];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $status = 1;
            if (isset($_POST['Status'])) {
                $status = trim($_POST['Status']);
            }
            $data = [
                'ID' => $booking->ID,
                'Accommodation' => trim($_POST['Accommodation']),
                'CIN' => trim($_POST['CIN']),
                'Date' => trim($_POST['Date']),
                'Duration' => trim($_POST['Duration']),
                'Status' => $status,
                'Errors' => '',
            ];

            if (empty($data['CIN'])) {
                $data['Errors'] = "CIN couldn't be empty,it's required";
            }
            if (empty($data['Date'])) {
                $data['Errors'] = "Date couldn't be empty,it's required";
            }
            if (empty($data['Duration'])) {
                $data['Errors'] = "Name couldn't be empty,it's required";
            }


            if (empty($data['Errors'])) {
                if ($this->bookingModel->update($data)) {
                    $data['Message'] = "Updated successfully";
                    header("Location:" . URLROOT . "/Booking");
                }
            }
        }

        $this->View("Dashboard/Booking/Booking", $data);
    }
    public function Delete($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->bookingModel->delete($id)) {
                header("Location:" . URLROOT . "/Booking");
            } else {
                die();
            }
        }
    }
}
