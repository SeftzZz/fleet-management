<?php
require_once APPPATH . "/libraries/JWT.php";
require_once "vendor/tecnickcom/tcpdf/tcpdf.php";
use Firebase\JWT\JWT;
defined("BASEPATH") or exit("No direct script access allowed");
class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(["form", "url"]);
        $this->load->library("curl");
        $this->load->helper("slug");
        $this->load->library("upload");
        $this->load->library("session");
        $this->load->library("user_agent");
        $this->load->library("datetime");
        $this->load->library(["form_validation"]);
        $this->load->library("recaptcha");
        $this->load->library("user_agent");
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("Home_m");
        $this->load->model("Home_m", "sop");
        $this->load->model("Training_m");
        $this->load->model("Training_m", "training");
        $this->load->model("Kamar_m");
        $this->load->model("Kamar_m", "kamar");
        $this->load->model("Karyawan_m");
        $this->load->model("Karyawan_m", "karyawan");
        $this->load->model("Customer_m");
        $this->load->model("Customer_m", "customer");
        $this->load->model("Company_m");
        $this->load->model("Company_m", "company");
        $this->load->model("Housekeeping_m");
        $this->load->model("Housekeeping_m", "hk_linen_inventori");
        $this->load->model("BusinessDetail_m");
        $this->load->model("BusinessDetail_m", "business_detail");
        $this->load->model("Fnb_m");
        $this->load->model("Fnb_m", "fnb_menu");
        $this->load->model("Booking_m");
        $this->load->model("Booking_m", "booking");
        $this->load->model("Menu_m");
        $this->load->model("Menu_m", "menu");
        $this->load->model("Login_m");
    }
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $year = date("Y");
        $data["paketMeeting"] = $this->Home_m->getfile_paket_meeting(
            $this->session->userdata("idBusiness")
        );
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "roombookingcartdetail"
        ] = $this->Booking_m->getfile_calendar_marketing();
        $data["business"] = $this->Kamar_m->getfile_all_rooms_by_business();
        $data["alltype"] = $this->Kamar_m->getfile_all_rooms_by_alltype($year);
        $data["roombookingdetail"] = $this->Booking_m->getfile_calendar_fo();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/home", $data);
        $this->load->view("cms/footer", $data);
    }
    public function masuk()
    {
        $this->form_validation->set_rules("emailUser", "emailUser", "required");
        $this->form_validation->set_rules("passUser", "passUser", "required");
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                "pesanerror",
                "all form must be filled out!"
            );
            $this->load->view("login", $data);
        } else {
            $emailUser = $this->input->post("emailUser");
            $passUser = $this->input->post("passUser");
            $data["user"] = $this->Login_m->cek_user(
                $emailUser,
                sha1($passUser)
            );
            if ($data["user"]) {
                // JWT Token
                $kunci = $this->config->item("thekey"); // From config/config.php
                $token["idUser"] = $data["user"]->idUser;
                $token["Email"] = $data["user"]->emailUser;
                $token["dep"] = $data["user"]->idDep;
                $token["level"] = $data["user"]->idLevel;
                $token["or"] = "cms";
                $token = JWT::encode($token, $kunci, "HS256");
                $this->session->set_userdata([
                    "logged_in" => "login",
                    "emailuser" => $data["user"]->emailUser,
                    "idUser" => $data["user"]->idUser,
                    "idKaryawan" => $data["user"]->idKaryawan,
                    "nmKaryawan" => $data["user"]->nmKaryawan,
                    "dep" => $data["user"]->idDep,
                    "depCode" => $data["user"]->DepCode,
                    "level" => $data["user"]->idLevel,
                    "level_name" => $data["user"]->Note,
                    "business" => $data["user"]->Name,
                    "idBusiness" => $data["user"]->idBusiness,
                    "address" => $data["user"]->addres,
                    "api_token" => $token,
                    "idGroup" => $data["user"]->idGroup,
                    "CABusiness" => $data["user"]->emailCABusiness,
                    "ARBusiness" => $data["user"]->emailARBusiness,
                    "ReservationBusiness" =>
                        $data["user"]->emailReservationBusiness,
                    "FOMBusiness" => $data["user"]->emailFOMBusiness,
                    "fee" => $data["user"]->feeBusiness,
                ]);
                $this->session->set_flashdata(
                    "pesansukses",
                    $this->input->post("emailUser") . " Berhasil !"
                );

                if($this->session->userdata('level') == '5') {
                    redirect("cms/home/viewAdditionalFnb/".$this->session->userdata('idBusiness')."/");
                } elseif($this->session->userdata('dep') == '4') {
                    redirect("cms/home/training");
                } elseif($this->session->userdata('level') == '6') {
                    redirect("cms/home/viewFnBmenu/".$this->session->userdata('idBusiness')."/");
                } else {
                    redirect("cms/home/viewFnBmenu/".$this->session->userdata('idBusiness')."/");
                }
            } else {
                $data_log = [
                    "ipLog" => $this->input->ip_address(),
                    "platformLog" => $this->agent->browser(),
                    "versionLog" => $this->agent->version(),
                    "attemptLog" => 1,
                    "statusLog" => "fail",
                    "ketLog" => $this->input->post("emailUser"),
                    "dateLog" => date("Y-m-d H:i:s"),
                ];
                $this->Login_m->log_sign($data_log);
                $attempt = $this->Login_m->getdataUser(
                    $this->input->post("emailUser")
                );
                $failAttempt = 0;
                if ($attempt >= 3) {
                    $this->session->set_flashdata(
                        "pesanerror",
                        $this->input->post("emailUser") .
                            " Blocked !, please call Administration System"
                    );
                    $data_user = [
                        "blockUser" => 1,
                        "createdAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->where(
                        "emailUser",
                        $this->input->post("emailUser")
                    );
                    $this->db->update("user", $data_user);
                    redirect("login");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "Wrong emailUser/passUser! " . $attempt . " Attempt"
                    );
                    redirect("login");
                }
            }
        }
    }
    public function logout()
    {
        $data = [
            "logged_in",
            "namalengkap",
            "leveluser",
            "id_user",
            "foto",
            "adminhddept",
            "hakaksesmsg",
        ];
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        echo "<script>";
        echo 'localStorage.removeItem("percentageInUse")';
        echo "</script>"; // Added the missing forward slash
        redirect("login/", "refresh");
    }
    // Fungsi create_slug untuk membuat slug dari sebuah string
    public function create_slug($string)
    {
        // Ubah string menjadi huruf kecil
        $slug = strtolower($string);
        // Ganti semua karakter non-alphabet atau non-numeric dengan '-'
        $slug = preg_replace("/[^a-z0-9]+/i", "_", $slug);
        // Hilangkan tanda '_' di awal dan akhir
        $slug = trim($slug, "_");
        return $slug;
    }
    public function daily_revenue()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 2,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/tables_dynamic", $data);
        $this->load->view("cms/footer", $data);
    }
    public function mounthly_revenue()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 3,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/tables_dynamic", $data);
        $this->load->view("cms/footer", $data);
    }
    public function yearly_revenue()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 4,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/tables_dynamic", $data);
        $this->load->view("cms/footer", $data);
    }
    public function sop()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 5,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["sop"] = $this->Home_m->getfile_sop();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/sop", $data);
        $this->load->view("cms/footer", $data);
    }
    public function training()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 6,
        ];
        // $data["new_training_number"] = $this->Kamar_m->generate_training_number();
        $data["training"] = $this->Training_m->getfile_training();
        // $data['folders'] = $this->Training_m->get_all_folders(); // Adjust this to your model method
        $data["folders"] = $this->Training_m->get_all_folders_with_files(); // Get folders and files
        $this->load->view("cms/header", $data);
        $this->load->view("cms/training", $data);
        $this->load->view("cms/footer", $data);
    }
    public function generate_training_number_ajax() {
        $input = json_decode(file_get_contents('php://input'), true);
        $idBusiness = $input['idBusiness'];

        if (!isset($idBusiness)) {
            echo json_encode(['error' => 'Invalid request']);
            return;
        }

        $new_training_number = $this->Kamar_m->generate_training_number($idBusiness);
        echo json_encode(['new_training_number' => $new_training_number]);
    }

    public function uploadSop()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 7,
        ];
        // konfigurasi proses upload file foto gallery
        $extensi = explode(".", $_FILES["attachSOP"]["name"]);
        $config["upload_path"] = "./assets/images/sop/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($_FILES["attachSOP"]["name"]) {
            if (
                $extensi[1] == "jpg" ||
                $extensi[1] == "JPG" ||
                $extensi[1] == "png" ||
                $extensi[1] == "jpeg" ||
                $extensi[1] == "pdf"
            ) {
                if ($this->upload->do_upload("attachSOP")) {
                    $gbr = $this->upload->data();
                    $data_sop = [
                        "idUser" => $this->session->userdata("idUser"),
                        "attachSOP" => $gbr["file_name"],
                        "ketSOP" => $this->input->post("ketSOP"),
                        "createdAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->insert("sop", $data_sop);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "SOP Berhasil dibuat"
                    );
                    redirect("cms/home/sop");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/sop");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file is not jpg/png"
                );
                redirect("cms/home/sop");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file not found");
            redirect("cms/home/sop");
        }
    }
    public function uploadTraining()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 8,
        ];
        // konfigurasi proses upload file foto gallery
        $extensi = explode(".", $_FILES["attachTraining"]["name"]);
        $config["upload_path"] = "./assets/images/training/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($_FILES["attachTraining"]["name"]) {
            if (
                $extensi[1] == "jpg" ||
                $extensi[1] == "JPG" ||
                $extensi[1] == "png" ||
                $extensi[1] == "jpeg" ||
                $extensi[1] == "pdf"
            ) {
                if ($this->upload->do_upload("attachTraining")) {
                    $gbr = $this->upload->data();
                    $data_Training = [
                        "idUser" => $this->session->userdata("idUser"),
                        "attachTraining" => $gbr["file_name"],
                        "ketTraining" => $this->input->post("ketTraining"),
                        "createdAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->insert("training", $data_Training);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Training Berhasil dibuat"
                    );
                    redirect("cms/home/training");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/training");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file is not jpg/png"
                );
                redirect("cms/home/training");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file not found");
            redirect("cms/home/training");
        }
    }
    public function get_folders()
    {
        $query = $this->db
            ->select("id, name")
            ->from("folders")
            ->get();
        $folders = $query->result_array();

        // Pastikan Anda mengirim JSON yang benar dari PHP
        header("Content-Type: application/json");
        echo json_encode(["folders" => $folders]); // $folders harus array berisi data folder
    }
    public function create_folder()
    {
        $folderName = $this->input->post("folderName");
        $parentId = $this->input->post("parentId")
            ? $this->input->post("parentId")
            : null;

        if (empty($folderName)) {
            echo json_encode([
                "status" => "error",
                "message" => "Folder name cannot be empty.",
            ]);
            return;
        }

        // Set the path based on parent ID
        $path =
            ($parentId ? $this->get_folder_path($parentId) . "/" : "") .
            $folderName;

        if (!file_exists($path)) {
            mkdir($path, 0777, true); // Create the folder on the filesystem
        }

        $data = [
            "name" => $folderName,
            "parent_id" => $parentId,
            "path" => $path, // Store the path in the database
        ];

        if ($this->db->insert("folders", $data)) {
            echo json_encode([
                "status" => "success",
                "message" => "Folder created successfully.",
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to create folder.",
            ]);
        }
    }
    private function get_folder_path($id)
    {
        // Fetch the folder's path from the database based on the ID
        $folder = $this->db->get_where("folders", ["id" => $id])->row();
        return $folder ? $folder->path : "";
    }
    private function getFullPath($parentId, $baseFolder)
    {
        // Inisialisasi path awal
        $folderPath = $baseFolder;

        // Loop rekursif untuk membangun full path berdasarkan parent_id
        while ($parentId) {
            $parentFolder = $this->db
                ->select("name, parent_id")
                ->from("folders")
                ->where("id", $parentId)
                ->get()
                ->row_array();
            if ($parentFolder) {
                $folderPath .= "/" . $parentFolder["name"];
                $parentId = $parentFolder["parent_id"];
            } else {
                break;
            }
        }

        return $folderPath;
    }
    private function build_tree($folders, $parent_id = 0)
    {
        $branch = [];
        foreach ($folders as $folder) {
            if ($folder->parent_id == $parent_id) {
                $children = $this->build_tree($folders, $folder->id);
                if ($children) {
                    $folder->children = $children;
                }
                $branch[] = $folder;
            }
        }
        return $branch;
    }
    // Function to handle the upload process
    public function process_upload() {
        // Retrieve form inputs
        $hotel_id = $this->input->post('hotel');
        $kodeUploads = $this->input->post('training-number');
        $file_name = $this->input->post('file-name');
        $categoryUploads = $this->input->post('categoryUploads');
        $departementUploads = $this->input->post('departementUploads');
        $keterangan = $this->input->post('keterangan');
        $expired = $this->input->post('expired');

        // Check required fields
        if (empty($hotel_id) || empty($file_name)) {
            $this->session->set_flashdata('error', 'Please fill in all required fields.');
            redirect('cms/home/training'); // Replace with the actual route
            return;
        }

        // File upload configuration
        $config['upload_path'] = './uploads/'; // Replace with your upload folder
        $config['allowed_types'] = 'jpg|png|pdf|docx'; // Modify as needed
        $config['max_size'] = 2048; // 2 MB
        $config['file_name'] = time() . '_' . $_FILES['fileUploads']['name'];

        $this->upload->initialize($config);

        // File upload process
        if (!$this->upload->do_upload('fileUploads')) {
            // Handle upload error
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'File upload failed: ' . $error);
            redirect('cms/home/training'); // Replace with the actual route
        } else {
            // Get uploaded file data
            $file_data = $this->upload->data();

            // Define the folder path
            $folder_path = 'uploads/'; // Replace with your actual folder path

            // Save data to database
            $data = array(
                'idBusiness'        => $hotel_id,
                'idUser'            => $this->session->userdata('idUser'),
                'kodeUploads'       => $kodeUploads,
                'nmUploads'         => $file_name,
                'categoryUploads'   => $categoryUploads,
                'departementUploads'=> $departementUploads,
                'fileUploads'       => $folder_path . $file_data['file_name'],
                'ketUploads'        => $keterangan,
                'expired_uploads'   => $expired,
                'created_at_uploads'=> date('Y-m-d H:i:s'),
            );

            if ($this->db->insert('uploads', $data)) {
                $this->session->set_flashdata('success', 'File uploaded successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to save file data to the database.');
            }

            redirect('cms/home/training'); // Replace with the actual route
        }
    }
    public function update_upload() {
        // Retrieve form inputs
        $hotel_id = $this->input->post('hotel');
        $kodeUploads = $this->input->post('training-number');
        $file_name = $this->input->post('file-name');
        $categoryUploads = $this->input->post('categoryUploads');
        $departementUploads = $this->input->post('departementUploads');
        $keterangan = $this->input->post('keterangan');
        $expired = $this->input->post('expired');

        // Check required fields
        if (empty($hotel_id) || empty($file_name)) {
            $this->session->set_flashdata('error', 'Please fill in all required fields.');
            redirect('cms/home/training'); // Replace with the actual route
            return;
        }

        // File upload configuration
        $config['upload_path'] = './uploads/'; // Replace with your upload folder
        $config['allowed_types'] = 'jpg|png|pdf|docx'; // Modify as needed
        $config['max_size'] = 2048; // 2 MB
        $config['file_name'] = time() . '_' . $_FILES['fileUploads']['name'];

        $this->upload->initialize($config);

        // File upload process
        if (!$this->upload->do_upload('fileUploads')) {
            // Handle upload error
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'File upload failed: ' . $error);
            redirect('cms/home/training'); // Replace with the actual route
        } else {
            // Get uploaded file data
            $file_data = $this->upload->data();

            // Define the folder path
            $folder_path = 'uploads/'; // Replace with your actual folder path

            // Save data to database
            $data = array(
                'idBusiness'        => $hotel_id,
                'idUser'            => $this->session->userdata('idUser'),
                'kodeUploads'       => $kodeUploads,
                'nmUploads'         => $file_name,
                'categoryUploads'   => $categoryUploads,
                'departementUploads'=> $departementUploads,
                'fileUploads'       => $folder_path . $file_data['file_name'],
                'ketUploads'        => $keterangan,
                'expired_uploads'   => $expired,
                'created_at_uploads'=> date('Y-m-d H:i:s'),
            );

            if ($this->db->insert('uploads', $data)) {
                $this->session->set_flashdata('success', 'File uploaded successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to save file data to the database.');
            }

            redirect('cms/home/training'); // Replace with the actual route
        }
    }
    public function inputGroup()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 5,
        ];
        $data["groups"] = $this->Home_m->getfile_group();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_group", $data);
        $this->load->view("cms/footer", $data);
    }
    public function update_retensi()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 14,
        ];
        $data_retensi = [
            "retensi_uploads" => $this->input->post("retensi_uploads"),
        ];
        $this->db->where("idUploads", $this->input->post("idUploads"));
        $this->db->update("uploads", $data_retensi);
        $this->session->set_flashdata("pesansukses", "Retensi telah ditambahkan");
        redirect("cms/home/training");
    }
    public function update_eleminasi()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 14,
        ];
        $data_eleminasi = [
            "eleminasi_uploads" => 1,
        ];
        $this->db->where("idUploads", $this->input->post("idUploads"));
        $this->db->update("uploads", $data_eleminasi);
        $this->session->set_flashdata("pesansukses", "eleminasi telah ditambahkan");
        redirect("cms/home/training");
    }
    public function update_category()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 14,
        ];
        $data_category = [
            "categoryUploads" => $this->input->post("categoryUploads"),
        ];
        $this->db->where("idUploads", $this->input->post("idUploads"));
        $this->db->update("uploads", $data_category);
        $this->session->set_flashdata("pesansukses", "category telah ditambahkan");
        redirect("cms/home/training");
    }
    public function insertGroupBusiness()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 14,
        ];
        $data_group = [
            "nmGroup" => $this->input->post("nmGroup"),
            "idUser" => $this->session->userdata("idUser"),
            "createdAtGroup" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("business_group", $data_group);
        $this->session->set_flashdata("pesansukses", "Group telah ditambahkan");
        redirect("cms/home");
    }
    public function viewPembayaran($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $data["idBusiness"] = $idBusiness;
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival_by_id_business(
            $idBusiness
        );
        $data[
            "bookingRoom"
        ] = $this->Kamar_m->getfile_booking_kamar_by_business_id($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_by_id_business(
            $idBusiness
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_pembayaran", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewBuktiPembayaran($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival_by_id_business(
            $idBusiness
        );
        $data[
            "bookingRoom"
        ] = $this->Kamar_m->getfile_booking_kamar_by_business_id($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_by_id_business(
            $idBusiness
        );
        $data["idBusiness"] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_pembayaran_bukti", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewKamar($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["idBusiness"] = $idBusiness;
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["kamar"] = $this->Kamar_m->getfile_kamar_by_id_business(
            $idBusiness
        );
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival_by_id_business(
            $idBusiness
        );
        $data[
            "bookingRoom"
        ] = $this->Kamar_m->getfile_booking_kamar_by_business_id($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_by_id_business(
            $idBusiness
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code($idBusiness);
        $data[
            "business"
        ] = $this->BusinessDetail_m->getFile_business_details_by_id(
            $idBusiness
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_kamar", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewdetailKamar($idBusiness, $idKamar)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 18,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["kamar"] = $this->Kamar_m->getfile_kamar_by_id_room($idKamar);
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $idBusiness
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $idBusiness
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code($idBusiness);
        $data["nomorkamar"] = $this->Kamar_m->getfile_number_kamar(
            $idKamar,
            $idBusiness
        );
        $data["totalharga"] = $this->Kamar_m->getfile_pricerate_kamar($idKamar);
        $data["nomor_edit"] = $this->Kamar_m->getfile_number_kamar_edit(
            $idKamar
        );
        $data["facilityKamar"] = $this->Kamar_m->getfile_facility_by_id(
            $data["kamar"]->ketKamar
        );
        $data["idBusiness"] = $idBusiness;
        $data["idKamarAll"] = $idKamar;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_detail_kamar", $data);
        $this->load->view("cms/footer", $data);
    }
    public function sendajaxFacilityroom()
    {
        $data["facility"] = $this->BusinessDetail_m->getfile_room_facility();
        if (!$data["facility"]) {
            $response = [
                "nmNumber" => "",
                "nmType" => "",
                "ketNumber" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["facility"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function sendajaxFnbType()
    {
        $data["facility"] = $this->BusinessDetail_m->getfile_fnb_type();
        if (!$data["facility"]) {
            $response = [
                "nmNumber" => "",
                "nmType" => "",
                "ketNumber" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["facility"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function applyFacilityKamar($idKamarAll)
    {
        $idBusiness = $this->input->post("idBusiness");
        $idKamar = $this->input->post("idKamar");
        $nmFacility = $this->input->post("nmFacility");
        $facilityIds = $this->input->post("id"); // Get the array of facility IDs
        // Explode the comma-separated string into an array
        $data = [
            "idKamar" => $this->input->post("idKamar"),
            "idBusiness" => $this->input->post("idBusiness"),
            "nmFacility" => $this->input->post("nmFacility"),
        ];

        $this->db->insert("kamar_facility", $data);
        redirect(
            "cms/home/viewdetailKamar/" . $idBusiness . "/" . $idKamarAll . "/"
        );
    }
    public function applyFacilityRoom()
    {
        $idKamar = $this->input->post("idKamar");
        $kamarFacility = $this->input->post("kamarFacility");
        $facilityIds = $this->input->post("id"); // Get the array of facility IDs
        // Explode the comma-separated string into an array
        $data = [
            "kamarFacility" => $kamarFacility,
        ];

        $this->db->where("idKamar", $idKamar);
        $this->db->update("kamar_detail", $data);
        redirect(
            "cms/home/viewkamar/" .
                $this->session->userdata("idBusiness") .
                "/" .
                $idKamar .
                "/"
        );
        // echo json_encode(array($data, $idKamar));
    }
    public function viewPackage($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];

        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["packages"] = $this->BusinessDetail_m->getFile_packages();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_package", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewVoucher($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];

        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["voucher"] = $this->BusinessDetail_m->getFile_voucher();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_voucher", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewNewsletter()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];

        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["newsletter"] = $this->BusinessDetail_m->getFile_newsletter();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_newsletter", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewNotificationCenter()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];

        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["notification"] = $this->BusinessDetail_m->getFile_notification();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_notification", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insert_voucher()
    {
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/voucher/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            $data_voucher = [
                "nmVoucher" => $this->input->post("nmVoucher"),
                "idBusiness" => $this->input->post("idBusiness"),
                "expiredVoucher" => $this->input->post("expiredVoucher"),
                "ketVoucher" => $this->input->post("ketVoucher"),
                "diskonVoucher" => str_replace(
                    ",",
                    "",
                    $this->input->post("diskonVoucher")
                ),
                "imgVoucher" => $uniqueFileName,
                "idUser" => $this->session->userdata("idUser"),
                "statusVoucher" => $this->input->post("statusVoucher"),
                "createdAtVoucher" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("voucher", $data_voucher);
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
        // echo json_encode($data_newsletter);
    }
    public function package_details($idKamar)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];

        $data["package"] = $this->BusinessDetail_m->getFile_packagesbyId(
            $idKamar
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_package_detail", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertFormKamar($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        $idBusiness = $this->input->post("idBusiness");
        $ketKamar = explode(", ", $this->input->post("ketKamar"));
        $qtyKamar = explode(", ", $this->input->post("qtyKamar"));
        $hargaROKamar = explode(
            ", ",
            intval(str_replace(",", "", $this->input->post("totalHargaRO")))
        );
        $hargaRBKamar = explode(
            ", ",
            intval(str_replace(",", "", $this->input->post("totalHargaRB")))
        );
        $soldKamar = array_fill(0, count($ketKamar), 0);
        $year = date("Y");
        $date = strtotime($year . "-01-01");
        $lastDate = strtotime($year . "-12-31");
        $data = [];
        while ($date <= $lastDate) {
            for ($i = 0; $i < count($ketKamar); $i++) {
                $data[] = [
                    "idBusiness" => $idBusiness[$i],
                    "ketKamar" => $ketKamar[$i],
                    "qtyKamar" => $qtyKamar[$i],
                    "soldKamar" => $soldKamar[$i],
                    "hargaROKamar" => $hargaROKamar[$i],
                    "hargaRBKamar" => $hargaRBKamar[$i],
                    "idUser" => $this->session->userdata("idUser"),
                    "dateKamar" => date("Y-m-d", $date),
                ];
            }
            // Increment date by one day for the next iteration
            $date = strtotime("+1 day", $date);
        }
        foreach ($data as $row) {
            $this->Kamar_m->insert_kamar($row);
        }
        // echo "Data inserted successfully.";
        $data_Kamar_detail = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $idBusiness,
            "imgKamardetail" => $this->input->post("photoPath1"),
            "img2Kamardetail" => $this->input->post("photoPath2"),
            "img3Kamardetail" => $this->input->post("photoPath3"),
            "idKamar" => $ketKamar[0],
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("kamar_detail", $data_Kamar_detail);
        $this->session->set_flashdata("pesansukses", "Kamar Berhasil dibuat");
        redirect("cms/home/viewKamar/" . $idBusiness . "/");
    }
    public function editFormKamar($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        $idBusiness = $this->input->post("idBusiness");
        $ketKamar = $this->input->post("ketKamar");
        $qtyKamar = $this->input->post("qtyKamar");
        $capKamar = $this->input->post("capKamar");
        $data = [
            "qtyKamar" => $qtyKamar,
            "capKamar" => $capKamar,
            "idUser" => $this->session->userdata("idUser"),
        ];
        $this->db->where("idBusiness", $idBusiness);
        $this->db->where("ketKamar", $ketKamar);
        $this->db->update("kamar_all", $data);
        $this->session->set_flashdata("pesansukses", "Kamar Berhasil dibuat");
        redirect("cms/home/viewKamar/" . $idBusiness . "/");
    }
    public function insertFormKamarPackage()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/package/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            $data_Kamar = [
                "idUser" => $this->session->userdata("idUser"),
                "locale" => $this->input->post("locale"),
                "nightPackage" => $this->input->post("nightPackage"),
                "eventType" => $this->input->post("eventType"),
                "ketKamar" => $this->input->post("ketKamar"),
                "startPackage" => $this->input->post("dateKamar"),
                "endPackage" => $this->input->post("dateafterKamar"),
                "nmPackage" => $this->input->post("nmPackage"),
                "ketPackage" => $this->input->post("ketPackage"),
                "durationPackage" => $this->input->post("durationPackage"),
                "durationnightPackage" => $this->input->post(
                    "durationnightPackage"
                ),
                "statusPackage" => $this->input->post("statusPackage"),
                "idBusiness" => $this->input->post("idBusiness"),
                "imgPackage" => $uniqueFileName, // Save as comma-separated string
                "createdAtKamar" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("kamar_package", $data_Kamar);
            $idKamar = $this->db->insert_id();
            $ketKamar = explode(", ", $this->input->post("ketKamar"));
            $qtyKamar = explode(", ", $this->input->post("qtyKamar"));
            $hargaROKamar = explode(
                ", ",
                intval(str_replace(",", "", $this->input->post("hargaROKamar")))
            );
            $soldKamar = array_fill(0, count($ketKamar), 0);
            $year = date("Y");
            $date = strtotime($this->input->post("dateKamar"));
            $lastDate = strtotime($this->input->post("dateafterKamar"));
            $data = [];
            while ($date <= $lastDate) {
                for ($i = 0; $i < count($ketKamar); $i++) {
                    $data[] = [
                        "idUser" => $this->session->userdata("idUser"),
                        "idKamar" => $idKamar,
                        "qtyKamar" => $qtyKamar[$i],
                        "ketKamar" => $ketKamar[$i],
                        "hargaROKamar" => $hargaROKamar[$i],
                        "hargaRBKamar" => $hargaROKamar[$i],
                        "dateKamar" => date("Y-m-d", $date),
                        "idBusiness" => $this->input->post("idBusiness"),
                        "createdAtKamar" => date("Y-m-d H:i:s"),
                    ];
                }
                // Increment date by one day for the next iteration
                $date = strtotime("+1 day", $date);
            }
            foreach ($data as $row) {
                $this->Kamar_m->insert_kamar_package($row);
                // echo json_encode($row);
            }
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
        // echo json_encode($data_newsletter);
    }
    public function updateFormKamarPackage($idKamar)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/package/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            // var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            $data_Kamar = [
                "idUser" => $this->session->userdata("idUser"),
                "ketKamar" => $this->input->post("ketKamar"),
                "nmPackage" => $this->input->post("nmPackage"),
                "ketPackage" => $this->input->post("ketPackage"),
                "startPackage" => $this->input->post("dateKamar"),
                "durationPackage" => $this->input->post("durationPackage"),
                "durationnightPackage" => $this->input->post(
                    "durationnightPackage"
                ),
                "statusPackage" => $this->input->post("statusPackage"),
                "imgPackage" => $uniqueFileName, // Save as comma-separated string
            ];
            $this->db->where("idKamar", $idKamar);
            $this->db->update("kamar_package", $data_Kamar);
            $data_Kamar_package_Inventory = [
                "hargaROKamar" => $this->input->post("hargaROKamar"),
                "hargaRBKamar" => $this->input->post("hargaROKamar"),
            ];
            $this->db->where("idKamar", $idKamar);
            $this->db->update(
                "kamar_package_inventory",
                $data_Kamar_package_Inventory
            );
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $response = [
                "response" => "error",
                "desc" => "Unsupported file type",
            ];
            // echo json_encode($response);
        }
        // echo json_encode($data_newsletter);
    }
    public function viewKaryawan()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 12,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["karyawan"] = $this->Karyawan_m->getfile_karyawan();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_karyawan", $data);
        $this->load->view("cms/footer", $data);
    }
    public function inputKaryawan()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["menu_header"] = $this->Menu_m->get_menu_headers();
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_karyawan", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertFormKaryawan()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 14,
        ];
        // konfigurasi proses upload file foto gallery
        if ($this->session->userdata("level") != "7") {
            $gbr = $this->upload->data();
            $office = $this->input->post("officeKaryawan");
            $data_Karyawan = [
                "idUser" => $this->session->userdata("idUser"),
                "idBusiness" => $this->input->post("officeKaryawan"),
                "nmKaryawan" => $this->input->post("nmKaryawan"),
                "tgllahirKaryawan" => $this->input->post("tgllahirKaryawan"),
                "idLevel" => $this->input->post("idLevel"),
                "idDep" => $this->input->post("idDep"),
                "mobileKaryawan" => $this->input->post("mobileKaryawan"),
                "emailKaryawan" => $this->input->post("emailKaryawan"),
                "officeKaryawan" => $this->input->post("officeKaryawan"),
                "imgKaryawan" => $this->input->post("photoPath"), // Save as comma-separated string
                "linkedinKaryawan" => $this->input->post("linkedinKaryawan"),
                "instagramKaryawan" => $this->input->post("instagramKaryawan"),
                "facebookKaryawan" => $this->input->post("facebookKaryawan"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("karyawan", $data_Karyawan);
            $idKaryawan = $this->db->insert_id();
            $data_user = [
                "idKaryawan" => $idKaryawan,
                "idBusiness" => $this->input->post("officeKaryawan"),
                "idLevel" => $this->input->post("idLevel"),
                "idDep" => $this->input->post("idDep"),
                "emailuser" => $this->input->post("emailKaryawan"),
                "passUser" => sha1($this->input->post("passwordKaryawan")),
                "idGroup" => $this->session->userdata("idGroup"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("user", $data_user);
            $idUser = $this->db->insert_id();
            $data_access = [];
            foreach ($this->input->post("access") as $checkbox) {
                $data = [
                    "idUser" => $idUser,
                    "menuName" => $checkbox,
                ];
                $data_access[] = $data;
            }
            $this->db->insert_batch("access", $data_access);
            $this->session->set_flashdata(
                "pesansukses",
                "Karyawan telah ditambahkan"
            );
            redirect("cms/home/inputKaryawan/");
        } else {
            $gbr = $this->upload->data();
            $office = $this->input->post("officeKaryawan");
            $data_Karyawan = [
                "idUser" => $this->session->userdata("idUser"),
                "idBusiness" => $this->input->post("officeKaryawan"),
                "nmKaryawan" => $this->input->post("nmKaryawan"),
                "tgllahirKaryawan" => $this->input->post("tgllahirKaryawan"),
                "idLevel" => $this->input->post("idLevel"),
                "idDep" => $this->input->post("idDep"),
                "mobileKaryawan" => $this->input->post("mobileKaryawan"),
                "emailKaryawan" => $this->input->post("emailKaryawan"),
                "officeKaryawan" => $this->input->post("officeKaryawan"),
                "imgKaryawan" => $this->input->post("photoPath"), // Save as comma-separated string
                "linkedinKaryawan" => $this->input->post("linkedinKaryawan"),
                "instagramKaryawan" => $this->input->post("instagramKaryawan"),
                "facebookKaryawan" => $this->input->post("facebookKaryawan"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("karyawan", $data_Karyawan);
            $idKaryawan = $this->db->insert_id();
            $data_user = [
                "idKaryawan" => $idKaryawan,
                "idBusiness" => $this->input->post("officeKaryawan"),
                "idLevel" => $this->input->post("idLevel"),
                "idDep" => $this->input->post("idDep"),
                "emailuser" => $this->input->post("emailKaryawan"),
                "passUser" => sha1($this->input->post("passwordKaryawan")),
                "idGroup" => $this->input->post("idGroup"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("user", $data_user);
            $idUser = $this->db->insert_id();
            $data_access = [];
            foreach ($this->input->post("access") as $checkbox) {
                $data = [
                    "idUser" => $idUser,
                    "menuName" => $checkbox,
                ];
                $data_access[] = $data;
            }
            $this->db->insert_batch("access", $data_access);
            $this->session->set_flashdata(
                "pesansukses",
                "Karyawan telah ditambahkan"
            );
            redirect("cms/home/inputKaryawan/");
        }
    }
    public function deleteKaryawan($idKaryawwan)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $this->db->where("idKaryawan", $idKaryawwan);
        $this->db->delete("user");
        $this->db->where("idKaryawan", $idKaryawwan);
        $this->db->delete("karyawan");
        redirect("cms/viewKaryawan");
    }
    public function editKaryawan($idKaryawan)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 33,
        ];
        $user = [];
        $this->db->from("user");
        $this->db->where("idKaryawan", $idKaryawan);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $user = $query->row();
        }
        $query->free_result();
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["getkaryawan"] = $this->Karyawan_m->getfile_karyawan_by_id(
            $idKaryawan
        );
        $data["menu_header"] = $this->Menu_m->get_menu_headers();
        $data["user_access"] = $this->Menu_m->get_akses_menu($user->idUser);
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/edit_karyawan", $data);
        $this->load->view("cms/footer", $data);
    }
    public function inputBooking()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 15,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["kamar"] = $this->Kamar_m->getfile_kamar();
        $data["kamar_member"] = $this->Kamar_m->getfile_kamar_member();
        $data["number"] = $this->Kamar_m->getfile_number(
            $this->session->userdata("idBusiness")
        );
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
            $this->session->userdata("idBusiness")
        );
        $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_booking", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertFormBooking()
    {
        if ($post = $this->input->post("submit")) {
            // rules
            $this->form_validation->set_rules(
                "arrivalBooking",
                "arrivalBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "nightBooking",
                "nightBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "departureBooking",
                "departureBooking",
                ""
            );
            $this->form_validation->set_rules(
                "memberBooking",
                "memberBooking",
                ""
            );
            $this->form_validation->set_rules(
                "statusBooking",
                "statusBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "roomtypeBooking",
                "roomtypeBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "updagradetoBooking",
                "updagradetoBooking",
                ""
            );
            $this->form_validation->set_rules(
                "blockBooking",
                "blockBooking",
                ""
            );
            $this->form_validation->set_rules(
                "feautresBooking",
                "feautresBooking",
                ""
            );
            $this->form_validation->set_rules(
                "numberroomBooking",
                "numberroomBooking",
                ""
            );
            $this->form_validation->set_rules("paxBooking", "paxBooking", "");
            $this->form_validation->set_rules(
                "childBooking",
                "childBooking",
                ""
            );
            $this->form_validation->set_rules(
                "extrabedBooking",
                "extrabedBooking",
                ""
            );
            $this->form_validation->set_rules("vipBooking", "vipBooking", "");
            $this->form_validation->set_rules(
                "arrivaltimeBooking",
                "arrivaltimeBooking",
                ""
            );
            $this->form_validation->set_rules(
                "departuretimeBooking",
                "departuretimeBooking",
                ""
            );
            $this->form_validation->set_rules(
                "firstnameBooking",
                "firstnameBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "lastnameBooking",
                "lastnameBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "genderBooking",
                "genderBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "idnumberBooking",
                "idnumberBooking",
                ""
            );
            $this->form_validation->set_rules(
                "birthdayBooking",
                "birthdayBooking",
                ""
            );
            $this->form_validation->set_rules(
                "emailBooking",
                "emailBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "mobileBooking",
                "mobileBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "addressBooking",
                "addressBooking",
                ""
            );
            $this->form_validation->set_rules(
                "companyBooking",
                "companyBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "insideallotmentBooking",
                "insideallotmentBooking",
                ""
            );
            $this->form_validation->set_rules(
                "individualbillBooking",
                "individualbillBooking",
                ""
            );
            $this->form_validation->set_rules(
                "bookercodeBooking",
                "bookercodeBooking",
                ""
            );
            $this->form_validation->set_rules(
                "bookercode1Booking",
                "bookercode1Booking",
                ""
            );
            $this->form_validation->set_rules(
                "bookercontactBooking",
                "bookercontactBooking",
                ""
            );
            $this->form_validation->set_rules(
                "bookercontact1Booking",
                "bookercontact1Booking",
                ""
            );
            $this->form_validation->set_rules(
                "bookeremailBooking",
                "bookeremailBooking",
                ""
            );
            $this->form_validation->set_rules(
                "bookermobile1Booking",
                "bookermobile1Booking",
                ""
            );
            $this->form_validation->set_rules(
                "ratecodeBooking",
                "ratecodeBooking",
                ""
            );
            $this->form_validation->set_rules(
                "totalrateBooking",
                "totalrateBooking",
                ""
            );
            $this->form_validation->set_rules("tagBooking", "tagBooking", "");
            $this->form_validation->set_rules(
                "discountBooking",
                "discountBooking",
                ""
            );
            $this->form_validation->set_rules(
                "reasonBooking",
                "reasonBooking",
                ""
            );
            $this->form_validation->set_rules(
                "rateafterdiscountBooking",
                "rateafterdiscountBooking",
                ""
            );
            $this->form_validation->set_rules(
                "splitroomonlyBooking",
                "splitroomonlyBooking",
                ""
            );
            $this->form_validation->set_rules(
                "latecheckoutchargeBooking",
                "latecheckoutchargeBooking",
                ""
            );
            $this->form_validation->set_rules(
                "commisionBooking",
                "commisionBooking",
                ""
            );
            $this->form_validation->set_rules(
                "agentBooking",
                "agentBooking",
                ""
            );
            $this->form_validation->set_rules(
                "paymentBooking",
                "paymentBooking",
                ""
            );
            $this->form_validation->set_rules(
                "currencyBooking",
                "currencyBooking",
                ""
            );
            $this->form_validation->set_rules(
                "creditcardnoBooking",
                "creditcardnoBooking",
                ""
            );
            $this->form_validation->set_rules(
                "validdatethruBooking",
                "validdatethruBooking",
                ""
            );
            $this->form_validation->set_rules(
                "creditlimitBooking",
                "creditlimitBooking",
                ""
            );
            $this->form_validation->set_rules(
                "vouchernoBooking",
                "vouchernoBooking",
                ""
            );
            $this->form_validation->set_rules(
                "salespersonBooking",
                "salespersonBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "welcomingBooking",
                "welcomingBooking",
                ""
            );
            $this->form_validation->set_rules(
                "segmentBooking",
                "segmentBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "nationalityBooking",
                "nationalityBooking",
                ""
            );
            $this->form_validation->set_rules(
                "originareaBooking",
                "originareaBooking",
                ""
            );
            $this->form_validation->set_rules(
                "destinationBooking",
                "destinationBooking",
                ""
            );
            $this->form_validation->set_rules(
                "sourceBooking",
                "sourceBooking",
                ""
            );
            $this->form_validation->set_rules(
                "honeymoonBooking",
                "honeymoonBooking",
                ""
            );
            $this->form_validation->set_rules(
                "cashbasisBooking",
                "cashbasisBooking",
                ""
            );
            $this->form_validation->set_rules(
                "transactionclosedBooking",
                "transactionclosedBooking",
                ""
            );
            $this->form_validation->set_rules(
                "noinfoBooking",
                "noinfoBooking",
                ""
            );
            $this->form_validation->set_rules(
                "blockedphoneBooking",
                "blockedphoneBooking",
                ""
            );
            $this->form_validation->set_rules(
                "flightarriveBooking",
                "flightarriveBooking",
                ""
            );
            $this->form_validation->set_rules(
                "flightdepartBooking",
                "flightdepartBooking",
                ""
            );
            $this->form_validation->set_rules(
                "billinginstructionBooking",
                "billinginstructionBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "checkinremarkBooking",
                "checkinremarkBooking",
                ""
            );
            $this->form_validation->set_rules(
                "preferenceBooking",
                "preferenceBooking",
                ""
            );
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata(
                    "pesanerror",
                    "Item dengan tanda * harap diisi"
                );
                // Validation failed, reload the form
                $data = [
                    "title" => "Madani Djourney | ONIXLABS",
                    "nopage" => 15,
                ];
                $data[
                    "new_invoice_number"
                ] = $this->Kamar_m->generate_invoice_number();
                $data["kamar"] = $this->Kamar_m->getfile_kamar();
                $data["number"] = $this->Kamar_m->getfile_number(
                    $this->session->userdata("idBusiness")
                );
                $data["company"] = $this->Company_m->getfile_company();
                $data[
                    "availableRoom"
                ] = $this->Kamar_m->getfile_available_kamar(
                    $this->session->userdata("idBusiness")
                );
                $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                    $this->session->userdata("idBusiness")
                );
                $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                    $this->session->userdata("idBusiness")
                );
                $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
                    $this->session->userdata("idBusiness")
                );
                $this->load->view("cms/header", $data);
                $this->load->view("cms/input_booking", $data);
                $this->load->view("cms/footer", $data);
            } else {
                $idKamar = $this->input->post("idKamar");
                $numberroomBooking = $this->input->post("numberroomBooking");
                $data_customer = [
                    "idUser" => $this->session->userdata("idUser"),
                    "FirstName" => $this->input->post("firstnameBooking"),
                    "LastName" => $this->input->post("lastnameBooking"),
                    "IDNumber" => $this->input->post("idnumberBooking"),
                    "Bday" => $this->input->post("birthdayBooking"),
                    "addres" => $this->input->post("addressBooking"),
                    "notel" => $this->input->post("mobileBooking"),
                    "gmail" => $this->input->post("emailBooking"),
                    "createdAt" => date("Y-m-d H:i:s"),
                ];
                $this->db->insert("Customer", $data_customer);
                $idCustomer = $this->db->insert_id();
                $departure_time = "13:00:00";
                $checkout_datetime =
                    $this->input->post("departureBooking") .
                    " " .
                    $departure_time;
                $data_booking = [
                    "idBusiness" => $this->input->post("idBusiness"),
                    "idUser" => $this->session->userdata("idUser"),
                    "idKamar" => $idKamar,
                    "checkouttimeBooking" => $checkout_datetime,
                    "RateNow" => $this->input->post("RateNow"),
                    "arrivalBooking" => $this->input->post("arrivalBooking"),
                    "nightBooking" => $this->input->post("nightBooking"),
                    "departureBooking" => $this->input->post(
                        "departureBooking"
                    ),
                    "memberBooking" => $this->input->post("memberBooking"),
                    "statusBooking" => $this->input->post("statusBooking"),
                    "roomtypeBooking" => $this->input->post("roomtypeBooking"),
                    "updagradetoBooking" => $this->input->post(
                        "updagradetoBooking"
                    ),
                    "blockBooking" => $this->input->post("blockBooking"),
                    "feautresBooking" => $this->input->post("feautresBooking"),
                    "numberroomBooking" => $numberroomBooking,
                    "roompaxBooking" => 1,
                    "paxBooking" => $this->input->post("paxBooking"),
                    "childBooking" => $this->input->post("childBooking"),
                    "extrabedBooking" => $this->input->post("extrabedBooking"),
                    "vipBooking" => $this->input->post("vipBooking"),
                    "arrivaltimeBooking" => $this->input->post(
                        "arrivaltimeBooking"
                    ),
                    "departuretimeBooking" => $this->input->post(
                        "departuretimeBooking"
                    ),
                    "firstnameBooking" => $this->input->post(
                        "firstnameBooking"
                    ),
                    "lastnameBooking" => $this->input->post("lastnameBooking"),
                    "genderBooking" => $this->input->post("genderBooking"),
                    "idnumberBooking" => $this->input->post("idnumberBooking"),
                    "birthdayBooking" => $this->input->post("birthdayBooking"),
                    "emailBooking" => $this->input->post("emailBooking"),
                    "mobileBooking" => $this->input->post("mobileBooking"),
                    "addressBooking" => $this->input->post("addressBooking"),
                    "companyBooking" => $this->input->post("companyBooking"),
                    "insideallotmentBooking" => $this->input->post(
                        "insideallotmentBooking",
                        true
                    ),
                    "individualbillBooking" => $this->input->post(
                        "individualbillBooking",
                        true
                    ),
                    "bookercodeBooking" => $this->input->post(
                        "bookercodeBooking"
                    ),
                    "bookercode1Booking" => $this->input->post(
                        "bookercode1Booking"
                    ),
                    "bookercontactBooking" => $this->input->post(
                        "bookercontactBooking"
                    ),
                    "bookercontact1Booking" => $this->input->post(
                        "bookercontact1Booking"
                    ),
                    "bookeremailBooking" => $this->input->post(
                        "bookeremailBooking"
                    ),
                    "bookermobile1Booking" => $this->input->post(
                        "bookermobile1Booking"
                    ),
                    "ratecodeBooking" => $this->input->post("ratecodeBooking"),
                    "totalrateBooking" => intval(
                        str_replace(
                            ".",
                            "",
                            $this->input->post("totalrateBooking")
                        )
                    ),
                    "tagBooking" => $this->input->post("tagBooking"),
                    "discountBooking" => $this->input->post("discountBooking"),
                    "reasonBooking" => $this->input->post("reasonBooking"),
                    "rateafterdiscountBooking" => intval(
                        str_replace(
                            ".",
                            "",
                            $this->input->post("rateafterdiscountBooking")
                        )
                    ),
                    "splitroomonlyBooking" => $this->input->post(
                        "splitroomonlyBooking",
                        true
                    ),
                    "latecheckoutchargeBooking" => $this->input->post(
                        "latecheckoutchargeBooking"
                    ),
                    "commisionBooking" => $this->input->post(
                        "commisionBooking"
                    ),
                    "agentBooking" => $this->input->post("agentBooking"),
                    "paymentBooking" => $this->input->post("paymentBooking"),
                    "currencyBooking" => $this->input->post("currencyBooking"),
                    "creditcardnoBooking" => $this->input->post(
                        "creditcardnoBooking"
                    ),
                    "validdatethruBooking" => $this->input->post(
                        "validdatethruBooking"
                    ),
                    "creditlimitBooking" => $this->input->post(
                        "creditlimitBooking"
                    ),
                    "vouchernoBooking" => $this->input->post(
                        "vouchernoBooking"
                    ),
                    "salespersonBooking" => $this->input->post(
                        "salespersonBooking"
                    ),
                    "welcomingBooking" => $this->input->post(
                        "welcomingBooking"
                    ),
                    "segmentBooking" => $this->input->post("segmentBooking"),
                    "nationalityBooking" => $this->input->post(
                        "nationalityBooking"
                    ),
                    "originareaBooking" => $this->input->post(
                        "originareaBooking"
                    ),
                    "destinationBooking" => $this->input->post(
                        "destinationBooking"
                    ),
                    "sourceBooking" => $this->input->post("sourceBooking"),
                    "honeymoonBooking" => $this->input->post(
                        "honeymoonBooking",
                        true
                    ),
                    "cashbasisBooking" => $this->input->post(
                        "cashbasisBooking",
                        true
                    ),
                    "transactionclosedBooking" => $this->input->post(
                        "transactionclosedBooking",
                        true
                    ),
                    "noinfoBooking" => $this->input->post(
                        "noinfoBooking",
                        true
                    ),
                    "blockedphoneBooking" => $this->input->post(
                        "blockedphoneBooking",
                        true
                    ),
                    "flightarriveBooking" => $this->input->post(
                        "flightarriveBooking"
                    ),
                    "flightdepartBooking" => $this->input->post(
                        "flightdepartBooking"
                    ),
                    "billinginstructionBooking" => $this->input->post(
                        "billinginstructionBooking"
                    ),
                    "checkinremarkBooking" => $this->input->post(
                        "checkinremarkBooking"
                    ),
                    "preferenceBooking" => $this->input->post(
                        "preferenceBooking"
                    ),
                    "statuspayBooking" => "UNPAID",
                    "idCustomer" => $idCustomer,
                    "createdAtBooking" => date("Y-m-d H:i:s"),
                ];
                $this->db->insert("booking", $data_booking);
                $idBooking = $this->db->insert_id();
                $data_membership = [
                    "idUser" => $this->session->userdata("idUser"),
                    "idCustomer" => $idCustomer,
                    "idBooking" => $idBooking,
                    "idBusiness" => $this->input->post("idBusiness"),
                    "idnumberBooking" => $this->input->post("idnumberBooking"),
                    "createdAtMembership" => date("Y-m-d H:i:s"),
                ];
                $this->db->insert("membership", $data_membership);
                $intervalDate = $this->input->post("intervalDate");
                // Explode the comma-separated string into an array
                $intervalDates = explode(",", $intervalDate);
                foreach ($intervalDates as $interval) {
                    $this->db->set("qtyKamar", "qtyKamar - 1", false);
                    $this->db->set("soldKamar", "soldKamar + 1", false);
                    $data_update_kamar = [
                        "idUser" => $this->session->userdata("idUser"),
                        "updateAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->where(
                        "ketKamar",
                        $this->input->post("roomtypeBooking")
                    );
                    $this->db->where("dateKamar", $interval);
                    $this->db->update("kamar_all", $data_update_kamar);
                }
                if ($numberroomBooking != "") {
                    $data_update_nomor_kamar = [
                        "idUser" => $this->session->userdata("idUser"),
                        "ketNumber" => "VR",
                        "updateAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->where(
                        "nmNumber",
                        $this->input->post("numberroomBooking")
                    );
                    $this->db->update("kamar_number", $data_update_nomor_kamar);
                }
                $this->session->set_flashdata(
                    "pesansukses",
                    "Booking telah ditambahkan No. Room"
                );
                redirect(
                    "cms/home/inputBooking/" .
                        $this->session->userdata("idBusiness") .
                        "/"
                );
            }
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata("pesanerror", "Gagal insert booking");
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 15,
            ];
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data["kamar"] = $this->Kamar_m->getfile_kamar();
            $data["number"] = $this->Kamar_m->getfile_number(
                $this->session->userdata("idBusiness")
            );
            $data["company"] = $this->Company_m->getfile_company();
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
                $this->session->userdata("idBusiness")
            );
            $this->load->view("cms/header", $data);
            $this->load->view("cms/input_booking", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function viewCard()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 17,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_card", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertNumberKamar($idBusiness, $idKamarAll)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 27,
        ];
        $insertNomor = $this->input->post("nmNumber");
        $idKamar = $this->input->post("idKamar");
        $dataNumber = [];
        $this->db->from("kamar_number");
        $this->db->where("idKamar", $idKamar);
        $this->db->where("nmNumber", $insertNomor);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $dataNumber = $query->row();
        }
        $query->free_result();
        if ($dataNumber) {
            $this->session->set_flashdata(
                "pesanerror",
                "Nomor Kamar telah terdaftar"
            );
            redirect(
                "cms/home/viewdetailKamar/" .
                    $idBusiness .
                    "/" .
                    $idKamarAll .
                    "/"
            );
        } else {
            // The value doesn't exist, perform the insert.
            $data_number_kamar = [
                "idUser" => $this->session->userdata("idUser"),
                "nmNumber" => $insertNomor,
                "ketNumber" => $this->input->post("ketNumber"),
                "idBusiness" => $idBusiness,
                "idKamar" => $idKamar,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("kamar_number", $data_number_kamar);
            $data_update_hk_room_attendant = [
                "idUser" => $this->session->userdata("idUser"),
                "idBusiness" => $this->session->userdata("idBusiness"),
                "roomAttendant" => $insertNomor,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert(
                "hk_room_attendant",
                $data_update_hk_room_attendant
            );
            echo json_encode(
                ["message" => "Nomor Kamar telah ditambahkan"],
                JSON_NUMERIC_CHECK
            );
            $this->session->set_flashdata(
                "pesansukses",
                "Nomor Kamar telah ditambahkan"
            );
            redirect(
                "cms/home/viewdetailKamar/" .
                    $idBusiness .
                    "/" .
                    $idKamarAll .
                    "/"
            );
        }
    }
    public function insertFormCustomer()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 19,
        ];
        $data_customer = [
            "idUser" => $this->session->userdata("idUser"),
            "FirstName" => $this->input->post("firstnameBooking"),
            "LastName" => $this->input->post("lastnameBooking"),
            "IDNumber" => $this->input->post("idnumberBooking"),
            "Bday" => $this->input->post("birthdayBooking"),
            "addres" => $this->input->post("addressBooking"),
            "notel" => $this->input->post("mobileBooking"),
            "gmail" => $this->input->post("emailBooking"),
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("Customer", $data_customer);
        $this->session->set_flashdata(
            "pesansukses",
            "Customer Berhasil dibuat"
        );
        redirect("cms/home/inputBooking");
    }
    public function ajaxCustomer($idnumber)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 20,
        ];
        $data["customer"] = $this->Customer_m->checkIdNumber($idnumber);
        if (!$data["customer"]) {
            $response = [
                "FirstName" => "",
                "LastName" => "",
                "gmail" => "",
                "Bday" => "",
                "addres" => "",
                "notel" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = [
                "idnumberBooking" => $data["customer"]->idnumberBooking,
                "FirstName" => $data["customer"]->FirstName,
                "LastName" => $data["customer"]->LastName,
                "gmail" => $data["customer"]->gmail,
                "Bday" => $data["customer"]->Bday,
                "addres" => $data["customer"]->addres,
                "notel" => $data["customer"]->notel,
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxRoomType()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 21,
        ];
        $ketKamar = $this->input->post("ketKamar");
        $data["kamar"] = $this->Kamar_m->getfile_kamar_by_id($ketKamar);
        if (!$data["kamar"]) {
            $response = [
                "ketkamar" => "",
                "totalHarga" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = [
                "ketKamar" => $data["kamar"]->ketKamar,
                "hargaROKamar" => $data["kamar"]->hargaROKamar,
                "hargaRBKamar" => $data["kamar"]->hargaRBKamar,
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxCompany()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 22,
        ];
        $company = $this->input->post("nmCompany");
        $data["company"] = $this->Company_m->getfile_company_by_id($company);
        if (!$data["company"]) {
            $response = [];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["company"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxRatecode()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 23,
        ];
        $ketKamar = $this->input->post("ketKamar");
        $data["ratecode"] = $this->Kamar_m->getfile_ratecode_by_id($ketKamar);
        if (!$data["ratecode"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["ratecode"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxNumberkamar()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 24,
        ];
        $arrival = $this->input->post("arrival");
        $departure = $this->input->post("departure");
        $ketKamar = $this->input->post("ketKamar");
        $datanumber = $this->Kamar_m->get_available_room_numbers(
            $ketKamar,
            $arrival,
            $departure
        );
        if (!$datanumber) {
            $response = [
                "nmNumber" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            echo json_encode($datanumber, JSON_NUMERIC_CHECK);
        }
    }
    public function viewLinenInventory()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 25,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "lineninventory"
        ] = $this->Housekeeping_m->getfile_linen_inventory();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_linen_inventory", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewBooking($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 26,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["booking"] = $this->Booking_m->getfile_booking($idBusiness);
        $data[
            "booking_reservation"
        ] = $this->Booking_m->getfile_booking_reservation($idBusiness);
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $idBusiness
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $idBusiness
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_booking", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewBookingDetail($idBooking)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 26,
        ];
        $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
            $idBooking
        );
        $data["getidBooking"] = $idBooking;
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["kamar"] = $this->Kamar_m->getfile_kamar();
        $data["number"] = $this->Kamar_m->getfile_number(
            $this->session->userdata("idBusiness")
        );
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
            $this->session->userdata("idBusiness")
        );
        $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_booking_detail", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewRoomAttendant($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 28,
        ];
        $data[
            "roomattendant_all"
        ] = $this->Housekeeping_m->getfile_roomattendant_all($idBusiness);
        $data[
            "roomattendant_or"
        ] = $this->Housekeeping_m->getfile_roomattendant_or($idBusiness);
        $data[
            "roomattendant_od"
        ] = $this->Housekeeping_m->getfile_roomattendant_od($idBusiness);
        $data[
            "roomattendant_oc"
        ] = $this->Housekeeping_m->getfile_roomattendant_oc($idBusiness);
        $data[
            "roomattendant_ed"
        ] = $this->Housekeeping_m->getfile_roomattendant_ed($idBusiness);
        $data[
            "roomattendant_vd"
        ] = $this->Housekeeping_m->getfile_roomattendant_vd($idBusiness);
        $data[
            "roomattendant_vc"
        ] = $this->Housekeeping_m->getfile_roomattendant_vc($idBusiness);
        $data[
            "roomattendant_vr"
        ] = $this->Housekeeping_m->getfile_roomattendant_vr($idBusiness);
        $data[
            "roomattendant_oo"
        ] = $this->Housekeeping_m->getfile_roomattendant_oo($idBusiness);
        $data[
            "taskAttendant"
        ] = $this->Housekeeping_m->get_task_attendant_with_detail_by_businessId_and_today($idBusiness);
        $data["taskTypes"] = $this->Housekeeping_m->get_task_type($idBusiness);
        $data[
            "checkoutRoomNumber"
        ] = $this->Booking_m->get_h_checkout_today_group_nmNumber($idBusiness);
        $data[
            "checkinRoomNumber"
        ] = $this->Booking_m->get_h_checkin_today_group_nmNumber($idBusiness);
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar($idBusiness);
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_roomattendant", $data);
        $this->load->view("cms/footer", $data);
    }
    public function inputRoomAttendant()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 28,
        ];
        $data[
            "roomattendant_all"
        ] = $this->Housekeeping_m->getfile_roomattendant_all(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_or"
        ] = $this->Housekeeping_m->getfile_roomattendant_or(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_od"
        ] = $this->Housekeeping_m->getfile_roomattendant_od(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_oc"
        ] = $this->Housekeeping_m->getfile_roomattendant_oc(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_ed"
        ] = $this->Housekeeping_m->getfile_roomattendant_ed(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_vd"
        ] = $this->Housekeeping_m->getfile_roomattendant_vd(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_vc"
        ] = $this->Housekeeping_m->getfile_roomattendant_vc(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_vr"
        ] = $this->Housekeeping_m->getfile_roomattendant_vr(
            $this->session->userdata("idBusiness")
        );
        $data[
            "roomattendant_oo"
        ] = $this->Housekeeping_m->getfile_roomattendant_oo(
            $this->session->userdata("idBusiness")
        );
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_roomattendant", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateRoomAttendant($nmNumber)
    {
        $data_update_nomor_kamar = [
            "idUser" => $this->session->userdata("idUser"),
            "ketNumber" => $this->input->post("ketNumber"),
            "updateAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("nmNumber", $nmNumber);
        $this->db->update("kamar_number", $data_update_nomor_kamar);
        $this->session->set_flashdata("pesansukses", "Status telah disimpan");
        redirect("cms/home/viewRoomAttendant/");
    }
    public function viewBookingInvoice($idBooking, $idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 29,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
            $idBooking
        );
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $idBusiness
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $idBusiness
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
        $data["user"] = $this->Home_m->getfile_user_by_tokenpushnotification(
            $idBooking
        );
        $data["idBusiness"] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_invoice_booking", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateStatusBooking()
    {
        $idBusiness = $this->input->post("idBusiness");
        $rateNow = $this->input->post("RateNow");
        $idBooking = $this->input->post("idBooking");
        $idCustomer = $this->input->post("idCustomer");
        if ($rateNow >= 0 && $rateNow < 20) {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            $additionalBooking = number_format(
                $bookingdetail->numberroomBooking
            );
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $extensi1 = explode(".", $_FILES["imgInvoice"]["name"]);
            $config1["upload_path"] = "./assets/images/invoice/";
            $config1["allowed_types"] = "jpg|png|jpeg|pdf";
            $config1["max_size"] = 4048000;
            $this->upload->initialize($config1);
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0.17;
            $data_invoice = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "priceInvoice" => intval(
                    str_replace(",", "", $this->input->post("priceInvoice"))
                ),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $data_update_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        } elseif ($rateNow > 21 && $rateNow < 40) {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            $additionalBooking = number_format(
                $bookingdetail->numberroomBooking
            );
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $extensi1 = explode(".", $_FILES["imgInvoice"]["name"]);
            $config1["upload_path"] = "./assets/images/invoice/";
            $config1["allowed_types"] = "jpg|png|jpeg|pdf";
            $config1["max_size"] = 4048000;
            $this->upload->initialize($config1);
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $data_invoice = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "priceInvoice" => intval(
                    str_replace(",", "", $this->input->post("priceInvoice"))
                ),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $data_update_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0.15;
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        } elseif ($rateNow > 41 && $rateNow < 100) {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            $additionalBooking = number_format(
                $bookingdetail->numberroomBooking
            );
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $data_invoice = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "priceInvoice" => intval(
                    str_replace(",", "", $this->input->post("priceInvoice"))
                ),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $data_update_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0.12;
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        } else {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            $additionalBooking = number_format(
                $bookingdetail->numberroomBooking
            );
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $data_invoice = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "priceInvoice" => intval(
                    str_replace(",", "", $this->input->post("priceInvoice"))
                ),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $data_update_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0;
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        }
    }
    public function updateStatusBookingADP()
    {
        $idBusiness = $this->input->post("idBusiness");
        $rateNow = $this->input->post("RateNow");
        $idBooking = $this->input->post("idBooking");
        $idCustomer = $this->input->post("idCustomer");
        $idUser = $this->input->post("idUser");
        $emailBooking = $this->input->post("emailBooking");
        $firstnameBooking = $this->input->post("firstnameBooking");
        $lastnameBooking = $this->input->post("lastnameBooking");
        $createdAtBooking = $this->input->post("createdAtBooking");
        $arrivalBooking = $this->input->post("arrivalBooking");
        $departureBooking = $this->input->post("departureBooking");
        $roomtypeBooking = $this->input->post("roomtypeBooking");
        $roompaxBooking = $this->input->post("roompaxBooking");
        $paxBooking = $this->input->post("paxBooking");
        $childBooking = $this->input->post("childBooking");
        $extrabedBooking = $this->input->post("extrabedBooking");
        $invoiceBooking = $this->input->post("invoiceBooking");
        $rateafterdiscountBooking = $this->input->post(
            "rateafterdiscountBooking"
        );
        $hotelName = $this->session->userdata("business");
        if ($rateNow >= 0 && $rateNow < 20) {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            // $additionalBooking = number_format($bookingdetail->numberroomBooking);
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $extensi1 = explode(".", $_FILES["imgInvoice"]["name"]);
            $config1["upload_path"] = "./assets/images/invoice/";
            $config1["allowed_types"] = "jpg|png|jpeg|pdf";
            $config1["max_size"] = 4048000;
            $this->upload->initialize($config1);
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0.17;
            $data_invoice = [
                "idUser" => $idUser,
                "idBooking" => $idBooking,
                "priceInvoice" => $this->input->post("priceInvoice"),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $idInvoice = $this->db->insert_id();
            $data_update_booking = [
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            // ADP SECTION
            $current_investment = 0;
            $get_totalInvestment = $this->Home_m->getfile_total_investment_ota();
            $priceInvoice = $this->input->post("priceInvoice");
            $statuspayBooking = $this->input->post("statuspayBooking");
            $business = $this->session->userdata("business");
            $current_investment = $get_totalInvestment - $priceInvoice;
            $data_invoice = [
                "adpInvoice" => 1,
            ];
            $this->db->where("idInvoice", $idInvoice);
            $this->db->update("invoice", $data_invoice);
            // AFTER SEND TO ADP
            $investments = $this->Home_m->getfile_investment_onOTA();
            // Update the last row with 'on' status to 'expired'
            $lastInvestment = end($investments);
            $data_investment_expired = [
                "idInvoice" => $idInvoice,
                "statusInvestment" => "expired",
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idInvestment", $lastInvestment->idInvestment);
            $this->db->update("investment", $data_investment_expired);
            echo json_encode([
                "lastInvestment" => $lastInvestment->idInvestment,
            ]);
            // Calculate the sum of totalInvestment values
            $totalInvestmentSum = 0;
            $totalagreementInvest = 0;
            foreach ($investments as $investment) {
                $totalInvestmentSum += $investment->totalInvestment;
                $totalagreementInvest = $investment->agreementInvestment;
            }
            $feeInvestment =
                ($this->input->post("priceInvoice") *
                    $this->session->userdata("fee")) /
                100;
            $grossInvestment = $totalagreementInvest + $feeInvestment;
            $marginInvestment = $priceInvoice - $grossInvestment;
            $percentBase =
                $this->input->post("priceInvoice") / $marginInvestment;
            $percmarginInvestment = $percentBase * 10;
            $percentInvestment = $this->session->userdata("fee");
            // Format the percentage value
            $formatted_percent = number_format($percmarginInvestment, 2); // Rounds to 2 decimal places and adds '%' symbol
            // echo json_encode(array("invoice" => $priceInvoice, "agreement" => $totalagreementInvest, "fee" => $feeInvestment, "gross" => $grossInvestment, "margin" => $marginInvestment, "percent" => $formatted_percent));
            $data_investment_add = [
                "nmSegment" => "OTA-WEB",
                "idBusiness" => $idBusiness,
                "idInvoice" => $idInvoice,
                "dateInvestment" => date("Y-m-d"),
                "agreementInvestment" => $totalagreementInvest,
                "kreditInvestment" => $this->input->post("priceInvoice"),
                "totalInvestment" => $current_investment,
                "statusInvestment" => "on",
                "ketInvestment" => "CONFIRMED INVOICE " . $idInvoice,
                "feeInvestment" => $feeInvestment,
                "percentInvestment" => $this->session->userdata("fee"),
                "grossInvestment" => $grossInvestment,
                "marginInvestment" => $marginInvestment,
                "percmarginInvestment" => $formatted_percent,
                "idUser" => $this->session->userdata("idUser"),
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("investment", $data_investment_add);
            // ADP SECTION
            // PDF GENERATOR RESERVATION SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Invoice Sahira Hotels Group");
            $pdf->SetSubject("Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Invoice, Reservation, PDF");
            // Add a page
            $pdf->AddPage();
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 100px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>official@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR RESERVATION SECTION
            // EMAIL RESERVATION SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($emailBooking);
            $this->email->bcc($this->session->userdata("ReservationBusiness"));
            $this->email->subject(
                "Confirmation of Your Hotel Room Booking at " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>Dear $firstnameBooking,</h4>";
            $isi_email .= "<br>";
            $isi_email .= "<p>We are pleased to inform you that your hotel room booking has been successfully received. Thank you for choosing $hotelName for your stay.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Booking Details:</p>";
            $isi_email .= "<p>Name of the Guest: $firstnameBooking $lastnameBooking</p>";
            $isi_email .= "<p>Check-in Date: $arrivalBooking</p>";
            $isi_email .= "<p>Check-out Date: $departureBooking</p>";
            $isi_email .= "<p>Room Type: $roomtypeBooking</p>";
            $isi_email .= "<p>Number of Guests: $paxBooking</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>We will promptly process your booking and send an official confirmation along with further details via email shortly.</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>If you have any questions or specific requests, feel free to contact us at +62-877-90400-030 or info@sahirahotelsgroup.com.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Thank you for your choice, and we look forward to welcoming you at $hotelName!</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Warm Regards,</p>";
            $isi_email .= "<p>Hotel Reservation Team</p>";
            $isi_email .= "<p>$hotelName</p>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL RESERVATION SECTION
            // PDF GENERATOR FINANCE SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Finance Invoice Sahira Hotels Group");
            $pdf->SetSubject("Finance Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Finance, Invoice, Reservation, PDF");
            // // Add a page
            $pdf->AddPage();
            // $business = 'The Sahira Hotel';
            // $statuspayBooking = 'PAID';
            // $invoiceBooking = 'INV00001';
            // $firstnameBooking = 'LOREM';
            // $lastnameBooking = 'IPSUM';
            // $arrivalBooking = '2024-01-20';
            // $departureBooking = '2024-01-21';
            // $createdAtBooking = '2024-01-19 12:04:21';
            // $roompaxBooking = '1';
            // $roomtypeBooking = 'Deluxe Single Bed';
            // $paxBooking = '1';
            // $childBooking = '1';
            // $extrabedBooking = '1';
            // $priceInvoice = '850000';
            // $rateafterdiscountBooking = '850000';
            // $totalagreementInvest = '370000';
            // $percentInvestment = '25';
            // $feeInvestment = '212500';
            // $grossInvestment = '582500';
            // $marginInvestment = '267500';
            // $formatted_percent = '31.78';
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 200px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">ADP INFORMATION :<br>' .
                $business .
                '</th><th style="border: 0.5px solid #212121; padding: 8px;font-size: 12px;">Total Agreement Investment<br>IDR ' .
                $totalagreementInvest .
                "</th><th></th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Fee OTA<br>$percentInvestment%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Fee OTA<br>IDR $feeInvestment</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Income from OTA<br>IDR $grossInvestment</td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Hotel<br>$formatted_percent%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Margin Hotel<br>IDR $marginInvestment</td><td></td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>info@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Salam Djourney, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR FINANCE SECTION
            // EMAIL FINANCE SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($this->session->userdata("CABusiness"));
            $this->email->cc($this->session->userdata("ARBusiness"));
            $this->email->subject(
                "Payment From Sahira Hotels Group - " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>This is recap for Hotel Finance.</h4>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL FINANCE SECTION
            // NOTIFICATION SECTION
            $data_notification = [
                "idBusiness" => $idBusiness,
                "typeNotification" => "Reservation Payment",
                "nmNotification" => "Payment PAID - " . $invoiceBooking,
                "descNotification" =>
                    $roomtypeBooking .
                    " - IDR " .
                    number_format($rateafterdiscountBooking),
                "idBooking" => $idBooking,
                "idUser" => $idUser,
                "createdAtNotification" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("notification", $data_notification);
            // NOTIFICATION SECTION
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        } elseif ($rateNow > 21 && $rateNow < 40) {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            // $additionalBooking = number_format($bookingdetail->numberroomBooking);
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $extensi1 = explode(".", $_FILES["imgInvoice"]["name"]);
            $config1["upload_path"] = "./assets/images/invoice/";
            $config1["allowed_types"] = "jpg|png|jpeg|pdf";
            $config1["max_size"] = 4048000;
            $this->upload->initialize($config1);
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $data_invoice = [
                "idUser" => $idUser,
                "idBooking" => $idBooking,
                "priceInvoice" => $this->input->post("priceInvoice"),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $idInvoice = $this->db->insert_id();
            $data_update_booking = [
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0.15;
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            // ADP SECTION
            $current_investment = 0;
            $get_totalInvestment = $this->Home_m->getfile_total_investment_ota();
            $priceInvoice = $this->input->post("priceInvoice");
            $statuspayBooking = $this->input->post("statuspayBooking");
            $business = $this->session->userdata("business");
            $current_investment = $get_totalInvestment - $priceInvoice;
            $data_invoice = [
                "adpInvoice" => 1,
            ];
            $this->db->where("idInvoice", $idInvoice);
            $this->db->update("invoice", $data_invoice);
            // AFTER SEND TO ADP
            $investments = $this->Home_m->getfile_investment_onOTA();
            // Update the last row with 'on' status to 'expired'
            $lastInvestment = end($investments);
            $data_investment_expired = [
                "idInvoice" => $idInvoice,
                "statusInvestment" => "expired",
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idInvestment", $lastInvestment->idInvestment);
            $this->db->update("investment", $data_investment_expired);
            echo json_encode([
                "lastInvestment" => $lastInvestment->idInvestment,
            ]);
            // Calculate the sum of totalInvestment values
            $totalInvestmentSum = 0;
            $totalagreementInvest = 0;
            foreach ($investments as $investment) {
                $totalInvestmentSum += $investment->totalInvestment;
                $totalagreementInvest = $investment->agreementInvestment;
            }
            $feeInvestment =
                ($this->input->post("priceInvoice") *
                    $this->session->userdata("fee")) /
                100;
            $grossInvestment = $totalagreementInvest + $feeInvestment;
            $marginInvestment = $priceInvoice - $grossInvestment;
            $percentBase =
                $this->input->post("priceInvoice") / $marginInvestment;
            $percmarginInvestment = $percentBase * 10;
            $percentInvestment = $this->session->userdata("fee");
            // Format the percentage value
            $formatted_percent = number_format($percmarginInvestment, 2); // Rounds to 2 decimal places and adds '%' symbol
            // echo json_encode(array("invoice" => $priceInvoice, "agreement" => $totalagreementInvest, "fee" => $feeInvestment, "gross" => $grossInvestment, "margin" => $marginInvestment, "percent" => $formatted_percent));
            $data_investment_add = [
                "nmSegment" => "OTA-WEB",
                "idBusiness" => $idBusiness,
                "idInvoice" => $idInvoice,
                "dateInvestment" => date("Y-m-d"),
                "agreementInvestment" => $totalagreementInvest,
                "kreditInvestment" => $this->input->post("priceInvoice"),
                "totalInvestment" => $current_investment,
                "statusInvestment" => "on",
                "ketInvestment" => "CONFIRMED INVOICE " . $idInvoice,
                "feeInvestment" => $feeInvestment,
                "percentInvestment" => $this->session->userdata("fee"),
                "grossInvestment" => $grossInvestment,
                "marginInvestment" => $marginInvestment,
                "percmarginInvestment" => $formatted_percent,
                "idUser" => $this->session->userdata("idUser"),
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("investment", $data_investment_add);
            // ADP SECTION
            // PDF GENERATOR RESERVATION SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Invoice Sahira Hotels Group");
            $pdf->SetSubject("Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Invoice, Reservation, PDF");
            // Add a page
            $pdf->AddPage();
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 100px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>official@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR RESERVATION SECTION
            // EMAIL RESERVATION SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($emailBooking);
            $this->email->bcc($this->session->userdata("ReservationBusiness"));
            $this->email->subject(
                "Confirmation of Your Hotel Room Booking at " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>Dear $firstnameBooking,</h4>";
            $isi_email .= "<br>";
            $isi_email .= "<p>We are pleased to inform you that your hotel room booking has been successfully received. Thank you for choosing $hotelName for your stay.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Booking Details:</p>";
            $isi_email .= "<p>Name of the Guest: $firstnameBooking $lastnameBooking</p>";
            $isi_email .= "<p>Check-in Date: $arrivalBooking</p>";
            $isi_email .= "<p>Check-out Date: $departureBooking</p>";
            $isi_email .= "<p>Room Type: $roomtypeBooking</p>";
            $isi_email .= "<p>Number of Guests: $paxBooking</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>We will promptly process your booking and send an official confirmation along with further details via email shortly.</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>If you have any questions or specific requests, feel free to contact us at +62-877-90400-030 or info@sahirahotelsgroup.com.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Thank you for your choice, and we look forward to welcoming you at $hotelName!</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Warm Regards,</p>";
            $isi_email .= "<p>Hotel Reservation Team</p>";
            $isi_email .= "<p>$hotelName</p>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL RESERVATION SECTION
            // PDF GENERATOR FINANCE SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Finance Invoice Sahira Hotels Group");
            $pdf->SetSubject("Finance Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Finance, Invoice, Reservation, PDF");
            // // Add a page
            $pdf->AddPage();
            // $business = 'The Sahira Hotel';
            // $statuspayBooking = 'PAID';
            // $invoiceBooking = 'INV00001';
            // $firstnameBooking = 'LOREM';
            // $lastnameBooking = 'IPSUM';
            // $arrivalBooking = '2024-01-20';
            // $departureBooking = '2024-01-21';
            // $createdAtBooking = '2024-01-19 12:04:21';
            // $roompaxBooking = '1';
            // $roomtypeBooking = 'Deluxe Single Bed';
            // $paxBooking = '1';
            // $childBooking = '1';
            // $extrabedBooking = '1';
            // $priceInvoice = '850000';
            // $rateafterdiscountBooking = '850000';
            // $totalagreementInvest = '370000';
            // $percentInvestment = '25';
            // $feeInvestment = '212500';
            // $grossInvestment = '582500';
            // $marginInvestment = '267500';
            // $formatted_percent = '31.78';
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 200px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">ADP INFORMATION :<br>' .
                $business .
                '</th><th style="border: 0.5px solid #212121; padding: 8px;font-size: 12px;">Total Agreement Investment<br>IDR ' .
                $totalagreementInvest .
                "</th><th></th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Fee OTA<br>$percentInvestment%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Fee OTA<br>IDR $feeInvestment</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Income from OTA<br>IDR $grossInvestment</td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Hotel<br>$formatted_percent%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Margin Hotel<br>IDR $marginInvestment</td><td></td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>info@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Salam Djourney, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR FINANCE SECTION
            // EMAIL FINANCE SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($this->session->userdata("CABusiness"));
            $this->email->cc($this->session->userdata("ARBusiness"));
            $this->email->subject(
                "Payment From Sahira Hotels Group - " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>This is recap for Hotel Finance.</h4>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL FINANCE SECTION
            // NOTIFICATION SECTION
            $data_notification = [
                "idBusiness" => $idBusiness,
                "typeNotification" => "Reservation Payment",
                "nmNotification" => "Payment PAID - " . $invoiceBooking,
                "descNotification" =>
                    $roomtypeBooking .
                    " - IDR " .
                    number_format($rateafterdiscountBooking),
                "idBooking" => $idBooking,
                "idUser" => $idUser,
                "createdAtNotification" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("notification", $data_notification);
            // NOTIFICATION SECTION
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        } elseif ($rateNow > 41 && $rateNow < 100) {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            // $additionalBooking = number_format($bookingdetail->numberroomBooking);
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $data_invoice = [
                "idUser" => $idUser,
                "idBooking" => $idBooking,
                "priceInvoice" => $this->input->post("priceInvoice"),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $idInvoice = $this->db->insert_id();
            $data_update_booking = [
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0.12;
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            // ADP SECTION
            $current_investment = 0;
            $get_totalInvestment = $this->Home_m->getfile_total_investment_ota();
            $priceInvoice = $this->input->post("priceInvoice");
            $statuspayBooking = $this->input->post("statuspayBooking");
            $business = $this->session->userdata("business");
            $current_investment = $get_totalInvestment - $priceInvoice;
            $data_invoice = [
                "adpInvoice" => 1,
            ];
            $this->db->where("idInvoice", $idInvoice);
            $this->db->update("invoice", $data_invoice);
            // AFTER SEND TO ADP
            $investments = $this->Home_m->getfile_investment_onOTA();
            // Update the last row with 'on' status to 'expired'
            $lastInvestment = end($investments);
            $data_investment_expired = [
                "idInvoice" => $idInvoice,
                "statusInvestment" => "expired",
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idInvestment", $lastInvestment->idInvestment);
            $this->db->update("investment", $data_investment_expired);
            echo json_encode([
                "lastInvestment" => $lastInvestment->idInvestment,
            ]);
            // Calculate the sum of totalInvestment values
            $totalInvestmentSum = 0;
            $totalagreementInvest = 0;
            foreach ($investments as $investment) {
                $totalInvestmentSum += $investment->totalInvestment;
                $totalagreementInvest = $investment->agreementInvestment;
            }
            $feeInvestment =
                ($this->input->post("priceInvoice") *
                    $this->session->userdata("fee")) /
                100;
            $grossInvestment = $totalagreementInvest + $feeInvestment;
            $marginInvestment = $priceInvoice - $grossInvestment;
            $percentBase =
                $this->input->post("priceInvoice") / $marginInvestment;
            $percmarginInvestment = $percentBase * 10;
            $percentInvestment = $this->session->userdata("fee");
            // Format the percentage value
            $formatted_percent = number_format($percmarginInvestment, 2); // Rounds to 2 decimal places and adds '%' symbol
            // echo json_encode(array("invoice" => $priceInvoice, "agreement" => $totalagreementInvest, "fee" => $feeInvestment, "gross" => $grossInvestment, "margin" => $marginInvestment, "percent" => $formatted_percent));
            $data_investment_add = [
                "nmSegment" => "OTA-WEB",
                "idBusiness" => $idBusiness,
                "idInvoice" => $idInvoice,
                "dateInvestment" => date("Y-m-d"),
                "agreementInvestment" => $totalagreementInvest,
                "kreditInvestment" => $this->input->post("priceInvoice"),
                "totalInvestment" => $current_investment,
                "statusInvestment" => "on",
                "ketInvestment" => "CONFIRMED INVOICE " . $idInvoice,
                "feeInvestment" => $feeInvestment,
                "percentInvestment" => $this->session->userdata("fee"),
                "grossInvestment" => $grossInvestment,
                "marginInvestment" => $marginInvestment,
                "percmarginInvestment" => $formatted_percent,
                "idUser" => $this->session->userdata("idUser"),
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("investment", $data_investment_add);
            // ADP SECTION
            // PDF GENERATOR RESERVATION SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Invoice Sahira Hotels Group");
            $pdf->SetSubject("Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Invoice, Reservation, PDF");
            // Add a page
            $pdf->AddPage();
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 100px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>official@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR RESERVATION SECTION
            // EMAIL RESERVATION SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($emailBooking);
            $this->email->bcc($this->session->userdata("ReservationBusiness"));
            $this->email->subject(
                "Confirmation of Your Hotel Room Booking at " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>Dear $firstnameBooking,</h4>";
            $isi_email .= "<br>";
            $isi_email .= "<p>We are pleased to inform you that your hotel room booking has been successfully received. Thank you for choosing $hotelName for your stay.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Booking Details:</p>";
            $isi_email .= "<p>Name of the Guest: $firstnameBooking $lastnameBooking</p>";
            $isi_email .= "<p>Check-in Date: $arrivalBooking</p>";
            $isi_email .= "<p>Check-out Date: $departureBooking</p>";
            $isi_email .= "<p>Room Type: $roomtypeBooking</p>";
            $isi_email .= "<p>Number of Guests: $paxBooking</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>We will promptly process your booking and send an official confirmation along with further details via email shortly.</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>If you have any questions or specific requests, feel free to contact us at +62-877-90400-030 or info@sahirahotelsgroup.com.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Thank you for your choice, and we look forward to welcoming you at $hotelName!</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Warm Regards,</p>";
            $isi_email .= "<p>Hotel Reservation Team</p>";
            $isi_email .= "<p>$hotelName</p>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL RESERVATION SECTION
            // PDF GENERATOR FINANCE SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Finance Invoice Sahira Hotels Group");
            $pdf->SetSubject("Finance Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Finance, Invoice, Reservation, PDF");
            // // Add a page
            $pdf->AddPage();
            // $business = 'The Sahira Hotel';
            // $statuspayBooking = 'PAID';
            // $invoiceBooking = 'INV00001';
            // $firstnameBooking = 'LOREM';
            // $lastnameBooking = 'IPSUM';
            // $arrivalBooking = '2024-01-20';
            // $departureBooking = '2024-01-21';
            // $createdAtBooking = '2024-01-19 12:04:21';
            // $roompaxBooking = '1';
            // $roomtypeBooking = 'Deluxe Single Bed';
            // $paxBooking = '1';
            // $childBooking = '1';
            // $extrabedBooking = '1';
            // $priceInvoice = '850000';
            // $rateafterdiscountBooking = '850000';
            // $totalagreementInvest = '370000';
            // $percentInvestment = '25';
            // $feeInvestment = '212500';
            // $grossInvestment = '582500';
            // $marginInvestment = '267500';
            // $formatted_percent = '31.78';
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 200px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">ADP INFORMATION :<br>' .
                $business .
                '</th><th style="border: 0.5px solid #212121; padding: 8px;font-size: 12px;">Total Agreement Investment<br>IDR ' .
                $totalagreementInvest .
                "</th><th></th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Fee OTA<br>$percentInvestment%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Fee OTA<br>IDR $feeInvestment</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Income from OTA<br>IDR $grossInvestment</td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Hotel<br>$formatted_percent%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Margin Hotel<br>IDR $marginInvestment</td><td></td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>info@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Salam Djourney, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR FINANCE SECTION
            // EMAIL FINANCE SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($this->session->userdata("CABusiness"));
            $this->email->cc($this->session->userdata("ARBusiness"));
            $this->email->subject(
                "Payment From Sahira Hotels Group - " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>This is recap for Hotel Finance.</h4>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL FINANCE SECTION
            // NOTIFICATION SECTION
            $data_notification = [
                "idBusiness" => $idBusiness,
                "typeNotification" => "Reservation Payment",
                "nmNotification" => "Payment PAID - " . $invoiceBooking,
                "descNotification" =>
                    $roomtypeBooking .
                    " - IDR " .
                    number_format($rateafterdiscountBooking),
                "idBooking" => $idBooking,
                "idUser" => $idUser,
                "createdAtNotification" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("notification", $data_notification);
            // NOTIFICATION SECTION
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        } else {
            $bookingdetail = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            if ($bookingdetail->rateafterdiscountBooking != 0) {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->rateafterdiscountBooking;
                $totalratebooking = number_format($payment);
            } else {
                $payment =
                    $bookingdetail->additionalBooking +
                    $bookingdetail->chargeBooking +
                    $bookingdetail->totalrateBooking;
                $totalratebooking = number_format($payment);
            }
            // $additionalBooking = number_format($bookingdetail->numberroomBooking);
            $chargeBooking = number_format($bookingdetail->chargeBooking);
            $sessionBusiness = $this->session->userdata("business");
            $sessionAddressBusiness = $this->session->userdata("address");
            $sessionEmailUser = $this->session->userdata("emailuser");
            $arrivalBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->arrivalBooking
            );
            $departureBooking = $this->fppfunction->format_tgl1(
                $bookingdetail->departureBooking
            );
            $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
            $this->upload->do_upload("imgInvoice");
            $gbr1 = $this->upload->data();
            $data_invoice = [
                "idUser" => $idUser,
                "idBooking" => $idBooking,
                "priceInvoice" => $this->input->post("priceInvoice"),
                "ketInvoice" => $this->input->post("ketInvoice"),
                "refInvoice" => $this->input->post("refInvoice"),
                "imgInvoice" => $gbr1["file_name"],
                "idCustomer" => $idCustomer,
                "idBusiness" => $idBusiness,
                "createdAtInvoice" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("invoice", $data_invoice);
            $idInvoice = $this->db->insert_id();
            $data_update_booking = [
                "statuspayBooking" => $this->input->post("statuspayBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $JumlahKomisi = $bookingdetail->totalrateBooking * 0;
            $data_CustomerPoin = [
                "idUser" => $this->session->userdata("idUser"),
                "idCustomer" => $idCustomer,
                "idBooking" => $idBooking,
                "JumlahPoin" => $JumlahPoin,
                "createdAtPoin" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("CustomerPoin", $data_CustomerPoin);
            $data_KomisiAsalam = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "JumlahKomisi" => $JumlahKomisi,
                "RateNow" => $rateNow,
                "idBusiness" => $idBusiness,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Salam", $data_KomisiAsalam);
            // ADP SECTION
            $current_investment = 0;
            $get_totalInvestment = $this->Home_m->getfile_total_investment_ota();
            $priceInvoice = $this->input->post("priceInvoice");
            $statuspayBooking = $this->input->post("statuspayBooking");
            $business = $this->session->userdata("business");
            $current_investment = $get_totalInvestment - $priceInvoice;
            $data_invoice = [
                "adpInvoice" => 1,
            ];
            $this->db->where("idInvoice", $idInvoice);
            $this->db->update("invoice", $data_invoice);
            // AFTER SEND TO ADP
            $investments = $this->Home_m->getfile_investment_onOTA();
            // Update the last row with 'on' status to 'expired'
            $lastInvestment = end($investments);
            $data_investment_expired = [
                "idInvoice" => $idInvoice,
                "statusInvestment" => "expired",
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idInvestment", $lastInvestment->idInvestment);
            $this->db->update("investment", $data_investment_expired);
            echo json_encode([
                "lastInvestment" => $lastInvestment->idInvestment,
            ]);
            // Calculate the sum of totalInvestment values
            $totalInvestmentSum = 0;
            $totalagreementInvest = 0;
            foreach ($investments as $investment) {
                $totalInvestmentSum += $investment->totalInvestment;
                $totalagreementInvest = $investment->agreementInvestment;
            }
            $feeInvestment =
                ($this->input->post("priceInvoice") *
                    $this->session->userdata("fee")) /
                100;
            $grossInvestment = $totalagreementInvest + $feeInvestment;
            $marginInvestment = $priceInvoice - $grossInvestment;
            $percentBase =
                $this->input->post("priceInvoice") / $marginInvestment;
            $percmarginInvestment = $percentBase * 10;
            $percentInvestment = $this->session->userdata("fee");
            // Format the percentage value
            $formatted_percent = number_format($percmarginInvestment, 2); // Rounds to 2 decimal places and adds '%' symbol
            // echo json_encode(array("invoice" => $priceInvoice, "agreement" => $totalagreementInvest, "fee" => $feeInvestment, "gross" => $grossInvestment, "margin" => $marginInvestment, "percent" => $formatted_percent));
            $data_investment_add = [
                "nmSegment" => "OTA-WEB",
                "idBusiness" => $idBusiness,
                "idInvoice" => $idInvoice,
                "dateInvestment" => date("Y-m-d"),
                "agreementInvestment" => $totalagreementInvest,
                "kreditInvestment" => $this->input->post("priceInvoice"),
                "totalInvestment" => $current_investment,
                "statusInvestment" => "on",
                "ketInvestment" => "CONFIRMED INVOICE " . $idInvoice,
                "feeInvestment" => $feeInvestment,
                "percentInvestment" => $this->session->userdata("fee"),
                "grossInvestment" => $grossInvestment,
                "marginInvestment" => $marginInvestment,
                "percmarginInvestment" => $formatted_percent,
                "idUser" => $this->session->userdata("idUser"),
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("investment", $data_investment_add);
            // ADP SECTION
            // PDF GENERATOR RESERVATION SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Invoice Sahira Hotels Group");
            $pdf->SetSubject("Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Invoice, Reservation, PDF");
            // Add a page
            $pdf->AddPage();
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 100px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>official@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR RESERVATION SECTION
            // EMAIL RESERVATION SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($emailBooking);
            $this->email->bcc($this->session->userdata("ReservationBusiness"));
            $this->email->subject(
                "Confirmation of Your Hotel Room Booking at " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>Dear $firstnameBooking,</h4>";
            $isi_email .= "<br>";
            $isi_email .= "<p>We are pleased to inform you that your hotel room booking has been successfully received. Thank you for choosing $hotelName for your stay.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Booking Details:</p>";
            $isi_email .= "<p>Name of the Guest: $firstnameBooking $lastnameBooking</p>";
            $isi_email .= "<p>Check-in Date: $arrivalBooking</p>";
            $isi_email .= "<p>Check-out Date: $departureBooking</p>";
            $isi_email .= "<p>Room Type: $roomtypeBooking</p>";
            $isi_email .= "<p>Number of Guests: $paxBooking</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>We will promptly process your booking and send an official confirmation along with further details via email shortly.</p>";
            $isi_email .= "<br>";
            $isi_email .=
                "<p>If you have any questions or specific requests, feel free to contact us at +62-877-90400-030 or info@sahirahotelsgroup.com.</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Thank you for your choice, and we look forward to welcoming you at $hotelName!</p>";
            $isi_email .= "<br>";
            $isi_email .= "<p>Warm Regards,</p>";
            $isi_email .= "<p>Hotel Reservation Team</p>";
            $isi_email .= "<p>$hotelName</p>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL RESERVATION SECTION
            // PDF GENERATOR FINANCE SECTION
            $pdf = new TCPDF(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                "UTF-8",
                false
            );
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Sahira Hotels Group");
            $pdf->SetTitle("Finance Invoice Sahira Hotels Group");
            $pdf->SetSubject("Finance Reservation from Sahira Hotels Group");
            $pdf->SetKeywords("Finance, Invoice, Reservation, PDF");
            // // Add a page
            $pdf->AddPage();
            // $business = 'The Sahira Hotel';
            // $statuspayBooking = 'PAID';
            // $invoiceBooking = 'INV00001';
            // $firstnameBooking = 'LOREM';
            // $lastnameBooking = 'IPSUM';
            // $arrivalBooking = '2024-01-20';
            // $departureBooking = '2024-01-21';
            // $createdAtBooking = '2024-01-19 12:04:21';
            // $roompaxBooking = '1';
            // $roomtypeBooking = 'Deluxe Single Bed';
            // $paxBooking = '1';
            // $childBooking = '1';
            // $extrabedBooking = '1';
            // $priceInvoice = '850000';
            // $rateafterdiscountBooking = '850000';
            // $totalagreementInvest = '370000';
            // $percentInvestment = '25';
            // $feeInvestment = '212500';
            // $grossInvestment = '582500';
            // $marginInvestment = '267500';
            // $formatted_percent = '31.78';
            // Set invoice HTML content
            $html = "<br>";
            $html .= "<br>";
            $html .=
                '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 200px;">';
            $html .= "<br>";
            // Add the provided HTML content
            $html .= '<section class="content invoice">';
            $html .= '<div class="row invoice-info">';
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
                $hotelName .
                '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
                $invoiceBooking .
                '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
                $statuspayBooking .
                "</th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";

            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
            $html .= "</thead>";
            $html .= "</table>";
            $html .= "<hr>";
            $html .= "<br>";
            $html .=
                '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
            $html .= "<thead>";
            $html .=
                '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">ADP INFORMATION :<br>' .
                $business .
                '</th><th style="border: 0.5px solid #212121; padding: 8px;font-size: 12px;">Total Agreement Investment<br>IDR ' .
                $totalagreementInvest .
                "</th><th></th></tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Fee OTA<br>$percentInvestment%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Fee OTA<br>IDR $feeInvestment</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Income from OTA<br>IDR $grossInvestment</td></tr>";
            $html .=
                "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
            $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Hotel<br>$formatted_percent%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Margin Hotel<br>IDR $marginInvestment</td><td></td></tr>";
            $html .= "</tbody>";
            $html .= "</table>";
            $html .= "</div>";
            $html .= "</section>";
            $html .= '<div style="text-align: center;">';
            $html .= "<h4>Have any questions?</h4>";
            $html .=
                "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
            $html .= "<p>info@sahirahotelsgroup.com</p>";
            $html .= "<p>+62-877-90400-030</p>";
            $html .= "</div>";
            $html .= "<hr>";
            $html .= '<div style="text-align: center;">';
            $html .=
                "<p>If the guests need to contact Salam Djourney, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
            $html .= "</div>";
            // Print HTML content
            $pdf->writeHTML($html, true, false, true, false, "");
            // Define the file path to save the PDF
            $file_path =
                FCPATH . "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Modify the path as needed
            // Save the PDF file to the specified path
            $pdf->Output($file_path, "F");
            echo "PDF file saved successfully to: " . $file_path;
            // PDF GENERATOR FINANCE SECTION
            // EMAIL FINANCE SECTION
            $config = [
                "protocol" => "smtp",
                "smtp_host" => "ssl://salamdjourney.com",
                "smtp_port" => "465",
                "smtp_user" => "noreply@salamdjourney.com",
                "smtp_pass" => "noreply@salamdjourney.com",
                "mailtype" => "html",
                "charset" => "iso-8859-1",
                "wordwrap" => true,
                "crlf" => "\r\n",
                "newline" => "\r\n",
            ];
            $this->load->library("email", $config);
            // Path to the file you want to attach
            $file_path = "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Update with the actual file path
            // Attach the file
            $this->email->attach($file_path);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@sahirahotelsgroup.com",
                "noreply-sahirahotelsgroup"
            );
            $this->email->to($this->session->userdata("CABusiness"));
            $this->email->cc($this->session->userdata("ARBusiness"));
            $this->email->subject(
                "Payment From Sahira Hotels Group - " . $hotelName . ""
            );
            $isi_email = "<html>";
            $isi_email .= "<body>";
            $isi_email .= "<h4>This is recap for Hotel Finance.</h4>";
            $isi_email .= "</body>";
            $isi_email .= "</html>";
            $this->email->message($isi_email);
            $this->email->send();
            // EMAIL FINANCE SECTION
            // NOTIFICATION SECTION
            $data_notification = [
                "idBusiness" => $idBusiness,
                "typeNotification" => "Reservation Payment",
                "nmNotification" => "Payment PAID - " . $invoiceBooking,
                "descNotification" =>
                    $roomtypeBooking .
                    " - IDR " .
                    number_format($rateafterdiscountBooking),
                "idBooking" => $idBooking,
                "idUser" => $idUser,
                "createdAtNotification" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("notification", $data_notification);
            // NOTIFICATION SECTION
            $this->session->set_flashdata(
                "pesansukses",
                "Status telah disimpan"
            );
            redirect(
                "cms/home/viewBookingInvoice/" .
                    $idBooking .
                    "/" .
                    $idBusiness .
                    "/"
            );
        }
        $bookingdetail = $this->Booking_m->getfile_booking_by_id($idBooking);
        if ($bookingdetail->rateafterdiscountBooking != 0) {
            $payment =
                $bookingdetail->additionalBooking +
                $bookingdetail->chargeBooking +
                $bookingdetail->rateafterdiscountBooking;
            $totalratebooking = number_format($payment);
        } else {
            $payment =
                $bookingdetail->additionalBooking +
                $bookingdetail->chargeBooking +
                $bookingdetail->totalrateBooking;
            $totalratebooking = number_format($payment);
        }
        // $additionalBooking = number_format($bookingdetail->numberroomBooking);
        $chargeBooking = number_format($bookingdetail->chargeBooking);
        $sessionBusiness = $this->session->userdata("business");
        $sessionAddressBusiness = $this->session->userdata("address");
        $sessionEmailUser = $this->session->userdata("emailuser");
        $arrivalBooking = $this->fppfunction->format_tgl1(
            $bookingdetail->arrivalBooking
        );
        $departureBooking = $this->fppfunction->format_tgl1(
            $bookingdetail->departureBooking
        );
        $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
        $extensi1 = explode(".", $_FILES["imgInvoice"]["name"]);
        $config1["upload_path"] = "./assets/images/invoice/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        $this->upload->do_upload("imgInvoice");
        $gbr1 = $this->upload->data();
        $JumlahKomisi = $bookingdetail->totalrateBooking * 0.17;
        $data_invoice = [
            "idUser" => $idUser,
            "idBooking" => $idBooking,
            "priceInvoice" => $this->input->post("priceInvoice"),
            "ketInvoice" => $this->input->post("ketInvoice"),
            "refInvoice" => $this->input->post("refInvoice"),
            "imgInvoice" => $gbr1["file_name"],
            "idCustomer" => $idCustomer,
            "idBusiness" => $idBusiness,
            "createdAtInvoice" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("invoice", $data_invoice);
        $idInvoice = $this->db->insert_id();
        $data_update_booking = [
            "statuspayBooking" => $this->input->post("statuspayBooking"),
            "editAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idBooking", $idBooking);
        $this->db->update("booking", $data_update_booking);
        $data_CustomerPoin = [
            "idUser" => $this->session->userdata("idUser"),
            "idCustomer" => $idCustomer,
            "idBooking" => $idBooking,
            "JumlahPoin" => $JumlahPoin,
            "createdAtPoin" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("CustomerPoin", $data_CustomerPoin);
        $data_KomisiAsalam = [
            "idUser" => $this->session->userdata("idUser"),
            "idBooking" => $idBooking,
            "JumlahKomisi" => $JumlahKomisi,
            "RateNow" => $rateNow,
            "idBusiness" => $idBusiness,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("Salam", $data_KomisiAsalam);
        // ADP SECTION
        $current_investment = 0;
        $get_totalInvestment = $this->Home_m->getfile_total_investment_ota();
        $priceInvoice = $this->input->post("priceInvoice");
        $statuspayBooking = $this->input->post("statuspayBooking");
        $business = $this->session->userdata("business");
        $current_investment = $get_totalInvestment - $priceInvoice;
        $data_invoice = [
            "adpInvoice" => 1,
        ];
        $this->db->where("idInvoice", $idInvoice);
        $this->db->update("invoice", $data_invoice);
        // AFTER SEND TO ADP
        $investments = $this->Home_m->getfile_investment_onOTA();
        // Update the last row with 'on' status to 'expired'
        $lastInvestment = end($investments);
        $data_investment_expired = [
            "idInvoice" => $idInvoice,
            "statusInvestment" => "expired",
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idInvestment", $lastInvestment->idInvestment);
        $this->db->update("investment", $data_investment_expired);
        echo json_encode(["lastInvestment" => $lastInvestment->idInvestment]);
        // Calculate the sum of totalInvestment values
        $totalInvestmentSum = 0;
        $totalagreementInvest = 0;
        foreach ($investments as $investment) {
            $totalInvestmentSum += $investment->totalInvestment;
            $totalagreementInvest = $investment->agreementInvestment;
        }
        $feeInvestment =
            ($this->input->post("priceInvoice") *
                $this->session->userdata("fee")) /
            100;
        $grossInvestment = $totalagreementInvest + $feeInvestment;
        $marginInvestment = $priceInvoice - $grossInvestment;
        $percentBase = $this->input->post("priceInvoice") / $marginInvestment;
        $percmarginInvestment = $percentBase * 10;
        $percentInvestment = $this->session->userdata("fee");
        // Format the percentage value
        $formatted_percent = number_format($percmarginInvestment, 2); // Rounds to 2 decimal places and adds '%' symbol
        // echo json_encode(array("invoice" => $priceInvoice, "agreement" => $totalagreementInvest, "fee" => $feeInvestment, "gross" => $grossInvestment, "margin" => $marginInvestment, "percent" => $formatted_percent));
        $data_investment_add = [
            "nmSegment" => "OTA-WEB",
            "idBusiness" => $idBusiness,
            "idInvoice" => $idInvoice,
            "dateInvestment" => date("Y-m-d"),
            "agreementInvestment" => $totalagreementInvest,
            "kreditInvestment" => $this->input->post("priceInvoice"),
            "totalInvestment" => $current_investment,
            "statusInvestment" => "on",
            "ketInvestment" => "CONFIRMED INVOICE " . $idInvoice,
            "feeInvestment" => $feeInvestment,
            "percentInvestment" => $this->session->userdata("fee"),
            "grossInvestment" => $grossInvestment,
            "marginInvestment" => $marginInvestment,
            "percmarginInvestment" => $formatted_percent,
            "idUser" => $this->session->userdata("idUser"),
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("investment", $data_investment_add);
        // ADP SECTION
        // PDF GENERATOR RESERVATION SECTION
        $pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            "UTF-8",
            false
        );
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Sahira Hotels Group");
        $pdf->SetTitle("Invoice Sahira Hotels Group");
        $pdf->SetSubject("Reservation from Sahira Hotels Group");
        $pdf->SetKeywords("Invoice, Reservation, PDF");
        // Add a page
        $pdf->AddPage();
        // Set invoice HTML content
        $html = "<br>";
        $html .= "<br>";
        $html .=
            '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 100px;">';
        $html .= "<br>";
        // Add the provided HTML content
        $html .= '<section class="content invoice">';
        $html .= '<div class="row invoice-info">';
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<thead>";
        $html .=
            '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
            $hotelName .
            '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
            $invoiceBooking .
            '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
            $statuspayBooking .
            "</th></tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "<hr>";
        $html .= "<br>";
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<tbody>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
        $html .= "</tbody>";
        $html .= "</table>";

        $html .= "<hr>";
        $html .= "<br>";
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<thead>";
        $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
        $html .= "</thead>";
        $html .= "</table>";
        $html .= "</div>";
        $html .= "</section>";
        $html .= '<div style="text-align: center;">';
        $html .= "<h4>Have any questions?</h4>";
        $html .=
            "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
        $html .= "<p>official@sahirahotelsgroup.com</p>";
        $html .= "<p>+62-877-90400-030</p>";
        $html .= "</div>";
        $html .= "<hr>";
        $html .= '<div style="text-align: center;">';
        $html .=
            "<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
        $html .= "<br>";
        $html .= "<br>";
        $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
        $html .= "</div>";
        // Print HTML content
        $pdf->writeHTML($html, true, false, true, false, "");
        // Define the file path to save the PDF
        $file_path = FCPATH . "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Modify the path as needed
        // Save the PDF file to the specified path
        $pdf->Output($file_path, "F");
        echo "PDF file saved successfully to: " . $file_path;
        // PDF GENERATOR RESERVATION SECTION
        // EMAIL RESERVATION SECTION
        $config = [
            "protocol" => "smtp",
            "smtp_host" => "ssl://salamdjourney.com",
            "smtp_port" => "465",
            "smtp_user" => "noreply@salamdjourney.com",
            "smtp_pass" => "noreply@salamdjourney.com",
            "mailtype" => "html",
            "charset" => "iso-8859-1",
            "wordwrap" => true,
            "crlf" => "\r\n",
            "newline" => "\r\n",
        ];
        $this->load->library("email", $config);
        // Path to the file you want to attach
        $file_path = "assets/pdfs/booking-" . $invoiceBooking . ".pdf"; // Update with the actual file path
        // Attach the file
        $this->email->attach($file_path);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from(
            "noreply@sahirahotelsgroup.com",
            "noreply-sahirahotelsgroup"
        );
        $this->email->to($emailBooking);
        $this->email->bcc($this->session->userdata("ReservationBusiness"));
        $this->email->subject(
            "Confirmation of Your Hotel Room Booking at " . $hotelName . ""
        );
        $isi_email = "<html>";
        $isi_email .= "<body>";
        $isi_email .= "<h4>Dear $firstnameBooking,</h4>";
        $isi_email .= "<br>";
        $isi_email .= "<p>We are pleased to inform you that your hotel room booking has been successfully received. Thank you for choosing $hotelName for your stay.</p>";
        $isi_email .= "<br>";
        $isi_email .= "<p>Booking Details:</p>";
        $isi_email .= "<p>Name of the Guest: $firstnameBooking $lastnameBooking</p>";
        $isi_email .= "<p>Check-in Date: $arrivalBooking</p>";
        $isi_email .= "<p>Check-out Date: $departureBooking</p>";
        $isi_email .= "<p>Room Type: $roomtypeBooking</p>";
        $isi_email .= "<p>Number of Guests: $paxBooking</p>";
        $isi_email .= "<br>";
        $isi_email .=
            "<p>We will promptly process your booking and send an official confirmation along with further details via email shortly.</p>";
        $isi_email .= "<br>";
        $isi_email .=
            "<p>If you have any questions or specific requests, feel free to contact us at +62-877-90400-030 or info@sahirahotelsgroup.com.</p>";
        $isi_email .= "<br>";
        $isi_email .= "<p>Thank you for your choice, and we look forward to welcoming you at $hotelName!</p>";
        $isi_email .= "<br>";
        $isi_email .= "<p>Warm Regards,</p>";
        $isi_email .= "<p>Hotel Reservation Team</p>";
        $isi_email .= "<p>$hotelName</p>";
        $isi_email .= "</body>";
        $isi_email .= "</html>";
        $this->email->message($isi_email);
        $this->email->send();
        // EMAIL RESERVATION SECTION
        // PDF GENERATOR FINANCE SECTION
        $pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,
            "UTF-8",
            false
        );
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Sahira Hotels Group");
        $pdf->SetTitle("Finance Invoice Sahira Hotels Group");
        $pdf->SetSubject("Finance Reservation from Sahira Hotels Group");
        $pdf->SetKeywords("Finance, Invoice, Reservation, PDF");
        // // Add a page
        $pdf->AddPage();
        // $business = 'The Sahira Hotel';
        // $statuspayBooking = 'PAID';
        // $invoiceBooking = 'INV00001';
        // $firstnameBooking = 'LOREM';
        // $lastnameBooking = 'IPSUM';
        // $arrivalBooking = '2024-01-20';
        // $departureBooking = '2024-01-21';
        // $createdAtBooking = '2024-01-19 12:04:21';
        // $roompaxBooking = '1';
        // $roomtypeBooking = 'Deluxe Single Bed';
        // $paxBooking = '1';
        // $childBooking = '1';
        // $extrabedBooking = '1';
        // $priceInvoice = '850000';
        // $rateafterdiscountBooking = '850000';
        // $totalagreementInvest = '370000';
        // $percentInvestment = '25';
        // $feeInvestment = '212500';
        // $grossInvestment = '582500';
        // $marginInvestment = '267500';
        // $formatted_percent = '31.78';
        // Set invoice HTML content
        $html = "<br>";
        $html .= "<br>";
        $html .=
            '<img src="./assets/images/logo_sahira_group_brown.png" style="padding: 20px;margin: 20px;width: 200px;">';
        $html .= "<br>";
        // Add the provided HTML content
        $html .= '<section class="content invoice">';
        $html .= '<div class="row invoice-info">';
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<thead>";
        $html .=
            '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">' .
            $hotelName .
            '</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>' .
            $invoiceBooking .
            '</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>' .
            $statuspayBooking .
            "</th></tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "<hr>";
        $html .= "<br>";
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<tbody>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
        $html .= "</tbody>";
        $html .= "</table>";

        $html .= "<hr>";
        $html .= "<br>";
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<thead>";
        $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
        $html .= "</thead>";
        $html .= "</table>";
        $html .= "<hr>";
        $html .= "<br>";
        $html .=
            '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
        $html .= "<thead>";
        $html .=
            '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">ADP INFORMATION :<br>' .
            $business .
            '</th><th style="border: 0.5px solid #212121; padding: 8px;font-size: 12px;">Total Agreement Investment<br>IDR ' .
            $totalagreementInvest .
            "</th><th></th></tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Fee OTA<br>$percentInvestment%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Fee OTA<br>IDR $feeInvestment</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Income from OTA<br>IDR $grossInvestment</td></tr>";
        $html .=
            "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
        $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Hotel<br>$formatted_percent%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Margin Hotel<br>IDR $marginInvestment</td><td></td></tr>";
        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</div>";
        $html .= "</section>";
        $html .= '<div style="text-align: center;">';
        $html .= "<h4>Have any questions?</h4>";
        $html .=
            "<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>";
        $html .= "<p>info@sahirahotelsgroup.com</p>";
        $html .= "<p>+62-877-90400-030</p>";
        $html .= "</div>";
        $html .= "<hr>";
        $html .= '<div style="text-align: center;">';
        $html .=
            "<p>If the guests need to contact Salam Djourney, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>";
        $html .= "<br>";
        $html .= "<br>";
        $html .= "<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>";
        $html .= "</div>";
        // Print HTML content
        $pdf->writeHTML($html, true, false, true, false, "");
        // Define the file path to save the PDF
        $file_path = FCPATH . "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Modify the path as needed
        // Save the PDF file to the specified path
        $pdf->Output($file_path, "F");
        echo "PDF file saved successfully to: " . $file_path;
        // PDF GENERATOR FINANCE SECTION
        // EMAIL FINANCE SECTION
        $config = [
            "protocol" => "smtp",
            "smtp_host" => "ssl://salamdjourney.com",
            "smtp_port" => "465",
            "smtp_user" => "noreply@salamdjourney.com",
            "smtp_pass" => "noreply@salamdjourney.com",
            "mailtype" => "html",
            "charset" => "iso-8859-1",
            "wordwrap" => true,
            "crlf" => "\r\n",
            "newline" => "\r\n",
        ];
        $this->load->library("email", $config);
        // Path to the file you want to attach
        $file_path = "assets/pdfs/finance-" . $invoiceBooking . ".pdf"; // Update with the actual file path
        // Attach the file
        $this->email->attach($file_path);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from(
            "noreply@sahirahotelsgroup.com",
            "noreply-sahirahotelsgroup"
        );
        $this->email->to($this->session->userdata("CABusiness"));
        $this->email->cc($this->session->userdata("ARBusiness"));
        $this->email->subject(
            "Payment From Sahira Hotels Group - " . $hotelName . ""
        );
        $isi_email = "<html>";
        $isi_email .= "<body>";
        $isi_email .= "<h4>This is recap for Hotel Finance.</h4>";
        $isi_email .= "</body>";
        $isi_email .= "</html>";
        $this->email->message($isi_email);
        $this->email->send();
        // EMAIL FINANCE SECTION
        // NOTIFICATION SECTION
        $data_notification = [
            "idBusiness" => $idBusiness,
            "typeNotification" => "Reservation Payment",
            "nmNotification" => "Payment PAID - " . $invoiceBooking,
            "descNotification" =>
                $roomtypeBooking .
                " - IDR " .
                number_format($rateafterdiscountBooking),
            "idBooking" => $idBooking,
            "idUser" => $idUser,
            "createdAtNotification" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("notification", $data_notification);
        // NOTIFICATION SECTION
    }
    public function insertRoomAttendant($nmNumber)
    {
        if ($post = $this->input->post("submit")) {
            $this->form_validation->set_rules(
                "combAttendant",
                "combAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "cottonbudAttendant",
                "cottonbudAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "dentalkitAttendant",
                "dentalkitAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "handsoapAttendant",
                "handsoapAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "bedpadAttendant",
                "bedpadAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "sewingkitAttendant",
                "sewingkitAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "shampooAttendant",
                "shampooAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "showercapAttendant",
                "showercapAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "tissueboxAttendant",
                "tissueboxAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "tissuerollAttendant",
                "tissuerollAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "soapAttendant",
                "soapAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "disposalbagAttendant",
                "disposalbagAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "sleeperAttendant",
                "sleeperAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "laundryAttendant",
                "laundryAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "coasterAttendant",
                "coasterAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "memopadAttendant",
                "memopadAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "pencilAttendant",
                "pencilAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "guestcommentAttendant",
                "guestcommentAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "complimentAttendant",
                "complimentAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "bathmatAttendant",
                "bathmatAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "bedsheetAttendant",
                "bedsheetAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "duvetcoverAttendant",
                "duvetcoverAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "facetowelAttendant",
                "facetowelAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "handtowelAttendant",
                "handtowelAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "pillowcaseAttendant",
                "pillowcaseAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "sheetdoubleAttendant",
                "sheetdoubleAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "sheetsingleAttendant",
                "sheetsingleAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "bedcoverAttendant",
                "bedcoverAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "innerduvetAttendant",
                "innerduvetAttendant",
                ""
            );
            $this->form_validation->set_rules(
                "remarkAttendant",
                "remarkAttendant",
                "required"
            );
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata(
                    "pesanerror",
                    "Harap item remark diisi"
                );
                // Validation failed, reload the form
                $data = [
                    "title" => "Madani Djourney | ONIXLABS",
                    "nopage" => 28,
                ];
                $data[
                    "new_invoice_number"
                ] = $this->Kamar_m->generate_invoice_number();
                $data[
                    "roomattendant"
                ] = $this->Housekeeping_m->getfile_roomattendant_all(
                    $this->session->userdata("idBusiness")
                );
                $data[
                    "availableRoom"
                ] = $this->Kamar_m->getfile_available_kamar(
                    $this->session->userdata("idBusiness")
                );
                $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                    $this->session->userdata("idBusiness")
                );
                $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                    $this->session->userdata("idBusiness")
                );
                $this->load->view("cms/header", $data);
                $this->load->view("cms/view_roomattendant", $data);
                $this->load->view("cms/footer", $data);
            } else {
                $nomor_kamar_value = $this->Kamar_m->getfile_number_kamar_by_input(
                    $nmNumber
                );
                // echo json_encode(array('message' => $nomor_kamar_value), JSON_NUMERIC_CHECK);
                $data_update_hk_room_attendant = [
                    "idUser" => $this->session->userdata("idUser"),
                    "idBusiness" => $this->input->post("idBusiness"),
                    "roomAttendant" => $nmNumber,
                    "combAttendant" => $this->input->post("combAttendant"),
                    "cottonbudAttendant" => $this->input->post(
                        "cottonbudAttendant"
                    ),
                    "dentalkitAttendant" => $this->input->post(
                        "dentalkitAttendant"
                    ),
                    "handsoapAttendant" => $this->input->post(
                        "handsoapAttendant"
                    ),
                    "bedpadAttendant" => $this->input->post("bedpadAttendant"),
                    "sewingkitAttendant" => $this->input->post(
                        "sewingkitAttendant"
                    ),
                    "shampooAttendant" => $this->input->post(
                        "shampooAttendant"
                    ),
                    "showercapAttendant" => $this->input->post(
                        "showercapAttendant"
                    ),
                    "tissueboxAttendant" => $this->input->post(
                        "tissueboxAttendant"
                    ),
                    "tissuerollAttendant" => $this->input->post(
                        "tissuerollAttendant"
                    ),
                    "soapAttendant" => $this->input->post("soapAttendant"),
                    "disposalbagAttendant" => $this->input->post(
                        "disposalbagAttendant"
                    ),
                    "sleeperAttendant" => $this->input->post(
                        "sleeperAttendant"
                    ),
                    "laundryAttendant" => $this->input->post(
                        "laundryAttendant"
                    ),
                    "coasterAttendant" => $this->input->post(
                        "coasterAttendant"
                    ),
                    "memopadAttendant" => $this->input->post(
                        "memopadAttendant"
                    ),
                    "pencilAttendant" => $this->input->post("pencilAttendant"),
                    "guestcommentAttendant" => $this->input->post(
                        "guestcommentAttendant"
                    ),
                    "complimentAttendant" => $this->input->post(
                        "complimentAttendant"
                    ),
                    "bathmatAttendant" => $this->input->post(
                        "bathmatAttendant"
                    ),
                    "bathtowelAttendant" => $this->input->post(
                        "bathtowelAttendant"
                    ),
                    "bedsheetAttendant" => $this->input->post(
                        "bedsheetAttendant"
                    ),
                    "duvetcoverAttendant" => $this->input->post(
                        "duvetcoverAttendant"
                    ),
                    "facetowelAttendant" => $this->input->post(
                        "facetowelAttendant"
                    ),
                    "handtowelAttendant" => $this->input->post(
                        "handtowelAttendant"
                    ),
                    "pillowcaseAttendant" => $this->input->post(
                        "pillowcaseAttendant"
                    ),
                    "sheetdoubleAttendant" => $this->input->post(
                        "sheetdoubleAttendant"
                    ),
                    "sheetsingleAttendant" => $this->input->post(
                        "sheetsingleAttendant"
                    ),
                    "bedcoverAttendant" => $this->input->post(
                        "bedcoverAttendant"
                    ),
                    "innerduvetAttendant" => $this->input->post(
                        "innerduvetAttendant"
                    ),
                    "remarkAttendant" => $this->input->post("remarkAttendant"),
                    "createdAt" => date("Y-m-d H:i:s"),
                ];
                $this->db->where("roomAttendant", $nmNumber);
                $this->db->update(
                    "hk_room_attendant",
                    $data_update_hk_room_attendant
                );
                $idAttendant = $this->input->post("idAttendant");
                foreach (
                    $_FILES["file"]["name"]
                    as $nmAttendantdetail => $file_name
                ) {
                    if (!empty($file_name)) {
                        $upload_path = "./assets/images/house_keeping/";
                        move_uploaded_file(
                            $_FILES["file"]["tmp_name"][$nmAttendantdetail],
                            $upload_path . $file_name
                        );
                        $this->Housekeeping_m->insert_file_data(
                            $nmAttendantdetail,
                            $file_name,
                            $nmNumber,
                            $this->session->userdata("idBusiness"),
                            $idAttendant,
                            $this->session->userdata("idUser")
                        );
                    }
                }
                $this->session->set_flashdata(
                    "pesansukses",
                    "Status telah diupdate"
                );
                redirect("cms/home/viewRoomAttendant/");
            }
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata(
                "pesanerror",
                "Gagal insert attendant"
            );
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 28,
            ];
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data[
                "roomattendant"
            ] = $this->Housekeeping_m->getfile_roomattendant_all(
                $this->session->userdata("idBusiness")
            );
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                $this->session->userdata("idBusiness")
            );
            $this->load->view("cms/header", $data);
            $this->load->view("cms/view_roomattendant", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function viewKomisi()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 29,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["komisi"] = $this->Home_m->getfile_komisi();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_komisi", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewBusiness()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 29,
        ];
        $data["business"] = $this->Home_m->getfile_business();
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_business", $data);
        $this->load->view("cms/footer", $data);
    }
    public function inputBookingMeeting()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 30,
        ];
        $data["businessId"] = $this->Home_m->getfile_business_by_id(
            $this->session->userdata("idBusiness")
        );
        $data["kamar"] = $this->Kamar_m->getfile_kamar_marketing();
        $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting(
            $this->session->userdata("idBusiness")
        );
        $data["number"] = $this->Kamar_m->getfile_number(
            $this->session->userdata("idBusiness")
        );
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
            $this->session->userdata("idBusiness")
        );
        $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
            $this->session->userdata("idBusiness")
        );
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        if (!$data["businessId"]) {
            $this->session->set_flashdata(
                "no_business_exists",
                "Bisnis belum terdaftar"
            );
            redirect("cms/home");
        }
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_booking_meeting", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxRoomTypeMeeting($idPaketmeeting)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 31,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting_by_id(
            $idPaketmeeting
        );
        if (!$data["meeting"]) {
            $response = [
                "idPaketmeeting" => "",
                "nmPaketmeeting" => "",
                "pricePaketmeeting" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = [
                "idPaketmeeting" => $data["meeting"]->idPaketmeeting,
                "nmPaketmeeting" => $data["meeting"]->nmPaketmeeting,
                "pricePaketmeeting" => $data["meeting"]->pricePaketmeeting,
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function insertFormTypeMeeting($new_invoice_number)
    {
        $total = $this->input->post("pricePaketmeeting");
        $roompax = $this->input->post("roompaxBooking");
        $pax = $this->input->post("paxBooking");
        $subtotal = $total * $pax;
        $totalPaketmeeting = $subtotal;
        if ($roompax != 0 || $pax != 0) {
            $data_booking = [
                "idBusiness" => $this->input->post("idBusiness"),
                "idUser" => $this->session->userdata("idUser"),
                "idKamar" => $this->input->post("idKamar"),
                "idType" => $this->input->post("idType"),
                "nightBooking" => $this->input->post("nightBooking"),
                "arrivalBooking" => $this->input->post("arrivalBooking"),
                "departureBooking" => $this->input->post("departureBooking"),
                "invoiceBooking" => $new_invoice_number,
                "roomtypeBooking" => $this->input->post("roomtypeBooking"),
                "roompaxBooking" => $this->input->post("roompaxBooking"),
                "paxBooking" => $this->input->post("paxBooking"),
                "totalrateBooking" => $totalPaketmeeting,
                "statuspayBooking" => "UNPAID",
                "createdAtBooking" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("booking_cart", $data_booking);
            $data[
                "bookingcart"
            ] = $this->Booking_m->getfile_booking_cart_by_invoice(
                $this->input->post("invoiceBooking")
            );
            if (!$data["bookingcart"]) {
                $response = [
                    "bookingcart" => "",
                ];
                echo json_encode($response, JSON_NUMERIC_CHECK);
            } else {
                $response = $data["bookingcart"];
                echo json_encode($response, JSON_NUMERIC_CHECK);
            }
        }
    }
    public function inputAdditionalBookingMeeting($get_invoice_number)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 32,
        ];
        $data["businessId"] = $this->Home_m->getfile_business_by_id(
            $this->session->userdata("idBusiness")
        );
        $data["kamar"] = $this->Kamar_m->getfile_kamar_marketing();
        $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting(
            $this->session->userdata("idBusiness")
        );
        $data["number"] = $this->Kamar_m->getfile_number(
            $this->session->userdata("idBusiness")
        );
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
            $this->session->userdata("idBusiness")
        );
        $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
            $this->session->userdata("idBusiness")
        );
        $data["roomtype_booking"] = $this->Booking_m->getfile_roomtype_booking(
            $this->session->userdata("idBusiness")
        );
        $data["new_invoice_number"] = $get_invoice_number;
        $data[
            "bookingcart"
        ] = $this->Booking_m->getfile_booking_cart_by_invoice(
            $get_invoice_number
        );
        $data[
            "databookingcart"
        ] = $this->Booking_m->getfile_data_booking_cart_by_invoice(
            $get_invoice_number
        );
        $data["meetingroom"] = $this->Kamar_m->getfile_meeting_room(
            $this->session->userdata("idBusiness")
        );
        // $data['member'] = $this->Customer_m->getfile_sort_member($get_invoice_number);
        $data["idBusiness"] = $this->session->userdata("idBusiness");
        if (!$data["databookingcart"]) {
            redirect(
                "cms/home/inputBookingMeeting/" .
                    $this->session->userdata("idBusiness") .
                    "/"
            );
        }
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_additional_booking_meeting", $data);
        $this->load->view("cms/footer", $data);
    }
    public function inputMemberRoomMeeting($get_invoice_number)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 32,
        ];
        $data["businessId"] = $this->Home_m->getfile_business_by_id(
            $this->session->userdata("idBusiness")
        );
        $data["kamar"] = $this->Kamar_m->getfile_kamar_marketing();
        $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting(
            $this->session->userdata("idBusiness")
        );
        $data["number"] = $this->Kamar_m->getfile_number(
            $this->session->userdata("idBusiness")
        );
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
            $this->session->userdata("idBusiness")
        );
        $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
            $this->session->userdata("idBusiness")
        );
        $data["roomtype_booking"] = $this->Booking_m->getfile_roomtype_booking(
            $this->session->userdata("idBusiness")
        );
        $data["new_invoice_number"] = $get_invoice_number;
        $data[
            "bookingcart"
        ] = $this->Booking_m->getfile_booking_cart_by_invoice(
            $get_invoice_number
        );
        $data[
            "databookingcart"
        ] = $this->Booking_m->getfile_data_booking_cart_by_invoice(
            $get_invoice_number
        );
        $data["meetingroom"] = $this->Kamar_m->getfile_meeting_room(
            $this->session->userdata("idBusiness")
        );
        $data["booking_cart"] = $this->Booking_m->getfile_member_number_meeting(
            $get_invoice_number
        );
        $data["idBusiness"] = $this->session->userdata("idBusiness");
        if (!$data["databookingcart"]) {
            redirect(
                "cms/home/inputBookingMeeting/" .
                    $this->session->userdata("idBusiness") .
                    "/"
            );
        }
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_member_room_meeting", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxAdditionalTypeMeeting($new_invoice_number)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 33,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "bookingcart"
        ] = $this->Booking_m->getfile_booking_cart_by_invoice(
            $new_invoice_number
        );
        if (!$data["bookingcart"]) {
            $response = [
                "bookingcart" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["bookingcart"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function insertFormAdditional()
    {
        $total = $this->input->post("totalHarga");
        $pax = $this->input->post("paxBooking");
        $subtotal = $total * $pax;
        $totalPaketmeeting = $subtotal;
        $data_booking = [
            "idBusiness" => $this->session->userdata("idBusiness"),
            "idUser" => $this->session->userdata("idUser"),
            "invoiceBooking" => $this->input->post("invoiceBooking"),
            "roomtypeBooking" => $this->input->post("roomtypeBooking"),
            "roompaxBooking" => $this->input->post("roompaxBooking"),
            "paxBooking" => $this->input->post("paxBooking"),
            "totalrateBooking" => $totalPaketmeeting,
            "statuspayBooking" => "UNPAID",
            "createdAtBooking" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("booking_cart", $data_booking);
    }
    public function updateFormBookingMeeting($idBusiness)
    {
        if ($post = $this->input->post("submit")) {
            $new_invoice_number = $this->input->post("invoiceBooking");
            $this->form_validation->set_rules(
                "arrivalBooking",
                "arrivalBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "nightBooking",
                "nightBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "departureBooking",
                "departureBooking",
                "required"
            );
            $this->form_validation->set_rules(
                "statusBooking",
                "statusBooking",
                "required"
            );
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata(
                    "pesanerror",
                    "Item dengan tanda * harap diisi"
                );
                // Validation failed, reload the form
                $data = [
                    "title" => "Madani Djourney | ONIXLABS",
                    "nopage" => 32,
                ];
                $data["businessId"] = $this->Home_m->getfile_business_by_id(
                    $idBusiness
                );
                $data["kamar"] = $this->Kamar_m->getfile_kamar_marketing();
                $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting(
                    $idBusiness
                );
                $data["number"] = $this->Kamar_m->getfile_number($idBusiness);
                $data["company"] = $this->Company_m->getfile_company();
                $data[
                    "availableRoom"
                ] = $this->Kamar_m->getfile_available_kamar($idBusiness);
                $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                    $idBusiness
                );
                $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                    $idBusiness
                );
                $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
                    $idBusiness
                );
                $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
                    $idBusiness
                );
                $data[
                    "new_invoice_number"
                ] = $this->Kamar_m->generate_invoice_number();
                $data[
                    "bookingcart"
                ] = $this->Booking_m->getfile_booking_cart_by_invoice(
                    $new_invoice_number
                );
                $this->load->view("cms/header", $data);
                $this->load->view("cms/input_booking_meeting", $data);
                $this->load->view("cms/footer", $data);
            } else {
                $data_booking = [
                    "idBusiness" => $idBusiness,
                    "idUser" => $this->session->userdata("idUser"),
                    "statusBooking" => $this->input->post("statusBooking"),
                    "arrivalBooking" => $this->input->post("arrivalBooking"),
                    "nightBooking" => $this->input->post("nightBooking"),
                    "departureBooking" => $this->input->post(
                        "departureBooking"
                    ),
                    "statuspayBooking" => "UNPAID",
                    "createdAtBooking" => date("Y-m-d H:i:s"),
                ];
                $this->db->where("invoiceBooking", $new_invoice_number);
                $this->db->update("booking_cart", $data_booking);
                $databookingcart = $this->Booking_m->getfile_booking_cart_by_invoice(
                    $new_invoice_number
                );
                foreach ($databookingcart as $row) {
                    echo json_encode($row->paxBooking);
                    $this->db->set(
                        "qtyKamar",
                        "qtyKamar -" . $row->paxBooking,
                        false
                    );
                    $this->db->set(
                        "soldKamar",
                        "soldKamar +" . $row->paxBooking,
                        false
                    );
                    $data_update_kamar_meeting = [
                        "idUser" => $this->session->userdata("idUser"),
                        "updateAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->where("idKamarMeeting", $row->idKamar);
                    $this->db->update(
                        "kamar_meeting",
                        $data_update_kamar_meeting
                    );
                    $this->db->set(
                        "qtyKamar",
                        "qtyKamar -" . $row->paxBooking,
                        false
                    );
                    $this->db->set(
                        "soldKamar",
                        "soldKamar +" . $row->paxBooking,
                        false
                    );
                    $data_update_kamar = [
                        "idUser" => $this->session->userdata("idUser"),
                        "updateAt" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->where("idKamar", $row->idKamar);
                    $this->db->update("kamar", $data_update_kamar);
                }
                $this->session->set_flashdata(
                    "pesansukses",
                    "Booking telah ditambahkan"
                );
                redirect(
                    "cms/home/inputAdditionalBookingMeeting/" .
                        $new_invoice_number .
                        "/" .
                        $idBusiness .
                        "/"
                );
            }
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata("pesanerror", "Gagal insert booking");
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 32,
            ];
            $data["businessId"] = $this->Home_m->getfile_business_by_id(
                $idBusiness
            );
            $data["kamar"] = $this->Kamar_m->getfile_kamar_marketing();
            $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting(
                $idBusiness
            );
            $data["number"] = $this->Kamar_m->getfile_number($idBusiness);
            $data["company"] = $this->Company_m->getfile_company();
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $idBusiness
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $idBusiness
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
            $data["rateCode"] = $this->Kamar_m->getfile_rate_code($idBusiness);
            $data["rateGap"] = $this->Kamar_m->getfile_rate_gap($idBusiness);
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data[
                "bookingcart"
            ] = $this->Booking_m->getfile_booking_cart_by_invoice(
                $get_invoice_number
            );
            $this->load->view("cms/header", $data);
            $this->load->view("cms/input_booking_meeting", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function updateAdditionalFormBookingMeeting($new_invoice_number)
    {
        if ($post = $this->input->post("submit")) {
            $data_customer = [
                "idUser" => $this->session->userdata("idUser"),
                "FirstName" => $this->input->post("firstnameBooking"),
                "LastName" => $this->input->post("lastnameBooking"),
                "IDNumber" => $this->input->post("idnumberBooking"),
                "Bday" => $this->input->post("birthdayBooking"),
                "addres" => $this->input->post("addressBooking"),
                "notel" => $this->input->post("mobileBooking"),
                "gmail" => $this->input->post("emailBooking"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("Customer", $data_customer);
            $idCustomer = $this->db->insert_id();
            $departure_time = "13:00:00";
            $checkout_datetime =
                $this->input->post("departureBooking") . " " . $departure_time;
            $data_booking = [
                "idBusiness" => $this->session->userdata("idBusiness"),
                "idUser" => $this->session->userdata("idUser"),
                "statusBooking" => $this->input->post("statusBooking"),
                "checkouttimeBooking" => $this->input->post(
                    "checkouttimeBooking"
                ),
                "meetingroomBooking" => $this->input->post(
                    "meetingroomBooking"
                ),
                "numberroomBooking" => $this->input->post("numberroomBooking"),
                "childBooking" => $this->input->post("childBooking"),
                "extrabedBooking" => $this->input->post("extrabedBooking"),
                "vipBooking" => $this->input->post("vipBooking"),
                "firstnameBooking" => $this->input->post("firstnameBooking"),
                "lastnameBooking" => $this->input->post("lastnameBooking"),
                "genderBooking" => $this->input->post("genderBooking"),
                "idnumberBooking" => $this->input->post("idnumberBooking"),
                "birthdayBooking" => $this->input->post("birthdayBooking"),
                "emailBooking" => $this->input->post("emailBooking"),
                "mobileBooking" => $this->input->post("mobileBooking"),
                "addressBooking" => $this->input->post("addressBooking"),
                "companyBooking" => $this->input->post("companyBooking"),
                "insideallotmentBooking" => $this->input->post(
                    "insideallotmentBooking",
                    true
                ),
                "individualbillBooking" => $this->input->post(
                    "individualbillBooking",
                    true
                ),
                "bookercodeBooking" => $this->input->post("bookercodeBooking"),
                "bookercode1Booking" => $this->input->post(
                    "bookercode1Booking"
                ),
                "bookercontactBooking" => $this->input->post(
                    "bookercontactBooking"
                ),
                "bookercontact1Booking" => $this->input->post(
                    "bookercontact1Booking"
                ),
                "bookeremailBooking" => $this->input->post(
                    "bookeremailBooking"
                ),
                "bookermobile1Booking" => $this->input->post(
                    "bookermobile1Booking"
                ),
                "paymentBooking" => $this->input->post("paymentBooking"),
                "currencyBooking" => $this->input->post("currencyBooking"),
                "creditcardnoBooking" => $this->input->post(
                    "creditcardnoBooking"
                ),
                "validdatethruBooking" => $this->input->post(
                    "validdatethruBooking"
                ),
                "creditlimitBooking" => $this->input->post(
                    "creditlimitBooking"
                ),
                "vouchernoBooking" => $this->input->post("vouchernoBooking"),
                "salespersonBooking" => $this->input->post(
                    "salespersonBooking"
                ),
                "welcomingBooking" => $this->input->post("welcomingBooking"),
                "segmentBooking" => $this->input->post("segmentBooking"),
                "nationalityBooking" => $this->input->post(
                    "nationalityBooking"
                ),
                "originareaBooking" => $this->input->post("originareaBooking"),
                "destinationBooking" => $this->input->post(
                    "destinationBooking"
                ),
                "flightarriveBooking" => $this->input->post(
                    "flightarriveBooking"
                ),
                "flightdepartBooking" => $this->input->post(
                    "flightdepartBooking"
                ),
                "billinginstructionBooking" => $this->input->post(
                    "billinginstructionBooking"
                ),
                "checkinremarkBooking" => $this->input->post(
                    "checkinremarkBooking"
                ),
                "preferenceBooking" => $this->input->post("preferenceBooking"),
                "RateNow" => $this->input->post("RateNow"),
                "statuspayBooking" => "UNPAID",
                "idCustomer" => $idCustomer,
                "createdAtBooking" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("invoiceBooking", $new_invoice_number);
            $this->db->update("booking_cart", $data_booking);
            $numberRoomMeeting = $this->input->post("numberroomBooking");
            // Explode the comma-separated string into an array
            $roomNumbers = explode(",", $numberRoomMeeting);
            foreach ($roomNumbers as $roomNumber) {
                $data_update_nomor_kamar = [
                    "idUser" => $this->session->userdata("idUser"),
                    "ketNumber" => "VR",
                    "updateAt" => date("Y-m-d H:i:s"),
                ];
                $this->db->where("nmNumber", $roomNumber);
                $this->db->update("kamar_number", $data_update_nomor_kamar);
                $data_update_nomor_kamar_meeting = [
                    "idUser" => $this->session->userdata("idUser"),
                    "ketNumberMeeting" => "VR",
                    "updateAt" => date("Y-m-d H:i:s"),
                ];
                $this->db->where("nmNumberMeeting", $roomNumber);
                $this->db->update(
                    "kamar_number_meeting",
                    $data_update_nomor_kamar_meeting
                );
                $data_insert_nomor_member = [
                    "noBookingroommember" => $roomNumber,
                    "idUser" => $this->session->userdata("idUser"),
                    "idBusiness" => $this->session->userdata("idBusiness"),
                    "invoiceBooking" => $new_invoice_number,
                    "idCompany" => $this->input->post("idCompany"),
                ];
                $this->db->insert(
                    "booking_room_member",
                    $data_insert_nomor_member
                );
            }
            $this->session->set_flashdata(
                "pesansukses",
                "Booking telah diupdate"
            );
            redirect(
                "cms/home/inputAdditionalBookingMeeting/" . $new_invoice_number
            );
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 32,
            ];
            $data[
                "roomtype_booking"
            ] = $this->Booking_m->getfile_roomtype_booking(
                $this->session->userdata("idBusiness")
            );
            $data["businessId"] = $this->Home_m->getfile_business_by_id(
                $this->session->userdata("idBusiness")
            );
            $data["kamar"] = $this->Kamar_m->getfile_kamar_marketing();
            $data["meeting"] = $this->Kamar_m->getfile_kamar_meeting(
                $this->session->userdata("idBusiness")
            );
            $data["number"] = $this->Kamar_m->getfile_number(
                $this->session->userdata("idBusiness")
            );
            $data["company"] = $this->Company_m->getfile_company();
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
                $this->session->userdata("idBusiness")
            );
            $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
                $this->session->userdata("idBusiness")
            );
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data[
                "bookingcart"
            ] = $this->Booking_m->getfile_booking_cart_by_invoice(
                $new_invoice_number
            );
            $this->load->view("cms/header", $data);
            $this->load->view("cms/input_additional_booking_meeting", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function sendajaxNumberkamar()
    {
        $get_invoice_number = $this->input->post("new_invoice_number");
        $arrivalBooking = $this->input->post("arrivalBooking");
        $departureBooking = $this->input->post("departureBooking");
        $roomtypeBooking = $this->input->post("roomtypeBooking");
        $data[
            "roomcart"
        ] = $this->Booking_m->getfile_room_booking_cart_by_invoice(
            $get_invoice_number,
            $arrivalBooking,
            $departureBooking,
            $roomtypeBooking
        );
        if (!$data["roomcart"]) {
            $response = [
                "nmNumber" => "",
                "nmType" => "",
                "ketNumber" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["roomcart"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function updateFormKaryawan($idKaryawan)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 33,
        ];
        // konfigurasi proses upload file foto gallery
        if ($this->session->userdata("level") != "7") {
            $gbr = $this->upload->data();
            $office = $this->input->post("officeKaryawan");
            $gbr = $this->upload->data();
            $office = $this->input->post("officeKaryawan");
            $data_Karyawan = [
                "idUser" => $this->session->userdata("idUser"),
                "idBusiness" => $this->input->post("officeKaryawan"),
                "nmKaryawan" => $this->input->post("nmKaryawan"),
                "tgllahirKaryawan" => $this->input->post("tgllahirKaryawan"),
                "mobileKaryawan" => $this->input->post("mobileKaryawan"),
                "officeKaryawan" => $this->input->post("officeKaryawan"),
                "imgKaryawan" => $this->input->post("photoPath"), // Save as comma-separated string
                "linkedinKaryawan" => $this->input->post("linkedinKaryawan"),
                "instagramKaryawan" => $this->input->post("instagramKaryawan"),
                "facebookKaryawan" => $this->input->post("facebookKaryawan"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idKaryawan", $idKaryawan);
            $this->db->update("karyawan", $data_Karyawan);
            $data_user = [
                "idKaryawan" => $idKaryawan,
                "idBusiness" => $this->input->post("officeKaryawan"),
                "idGroup" => $this->session->userdata("idGroup"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $password = $this->input->post("passwordKaryawan");
            if (isset($password)) {
                $data_user["passUser"] = sha1(
                    $this->input->post("passwordKaryawan")
                );
            }
            $this->db->where("idKaryawan", $idKaryawan);
            $this->db->update("user", $data_user);
            $idUser = $this->db
                ->get_where("user", ["idKaryawan" => $idKaryawan])
                ->row()->idUser;
            $existingAccess = $this->db
                ->get_where("access", ["idUser" => $idUser])
                ->result_array();
            $newAccessData = [];
            foreach ($this->input->post("access") as $checkbox) {
                $newAccessData[] = [
                    "idUser" => $idUser,
                    "menuName" => $checkbox,
                ];
            }
            $existingMenuNames = array_column($existingAccess, "menuName");
            $newMenuNames = array_column($newAccessData, "menuName");
            $toInsert = array_diff($newMenuNames, $existingMenuNames);
            $toDelete = array_diff($existingMenuNames, $newMenuNames);
            $insertedData = [];
            foreach ($newAccessData as $newMenu) {
                if (in_array($newAccessData->menuName, $toInsert)) {
                    $insertedData[] = $newMenu;
                }
            }
            if (!empty($toInsert)) {
                $this->db->insert_batch("access", $insertedData);
            }
            if (!empty($toDelete)) {
                $this->db
                    ->where("idUser", $idUser)
                    ->where_in("menuName", $toDelete)
                    ->delete("access");
            }
            $this->session->set_flashdata(
                "pesansukses",
                "Karyawan telah ditambahkan"
            );
            redirect("cms/home/inputKaryawan/");
        } else {
            $gbr = $this->upload->data();
            $office = $this->input->post("officeKaryawan");
            $data_Karyawan = [
                "idUser" => $this->session->userdata("idUser"),
                "idBusiness" => $this->input->post("officeKaryawan"),
                "nmKaryawan" => $this->input->post("nmKaryawan"),
                "tgllahirKaryawan" => $this->input->post("tgllahirKaryawan"),
                "mobileKaryawan" => $this->input->post("mobileKaryawan"),
                "officeKaryawan" => $this->input->post("officeKaryawan"),
                "imgKaryawan" => $this->input->post("photoPath"), // Save as comma-separated string
                "linkedinKaryawan" => $this->input->post("linkedinKaryawan"),
                "instagramKaryawan" => $this->input->post("instagramKaryawan"),
                "facebookKaryawan" => $this->input->post("facebookKaryawan"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idKaryawan", $idKaryawan);
            $this->db->update("karyawan", $data_Karyawan);
            $data_user = [
                "idKaryawan" => $idKaryawan,
                "idBusiness" => $this->input->post("officeKaryawan"),
                "idGroup" => $this->session->userdata("idGroup"),
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $password = $this->input->post("passwordKaryawan");
            if (isset($password)) {
                $data_user["passUser"] = sha1(
                    $this->input->post("passwordKaryawan")
                );
            }
            $this->db->where("idKaryawan", $idKaryawan);
            $this->db->update("user", $data_user);
            $idUser = $this->db
                ->get_where("user", ["idKaryawan" => $idKaryawan])
                ->row()->idUser;
            $existingAccess = $this->db
                ->get_where("access", ["idUser" => $idUser])
                ->result_array();
            $newAccessData = [];
            foreach ($this->input->post("access") as $checkbox) {
                $newAccessData[] = [
                    "idUser" => $idUser,
                    "menuName" => $checkbox,
                ];
            }
            $existingMenuNames = array_column($existingAccess, "menuName");
            $newMenuNames = array_column($newAccessData, "menuName");
            $toInsert = array_diff($newMenuNames, $existingMenuNames);
            $toDelete = array_diff($existingMenuNames, $newMenuNames);
            if (!empty($toInsert)) {
                $this->db->insert_batch("access", $newAccessData);
            }
            if (!empty($toDelete)) {
                $this->db
                    ->where("idUser", $idUser)
                    ->where_in("menuName", $toDelete)
                    ->delete("access");
            }
            $this->session->set_flashdata(
                "pesansukses",
                "Karyawan telah ditambahkan"
            );
            redirect("cms/home/editKaryawan/" . $idUser . "/");
        }
    }
    public function viewBookingCartInvoice($invoiceBooking)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 34,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "bookingcartdetail"
        ] = $this->Booking_m->getfile_booking_cart_by_id($invoiceBooking);
        $data[
            "roombookingcartdetail"
        ] = $this->Booking_m->getfile_room_booking_cart_by_id($invoiceBooking);
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_invoice_booking_cart", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxMeetingRoom($idMeeting)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 33,
        ];
        $data["idMeeting"] = $this->Kamar_m->generate_invoice_number();
        $data["meetingroom"] = $this->Kamar_m->getfile_meeting_room_by_id(
            $idMeeting
        );
        if (!$data["meetingroom"]) {
            $response = [
                "meetingroom" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["meetingroom"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewDataPaketMeeting()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 35,
        ];
        $data["bookingmeeting"] = $this->Home_m->getfile_booking_meeting();
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_booking_meeting", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxInventoryRoom($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];

        $data["inventoryRoom"] = $this->Booking_m->getInventoryRoom(
            $idBusiness
        );
        if (!$data["inventoryRoom"]) {
            $response = [
                "response" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["inventoryRoom"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxInventoryRoomByArrivalBookingCart(
        $idBusiness,
        $formattedDate
    ) {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];

        $data[
            "inventoryRoom"
        ] = $this->Booking_m->getInventoryRoomByArrivalBookingCart(
            $formattedDate,
            $idBusiness
        );
        if (!$data["inventoryRoom"]) {
            $response = [
                "response" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["inventoryRoom"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function updateRoomAttendantFO($nmNumber)
    {
        $data_update_nomor_kamar = [
            "idUser" => $this->session->userdata("idUser"),
            "ketNumber" => $this->input->post("ketNumber"),
            "updateAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("nmNumber", $nmNumber);
        $this->db->update("kamar_number", $data_update_nomor_kamar);
        $this->session->set_flashdata("pesansukses", "Status telah disimpan");
        redirect("cms/home/viewBooking/");
    }
    public function viewAdditionalFnb($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["idBusiness"] = $idBusiness;
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["booking"] = $this->Booking_m->getfile_booking_by_id_business(
            $idBusiness
        );
        $data[
            "additional"
        ] = $this->Booking_m->getfile_booking_additional_by_business_id(
            $idBusiness
        );
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival_by_id_business(
            $idBusiness
        );
        $data[
            "bookingRoom"
        ] = $this->Kamar_m->getfile_booking_kamar_by_business_id($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_by_id_business(
            $idBusiness
        );
        $data["fnb_menu"] = $this->Fnb_m->getfile_fnb_menu();
        $data["invoiceFnbadditional"] = $this->Fnb_m->noUrut_orderanFNB();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_additionalfnb", $data);
        $this->load->view("cms/footer");
    }
    public function viewReportFnb($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["idBusiness"] = $idBusiness;
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["booking"] = $this->Booking_m->getfile_booking_by_id_business(
            $idBusiness
        );
        $data[
            "additional"
        ] = $this->Booking_m->getfile_report_additional_by_business_id(
            $idBusiness
        );
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival_by_id_business(
            $idBusiness
        );
        $data[
            "bookingRoom"
        ] = $this->Kamar_m->getfile_booking_kamar_by_business_id($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_by_id_business(
            $idBusiness
        );
        $data["fnb_menu"] = $this->Fnb_m->getfile_fnb_menu();
        $data["invoiceFnbadditional"] = $this->Fnb_m->noUrut_orderanFNB();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_additionalfnb_report", $data);
        $this->load->view("cms/footer");
    }
    public function ajaxGetBookingData()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $numberroomBooking = $this->input->post("numberroomBooking");
        $data["bookingData"] = $this->Booking_m->getbookingDataByRoomNumber(
            $numberroomBooking
        );
        if (!$data["bookingData"]) {
            $response = [
                "response" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["bookingData"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewAdditionalDetail($idBooking, $invoiceFnbadditional)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 37,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
            $idBooking
        );
        $data["fnbdetail"] = $this->Booking_m->getfile_booking_by_id_fnbInvoice(
            $idBooking,
            $invoiceFnbadditional
        );
        $data["user"] = $this->Home_m->getfile_user_by_tokenpushnotification(
            $idBooking
        );
        $data[
            "additional_fnb"
        ] = $this->Booking_m->getfile_additional_fnb_by_id(
            $invoiceFnbadditional
        );
        $data["fnb_menu"] = $this->Fnb_m->getfile_fnb_menu();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_additionalfnb_detail", $data);
        $this->load->view("cms/footer");
    }
    public function inputAdditionalFnb()
    {
        $idBusiness = $this->input->post("idBusiness");
        $invoiceFnbadditional = $this->input->post("invoiceFnbadditional");
        $nmMenu = $this->input->post("ketFnbadditional");
        $qtyFnbadditional = $this->input->post("qtyFnbadditional");
        $numberroomBooking = $this->input->post("numberroomBooking");
        $descFnbadditional = $this->input->post("descFnbadditional");
        $idBooking = $this->input->post("idBooking");
        $fnb_menu = $this->Fnb_m->getfile_fnb_menu_by_name($nmMenu);
        $price = $fnb_menu->priceMenu * $qtyFnbadditional;
        $data["bookingData"] = $this->Booking_m->getbookingDataByRoomNumber(
            $numberroomBooking
        );
        if (!$data["bookingData"]) {
            $this->session->set_flashdata(
                "pesanerror",
                "Data booking tidak ditemukan !"
            );
            redirect("cms/home/viewAdditionalFnb/" . $idBusiness . "/");
        } else {
            $data_insert_fnb_additional_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "idBooking" => $idBooking,
                "numberroomFnbadditional" => $numberroomBooking,
                "qtyFnbadditional" => $this->input->post("qtyFnbadditional"),
                "invoiceFnbadditional" => $invoiceFnbadditional,
                "descFnbadditional" => $descFnbadditional,
                "ketFnbadditional" => $fnb_menu->nmMenu,
                "priceFnbadditional" => $price,
                "createdAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert(
                "fnb_additional_booking",
                $data_insert_fnb_additional_booking
            );
            $data_insert_fnb_additional_cooking = [
                "idBusiness" => $idBusiness,
                "idBooking" => $idBooking,
                "invoiceFnbadditional" => $invoiceFnbadditional,
                "subtotalPrice" => $price,
                "statuspayFnbcooking" => "UNCONFIRM",
                "paymentFnbcooking" => "room-billing",
                "idUser" => $this->session->userdata("idUser"),
                "createdAtFnbcooking" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert(
                "fnb_additional_cooking",
                $data_insert_fnb_additional_cooking
            );
            $additional_fnb = [];
            $this->db->from("fnb_additional_booking");
            $this->db->where("idBooking", $idBooking);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $additional_fnb[] = $row;
                }
            }
            $query->free_result();
            $additionalBooking = 0;
            foreach ($additional_fnb as $row) {
                $additionalBooking += $row->priceFnbadditional;
            }
            $data_update_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "additionalBooking" => $additionalBooking,
                "EditAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_update_booking);
            $data_update_fnb = [
                "idUser" => $this->session->userdata("idUser"),
                "stockMenu" => $fnb_menu->stockMenu - $qtyFnbadditional,
            ];
            $this->db->where("nmMenu", $nmMenu);
            $this->db->update("fnb_menu", $data_update_fnb);
            $this->session->set_flashdata(
                "pesansukses",
                "Additional telah disimpan"
            );
            redirect("cms/home/viewAdditionalFnb/" . $idBusiness . "/");
        }
    }
    public function updateAdditionalFnb()
    {
        $idMenu = $this->input->post("ketFnbadditional");
        $invoiceFnbadditional = $this->input->post("invoiceFnbadditional");
        $idBooking = $this->input->post("idBooking");
        $data_insert_fnb_additional_cooking = [
            "idBooking" => $idBooking,
            "invoiceFnbadditional" => $invoiceFnbadditional,
            "statuspayFnbcooking" => $this->input->post("statuspayFnbcooking"),
            "createdAtFnbcooking" => date("Y-m-d H:i:s"),
        ];
        // $this->db->where('idBooking', $idBooking);
        $this->db->where("invoiceFnbadditional", $invoiceFnbadditional);
        $this->db->update(
            "fnb_additional_cooking",
            $data_insert_fnb_additional_cooking
        );
        $this->session->set_flashdata(
            "pesansukses",
            "Additional telah disimpan"
        );
        redirect(
            "cms/home/viewAdditionalDetail/" .
                $idBooking .
                "/" .
                $invoiceFnbadditional .
                "/"
        );
        // echo json_encode($data_insert_fnb_additional_cooking);
    }
    public function updateorderAdditionalFnb() 
    {
        $invoiceFnbadditional = $this->input->post("invoiceFnbadditional");
        $ketFnbadditional = $this->input->post("ketFnbadditional");
        $idBooking = $this->input->post("idBooking");
        
        $data_update_fnb_additional_booking = [
            "orderFnbadditional" => $this->input->post("orderFnbadditional"),
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        
        $this->db->where('invoiceFnbadditional', $invoiceFnbadditional);
        $this->db->where("ketFnbadditional", $ketFnbadditional);
        $this->db->update("fnb_additional_booking", $data_update_fnb_additional_booking);
        
        // Ambil data dari fnb_additional_booking
        $this->db->from('fnb_additional_booking');
        $this->db->where('ketFnbadditional', $ketFnbadditional);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // Jika ada item dengan orderFnbadditional = 'SOLD_OUT'
                if ($row->orderFnbadditional == 'SOLD_OUT') {
                    
                    // Kurangi subtotalPrice di fnb_additional_cooking
                    $this->db->from('fnb_additional_cooking');
                    $this->db->where('invoiceFnbadditional', $invoiceFnbadditional);
                    $cookingQuery = $this->db->get();
                    
                    if ($cookingQuery->num_rows() > 0) {
                        $cookingData = $cookingQuery->row();
                        $newSubtotal = $cookingData->subtotalPrice - $row->priceFnbadditional;
                        
                        // Pastikan subtotal tidak negatif
                        if ($newSubtotal < 0) {
                            $newSubtotal = 0;
                        }
                        
                        $this->db->where('invoiceFnbadditional', $invoiceFnbadditional);
                        $this->db->update('fnb_additional_cooking', ['subtotalPrice' => $newSubtotal]);
                    }
                }
            }
        }
        
        $this->session->set_flashdata("pesansukses", "Additional telah disimpan");
        redirect("cms/home/viewAdditionalDetail/" . $idBooking . "/" . $invoiceFnbadditional . "/");
    }
    public function confirmAdditionalFnb()
    {
        $invoiceFnbadditional = $this->input->post("invoiceFnbadditional");
        $idBooking = $this->input->post("idBooking");
        $data_insert_fnb_additional_cooking = [
            "statusFnbcooking" => $this->input->post("statusFnbcooking"),
            "createdAtFnbcooking" => date("Y-m-d H:i:s"),
        ];
        // $this->db->where('idBooking', $idBooking);
        $this->db->where("invoiceFnbadditional", $invoiceFnbadditional);
        $this->db->update(
            "fnb_additional_cooking",
            $data_insert_fnb_additional_cooking
        );
        $this->session->set_flashdata(
            "pesansukses",
            "Additional telah disimpan"
        );
        redirect(
            "cms/home/viewAdditionalDetail/" .
                $idBooking .
                "/" .
                $invoiceFnbadditional .
                "/"
        );
        // echo json_encode($data_insert_fnb_additional_cooking);
    }
    public function servingAdditionalFnb()
    {
        $invoiceFnbadditional = $this->input->post("invoiceFnbadditional");
        $idBooking = $this->input->post("idBooking");
        $data_insert_fnb_additional_cooking = [
            "statusFnbcooking" => $this->input->post("statusFnbcooking"),
            "statusFnbserving" => $this->input->post("statusFnbserving"),
            "createdAtFnbcooking" => date("Y-m-d H:i:s"),
        ];
        // $this->db->where('idBooking', $idBooking);
        $this->db->where("invoiceFnbadditional", $invoiceFnbadditional);
        $this->db->update(
            "fnb_additional_cooking",
            $data_insert_fnb_additional_cooking
        );
        $this->session->set_flashdata(
            "pesansukses",
            "Additional telah disimpan"
        );
        redirect(
            "cms/home/viewAdditionalDetail/" .
                $idBooking .
                "/" .
                $invoiceFnbadditional .
                "/"
        );
        // echo json_encode($data_insert_fnb_additional_cooking);
    }
    public function editNumberKamar($idBusiness, $idKamar, $nmNumber, $idNumber)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 27,
        ];
        $idType = $this->input->post("idType");
        $idTypeAfter = $this->input->post("idTypeAfter");
        $nomor_kamar_value = $this->Kamar_m->getfile_number_kamar_by_input(
            $insertNomor
        );
        $data_number_kamar = [
            "idUser" => $this->session->userdata("idUser"),
            "nmNumber" => $nmNumber,
            "idKamar" => $idTypeAfter,
            "idType" => $idTypeAfter,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idNumber", $idNumber);
        $this->db->update("kamar_number", $data_number_kamar);
        echo json_encode(
            ["message" => "Nomor Kamar telah diubah"],
            JSON_NUMERIC_CHECK
        );
        $this->session->set_flashdata(
            "pesansukses",
            "Nomor Kamar telah ditambahkan"
        );
        redirect("cms/home/viewKamar/" . $idBusiness . "/");
    }
    public function updateFormBooking($idBusiness, $idBooking)
    {
        if ($post = $this->input->post("submit")) {
            $statusBooking = $this->input->post("statusBooking");
            if ($statusBooking == "Canceled") {
                $data_booking = [
                    "arrivalBooking" => $this->input->post("arrivalBooking"),
                    "nightBooking" => $this->input->post("nightBooking"),
                    "departureBooking" => $this->input->post(
                        "departureBooking"
                    ),
                    "memberBooking" => $this->input->post("memberBooking"),
                    "statusBooking" => $statusBooking,
                    "roomtypeBooking" => $this->input->post("roomtypeBooking"),
                    "updagradetoBooking" => $this->input->post(
                        "updagradetoBooking"
                    ),
                    "blockBooking" => $this->input->post("blockBooking"),
                    "feautresBooking" => $this->input->post("feautresBooking"),
                    "numberroomBooking" => $this->input->post(
                        "numberroomBooking"
                    ),
                    "paxBooking" => $this->input->post("paxBooking"),
                    "childBooking" => $this->input->post("childBooking"),
                    "extrabedBooking" => $this->input->post("extrabedBooking"),
                    "vipBooking" => $this->input->post("vipBooking"),
                    "arrivaltimeBooking" => $this->input->post(
                        "arrivaltimeBooking"
                    ),
                    "departuretimeBooking" => $this->input->post(
                        "departuretimeBooking"
                    ),
                    "firstnameBooking" => $this->input->post(
                        "firstnameBooking"
                    ),
                    "lastnameBooking" => $this->input->post("lastnameBooking"),
                    "genderBooking" => $this->input->post("genderBooking"),
                    "idnumberBooking" => $this->input->post("idnumberBooking"),
                    "birthdayBooking" => $this->input->post("birthdayBooking"),
                    "emailBooking" => $this->input->post("emailBooking"),
                    "mobileBooking" => $this->input->post("mobileBooking"),
                    "addressBooking" => $this->input->post("addressBooking"),
                    "companyBooking" => $this->input->post("companyBooking"),
                    "insideallotmentBooking" => $this->input->post(
                        "insideallotmentBooking",
                        true
                    ),
                    "individualbillBooking" => $this->input->post(
                        "individualbillBooking",
                        true
                    ),
                    "bookercodeBooking" => $this->input->post(
                        "bookercodeBooking"
                    ),
                    "bookercode1Booking" => $this->input->post(
                        "bookercode1Booking"
                    ),
                    "bookercontactBooking" => $this->input->post(
                        "bookercontactBooking"
                    ),
                    "bookercontact1Booking" => $this->input->post(
                        "bookercontact1Booking"
                    ),
                    "bookeremailBooking" => $this->input->post(
                        "bookeremailBooking"
                    ),
                    "bookermobile1Booking" => $this->input->post(
                        "bookermobile1Booking"
                    ),
                    "ratecodeBooking" => $this->input->post("ratecodeBooking"),
                    "totalrateBooking" => $this->input->post(
                        "totalrateBooking"
                    ),
                    "tagBooking" => $this->input->post("tagBooking"),
                    "discountBooking" => $this->input->post("discountBooking"),
                    "reasonBooking" => $this->input->post("reasonBooking"),
                    "rateafterdiscountBooking" => $this->input->post(
                        "rateafterdiscountBooking"
                    ),
                    "splitroomonlyBooking" => $this->input->post(
                        "splitroomonlyBooking",
                        true
                    ),
                    "latecheckoutchargeBooking" => $this->input->post(
                        "latecheckoutchargeBooking"
                    ),
                    "commisionBooking" => $this->input->post(
                        "commisionBooking"
                    ),
                    "agentBooking" => $this->input->post("agentBooking"),
                    "paymentBooking" => $this->input->post("paymentBooking"),
                    "currencyBooking" => $this->input->post("currencyBooking"),
                    "creditcardnoBooking" => $this->input->post(
                        "creditcardnoBooking"
                    ),
                    "validdatethruBooking" => $this->input->post(
                        "validdatethruBooking"
                    ),
                    "creditlimitBooking" => $this->input->post(
                        "creditlimitBooking"
                    ),
                    "vouchernoBooking" => $this->input->post(
                        "vouchernoBooking"
                    ),
                    "salespersonBooking" => $this->input->post(
                        "salespersonBooking"
                    ),
                    "welcomingBooking" => $this->input->post(
                        "welcomingBooking"
                    ),
                    "segmentBooking" => $this->input->post("segmentBooking"),
                    "nationalityBooking" => $this->input->post(
                        "nationalityBooking"
                    ),
                    "originareaBooking" => $this->input->post(
                        "originareaBooking"
                    ),
                    "destinationBooking" => $this->input->post(
                        "destinationBooking"
                    ),
                    "sourceBooking" => $this->input->post("sourceBooking"),
                    "honeymoonBooking" => $this->input->post(
                        "honeymoonBooking",
                        true
                    ),
                    "cashbasisBooking" => $this->input->post(
                        "cashbasisBooking",
                        true
                    ),
                    "transactionclosedBooking" => $this->input->post(
                        "transactionclosedBooking",
                        true
                    ),
                    "noinfoBooking" => $this->input->post(
                        "noinfoBooking",
                        true
                    ),
                    "blockedphoneBooking" => $this->input->post(
                        "blockedphoneBooking",
                        true
                    ),
                    "flightarriveBooking" => $this->input->post(
                        "flightarriveBooking"
                    ),
                    "flightdepartBooking" => $this->input->post(
                        "flightdepartBooking"
                    ),
                    "billinginstructionBooking" => $this->input->post(
                        "billinginstructionBooking"
                    ),
                    "checkinremarkBooking" => $this->input->post(
                        "checkinremarkBooking"
                    ),
                    "preferenceBooking" => $this->input->post(
                        "preferenceBooking"
                    ),
                ];
                $this->db->where("idBooking", $idBooking);
                $this->db->update("booking", $data_booking);
                $idKamar = $this->input->post("idKamar");
                $numberroomBooking = $this->input->post("numberroomBooking");
                $this->Booking_m->updateQtyByidKamar(
                    $idKamar,
                    $this->input->post("arrivalBooking")
                );
                $this->Booking_m->updateStatuskamarByNumberRoom(
                    $numberroomBooking,
                    $idKamar
                );
                if ($statusBooking == "Confirm") {
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Booking telah diupdate"
                    );
                    redirect("cms/home/viewBookingDetail/" . $idBooking . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Booking telah diupdate"
                    );
                    redirect("cms/home/viewBookingDetail/" . $idBooking . "/");
                }
            } else {
                $data_booking = [
                    "arrivalBooking" => $this->input->post("arrivalBooking"),
                    "nightBooking" => $this->input->post("nightBooking"),
                    "departureBooking" => $this->input->post(
                        "departureBooking"
                    ),
                    "memberBooking" => $this->input->post("memberBooking"),
                    "statusBooking" => $statusBooking,
                    "roomtypeBooking" => $this->input->post("roomtypeBooking"),
                    "updagradetoBooking" => $this->input->post(
                        "updagradetoBooking"
                    ),
                    "blockBooking" => $this->input->post("blockBooking"),
                    "feautresBooking" => $this->input->post("feautresBooking"),
                    "numberroomBooking" => $this->input->post(
                        "numberroomBooking"
                    ),
                    "paxBooking" => $this->input->post("paxBooking"),
                    "childBooking" => $this->input->post("childBooking"),
                    "extrabedBooking" => $this->input->post("extrabedBooking"),
                    "vipBooking" => $this->input->post("vipBooking"),
                    "arrivaltimeBooking" => $this->input->post(
                        "arrivaltimeBooking"
                    ),
                    "departuretimeBooking" => $this->input->post(
                        "departuretimeBooking"
                    ),
                    "firstnameBooking" => $this->input->post(
                        "firstnameBooking"
                    ),
                    "lastnameBooking" => $this->input->post("lastnameBooking"),
                    "genderBooking" => $this->input->post("genderBooking"),
                    "idnumberBooking" => $this->input->post("idnumberBooking"),
                    "birthdayBooking" => $this->input->post("birthdayBooking"),
                    "emailBooking" => $this->input->post("emailBooking"),
                    "mobileBooking" => $this->input->post("mobileBooking"),
                    "addressBooking" => $this->input->post("addressBooking"),
                    "companyBooking" => $this->input->post("companyBooking"),
                    "insideallotmentBooking" => $this->input->post(
                        "insideallotmentBooking",
                        true
                    ),
                    "individualbillBooking" => $this->input->post(
                        "individualbillBooking",
                        true
                    ),
                    "bookercodeBooking" => $this->input->post(
                        "bookercodeBooking"
                    ),
                    "bookercode1Booking" => $this->input->post(
                        "bookercode1Booking"
                    ),
                    "bookercontactBooking" => $this->input->post(
                        "bookercontactBooking"
                    ),
                    "bookercontact1Booking" => $this->input->post(
                        "bookercontact1Booking"
                    ),
                    "bookeremailBooking" => $this->input->post(
                        "bookeremailBooking"
                    ),
                    "bookermobile1Booking" => $this->input->post(
                        "bookermobile1Booking"
                    ),
                    "ratecodeBooking" => $this->input->post("ratecodeBooking"),
                    "totalrateBooking" => $this->input->post(
                        "totalrateBooking"
                    ),
                    "tagBooking" => $this->input->post("tagBooking"),
                    "discountBooking" => $this->input->post("discountBooking"),
                    "reasonBooking" => $this->input->post("reasonBooking"),
                    "rateafterdiscountBooking" => $this->input->post(
                        "rateafterdiscountBooking"
                    ),
                    "splitroomonlyBooking" => $this->input->post(
                        "splitroomonlyBooking",
                        true
                    ),
                    "latecheckoutchargeBooking" => $this->input->post(
                        "latecheckoutchargeBooking"
                    ),
                    "commisionBooking" => $this->input->post(
                        "commisionBooking"
                    ),
                    "agentBooking" => $this->input->post("agentBooking"),
                    "paymentBooking" => $this->input->post("paymentBooking"),
                    "currencyBooking" => $this->input->post("currencyBooking"),
                    "creditcardnoBooking" => $this->input->post(
                        "creditcardnoBooking"
                    ),
                    "validdatethruBooking" => $this->input->post(
                        "validdatethruBooking"
                    ),
                    "creditlimitBooking" => $this->input->post(
                        "creditlimitBooking"
                    ),
                    "vouchernoBooking" => $this->input->post(
                        "vouchernoBooking"
                    ),
                    "salespersonBooking" => $this->input->post(
                        "salespersonBooking"
                    ),
                    "welcomingBooking" => $this->input->post(
                        "welcomingBooking"
                    ),
                    "segmentBooking" => $this->input->post("segmentBooking"),
                    "nationalityBooking" => $this->input->post(
                        "nationalityBooking"
                    ),
                    "originareaBooking" => $this->input->post(
                        "originareaBooking"
                    ),
                    "destinationBooking" => $this->input->post(
                        "destinationBooking"
                    ),
                    "sourceBooking" => $this->input->post("sourceBooking"),
                    "honeymoonBooking" => $this->input->post(
                        "honeymoonBooking",
                        true
                    ),
                    "cashbasisBooking" => $this->input->post(
                        "cashbasisBooking",
                        true
                    ),
                    "transactionclosedBooking" => $this->input->post(
                        "transactionclosedBooking",
                        true
                    ),
                    "noinfoBooking" => $this->input->post(
                        "noinfoBooking",
                        true
                    ),
                    "blockedphoneBooking" => $this->input->post(
                        "blockedphoneBooking",
                        true
                    ),
                    "flightarriveBooking" => $this->input->post(
                        "flightarriveBooking"
                    ),
                    "flightdepartBooking" => $this->input->post(
                        "flightdepartBooking"
                    ),
                    "billinginstructionBooking" => $this->input->post(
                        "billinginstructionBooking"
                    ),
                    "checkinremarkBooking" => $this->input->post(
                        "checkinremarkBooking"
                    ),
                    "preferenceBooking" => $this->input->post(
                        "preferenceBooking"
                    ),
                ];
                $this->db->where("idBooking", $idBooking);
                $this->db->update("booking", $data_booking);
                if ($statusBooking == "Confirm") {
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Booking telah diupdate"
                    );
                    redirect("cms/home/viewBookingDetail/" . $idBooking . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Booking telah diupdate"
                    );
                    redirect("cms/home/viewBookingDetail/" . $idBooking . "/");
                }
            }
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata("pesanerror", "Gagal update booking");
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 26,
            ];
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["getidBooking"] = $idBooking;
            $this->load->view("cms/header", $data);
            $this->load->view("cms/view_booking_detail", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function viewBookingCopy($idBooking)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 38,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["kamar"] = $this->Kamar_m->getfile_kamar();
        $data["number"] = $this->Kamar_m->getfile_number(
            $this->session->userdata("idBusiness")
        );
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["rateCode"] = $this->Kamar_m->getfile_rate_code(
            $this->session->userdata("idBusiness")
        );
        $data["rateGap"] = $this->Kamar_m->getfile_rate_gap(
            $this->session->userdata("idBusiness")
        );
        $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
            $idBooking
        );
        $data["getidBooking"] = $idBooking;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_booking_copy", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertBookingCopy($idBusiness, $getidBooking)
    {
        if ($post = $this->input->post("submit")) {
            $data_booking = [
                "idBusiness" => $this->input->post("idBusiness"),
                "idUser" => $this->session->userdata("idUser"),
                "idKamar" => $this->input->post("idKamar"),
                "RateNow" => $this->input->post("RateNow"),
                "checkouttimeBooking" => $this->input->post(
                    "checkouttimeBooking"
                ),
                "arrivalBooking" => $this->input->post("arrivalBooking"),
                "nightBooking" => $this->input->post("nightBooking"),
                "departureBooking" => $this->input->post("departureBooking"),
                "memberBooking" => $this->input->post("memberBooking"),
                "statusBooking" => $this->input->post("statusBooking"),
                "roomtypeBooking" => $this->input->post("roomtypeBooking"),
                "roompaxBooking" => 1,
                "updagradetoBooking" => $this->input->post(
                    "updagradetoBooking"
                ),
                "blockBooking" => $this->input->post("blockBooking"),
                "feautresBooking" => $this->input->post("feautresBooking"),
                "numberroomBooking" => $this->input->post("numberroomBooking"),
                "paxBooking" => $this->input->post("paxBooking"),
                "childBooking" => $this->input->post("childBooking"),
                "extrabedBooking" => $this->input->post("extrabedBooking"),
                "vipBooking" => $this->input->post("vipBooking"),
                "arrivaltimeBooking" => $this->input->post(
                    "arrivaltimeBooking"
                ),
                "departuretimeBooking" => $this->input->post(
                    "departuretimeBooking"
                ),
                "firstnameBooking" => $this->input->post("firstnameBooking"),
                "lastnameBooking" => $this->input->post("lastnameBooking"),
                "genderBooking" => $this->input->post("genderBooking"),
                "idnumberBooking" => $this->input->post("idnumberBooking"),
                "birthdayBooking" => $this->input->post("birthdayBooking"),
                "emailBooking" => $this->input->post("emailBooking"),
                "mobileBooking" => $this->input->post("mobileBooking"),
                "addressBooking" => $this->input->post("addressBooking"),
                "companyBooking" => $this->input->post("companyBooking"),
                "insideallotmentBooking" => $this->input->post(
                    "insideallotmentBooking",
                    true
                ),
                "individualbillBooking" => $this->input->post(
                    "individualbillBooking",
                    true
                ),
                "bookercodeBooking" => $this->input->post("bookercodeBooking"),
                "bookercode1Booking" => $this->input->post(
                    "bookercode1Booking"
                ),
                "bookercontactBooking" => $this->input->post(
                    "bookercontactBooking"
                ),
                "bookercontact1Booking" => $this->input->post(
                    "bookercontact1Booking"
                ),
                "bookeremailBooking" => $this->input->post(
                    "bookeremailBooking"
                ),
                "bookermobile1Booking" => $this->input->post(
                    "bookermobile1Booking"
                ),
                "ratecodeBooking" => $this->input->post("ratecodeBooking"),
                "totalrateBooking" => intval(
                    str_replace(".", "", $this->input->post("totalrateBooking"))
                ),
                "tagBooking" => $this->input->post("tagBooking"),
                "discountBooking" => $this->input->post("discountBooking"),
                "reasonBooking" => $this->input->post("reasonBooking"),
                "rateafterdiscountBooking" => intval(
                    str_replace(
                        ".",
                        "",
                        $this->input->post("rateafterdiscountBooking")
                    )
                ),
                "splitroomonlyBooking" => $this->input->post(
                    "splitroomonlyBooking",
                    true
                ),
                "latecheckoutchargeBooking" => $this->input->post(
                    "latecheckoutchargeBooking"
                ),
                "commisionBooking" => $this->input->post("commisionBooking"),
                "agentBooking" => $this->input->post("agentBooking"),
                "paymentBooking" => $this->input->post("paymentBooking"),
                "currencyBooking" => $this->input->post("currencyBooking"),
                "creditcardnoBooking" => $this->input->post(
                    "creditcardnoBooking"
                ),
                "validdatethruBooking" => $this->input->post(
                    "validdatethruBooking"
                ),
                "creditlimitBooking" => $this->input->post(
                    "creditlimitBooking"
                ),
                "vouchernoBooking" => $this->input->post("vouchernoBooking"),
                "salespersonBooking" => $this->input->post(
                    "salespersonBooking"
                ),
                "welcomingBooking" => $this->input->post("welcomingBooking"),
                "segmentBooking" => $this->input->post("segmentBooking"),
                "nationalityBooking" => $this->input->post(
                    "nationalityBooking"
                ),
                "originareaBooking" => $this->input->post("originareaBooking"),
                "destinationBooking" => $this->input->post(
                    "destinationBooking"
                ),
                "sourceBooking" => $this->input->post("sourceBooking"),
                "honeymoonBooking" => $this->input->post(
                    "honeymoonBooking",
                    true
                ),
                "cashbasisBooking" => $this->input->post(
                    "cashbasisBooking",
                    true
                ),
                "transactionclosedBooking" => $this->input->post(
                    "transactionclosedBooking",
                    true
                ),
                "noinfoBooking" => $this->input->post("noinfoBooking", true),
                "blockedphoneBooking" => $this->input->post(
                    "blockedphoneBooking",
                    true
                ),
                "flightarriveBooking" => $this->input->post(
                    "flightarriveBooking"
                ),
                "flightdepartBooking" => $this->input->post(
                    "flightdepartBooking"
                ),
                "billinginstructionBooking" => $this->input->post(
                    "billinginstructionBooking"
                ),
                "checkinremarkBooking" => $this->input->post(
                    "checkinremarkBooking"
                ),
                "preferenceBooking" => $this->input->post("preferenceBooking"),
                "statuspayBooking" => "UNPAID",
                "idCustomer" => $this->input->post("idCustomer"),
                "createdAtBooking" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("booking", $data_booking);
            $idKamar = $this->input->post("idKamar");
            $this->db->set("qtyKamar", "qtyKamar - 1", false);
            $this->db->set("soldKamar", "soldKamar + 1", false);
            $data_update_kamar = [
                "idUser" => $this->session->userdata("idUser"),
                "updateAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idKamar", $idKamar);
            $this->db->update("kamar", $data_update_kamar);
            $data_update_nomor_kamar = [
                "idUser" => $this->session->userdata("idUser"),
                "ketNumber" => "VR",
                "updateAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where(
                "nmNumber",
                $this->input->post("numberroomBooking")
            );
            $this->db->update("kamar_number", $data_update_nomor_kamar);
            $this->session->set_flashdata(
                "pesansukses",
                "Booking telah diduplikasi"
            );
            redirect("cms/home/viewBookingCopy/" . $getidBooking . "/");
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata("pesanerror", "Gagal update booking");
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 15,
            ];
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data["kamar"] = $this->Kamar_m->getfile_kamar();
            $data["number"] = $this->Kamar_m->getfile_number($idBusiness);
            $data["company"] = $this->Company_m->getfile_company();
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $idBusiness
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $idBusiness
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
            $data["rateCode"] = $this->Kamar_m->getfile_rate_code($idBusiness);
            $this->load->view("cms/header", $data);
            $this->load->view("cms/view_booking_copy", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function checkoutFormBooking($idBusiness, $idBooking)
    {
        if ($post = $this->input->post("submit")) {
            $data_booking = [
                "statusBooking" => "Checkout",
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_booking);
            $idKamar = $this->input->post("idKamar");
            $arrivalBooking = $this->input->post("arrivalBooking");
            $numberroomBooking = $this->input->post("numberroomBooking");
            $fixPayment = $this->input->post("fixPayment");
            $totalMembership = $this->input->post("totalMembership");
            $expandMember = $fixPayment + $totalMembership;

            $this->Booking_m->updateQtyByidKamar($idKamar, $arrivalBooking);
            $this->Booking_m->updateStatuskamarByNumberRoom(
                $numberroomBooking,
                $idKamar
            );
            $this->db->set("visitMembership", "visitMembership + 1", false);
            $data_membership = [
                "totalMembership" => $expandMember,
                "createdAtMembership" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("membership", $data_membership);
            $nightBooking = $this->input->post("nightBooking");
            $this->session->set_flashdata("pesansukses", "Berhasi checkout");
            redirect("cms/home/viewCheckout");
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata("pesanerror", "Gagal update booking");
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 26,
            ];
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["getidBooking"] = $idBooking;
            $this->load->view("cms/header", $data);
            $this->load->view("cms/view_booking_detail", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function chargeFormBooking($idBusiness, $idBooking)
    {
        if ($post = $this->input->post("submit")) {
            $data_booking = [
                "idUser" => $this->session->userdata("idUser"),
                "departuretimeBooking" => $this->input->post(
                    "departuretimeBooking"
                ),
                "chargeBooking" => $this->input->post("chargeBooking"),
                "ketchargeBooking" => $this->input->post("ketchargeBooking"),
                "editAt" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idBooking", $idBooking);
            $this->db->update("booking", $data_booking);
            $this->session->set_flashdata(
                "pesansukses",
                "Booking telah diupdate"
            );
            redirect("cms/home/viewBookingDetail/" . $idBooking . "/");
        } else {
            if ($this->session->userdata("logged_in") != "login") {
                redirect("login", "refresh");
            }
            $this->session->set_flashdata("pesanerror", "Gagal update booking");
            $data = [
                "title" => "Madani Djourney | ONIXLABS",
                "nopage" => 26,
            ];
            $data[
                "new_invoice_number"
            ] = $this->Kamar_m->generate_invoice_number();
            $data["bookingdetail"] = $this->Booking_m->getfile_booking_by_id(
                $idBooking
            );
            $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
                $this->session->userdata("idBusiness")
            );
            $data["getidBooking"] = $idBooking;
            $this->load->view("cms/header", $data);
            $this->load->view("cms/view_booking_detail", $data);
            $this->load->view("cms/footer", $data);
        }
    }
    public function ajaxCheckExpired()
    {
        // Get expired reservations
        $expired_reservations = $this->Booking_m->get_expired_reservations();
        if (!$expired_reservations) {
            // current datetime
            $current_time = date("Y-m-d H:i:s");
            // Get OR booking
            $will_od_date = $this->Booking_m->get_or_to_od();
            echo json_encode($will_od_date);
        } else {
            $response = $expired_reservations;
            // Update status for expired reservations
            echo json_encode($response);
            foreach ($expired_reservations as $reservation) {
                $this->Booking_m->updateStatusByCheckout(
                    $reservation->idBooking
                );
                $this->Booking_m->updateQtyByidKamar(
                    $reservation->idKamar,
                    $reservation->arrivalBooking
                );
                $this->Booking_m->updateStatuskamarByNumberRoom(
                    $reservation->numberroomBooking,
                    $reservation->idKamar
                );
                $this->Booking_m->insertBookingCheckoutByidBooking(
                    $reservation->idBooking
                );
                // $this->Booking_m->deleteBookingById($reservation->idBooking);
            }
        }
    }
    public function ajaxCheckOccupancy()
    {
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar();
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar();
        // Send a response (if needed)
        echo json_encode($data);
    }
    public function ajaxCheckOccupancy_byDate_arrival($arrival)
    {
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_arrival($arrival);
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival($arrival);
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar_arrival(
            $arrival
        );
        // Send a response (if needed)
        echo json_encode($data);
    }
    public function viewCheckout()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 39,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["booking"] = $this->Booking_m->getfile_booking_checkout();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_checkout", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewRoomAttendantFO()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 28,
        ];
        $data[
            "roomattendant_all"
        ] = $this->Housekeeping_m->getfile_roomattendant_all();
        $data[
            "roomattendant_or"
        ] = $this->Housekeeping_m->getfile_roomattendant_or();
        $data[
            "roomattendant_od"
        ] = $this->Housekeeping_m->getfile_roomattendant_od();
        $data[
            "roomattendant_oc"
        ] = $this->Housekeeping_m->getfile_roomattendant_oc();
        $data[
            "roomattendant_ed"
        ] = $this->Housekeeping_m->getfile_roomattendant_ed();
        $data[
            "roomattendant_vd"
        ] = $this->Housekeeping_m->getfile_roomattendant_vd();
        $data[
            "roomattendant_vc"
        ] = $this->Housekeeping_m->getfile_roomattendant_vc();
        $data[
            "roomattendant_vr"
        ] = $this->Housekeeping_m->getfile_roomattendant_vr();
        $data[
            "roomattendant_oo"
        ] = $this->Housekeeping_m->getfile_roomattendant_oo();
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_roomattendant_fo", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateRoomStatusFO($nmNumber)
    {
        $data_update_nomor_kamar = [
            "idUser" => $this->session->userdata("idUser"),
            "ketNumber" => $this->input->post("ketNumber"),
            "updateAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("nmNumber", $nmNumber);
        $this->db->update("kamar_number", $data_update_nomor_kamar);
        $this->session->set_flashdata("pesansukses", "Status telah disimpan");
        redirect("cms/home/viewRoomAttendantFO/");
    }
    public function ajaxPaketMember($nmPaketmember)
    {
        $data["member"] = $this->Kamar_m->getfile_kamar_by_member(
            $nmPaketmember
        );
        if (!$data["member"]) {
            $response = [
                "idPaketmember" => "",
                "nmPaketmember" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["member"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewRateStructure($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["rate_structure"] = $this->Home_m->getfile_rate_structure(
            $idBusiness
        );
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $idBusiness
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $idBusiness
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar($idBusiness);
        $data["idBusiness"] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_rate_structure", $data);
        $this->load->view("cms/footer");
    }
    public function insertRateCode()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 37,
        ];
        $ketKamar = explode(", ", $this->input->post("ketKamar"));
        $hargaROKamar = explode(
            ", ",
            intval(str_replace(",", "", $this->input->post("roOccupancy")))
        );
        $hargaRBKamar = explode(
            ", ",
            intval(str_replace(",", "", $this->input->post("rbOccupancy")))
        );
        $beginRatecode = $this->input->post("beginRatecode");
        $endRatecode = $this->input->post("endRatecode");

        $date = strtotime($this->input->post("beginRatecode"));
        $lastDate = strtotime($this->input->post("endRatecode"));
        $data = [];
        while ($date <= $lastDate) {
            for ($i = 0; $i < count($ketKamar); $i++) {
                $data[] = [
                    "ketKamar" => $ketKamar[$i],
                    "hargaROKamar" => $hargaROKamar[$i],
                    "hargaRBKamar" => $hargaRBKamar[$i],
                    "idBusiness" => $this->input->post("idBusiness"),
                    "idUser" => $this->session->userdata("idUser"),
                ];
            }
            // Increment date by one day for the next iteration
            $date = strtotime("+1 day", $date);
        }
        foreach ($data as $row) {
            $this->Kamar_m->overwrite_kamar(
                $row,
                $ketKamar[0],
                $beginRatecode,
                $endRatecode
            );
        }
        $data_occupancy = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->input->post("idBusiness"),
            "idKamar" => $ketKamar[0],
            "idType" => $ketKamar[0],
            "lvlOccupancy" => $this->input->post("lvlOccupancy"),
            "dscOccupancy" => $this->input->post("dscOccupancy"),
            "roOccupancy" => $hargaROKamar[0],
            "rbOccupancy" => $hargaRBKamar[0],
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("occupancy", $data_occupancy);
        $idOccupancy = $this->db->insert_id();
        $data_rate_code = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->input->post("idBusiness"),
            "idOccupancy" => $idOccupancy,
            "idKamar" => $ketKamar[0],
            "nmRatecode" => $this->input->post("nmRatecode"),
            "beginRatecode" => $beginRatecode,
            "endRatecode" => $endRatecode,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("rate_code", $data_rate_code);
        $this->session->set_flashdata(
            "pesansukses",
            "Rate Code Berhasil dibuat"
        );
        redirect("cms/home/viewRateStructure");
    }
    public function updateAllotmentByDate($idBusiness)
    {
        // Get posted data from form
        $ketKamar = $this->input->post("ketKamar");
        $beginDate = $this->input->post("beginDateKamar");
        $endDate = $this->input->post("endDateKamar");
        $qtyKamar = $this->input->post("qtyKamar");

        // Convert date strings to timestamps for iteration
        $date = strtotime($beginDate);
        $lastDate = strtotime($endDate);

        // Prepare data array to insert or update for each day in the date range
        while ($date <= $lastDate) {
            $currentDate = date("Y-m-d", $date);

            // Prepare data array
            $data = [
                "ketKamar" => $ketKamar,
                "qtyKamar" => $qtyKamar,
                "idBusiness" => $idBusiness,
                "dateKamar" => $currentDate,
                "idUser" => $this->session->userdata("idUser"),
                "createdAtKamar" => date("Y-m-d H:i:s"),
                "updateAt" => date("Y-m-d H:i:s"),
            ];

            // Check if record already exists for the current date and room type
            $this->db->from("kamar_all");
            $this->db->where("ketKamar", $ketKamar);
            $this->db->where("dateKamar", $currentDate);
            $existingRecord = $this->db->get();

            if ($existingRecord->num_rows() > 0) {
                // If record exists, update it
                $this->db->where("ketKamar", $ketKamar);
                $this->db->where("dateKamar", $currentDate);
                $this->db->update("kamar_all", $data);
            } else {
                // If record does not exist, insert it
                $this->db->insert("kamar_all", $data);
            }

            // Move to the next day
            $date = strtotime("+1 day", $date);
        }

        // Set success message and redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Allotment berhasil diperbarui untuk rentang tanggal yang dipilih."
        );
        redirect("cms/home/viewKamar/" . $idBusiness . "/");
    }
    public function updateRateCode()
    {
        $idOccupancy = $this->input->post("idOccupancy");
        $idRatecode = $this->input->post("idRatecode");
        $nmRatecode = $this->input->post("nmRatecode");
        $ketKamar = explode(", ", $this->input->post("ketKamar"));
        $hargaROKamar = explode(
            ", ",
            intval(str_replace(",", "", $this->input->post("roOccupancy")))
        );
        $hargaRBKamar = explode(
            ", ",
            intval(str_replace(",", "", $this->input->post("rbOccupancy")))
        );
        $beginRatecode = $this->input->post("beginRatecode");
        $endRatecode = $this->input->post("endRatecode");
        $date = strtotime($this->input->post("beginRatecode"));
        $lastDate = strtotime($this->input->post("endRatecode"));
        $data = [];
        while ($date <= $lastDate) {
            for ($i = 0; $i < count($ketKamar); $i++) {
                $data[] = [
                    "ketKamar" => $ketKamar[$i],
                    "hargaROKamar" => $hargaROKamar[$i],
                    "hargaRBKamar" => $hargaRBKamar[$i],
                    "idBusiness" => $this->input->post("idBusiness"),
                    "idUser" => $this->session->userdata("idUser"),
                ];
            }
            // Increment date by one day for the next iteration
            $date = strtotime("+1 day", $date);
        }
        foreach ($data as $row) {
            $this->Kamar_m->overwrite_kamar(
                $row,
                $ketKamar[0],
                $beginRatecode,
                $endRatecode
            );
        }
        $data_occupancy = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->input->post("idBusiness"),
            "lvlOccupancy" => $this->input->post("lvlOccupancy"),
            "dscOccupancy" => $this->input->post("dscOccupancy"),
            "roOccupancy" => $hargaROKamar[0],
            "rbOccupancy" => $hargaRBKamar[0],
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idOccupancy", $idOccupancy);
        $this->db->update("occupancy", $data_occupancy);
        $data_rate_code = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->input->post("idBusiness"),
            "nmRatecode" => $nmRatecode,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idRatecode", $idRatecode);
        $this->db->update("rate_code", $data_rate_code);
        $this->session->set_flashdata(
            "pesansukses",
            "Rate Code " . $nmRatecode . " Berhasil diupdate"
        );
        redirect("cms/home/viewRateStructure");
    }
    public function ajaxVisitMember()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 23,
        ];
        $IDNumber = $this->input->post("IDNumber");
        $data["customer"] = $this->Customer_m->getfile_visit_by_IDNumber(
            $IDNumber
        );
        if (!$data["customer"]) {
            $response = 0;
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["customer"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxMembership()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 23,
        ];
        $data["customer"] = $this->Customer_m->getfile_membership(
            $this->session->userdata("idBusiness")
        );
        if (!$data["customer"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["customer"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function insertMemberRoom()
    {
        $noBookingroommember = $this->input->post("nomor");
        $nmBookingroommember = $this->input->post("member");
        $data_update_nomor_member = [
            "nmBookingroommember" => $nmBookingroommember,
            "noBookingroommember" => $noBookingroommember,
        ];
        $this->db->where("noBookingroommember", $noBookingroommember);
        $this->db->update("booking_room_member", $data_update_nomor_member);
        echo json_encode($data_update_nomor_member, JSON_NUMERIC_CHECK);
    }
    public function ajaxSortMember($new_invoice_number, $idType)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 23,
        ];
        $data["member"] = $this->Customer_m->getfile_sort_member(
            $new_invoice_number,
            $idType
        );
        if (!$data["member"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["member"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewMonthlyBudget()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_monthly_budget", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertMonthlyBudget()
    {
        $data_budget = [
            "nmSegment" => $this->input->post("segmentBudget"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "yearBudget" => date("Y"),
            "janBudget" => $this->input->post("janBudget"),
            "febBudget" => $this->input->post("janBudget"),
            "marBudget" => $this->input->post("janBudget"),
            "aprBudget" => $this->input->post("janBudget"),
            "mayBudget" => $this->input->post("janBudget"),
            "junBudget" => $this->input->post("janBudget"),
            "julBudget" => $this->input->post("janBudget"),
            "augBudget" => $this->input->post("janBudget"),
            "sepBudget" => $this->input->post("janBudget"),
            "octBudget" => $this->input->post("janBudget"),
            "novBudget" => $this->input->post("janBudget"),
            "decBudget" => $this->input->post("janBudget"),
            "totalBudget" => $this->input->post("janBudget") * 12,
            "idUser" => $this->session->userdata("idUser"),
            "createdAtBudget" => date("Y-m-d"),
        ];
        $this->db->insert("budget", $data_budget);
        $this->session->set_flashdata(
            "pesansukses",
            "Budget Berhasil diupdate"
        );
        redirect("cms/home/viewMonthlyBudget");
    }
    public function updateMonthlyBudget()
    {
        $data_budget = [
            "nmSegment" => $this->input->post("segmentBudget"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "yearBudget" => date("Y"),
            "janBudget" => $this->input->post("janBudget"),
            "febBudget" => $this->input->post("febBudget"),
            "marBudget" => $this->input->post("marBudget"),
            "aprBudget" => $this->input->post("aprBudget"),
            "mayBudget" => $this->input->post("mayBudget"),
            "junBudget" => $this->input->post("junBudget"),
            "julBudget" => $this->input->post("julBudget"),
            "augBudget" => $this->input->post("augBudget"),
            "sepBudget" => $this->input->post("sepBudget"),
            "octBudget" => $this->input->post("octBudget"),
            "novBudget" => $this->input->post("novBudget"),
            "decBudget" => $this->input->post("decBudget"),
            "totalBudget" =>
                $this->input->post("janBudget") +
                $this->input->post("febBudget") +
                $this->input->post("marBudget") +
                $this->input->post("aprBudget") +
                $this->input->post("mayBudget") +
                $this->input->post("junBudget") +
                $this->input->post("julBudget") +
                $this->input->post("augBudget") +
                $this->input->post("sepBudget") +
                $this->input->post("octBudget") +
                $this->input->post("novBudget") +
                $this->input->post("decBudget"),
            "idUser" => $this->session->userdata("idUser"),
            "createdAtBudget" => date("Y-m-d"),
        ];
        $this->db->where("nmSegment", $this->input->post("segmentBudget"));
        $this->db->update("budget", $data_budget);
        $this->session->set_flashdata(
            "pesansukses",
            "Budget Berhasil diupdate"
        );
        redirect("cms/home/viewMonthlyBudget");
    }
    public function viewMembership()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_membership", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxDeleteRate()
    {
        $idRatecode = $this->input->post("idRatecode");
        $this->db->where("idRatecode", $idRatecode);
        $this->db->delete("rate_code");
        echo json_encode(1);
    }
    public function ajaxPembayaranAll()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $start_date = $this->input->post("startDate");
        $end_date = $this->input->post("endDate");
        $idBusiness = $this->input->post("idBusiness");
        $data["pembayaran"] = $this->Home_m->getfile_pembayaranALL(
            $start_date,
            $end_date,
            $idBusiness
        );
        if (!$data["pembayaran"]) {
            $response = $data["pembayaran"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["pembayaran"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxInvoiceTemp()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $start_date = $this->input->post("startDate");
        $end_date = $this->input->post("endDate");
        $idBusiness = $this->input->post("idBusiness");
        $data["pembayaran"] = $this->Home_m->getfile_InvoiceTemp(
            $start_date,
            $end_date,
            $idBusiness
        );
        if (!$data["pembayaran"]) {
            $response = $data["pembayaran"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["pembayaran"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxORtoOD()
    {
        $arrivalBooking = $this->input->post("arrivalBooking");
        $numberroomBooking = $this->input->post("number");
        $idKamar = $this->input->post("idKamar");
        $ketNumber = $this->input->post("ketNumber");
        $datenow = $this->input->post("datenow");
        $odTime = $this->input->post("odTime");
        $idNumber = $this->input->post("idNumber");
        $data_kamar_number = [
            "nmNumber" => $numberroomBooking,
            "ketNumber" => "OD",
            "updateAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idNumber", $idNumber);
        $this->db->update("kamar_number", $data_kamar_number);
        $data_insert_hk_room_attendant = [
            "idUser" => "AUTO",
            "idBusiness" => $this->session->userdata("idBusiness"),
            "roomAttendant" => $numberroomBooking,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $this->db->update("hk_room_attendant", $data_insert_hk_room_attendant);
        echo json_encode($data_kamar_number);
    }
    public function ajaxPostPembayaran()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $idBusinessInput = $this->input->post("idBusiness");
        $idBusiness =
            isset($idBusinessInput) && $idBusinessInput != null
                ? $idBusinessInput
                : $this->session->userdata("idBusiness");
        $data["finance"] = $this->Home_m->getfile_PostPembayaran($idBusiness);
        if (!$data["finance"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["finance"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxUpdateStatusInvoice()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $idInvoice = $this->input->post("idInvoice");
        $data["updateInvoice"] = $this->Home_m->getfile_UpdatePembayaran(
            $idInvoice
        );
        if (!$data["updateInvoice"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["updateInvoice"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewInventory()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["inventory"] = $this->Home_m->getfile_inventory();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_inventory", $data);
        $this->load->view("cms/footer");
    }
    public function viewInventoryType()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["inventory_type"] = $this->Home_m->getfile_inventory_type();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_inventory_type", $data);
        $this->load->view("cms/footer");
    }
    public function insertInventory()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data_inventori = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "typeInventori" => $this->input->post("typeInventori"),
            "nmInventori" => $this->input->post("nmInventori"),
            "merkInventori" => $this->input->post("merkInventori"),
            "satuanInventori" => $this->input->post("satuanInventori"),
            "nettInventori" => $this->input->post("nettInventori"),
            "qtyInventori" => $this->input->post("qtyInventori"),
            "createdAtInventori" => date("Y-m-d"),
        ];
        $this->db->insert("pengadaan_inventori", $data_inventori);
        $this->session->set_flashdata(
            "pesansukses",
            "Inventory Berhasil ditambahkan"
        );
        redirect("cms/home/viewInventory");
    }
    public function insertInventoryType()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data_inventori_type = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "typeInventoritype" => $this->input->post("typeInventoritype"),
            "createdAtInventoritype" => date("Y-m-d"),
        ];
        $this->db->insert("pengadaan_inventori_type", $data_inventori_type);
        $this->session->set_flashdata(
            "pesansukses",
            "Inventory Berhasil ditambahkan"
        );
        redirect("cms/home/viewInventoryType");
    }
    public function viewCompany()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["company"] = $this->Company_m->getfile_company();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_company", $data);
        $this->load->view("cms/footer");
    }
    public function insertCompany()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data_company = [
            "idBusiness" => $this->session->userdata("idBusiness"),
            "nmCompany" => $this->input->post("nmCompany"),
            "ketCompany" => $this->input->post("ketCompany"),
            "code" => $this->input->post("code"),
            "sales" => $this->input->post("sales"),
            "area" => $this->input->post("area"),
            "type" => $this->input->post("type"),
            "createdAtCompany" => date("Y-m-d"),
        ];
        $this->db->insert("company", $data_company);
        $this->session->set_flashdata(
            "pesansukses",
            "Company Berhasil diinsert"
        );
        redirect("cms/home/viewCompany");
    }
    public function viewCompanyMember()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data["company_member"] = $this->Company_m->getfile_company_member();
        $data["availableRoom"] = $this->Kamar_m->getfile_available_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["bookingRoom"] = $this->Kamar_m->getfile_booking_kamar(
            $this->session->userdata("idBusiness")
        );
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar(
            $this->session->userdata("idBusiness")
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_company_member", $data);
        $this->load->view("cms/footer");
    }
    public function insertCompanyMember()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data_company = [
            "idUser" => $this->session->userdata("idUser"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "idCompany" => $this->input->post("idCompany"),
            "nmCompanymember" => $this->input->post("nmCompanymember"),
            "createdAtCompanymember" => date("Y-m-d"),
        ];
        $this->db->insert("company_member", $data_company);
        $this->session->set_flashdata(
            "pesansukses",
            "Company Member Berhasil diinsert"
        );
        redirect("cms/home/viewCompanyMember");
    }
    public function viewInvestmentFIT($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["investments"] = $this->Home_m->getfile_investment_FIT(
            $idBusiness
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_investment_fit", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewInvestmentOTA($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["investments"] = $this->Home_m->getfile_investment_OTA(
            $idBusiness
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_investment_ota", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertInvestment()
    {
        $investments = $this->Home_m->getfile_investment_on();
        // Update the last row with 'on' status to 'expired'
        $lastInvestment = end($investments);
        $data_investment_expired = [
            "statusInvestment" => "expired",
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idInvestment", $lastInvestment->idInvestment);
        $this->db->update("investment", $data_investment_expired);
        echo json_encode([
            "data_investment_expired" => $data_investment_expired,
        ]);
        // Calculate the sum of totalInvestment values
        $totalInvestmentSum = 0;
        foreach ($investments as $investment) {
            $totalInvestmentSum += $investment->totalInvestment;
        }
        $data_investment_add = [
            "nmSegment" => $this->input->post("segmentInvestment"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "dateInvestment" => $this->input->post("dateInvestment"),
            "agreementInvestment" => str_replace(
                ",",
                "",
                $this->input->post("agreementInvestment")
            ),
            "totalInvestment" =>
                $totalInvestmentSum +
                str_replace(",", "", $this->input->post("debitInvestment")),
            "debitInvestment" =>
                $totalInvestmentSum +
                str_replace(",", "", $this->input->post("debitInvestment")),
            "statusInvestment" => "on",
            "ketInvestment" => "INVEST ADD",
            "idUser" => $this->session->userdata("idUser"),
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("investment", $data_investment_add);
        echo json_encode(["data_investment_add" => $data_investment_add]);
        $this->session->set_flashdata(
            "pesansukses",
            "Investment Berhasil diupdate"
        );
        redirect(
            "cms/home/viewInvestmentFIT/" .
                $this->session->userdata("idBusiness") .
                "/"
        );
    }
    public function insertInvestment_ota()
    {
        $investments = $this->Home_m->getfile_investment_on();
        // Update the last row with 'on' status to 'expired'
        $lastInvestment = end($investments);
        $data_investment_expired = [
            "statusInvestment" => "expired",
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idInvestment", $lastInvestment->idInvestment);
        $this->db->update("investment", $data_investment_expired);
        echo json_encode([
            "data_investment_expired" => $data_investment_expired,
        ]);
        // Calculate the sum of totalInvestment values
        $totalInvestmentSum = 0;
        foreach ($investments as $investment) {
            $totalInvestmentSum += $investment->totalInvestment;
        }
        $data_investment_add = [
            "nmSegment" => $this->input->post("segmentInvestment"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "dateInvestment" => $this->input->post("dateInvestment"),
            "agreementInvestment" => str_replace(
                ",",
                "",
                $this->input->post("agreementInvestment")
            ),
            "totalInvestment" =>
                $totalInvestmentSum +
                str_replace(",", "", $this->input->post("debitInvestment")),
            "debitInvestment" =>
                $totalInvestmentSum +
                str_replace(",", "", $this->input->post("debitInvestment")),
            "statusInvestment" => "on",
            "ketInvestment" => "INVEST ADD",
            "idUser" => $this->session->userdata("idUser"),
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("investment", $data_investment_add);
        echo json_encode(["data_investment_add" => $data_investment_add]);
        $this->session->set_flashdata(
            "pesansukses",
            "Investment Berhasil diupdate"
        );
        redirect(
            "cms/home/viewInvestmentOTA/" .
                $this->session->userdata("idBusiness") .
                "/"
        );
    }
    public function updateInvestment()
    {
        $idInvestment = $this->input->post("idInvestment");
        $data_investment = [
            "nmSegment" => $this->input->post("segmentInvestment"),
            "idBusiness" => $this->session->userdata("idBusiness"),
            "dateInvestment" => date("Y"),
            "dateInvestment" => $this->input->post("dateInvestment"),
            "debitInvestment" => $this->input->post("totalInvestment"),
            "idUser" => $this->session->userdata("idUser"),
            "createdAtInvestment" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idInvestment", $idInvestment);
        $this->db->update("investment", $data_investment);
        $this->session->set_flashdata(
            "pesansukses",
            "Investment Berhasil diupdate"
        );
        redirect("cms/home/viewInvestment");
    }
    public function viewADP($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        // $idBusiness = isset($idBusiness) ? $idBusiness : $this->session->userdata('idBusiness');
        $data["idBusiness"] = $idBusiness;
        $data["new_invoice_number"] = $this->Kamar_m->generate_invoice_number();
        $data[
            "availableRoom"
        ] = $this->Kamar_m->getfile_available_kamar_arrival_by_id_business(
            $idBusiness
        );
        $data[
            "bookingRoom"
        ] = $this->Kamar_m->getfile_booking_kamar_by_business_id($idBusiness);
        $data["sumRoom"] = $this->Kamar_m->getfile_sum_kamar_by_id_business(
            $idBusiness
        );
        // Get the current month's first and last day
        $firstDayThisMonthBudget = date("Y-m-01");
        $lastDayThisMonthBudget = date("Y-m-t");
        // Calculate total kredit for FIT segment and current month
        $data["debitInvestmentFITmtd"] = $this->Home_m->calculateTotalDebitFIT(
            $idBusiness,
            "FIT",
            $firstDayThisMonthBudget,
            $lastDayThisMonthBudget
        );
        // Calculate total budget for FIT segment and current month
        $data["totalInvestmentFITmtd"] = $this->Home_m->calculateTotalBudgetFIT(
            $idBusiness,
            "FIT",
            $firstDayThisMonthBudget,
            $lastDayThisMonthBudget
        );
        // Calculate total kredit for OTA segment and current month
        $data["debitInvestmentOTAmtd"] = $this->Home_m->calculateTotalDebitOTA(
            $idBusiness,
            "OTA",
            $firstDayThisMonthBudget,
            $lastDayThisMonthBudget
        );
        // Calculate total budget for OTA segment and current month
        $data["totalInvestmentOTAmtd"] = $this->Home_m->calculateTotalBudgetOTA(
            $idBusiness,
            "OTA",
            $firstDayThisMonthBudget,
            $lastDayThisMonthBudget
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_adp", $data);
        $this->load->view("cms/footer", $data);
    }
    public function sendToAdp()
    {
        $idBusiness = $this->input->post("idBusiness");
        $idInvestment = $this->input->post("idInvestment");
        $idInvoice = $this->input->post("idInvoice");
        $priceInvoice = $this->input->post("priceInvoice");
        $current_investment = 0;
        $get_totalInvestment = $this->Home_m->getfile_total_investment(
            $idBusiness
        );
        $current_investment = $get_totalInvestment - $priceInvoice;
        if ($get_totalInvestment < $priceInvoice) {
            echo json_encode([
                "status" => "Gagal",
                "keterangan" =>
                    "Saldo investment kurang dari total pembayaran.",
            ]);
        } elseif ($current_investment <= 0) {
            $data_invoice = [
                "adpInvoice" => 1,
            ];
            $this->db->where("idInvoice", $idInvoice);
            $this->db->update("invoice", $data_invoice);
            $this->session->set_flashdata(
                "pesansukses",
                "ID Invoice " . $idInvoice . " Berhasil terkirim ke ADP"
            );
            echo json_encode(["idInvoice" => $idInvoice]);
            $data_investment_expired = [
                "statusInvestment" => "expired",
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idInvestment", $idInvestment);
            $this->db->update("investment", $data_investment_expired);
            echo json_encode([
                "data_investment_expired" => $data_investment_expired,
            ]);
        } else {
            // SEND TO ADP
            $data_invoice = [
                "adpInvoice" => 1,
            ];
            $this->db->where("idInvoice", $idInvoice);
            $this->db->update("invoice", $data_invoice);
            // AFTER SEND TO ADP
            $investments = $this->Home_m->getfile_investment_on($idBusiness);
            // Update the last row with 'on' status to 'expired'
            $lastInvestment = end($investments);
            $data_investment_expired = [
                "statusInvestment" => "expired",
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("idInvestment", $lastInvestment->idInvestment);
            $this->db->update("investment", $data_investment_expired);
            // echo json_encode(array('data_investment_expired' => $data_investment_expired));
            // Calculate the sum of totalInvestment values
            $totalInvestmentSum = 0;
            $totalagreementInvest = 0;
            foreach ($investments as $investment) {
                $totalInvestmentSum += $investment->totalInvestment;
                $totalagreementInvest = $investment->agreementInvestment;
            }
            $data_investment_add = [
                "nmSegment" => "FIT",
                "idBusiness" => $idBusiness,
                "dateInvestment" => date("Y"),
                "agreementInvestment" => $totalagreementInvest,
                "kreditInvestment" => $priceInvoice,
                "totalInvestment" => $current_investment,
                "statusInvestment" => "on",
                "ketInvestment" => "CONFIRMED INVOICE " . $idInvoice,
                "idUser" => $this->session->userdata("idUser"),
                "createdAtInvestment" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("investment", $data_investment_add);
            $this->session->set_flashdata(
                "pesansukses",
                "ID Invoice " . $idInvoice . " Berhasil terkirim ke ADP"
            );
            echo json_encode([
                "get_totalInvestment" => $get_totalInvestment,
                "data_investment" => $data_investment_add,
            ]);
        }
    }
    public function ajaxgetchartdata_adp($idBusiness)
    {
        $data = $this->Home_m->fetchChartData_adp($idBusiness);
        echo json_encode($data);
    }
    public function ajaxgetchartdata_adp_ota($idBusiness)
    {
        $data = $this->Home_m->fetchChartData_adp_ota($idBusiness);
        echo json_encode($data);
    }
    public function viewReport($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["investments"] = $this->Home_m->getfile_investment_FIT(
            $idBusiness
        );
        $data["idBusiness"] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_report", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxReport($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $start_date = $this->input->post("startDateReport");
        $end_date = $this->input->post("endDateReport");
        $data["report"] = $this->Home_m->getfile_Report(
            $start_date,
            $end_date,
            $idBusiness
        );
        if (!$data["report"]) {
            $response = $data["report"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["report"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewFnbDashboard($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("session");
        $data["idBusiness"] = $idBusiness;
        $data["fnbSchedule"] = $this->Fnb_m->getFnbSchedule($idBusiness);
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_fnbmenu_dashboard", $data);
        $this->load->view("cms/footer");
    }
    public function insertFnbSchedule()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = $this->session->userdata("idBusiness");
        $date = $this->input->post("date");
        $openTime = $this->input->post("openTime");
        $closeTime = $this->input->post("closeTime");
        $close = $this->input->post("close");
        $data_menu = [
            "idBusiness" => $idBusiness,
            "closeTime" => $openTime,
            "openTime" => $closeTime,
            "date" => $date,
            "close" => $close,
        ];
    }
    public function viewFnbMenuType($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["idBusiness"] = $idBusiness;
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type($idBusiness);
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_fnbmenu_type", $data);
        $this->load->view("cms/footer");
    }
    public function updateMenuOrder() {
        $order = $this->input->post('order');
        
        if (!empty($order)) {
            $this->Fnb_m->updateMenuOrder($order);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    public function updateIsActive() {
        $idMenuType = $this->input->post('idMenuType');

        // Set semua isActive ke 0 terlebih dahulu
        $this->db->update('fnb_menu_type', ['isActive' => 0]);

        // Set yang dipilih menjadi 1
        $this->db->where('idMenuType', $idMenuType);
        $this->db->update('fnb_menu_type', ['isActive' => 1]);

        echo json_encode(['status' => 'success']);
    }
    public function inputFnbMenuType($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["idBusiness"] = $idBusiness;
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type($idBusiness);
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_fnbmenu_type", $data);
        $this->load->view("cms/footer");
    }
    public function deleteMenuType()
    {
        $idMenuType = $this->input->post("idMenuType");
        $this->db->where("idMenuType", $idMenuType);
        $this->db->delete("fnb_menu_type");
        echo json_encode(1);
    }
    public function deleteMenu()
    {
        $idMenu = $this->input->post("idMenu");
        $this->db->where("idMenu", $idMenu);
        $this->db->delete("fnb_menu");
        echo json_encode(1);
    }
    public function detailFnbMenuType($idMenuType)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type_by_id(
            $idMenuType
        );
        $data["idBusiness"] = $data["fnbMenuType"]->idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_fnbmenu_type", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewFnBmenu($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $idBusiness = isset($idBusiness)
            ? $idBusiness
            : $this->session->userdata("idBusiness");
        $data["idBusiness"] = $idBusiness;
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu_by_id_business(
            $idBusiness
        );
        $data["fnbDetail"] = $this->db
            ->get_where("fnb_detail", ["idBusiness" => $idBusiness])
            ->row();
        $data[
            "fnbMenuHistory"
        ] = $this->Fnb_m->getfile_fnb_menu_history_by_id_business($idBusiness);
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_fnbmenu", $data);
        $this->load->view("cms/footer");
    }
    public function inputFnbMenu($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $data["idBusiness"] = $idBusiness;
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type($idBusiness);
        // $data['bookingRoom'] = $this->Kamar_m->getfile_booking_kamar($this->session->userdata('idBusiness'));
        // $data['sumRoom'] = $this->Kamar_m->getfile_sum_kamar($this->session->userdata('idBusiness'));
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_fnbmenu", $data);
        $this->load->view("cms/footer", $data);
    }
    public function detailFnbMenu($idMenu)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu_by_id($idMenu);
        $data["idBusiness"] = $data["fnbMenu"]->idBusiness;
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type(
            $data["idBusiness"]
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_fnbmenu_edit", $data);
        $this->load->view("cms/footer", $data);
    }
    public function detailFnbMenuImg($idMenu)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu_by_id($idMenu);
        $data["idBusiness"] = $data["fnbMenu"]->idBusiness;
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type(
            $data["idBusiness"]
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_fnbmenu_edit_img", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertFnbMenuType()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $idMenu = $this->input->post("idMenuType");
        $name = $this->input->post("name");
        $idBusiness = $this->input->post("idBusiness");
        $displayName = $this->input->post("displayName");
        if (!$idBusiness) {
            $idBusiness = $this->session->userdata("idBusiness");
        }
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $config["upload_path"] = "./assets/images/menu/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("imgCategory")) {
            $uploadData = $this->upload->data();
            // Generate a unique file name
            $uniqueFileName = time() . "_" . $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            $data_menu = [
                "idMenuType" => $idMenu,
                "name" => $name,
                "idBusiness" => $idBusiness,
                "displayName" => $displayName,
                "imgCategory" => "assets/images/menu/" . $uniqueFileName,
            ];
        } else {
            $data_menu = [
                "idMenuType" => $idMenu,
                "name" => $name,
                "idBusiness" => $idBusiness,
                "displayName" => $displayName,
            ];
        }
        $inserted_id = $idMenu;
        if (isset($idMenu) && $idMenu != "") {
            // idMenu exists, update the record
            $this->db->where("idMenuType", $idMenu);
            $this->db->update("fnb_menu_type", $data_menu);
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil diupdate"
            );
        } else {
            $this->db->insert("fnb_menu_type", $data_menu);
            $inserted_id = $this->db->insert_id();
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil ditambah"
            );
        }
        redirect("cms/home/viewFnBmenuType/" . $idBusiness . "/");
    }
    public function insertFnbMenu()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $idMenu = $this->input->post("idMenu");
        $idBusiness = $this->input->post("idBusiness");
        $name = $this->input->post("nmMenu");
        $description = $this->input->post("description");
        $price = $this->input->post("priceMenu");
        $type = $this->input->post("typeMenu");
        $stock = $this->input->post("stockMenu");
        $pictureUrl = $this->input->post("photoPath");
        if (strpos($pictureUrl, "/assets/images/menu/") !== 0) {
            $pictureUrl =
                "/assets/images/menu/" . $this->input->post("photoPath");
        }
        $data_menu = [
            "idMenu" => $idMenu,
            "idUser" => $this->session->userdata("idUser"),
            "nmMenu" => $name,
            "description" => $description,
            "pictureUrlMenu" => $pictureUrl,
            "priceMenu" => $price,
            "typeMenu" => $type,
            "stockMenu" => $stock,
            "idBusiness" => $idBusiness,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $inserted_id = $idMenu;
        if (isset($idMenu) && $idMenu != "") {
            // idMenu exists, update the record
            $this->db->where("idMenu", $idMenu);
            $this->db->update("fnb_menu", $data_menu);
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil diupdate"
            );
        } else {
            $this->db->insert("fnb_menu", $data_menu);
            $inserted_id = $this->db->insert_id();
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil ditambah"
            );
        }
        // save history
        if (!isset($idMenu)) {
            $data_menu["idMenu"] = $inserted_id;
            // Check if the picture Url is updated or not, if not use latest data as history
            if (!isset($pictureUrl)) {
                $fnb = $this->Fnb_m->getfile_fnb_menu_by_id($idMenu);
                $data_menu["pictureUrlMenu"] = $fnb->pictureUrlMenu;
            }
        }
        $data_menu["description"] = "updated data by cms system";
        $this->db->insert("fnb_menu_history", $data_menu);
        redirect("cms/home/inputFnbMenu/" . $idBusiness . "/");
    }
    public function updateFnbMenu()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $idMenu = $this->input->post("idMenu");
        $idBusiness = $this->input->post("idBusiness");
        $name = $this->input->post("nmMenu");
        $description = $this->input->post("description");
        $price = $this->input->post("priceMenu");
        $type = $this->input->post("typeMenu");
        $stock = $this->input->post("stockMenu");
        $data_menu = [
            "idMenu" => $idMenu,
            "idUser" => $this->session->userdata("idUser"),
            "nmMenu" => $name,
            "description" => $description,
            "priceMenu" => $price,
            "typeMenu" => $type,
            "stockMenu" => $stock,
            "idBusiness" => $idBusiness,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $inserted_id = $idMenu;
        if (isset($idMenu) && $idMenu != "") {
            // idMenu exists, update the record
            $this->db->where("idMenu", $idMenu);
            $this->db->update("fnb_menu", $data_menu);
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil diupdate"
            );
        } else {
            $this->db->insert("fnb_menu", $data_menu);
            $inserted_id = $this->db->insert_id();
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil ditambah"
            );
        }
        // save history
        if (!isset($idMenu)) {
            $data_menu["idMenu"] = $inserted_id;
        }
        $data_menu["description"] = "updated data by cms system";
        $this->db->insert("fnb_menu_history", $data_menu);
        redirect("cms/home/inputFnbMenu/" . $idBusiness . "/");
    }
    public function updateFnbMenuImg()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $idMenu = $this->input->post("idMenu");
        $idBusiness = $this->input->post("idBusiness");
        $pictureUrl = $this->input->post("photoPath");
        if (strpos($pictureUrl, "/assets/images/menu/") !== 0) {
            $pictureUrl =
                "/assets/images/menu/" . $this->input->post("photoPath");
        }
        $data_menu = [
            "idMenu" => $idMenu,
            "idUser" => $this->session->userdata("idUser"),
            "pictureUrlMenu" => $pictureUrl,
            "idBusiness" => $idBusiness,
            "createdAt" => date("Y-m-d H:i:s"),
        ];
        $inserted_id = $idMenu;
        if (isset($idMenu) && $idMenu != "") {
            // idMenu exists, update the record
            $this->db->where("idMenu", $idMenu);
            $this->db->update("fnb_menu", $data_menu);
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil diupdate"
            );
        } else {
            $this->db->insert("fnb_menu", $data_menu);
            $inserted_id = $this->db->insert_id();
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil ditambah"
            );
        }
        // save history
        if (!isset($idMenu)) {
            $data_menu["idMenu"] = $inserted_id;
            // Check if the picture Url is updated or not, if not use latest data as history
            if (!isset($pictureUrl)) {
                $fnb = $this->Fnb_m->getfile_fnb_menu_by_id($idMenu);
                $data_menu["pictureUrlMenu"] = $fnb->pictureUrlMenu;
            }
        }
        $data_menu["description"] = "updated data by cms system";
        $this->db->insert("fnb_menu_history", $data_menu);
        redirect("cms/home/inputFnbMenu/" . $idBusiness . "/");
    }
    public function viewApplicationSettings()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["discovery"] = $this->BusinessDetail_m->getFile_discovery();
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu();
        $data["city"] = $this->Fnb_m->getfile_city();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_application_settings", $data);
        $this->load->view("cms/footer");
    }
    public function insertgambarkamar1($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["imgKamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["imgKamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("imgKamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["imgKamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar2($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img2Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img2Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img2Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img2Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar3($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img3Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img3Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img3Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img3Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar4($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img4Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img4Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img4Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img4Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar5($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img5Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img5Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img5Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img5Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar6($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img6Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img6Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img6Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img6Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar7($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img7Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img7Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img7Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img7Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar8($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img8Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img8Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img8Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img8Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar9($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img9Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img9Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img9Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img9Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("idKamar", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar10($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img10Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img10Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img10Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img10Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("kamar_detail", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar11($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img11Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img11Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img11Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img11Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("kamar_detail", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function insertgambarkamar12($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // Get the last inserted ID
        $ketKamar = $this->input->post("ketKamar");

        $extensi1 = explode(".", $_FILES["img12Kamardetail"]["name"]);
        $config1["upload_path"] = "./assets/images/kamar/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $config1["max_size"] = 4048000;
        $this->upload->initialize($config1);
        if ($_FILES["img12Kamardetail"]["name"]) {
            if (
                $extensi1[1] == "jpg" ||
                $extensi1[1] == "JPG" ||
                $extensi1[1] == "png" ||
                $extensi1[1] == "jpeg" ||
                $extensi1[1] == "pdf"
            ) {
                if ($this->upload->do_upload("img12Kamardetail")) {
                    $gbr1 = $this->upload->data();
                    $data_Kamar = ["img12Kamardetail" => $gbr1["file_name"]]; // Save as comma-separated string
                    $this->db->where("kamar_detail", $ketKamar);
                    $this->db->update("kamar_detail", $data_Kamar);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Foto kamar berhasil diunggah"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file 1 is too large limit size to less than 4MB"
                    );
                    redirect("cms/home/viewKamar/" . $idBusiness . "/");
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file 1 is not jpg/png"
                );
                redirect("cms/home/viewKamar/" . $idBusiness . "/");
            }
        } else {
            $this->session->set_flashdata("pesanerror", "file 1 not found");
            redirect("cms/home/viewKamar/" . $idBusiness . "/");
        }
    }
    public function home_Setting()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 13,
        ];
        $data["fnbMenuType"] = $this->Fnb_m->getfile_fnb_menu_type(
            $this->session->userdata("idBusiness")
        );
        // $data['bookingRoom'] = $this->Kamar_m->getfile_booking_kamar($this->session->userdata('idBusiness'));
        // $data['sumRoom'] = $this->Kamar_m->getfile_sum_kamar($this->session->userdata('idBusiness'));
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_fnbmenu", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insert_home_setting()
    {
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $uniqueIdentifier = $this->input->post("uniqueIdentifier");
        $statusCity = $this->input->post("statusCity");
        $name = $this->input->post("name");
        $Des_City = $this->input->post("Des_City");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/city/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            // Insert image path into the database
            $data_city = [
                "statusCity" => $statusCity,
                "Des_City" => $Des_City,
                "imgCity" => $uniqueFileName,
                "createdAtCity" => date("Y-m-d H:i:s"),
            ];
            $this->db->where("name", $name);
            $this->db->update("city", $data_city);
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
    }
    public function chat()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 18,
        ];

        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_chat", $data);
        $this->load->view("cms/footer", $data);
    }
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST["add"])) {
            $this->kamar_m->add($post);
        }
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data Berhasil di simpan');</script>";
        }
        echo "<script>window.location='" .
            base_url("form/process" . $facility) .
            "';</script>";
    }
    public function applyFacility($idBusiness)
    {
        $idBusiness = $this->input->post("idBusiness");
        $selectedFacilities = $this->input->post("status_facility");
        $facilityIds = $this->input->post("id"); // Get the array of facility IDs
        foreach ($selectedFacilities as $name => $status) {
            $data = [
                "status_facility" => $status,
                "idBusiness" => $this->session->userdata("idBusiness"),
            ];

            // Assuming 'id' is the primary key of your 'kamar_facility' table
            // Loop through the array of facility IDs and update each record
            foreach ($facilityIds as $facilityId) {
                $this->db->insert("Business_facility", $data);
            }
        }
        redirect(
            "cms/home/viewdetailBusiness/" .
                $this->session->userdata("idBusiness") .
                "/"
        );
    }
    public function view_cropper()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_cropper", $data);
        $this->load->view("cms/footer");
    }
    public function inputFacility($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 10,
        ];

        $data["packages"] = $this->BusinessDetail_m->getFile_packages();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_facility", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insert_facility()
    {
        $extensi = explode(".", $_FILES["imgIcon"]["name"]);
        $config["upload_path"] = "./assets/images/facilites/";
        $config["allowed_types"] = "jpg|png|jpeg|svg";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($_FILES["imgIcon"]["name"]) {
            if (
                $extensi[1] == "jpg" ||
                $extensi[1] == "png" ||
                $extensi[1] == "jpeg" ||
                $extensi[1] == "svg"
            ) {
                if ($this->upload->do_upload("imgIcon")) {
                    $gbr = $this->upload->data();
                    $pictureUrl = $gbr["file_name"];
                    $data = [
                        "nameIcon" => $this->input->post("nameIcon"),
                        "typeIcon" => $this->input->post("typeIcon"),
                        "imgIcon" => $pictureUrl,
                        "createdAtfacility" => date("Y-m-d H:i:s"),
                    ];
                    $this->db->insert("type_facility", $data);
                    $this->session->set_flashdata(
                        "pesansukses",
                        "Facility Berhasil di tambahkan"
                    );
                    redirect(
                        "cms/home/inputFacility/" .
                            $this->session->userdata("idGroup") .
                            "/"
                    );
                } else {
                    $this->session->set_flashdata(
                        "pesanerror",
                        "file is too large limit size to less than 4MB"
                    );
                    redirect(
                        "cms/home/inputFacility/" .
                            $this->session->userdata("idGroup") .
                            "/"
                    );
                }
            } else {
                $this->session->set_flashdata(
                    "pesanerror",
                    "file is not jpg/png"
                );
                redirect(
                    "cms/home/inputFacility/" .
                        $this->session->userdata("idGroup") .
                        "/"
                );
            }
        }
    }
    public function updateimgBuilding()
    {
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $uniqueIdentifier = $this->input->post("uniqueIdentifier");
        $idBusiness = $this->input->post("idBusiness");
        $idbuilding = $this->input->post("idbuilding");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/hotels/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            // Insert image path into the database
            $data_Kamar = [
                "imgBuilding" => $uniqueFileName,
            ];
            $this->db->where("idBusiness", $idBusiness);
            $this->db->where("idbuilding", $idbuilding);
            $this->db->update("building_detail", $data_Kamar);
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
    }
    public function sendajaxFacility()
    {
        $data[
            "facility"
        ] = $this->BusinessDetail_m->getfile_buisness_facility();
        if (!$data["facility"]) {
            $response = [
                "nmNumber" => "",
                "nmType" => "",
                "ketNumber" => "",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["facility"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function viewdetailBusiness($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data[
            "detailBusiness"
        ] = $this->BusinessDetail_m->getFile_business_details_by_id(
            $idBusiness
        );
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu();
        $data["fnbDetail"] = $this->db
            ->get_where("fnb_detail", ["idBusiness" => $idBusiness])
            ->row();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_detail_business", $data);
        $this->load->view("cms/footer");
    }
    public function updatefasilitas_gedung1()
    {
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $uniqueIdentifier = $this->input->post("uniqueIdentifier");
        $idBusiness = $this->input->post("idBusiness");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/gallery/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName =
                $uniqueIdentifier . "_" . $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            // Insert image path into the database
            $data_Kamar = [
                "fasilitas_gedung1" => $config["upload_path"] . $uniqueFileName,
            ];
            $this->db->where("idBusiness", $idBusiness);
            $this->db->update("building_detail", $data_Kamar);
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
    }
    public function viewBusinessDetail()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data[
            "businessDetails"
        ] = $this->BusinessDetail_m->getFile_business_details();
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_business_detail", $data);
        $this->load->view("cms/footer");
    }
    public function inputBusinessDetail()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_business_detail", $data);
        $this->load->view("cms/footer");
    }
    public function insertBusinessDetail()
    {
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $uniqueIdentifier = $this->input->post("uniqueIdentifier");
        $idGroup = $this->input->post("idGroup");
        $Name = $this->input->post("Name");
        $addres = $this->input->post("addres");
        $urlmapBusiness = $this->input->post("urlmapBusiness");
        $latitude = $this->input->post("latitude");
        $longitude = $this->input->post("longitude");
        $emailReservationBusiness = $this->input->post(
            "emailReservationBusiness"
        );
        $emailFOMBusiness = $this->input->post("emailFOMBusiness");
        $emailCABusiness = $this->input->post("emailCABusiness");
        $emailARBusiness = $this->input->post("emailARBusiness");
        $mobileBusiness = $this->input->post("mobileBusiness");
        $feeBusiness = $this->input->post("feeBusiness");
        $messageBusiness = $this->input->post("messageBusiness");
        $extrabedBusiness = $this->input->post("extrabedBusiness");
        $typeBusiness = $this->input->post("typeBusiness");
        $descENBusiness = $this->input->post("cktextarea");
        $ratingstar = $this->input->post("ratingstar");
        $hasFnb = $this->input->post("hasFnb");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/hotels/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            // Insert image path into the database
            $data_Kamar = [
                "idGroup" => $idGroup,
                "Name" => $Name,
                "addres" => $addres,
                "image" => $uniqueFileName,
                "urlmapBusiness" => $urlmapBusiness,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "emailReservationBusiness" => $emailReservationBusiness,
                "emailFOMBusiness" => $emailFOMBusiness,
                "emailCABusiness" => $emailCABusiness,
                "emailARBusiness" => $emailARBusiness,
                "mobileBusiness" => $mobileBusiness,
                "feeBusiness" => $feeBusiness,
                "messageBusiness" => $messageBusiness,
                "extrabedBusiness" => $extrabedBusiness,
                "typeBusiness" => $typeBusiness,
                "descENBusiness" => $descENBusiness,
                "ratingstar" => $ratingstar,
            ];
            $this->db->insert("Business_Detail", $data_Kamar);
            $idBusiness = $this->db->insert_id();
            $fnbDetail = $this->db
                ->get_where("fnb_detail", ["idBusiness" => $idBusiness])
                ->row();
            $data = [
                "idBusiness" => $idBusiness,
                "isActive" => $hasFnb,
            ];
            if ($fnbDetail) {
                // Update existing record
                $this->db->where("idBusiness", $idBusiness);
                $this->db->update("fnb_detail", $data);
            } else {
                // Insert new record
                $this->db->insert("fnb_detail", $data);
            }
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $data[] = [
                    "idBusiness" => $idBusiness,
                    // Add other fields as needed
                ];
            }
            $this->db->trans_start(); // Start transaction
            foreach ($data as $row) {
                $this->db->insert("building_detail", $row);
            }
            if ($this->db->trans_status() === false) {
                // Rollback transaction and handle errors
                $this->db->trans_rollback();
                echo "Insert failed!";
            } else {
                // Commit transaction
                $this->db->trans_complete();
                echo "12 records inserted successfully!";
            }
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
    }
    public function updateBusinessDetail()
    {
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $uniqueIdentifier = $this->input->post("uniqueIdentifier");
        $idBusiness = $this->input->post("idBusiness");
        $Name = $this->input->post("Name");
        $addres = $this->input->post("addres");
        $location = $this->input->post("location");
        $typeBusiness = $this->input->post("typeBusiness");
        $ratingstar = $this->input->post("ratingstar");
        $active = $this->input->post("active");
        $descENBusiness = $this->input->post("descENBusiness");
        $hasFnb = $this->input->post("hasFnb");
        // Handle the uploaded image
        $config["upload_path"] = "./assets/images/hotels/";
        $config["allowed_types"] = "jpg|png|jpeg|pdf";
        $config["max_size"] = 4048000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file")) {
            $uploadData = $this->upload->data();
            var_dump($uploadData); // Debugging statement
            // Generate a unique file name
            $uniqueFileName = $uploadData["file_name"];
            // Rename the uploaded file
            rename(
                $config["upload_path"] . $uploadData["file_name"],
                $config["upload_path"] . $uniqueFileName
            );
            $extension = pathinfo(
                $config["upload_path"] . $uniqueFileName,
                PATHINFO_EXTENSION
            );
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    $image = imagecreatefromjpeg(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                case "png":
                    $image = imagecreatefrompng(
                        $config["upload_path"] . $uniqueFileName
                    );
                    break;
                // Add more cases for other supported file types if needed
                default:
                    // Handle unsupported file types or display an error
                    echo json_encode(["error" => "Unsupported file type"]);
                    return;
            }
            // Perform cropping using imagecopyresampled
            $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0, // Destination coordinates
                $dataX,
                $dataY, // Source coordinates
                $dataWidth,
                $dataHeight,
                $dataWidth,
                $dataHeight
            );
            // Save the cropped image with the unique file name
            imagejpeg($croppedImage, $config["upload_path"] . $uniqueFileName);
            imagedestroy($croppedImage);
            imagedestroy($image);
            // Insert image path into the database
            $data_business = [
                "Name" => $Name,
                "addres" => $addres,
                "image" => $uniqueFileName,
                "location" => $location,
                "typeBusiness" => $typeBusiness,
                "ratingstar" => $ratingstar,
                "descENBusiness" => $descENBusiness,
                "active" => $active,
            ];
            $this->db->where("idBusiness", $idBusiness);
            $this->db->update("Business_Detail", $data_business);
            $fnbDetail = $this->db
                ->get_where("fnb_detail", ["idBusiness" => $idBusiness])
                ->row();
            $data = [
                "idBusiness" => $idBusiness,
                "isActive" => $hasFnb,
            ];
            if ($fnbDetail) {
                // Update existing record
                $this->db->where("idBusiness", $idBusiness);
                $this->db->update("fnb_detail", $data);
            } else {
                // Insert new record
                $this->db->insert("fnb_detail", $data);
            }
            // Provide feedback to the user
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                ]);
            } else {
                echo json_encode(["error" => "Error updating the database."]);
            }
        } else {
            // Handle upload failure
            $error = ["error" => $this->upload->display_errors()];
            echo json_encode($error);
        }
    }
    public function uploadImageFnbHead()
    {
        $photoUrl = $this->input->post("photoUrl");
        $idBusiness = $this->input->post("idBusiness");
        $fnbDetail = $this->db
            ->get_where("fnb_detail", ["idBusiness" => $idBusiness])
            ->row();
        $data = [
            "idBusiness" => $idBusiness,
            "photoHeader" => $photoUrl,
        ];
        if ($fnbDetail) {
            // Update existing record
            $this->db->where("idBusiness", $idBusiness);
            $this->db->update("fnb_detail", $data);
        } else {
            // Insert new record
            $this->db->insert("fnb_detail", $data);
        }
    }
    public function applyFacilityBusiness()
    {
        $idBusiness = $this->input->post("idBusiness");
        $facilityBusiness = $this->input->post("facilityBusiness");
        $facilityIds = $this->input->post("id"); // Get the array of facility IDs
        // Explode the comma-separated string into an array
        $data = [
            "facilityBusiness" => $facilityBusiness,
        ];

        $this->db->where("idBusiness", $idBusiness);
        $this->db->update("Business_Detail", $data);
        redirect("cms/home/viewdetailBusiness/" . $idBusiness);
    }
    public function uploadImage()
    {
        try {
            $dataX = $this->input->post("dataX");
            $dataY = $this->input->post("dataY");
            $dataWidth = $this->input->post("dataWidth");
            $dataHeight = $this->input->post("dataHeight");
            $type = $this->input->post("type");
            // Handle the uploaded image
            $path = "";
            switch ($type) {
                case "karyawan":
                    $path = "./assets/images/karyawan/";
                    break;
                case "kamar":
                    $path = "./assets/images/kamar/";
                    break;
                case "menu":
                    $path = "./assets/images/menu/";
                    break;
                case "fnb":
                    $path = "./assets/images/fnb/";
                    break;
                case "voucher":
                    $path = "./assets/images/voucher/";
                    break;
                case "city":
                    $path = "./assets/images/city/";
                    break;
                case "newsletter":
                    $path = "./assets/images/newsletter/";
                    break;
                case "swiper":
                    $path = "./assets/images/swiper/";
                    break;
                default:
                    $path = "/assets/images/gallery/";
            }
            $config["upload_path"] = $path;
            $config["allowed_types"] = "jpg|png|jpeg|pdf|svg";
            $config["max_size"] = 2048;
            $this->upload->initialize($config);
            if ($this->upload->do_upload("file")) {
                $uploadData = $this->upload->data();
                // Generate a unique file name
                $uniqueFileName = time() . "_" . $uploadData["file_name"];
                // Rename the uploaded file
                rename(
                    $config["upload_path"] . $uploadData["file_name"],
                    $config["upload_path"] . $uniqueFileName
                );
                $extension = pathinfo(
                    $config["upload_path"] . $uniqueFileName,
                    PATHINFO_EXTENSION
                );
                switch ($extension) {
                    case "jpg":
                    case "jpeg":
                        $image = imagecreatefromjpeg(
                            $config["upload_path"] . $uniqueFileName
                        );
                        break;
                    case "png":
                        $image = imagecreatefrompng(
                            $config["upload_path"] . $uniqueFileName
                        );
                        break;
                    // Add more cases for other supported file types if needed
                    default:
                        // Handle unsupported file types or display an error
                        echo json_encode(["error" => "Unsupported file type"]);
                        return;
                }
                // Perform cropping using imagecopyresampled
                $croppedImage = imagecreatetruecolor($dataWidth, $dataHeight);
                imagecopyresampled(
                    $croppedImage,
                    $image,
                    0,
                    0, // Destination coordinates
                    $dataX,
                    $dataY, // Source coordinates
                    $dataWidth,
                    $dataHeight,
                    $dataWidth,
                    $dataHeight
                );
                // Save the cropped image with the unique file name
                imagejpeg(
                    $croppedImage,
                    $config["upload_path"] . $uniqueFileName
                );
                imagedestroy($croppedImage);
                imagedestroy($image);
                $data = [
                    "idUser" => $this->session->userdata("idUser"),
                    "idBusiness" => $this->session->userdata("idBusiness"),
                    "image" => $uniqueFileName,
                    "createdAt" => date("Y-m-d H:i:s"),
                ];
                $this->db->insert("file_image", $data);
                echo json_encode([
                    "result" => "Image inserted and resized successfully",
                    "data" => $data,
                ]);
            } else {
                // Handle upload failure
                $response = ["response" => "error", "desc" => "Upload failed"];
                echo json_encode($response);
            }
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
    public function uploadKamarGambar()
    {
        $ketKamar = $this->input->post("ketKamar");
        $typeGambar = $this->input->post("typeGambar");
        $filename = $this->input->post("filename");
        $data = [];
        if ($typeGambar > 1) {
            $data = ["img" . $typeGambar . "Kamardetail" => $filename];
        } else {
            $data = ["imgKamardetail" => $filename];
        }
        $this->db->where("idKamar", $ketKamar);
        $this->db->update("kamar_detail", $data);
        echo json_encode(["result" => "success"]);
    }
    public function blockUser($idUser)
    {
        $data = ["blockUser" => 1];
        $this->db->where("idKaryawan", $idUser);
        $this->db->update("user", $data);
        $this->session->set_flashdata(
            "pesansukses",
            "Business Berhasil didelete"
        );
        redirect("cms/home/viewKaryawan");
    }
    public function unblockUser($idUser)
    {
        // Fetch user data
        $user = $this->db->get_where("user", ["idKaryawan" => $idUser])->row();
        if ($user) {
            // Update user's block status
            $data = ["blockUser" => 0];
            $this->db->where("idKaryawan", $idUser);
            $this->db->update("user", $data);
            // Delete log entries based on emailUser
            $this->db->where("ketLog", $user->emailUser);
            $this->db->delete("log_sign");
            $this->session->set_flashdata(
                "pesansukses",
                "Business Berhasil didelete"
            );
        } else {
        }
        redirect("cms/home/viewKaryawan");
    }
    public function deleteBusiness($idBusiness)
    {
        $this->db->where("idBusiness", $idBusiness);
        $this->db->delete("Business_Detail");
        $this->session->set_flashdata(
            "pesansukses",
            "Business Berhasil didelete"
        );
        redirect("cms/home/viewBusinessDetail");
    }
    public function viewlog()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 12,
        ];
        $data["user_log"] = $this->Login_m->getdatalog();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_log", $data);
        $this->load->view("cms/footer", $data);
    }
    public function ajaxPostAdditionalFnb($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $data["additional"] = $this->Home_m->getfile_PostAdditionalFnb(
            $idBusiness
        );
        if (!$data["additional"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["additional"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function ajaxUpdateStatusAdditionalFnb()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $invoiceFnbadditional = $this->input->post("invoiceFnbadditional");
        $data[
            "invoiceFnbadditional"
        ] = $this->Home_m->getfile_UpdateStatusAdditionalFnb(
            $invoiceFnbadditional
        );
        if (!$data["invoiceFnbadditional"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["invoiceFnbadditional"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function printfnb($idBooking, $invoiceFnbadditional)
    {
        $data["fnbdetail"] = $this->Booking_m->getfile_booking_by_id_fnbInvoice(
            $idBooking,
            $invoiceFnbadditional
        );
        $this->load->view("cms/print_fnb", $data);
    }
    public function ajaxtokenPushNotification()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $data_notification = [
            "tokenPushNotification" => $this->input->post(
                "tokenPushNotification"
            ),
        ];
        $this->db->where("idUser", $this->input->post("idUser"));
        $this->db->update("user", $data_notification);
        echo json_encode($data_notification);
    }
    public function insertFormNewsletter($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // echo "Data inserted successfully.";
        $data_newsletter = [
            "titleNewsletter" => $this->input->post("titleNewsletter"),
            "bodyNewsletter" => $this->input->post("bodyNewsletter"),
            "createdAtNewsletter" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("newsletter", $data_newsletter);
        $displayed_name = [];
        $user_emails = [];
        $this->db->from("user");
        // $this->db->where('emailUser', 'yerblues6@gmail.com');
        // $this->db->or_where('emailUser', 'madanidjourney@gmail.com');
        // $this->db->or_where('emailUser', 'aryaseftzzz@gmail.com');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if (!in_array($row->emailUser, $displayed_name)) {
                    // Add the invoice to the list of displayed invoices
                    $displayed_name[] = $row->emailUser;
                    $user_emails[] = $row;
                }
            }
        }
        $query->free_result();
        // Load the email template from a file or any other source if needed
        $email_template = $this->input->post("bodyNewsletter");
        $titleNewsletter = $this->input->post("titleNewsletter");
        $config = [
            "protocol" => "smtp",
            "smtp_host" => "ssl://salamdjourney.com",
            "smtp_port" => "465",
            "smtp_user" => "noreply@salamdjourney.com",
            "smtp_pass" => "noreply@salamdjourney.com",
            "mailtype" => "html",
            "charset" => "iso-8859-1",
            "wordwrap" => true,
            "crlf" => "\r\n",
            "newline" => "\r\n",
        ];
        $this->load->library("email", $config);
        foreach ($user_emails as $user_email) {
            // $this->email->initialize($config);
            // $this->email->set_newline("\r\n");
            $this->email->from(
                "noreply@salamdjourney.com",
                "Salam Djourney Daily"
            );
            $this->email->to($user_email->emailUser);
            $this->email->subject($titleNewsletter);

            // Replace [email_user] with the user's email in the email template
            $body_message = str_replace(
                "[email_user]",
                $user_email->nmUser,
                $email_template
            );
            $this->email->message($body_message); // Your email message
            // $this->email->send();
            // if ($this->email->send()) {
            //   echo "Email sent to " . $user_email->emailUser . "<br>";
            // } else {
            //   echo "Failed to send email to " . $user_email->emailUser . "<br>";
            //   echo $this->email->print_debugger(); // Print debugging information
            // }
            // echo json_encode($user_email->emailUser);
        }
        $this->session->set_flashdata(
            "pesansukses",
            "News letter Berhasil dibuat"
        );
        redirect("cms/home/viewNewsletter/" . $idBusiness . "/");
    }
    public function insertFormNotification($idBusiness)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // echo "Data inserted successfully.";
        $data_notification = [
            "idBusiness" => $idBusiness,
            "nmNotification" => $this->input->post("titleNewsletter"),
            "descNotification" => $this->input->post("bodyNewsletter"),
            "createdAtNotification" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("notification_blast", $data_notification);
        $this->session->set_flashdata(
            "pesansukses",
            "Notification Berhasil dibuat"
        );
        redirect("cms/home/viewNotificationCenter/" . $idBusiness . "/");
    }
    public function viewDiscovery()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 12,
        ];
        $discover = [];
        if ($this->session->userdata("level") == 7) {
            $this->db->from("discovery");
            $this->db->join(
                "Business_Detail",
                "Business_Detail.idBusiness=discovery.idBusiness"
            );
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $discover[] = $row;
                }
            }
            $query->free_result();
        } elseif ($this->session->userdata("level") == 1) {
            $this->db->from("discovery");
            $this->db->join(
                "Business_Detail",
                "Business_Detail.idBusiness=discovery.idBusiness"
            );
            $this->db->where(
                "Business_Detail.idGroup",
                $this->session->userdata("idGroup")
            );
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $discover[] = $row;
                }
            }
            $query->free_result();
        }
        $data["discovery"] = $discover;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_discovery", $data);
        $this->load->view("cms/footer", $data);
    }
    public function inputDiscovery()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 12,
        ];
        $businessDetail = [];
        if ($this->session->userdata("level") == 7) {
            $this->db->from("Business_Detail");
            $this->db->where("typeBusiness", "PLACE");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $businessDetail[] = $row;
                }
            }
            $query->free_result();
        } elseif ($this->session->userdata("level") == 1) {
            $this->db->from("Business_Detail");
            $this->db->where("typeBusiness", "PLACE");
            $this->db->where(
                "Business_Detail.idGroup",
                $this->session->userdata("idGroup")
            );
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $businessDetail[] = $row;
                }
            }
            $query->free_result();
        }
        $data["businessDetail"] = $businessDetail;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_discovery", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertDiscovery()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 12,
        ];
        $idDiscovery = $this->input->post("idDiscovery");
        $idBusiness = $this->input->post("idBusiness");
        $photoUrl = $this->input->post("photoPath");
        $description = $this->input->post("description");
        $data_menu = [
            "idDiscovery" => $idDiscovery,
            "idBusiness" => $idBusiness,
            "imgCity" => $photoUrl,
            "description" => $description,
        ];
        $inserted_id = $idDiscovery;
        if (isset($idDiscovery) && $idDiscovery != "") {
            // idMenu exists, update the record
            $this->db->where("idDiscovery", $idDiscovery);
            $this->db->update("discovery", $data_menu);
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil diupdate"
            );
        } else {
            $this->db->insert("discovery", $data_menu);
            $inserted_id = $this->db->insert_id();
            $this->session->set_flashdata(
                "pesansukses",
                "Fnb Berhasil ditambah"
            );
        }
        redirect("cms/home/viewDiscovery/");
    }
    public function detailDiscovery($idDiscovery)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 12,
        ];
        $businessDetail = [];
        if ($this->session->userdata("level") == 7) {
            $this->db->from("Business_Detail");
            $this->db->where("typeBusiness", "PLACE");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $businessDetail[] = $row;
                }
            }
            $query->free_result();
        } elseif ($this->session->userdata("level") == 1) {
            $this->db->from("Business_Detail");
            $this->db->where("typeBusiness", "PLACE");
            $this->db->where(
                "Business_Detail.idGroup",
                $this->session->userdata("idGroup")
            );
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $businessDetail[] = $row;
                }
            }
            $query->free_result();
        }
        $data["businessDetail"] = $businessDetail;
        $data["disc"] = $query = $this->db
            ->get_where("discovery", ["idDiscovery" => $idDiscovery])
            ->row();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/input_discovery", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewVoucherCatalog()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 35,
        ];
        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["vouchercatalog"] = $this->Home_m->getfile_voucher_catalog();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_voucher_catalog", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewVoucherCatalogDetail($idVouchercatalog)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 35,
        ];
        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["voucher"] = $this->Home_m->getfile_voucher_catalogById(
            $idVouchercatalog
        );
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_voucher_catalog_detail", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertFormVoucherCatalog()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // echo "Data inserted successfully.";
        $data_voucher = [
            "nmVouchercatalog" => $this->input->post("nmVouchercatalog"),
            "idBusiness" => $this->input->post("idBusiness"),
            "ketVouchercatalog" => $this->input->post("ketVouchercatalog"),
            "categoryVouchercatalog" => $this->input->post(
                "categoryVouchercatalog"
            ),
            "qtyVouchercatalog" => $this->input->post("qtyVouchercatalog"),
            "priceVouchercatalog" => str_replace(
                ",",
                "",
                $this->input->post("priceVouchercatalog")
            ),
            "payableVouchercatalog" => $this->input->post(
                "payableVouchercatalog"
            ),
            "expiredVouchercatalog" => $this->input->post(
                "expiredVouchercatalog"
            ),
            "statusVouchercatalog" => $this->input->post(
                "statusVouchercatalog"
            ),
            "imgVouchercatalog" => $this->input->post("photoPath1"),
            "img2Vouchercatalog" => $this->input->post("photoPath2"),
            "img3Vouchercatalog" => $this->input->post("photoPath3"),
            "idUser" => $this->session->userdata("idUser"),
            "createdAtVouchercatalog" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("voucher_catalog", $data_voucher);
        $this->session->set_flashdata("pesansukses", "Voucher Berhasil dibuat");
        redirect("cms/home/viewVoucherCatalog");
    }
    public function updateFormVoucherCatalog($idVouchercatalog)
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 11,
        ];
        // echo "Data inserted successfully.";
        $data_voucher = [
            "nmVouchercatalog" => $this->input->post("nmVouchercatalog"),
            "idBusiness" => $this->input->post("idBusiness"),
            "ketVouchercatalog" => $this->input->post("ketVouchercatalog"),
            "categoryVouchercatalog" => $this->input->post(
                "categoryVouchercatalog"
            ),
            "qtyVouchercatalog" => $this->input->post("qtyVouchercatalog"),
            "priceVouchercatalog" => str_replace(
                ",",
                "",
                $this->input->post("priceVouchercatalog")
            ),
            "payableVouchercatalog" => $this->input->post(
                "payableVouchercatalog"
            ),
            "expiredVouchercatalog" => $this->input->post(
                "expiredVouchercatalog"
            ),
            "statusVouchercatalog" => $this->input->post(
                "statusVouchercatalog"
            ),
            "shortketVouchercatalog" => $this->input->post(
                "shortketVouchercatalog"
            ),
            "inslideVouchercatalog" => $this->input->post(
                "inslideVouchercatalog"
            ),
            "idUser" => $this->session->userdata("idUser"),
            "createdAtVouchercatalog" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idVouchercatalog", $idVouchercatalog);
        $this->db->update("voucher_catalog", $data_voucher);
        $this->session->set_flashdata("pesansukses", "Voucher Berhasil dibuat");
        redirect("cms/home/viewVoucherCatalog");
    }
    public function viewClaimVoucherCatalog()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 35,
        ];
        $data[
            "claimvouchercatalog"
        ] = $this->Home_m->getfile_claim_voucher_catalog();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_claim_voucher_catalog", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewOrderVoucherCatalog()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 35,
        ];
        $data[
            "ordervouchercatalog"
        ] = $this->Home_m->getfile_claim_voucher_catalog();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_order_voucher_catalog", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateFnbAdditionalCooking()
    {
        $data_claim = [
            "statusFnbcooking" => $this->input->post("statusFnbcooking"),
        ];
        $this->db->where("idBusiness", $this->input->post("idBusiness"));
        $this->db->where("idBooking", $this->input->post("idBooking"));
        $this->db->where(
            "invoiceFnbadditional",
            $this->input->post("invoiceFnbadditional")
        );
        $this->db->where("idUser", $this->input->post("idUser"));
        $this->db->update("fnb_additional_cooking", $data_claim);
        redirect("cms/home/viewClaimVoucherCatalog/");
    }
    public function updateFnbAdditionalServing()
    {
        $data_claim = [
            "statusFnbserving" => $this->input->post("statusFnbserving"),
        ];
        $this->db->where("idBusiness", $this->input->post("idBusiness"));
        $this->db->where("idBooking", $this->input->post("idBooking"));
        $this->db->where(
            "invoiceFnbadditional",
            $this->input->post("invoiceFnbadditional")
        );
        $this->db->where("idUser", $this->input->post("idUser"));
        $this->db->update("fnb_additional_cooking", $data_claim);
        $data = [];
        $this->db->from("voucher_catalog");
        $this->db->where("nmVouchercatalog", $this->input->post("nmVoucher"));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();
        $data_claim = [
            "qtyVouchercatalog" => $data->qtyVouchercatalog - 1,
            "claimVouchercatalog" => $data->claimVouchercatalog + 1,
        ];
        $this->db->where("nmVouchercatalog", $this->input->post("nmVoucher"));
        $this->db->update("voucher_catalog", $data_claim);
        redirect("cms/home/viewClaimVoucherCatalog/");
    }
    public function ajaxcheckBusiness()
    {
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 9,
        ];
        $BusinessID = $this->input->post("BusinessID");
        $data[
            "BusinessID"
        ] = $this->BusinessDetail_m->getFile_business_details_by_id(
            $BusinessID
        );
        if (!$data["BusinessID"]) {
            $response = [
                "result" => "empty",
            ];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        } else {
            $response = $data["BusinessID"];
            echo json_encode($response, JSON_NUMERIC_CHECK);
        }
    }
    public function copy_file()
    {
        // Load file helper
        $this->load->helper("file");
        $dataX = $this->input->post("dataX");
        $dataY = $this->input->post("dataY");
        $dataWidth = $this->input->post("dataWidth");
        $dataHeight = $this->input->post("dataHeight");
        $type = $this->input->post("type");
        // Handle the uploaded image
        $path = "";
        switch ($type) {
            case "karyawan":
                $path = "./assets/images/karyawan/";
                break;
            case "kamar":
                $path = "./assets/images/kamar/";
                break;
            case "menu":
                $path = "./assets/images/menu/";
                break;
            case "fnb":
                $path = "./assets/images/fnb/";
                break;
            case "voucher":
                $path = "./assets/images/voucher/";
                break;
            case "city":
                $path = "./assets/images/city/";
                break;
            case "newsletter":
                $path = "./assets/images/newsletter/";
                break;
            default:
                $path = "/assets/images/gallery/";
        }
        $config["upload_path"] = $path;
        $config["allowed_types"] = "jpg|png|jpeg|pdf|svg";
        $config["max_size"] = 4048000;
        // Source and destination directories
        $source_dir = "./assets/images/hotels/";
        $destination_dir = $path;
        // File name to copy
        $file_name = $this->input->post("file");
        // Check if the file exists in the source directory
        if (file_exists($source_dir . $file_name)) {
            // Copy the file to the destination directory
            if (copy($source_dir . $file_name, $destination_dir . $file_name)) {
                echo json_encode($file_name);

                // Optionally, you can delete the original file from the source directory
                // unlink($source_dir . $file_name);
            } else {
                echo "Failed to copy the file.";
            }
        } else {
            echo "The file does not exist in the source directory.";
        }
    }
    public function viewSiteSettingHeader()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["header"] = $this->Home_m->getfile_header();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_header", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingHeaderMeta()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["header"] = $this->Home_m->getfile_header_meta();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_header_meta", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingHeaderHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data['header'] = $this->Home_m->getfile_header_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_header_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingSlider()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["swiper"] = $this->Home_m->getfile_swiper();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingSliderHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["swiper"] = $this->Home_m->getfile_swiper_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingHero()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_hero", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingSpecialOffers()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingTestimonials()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["testimonial"] = $this->Home_m->getfile_testimonial();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_testimonial", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingTestimonialsHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["testimonial"] = $this->Home_m->getfile_testimonial_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_testimonial_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingLocalFinds()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingBecomeMember()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingConnectUs()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingFooter()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_slider", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertSiteSettingHeader()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Ambil data dari POST
        $nmHeader = $this->input->post("nmHeader");
        $locale = $this->input->post("locale");

        // Cek apakah nmHeader sudah ada di tabel sahira_header_left
        $existingHeader = $this->db
            ->get_where("sahira_header_left", [
                "nmHeader" => $nmHeader,
                "locale" => $locale,
            ])
            ->row();

        // Jika header belum ada, maka tambahkan ke sahira_header_left
        if (!$existingHeader) {
            $data_header = [
                "idUser" => $this->session->userdata("idUser"),
                "locale" => $locale,
                "nmHeader" => $nmHeader,
                "linkHeader" => $this->input->post("linkHeader"),
                "statusHeader" => $this->input->post("statusHeader"),
                "createdAtHeader" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("sahira_header_left", $data_header);
            $idHeader = $this->db->insert_id();
        } else {
            // Jika header sudah ada, gunakan idHeader yang sudah ada
            $idHeader = $existingHeader->idHeader;
        }
        // Proses sub-menu
        $subMenuCount = $this->input->post("jlmSubMenu");
        for ($i = 1; $i <= $subMenuCount; $i++) {
            $data_header_sub = [
                "idHeader" => $idHeader,
                "locale" => $this->input->post("localeSub$i"),
                "nmHeaderSub" => $this->input->post("nmHeaderSub$i"),
                "linkHeaderSub" => $this->input->post("linkHeaderSub$i"),
                "statusHeaderSub" => $this->input->post("statusHeaderSub$i"),
                "idUser" => $this->session->userdata("idUser"),
                "createdAtHeaderSub" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("sahira_header_left_sub", $data_header_sub);
        }
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingHeader/");
    }
    public function insertSiteSettingHeaderHotel()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Ambil data dari POST
        $nmHeader = $this->input->post("nmHeader");
        $locale = $this->input->post("locale");
        $idBusiness = $this->input->post("idBusiness");

        // Cek apakah nmHeader sudah ada di tabel sahira_header_left
        $existingHeader = $this->db
            ->get_where("sahira_header_left", [
                "nmHeader" => $nmHeader,
                "locale" => $locale,
                "idBusiness" => $idBusiness,
            ])
            ->row();

        // Jika header belum ada, maka tambahkan ke sahira_header_left
        if (!$existingHeader) {
            $data_header = [
                "idUser" => $this->session->userdata("idUser"),
                "idBusiness" => $idBusiness,
                "locale" => $locale,
                "nmHeader" => $nmHeader,
                "linkHeader" => $this->input->post("linkHeader"),
                "statusHeader" => $this->input->post("statusHeader"),
                "createdAtHeader" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("sahira_header_left", $data_header);
            $idHeader = $this->db->insert_id();
        } else {
            // Jika header sudah ada, gunakan idHeader yang sudah ada
            $idHeader = $existingHeader->idHeader;
        }
        // Proses sub-menu
        $subMenuCount = $this->input->post("jlmSubMenu");
        for ($i = 1; $i <= $subMenuCount; $i++) {
            $data_header_sub = [
                "idHeader" => $idHeader,
                "idBusiness" => $idBusiness,
                "locale" => $this->input->post("localeSub$i"),
                "nmHeaderSub" => $this->input->post("nmHeaderSub$i"),
                "linkHeaderSub" => $this->input->post("linkHeaderSub$i"),
                "statusHeaderSub" => $this->input->post("statusHeaderSub$i"),
                "idUser" => $this->session->userdata("idUser"),
                "createdAtHeaderSub" => date("Y-m-d H:i:s"),
            ];
            $this->db->insert("sahira_header_left_sub", $data_header_sub);
        }
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingHeaderHotel/".$idBusiness."/");
    }
    public function updateSiteSettingHeader()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $idHeader = $this->input->post("idHeader");
        $subMenuCount = $this->input->post("jlmSubMenu");

        for ($i = 1; $i <= $subMenuCount; $i++) {
            $data_header_sub = [
                "idHeader" => $idHeader,
                "locale" => $this->input->post("localeSub$i"),
                "nmHeaderSub" => $this->input->post("nmHeaderSub$i"),
                "statusHeaderSub" => $this->input->post("statusHeaderSub$i"),
                "idUser" => $this->session->userdata("idUser"),
                "createdAtHeaderSub" => date("Y-m-d H:i:s"),
            ];
            // echo json_encode(array(
            //  'idHeader'              => $idHeader,
            //   'locale'               => $this->input->post("localeSub$i"),
            //   'nmHeaderSub'          => $this->input->post("nmHeaderSub$i"),
            //   'statusHeaderSub'      => $this->input->post("statusHeaderSub$i"),
            //   'idUser'               => $this->session->userdata('idUser'),
            //   'createdAtHeaderSub'   => date('Y-m-d H:i:s'),
            // ));
            $this->db->where(
                "nmHeaderSub",
                $this->input->post("nmHeaderSub$i")
            );
            $this->db->update("sahira_header_left_sub", $data_header_sub);
        }
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingHeader/");
    }
    // Fungsi untuk menangani permintaan AJAX penghapusan sub-menu
    public function deleteSiteSettingSubHeader()
    {
        // Periksa apakah ini adalah permintaan AJAX
        if ($this->input->is_ajax_request()) {
            // Ambil data dari permintaan AJAX
            $idHeader = $this->input->post("idHeader");
            $subMenuName = $this->input->post("subMenuName");
            // Periksa apakah kedua parameter diterima
            if (!empty($idHeader) && !empty($subMenuName)) {
                // Panggil model untuk menghapus sub-menu
                $deleted = $this->Home_m->delete_sub_header(
                    $idHeader,
                    $subMenuName
                );
                if ($deleted) {
                    // Berikan respons sukses
                    echo json_encode([
                        "success" => true,
                        "message" => "Sub-menu deleted successfully.",
                    ]);
                } else {
                    // Gagal menghapus, kirim pesan kesalahan
                    echo json_encode([
                        "success" => false,
                        "message" => "Failed to delete sub-menu.",
                    ]);
                }
            } else {
                // Parameter tidak lengkap
                echo json_encode([
                    "success" => false,
                    "message" => "Invalid parameters.",
                ]);
            }
        } else {
            // Jika bukan AJAX request, kembalikan 403 Forbidden
            show_error("No direct script access allowed", 403);
        }
    }
    public function insertSiteSettingSlider()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $locale = $this->input->post("locale");
        $titleSwiper = $this->input->post("titleSwiper");
        $subtitleSwiper = $this->input->post("subtitleSwiper");
        $statusSwiper = $this->input->post("statusSwiper");
        $imgSwiper = $this->input->post("photoPath1");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_swiper = [
            "locale" => $locale,
            "imgSwiper" => $imgSwiper,
            "titleSwiper" => $titleSwiper,
            "subtitleSwiper" => $subtitleSwiper,
            "statusSwiper" => $statusSwiper,
            "expiredSwiper" => "2024-12-01",
            "idUser" => $this->session->userdata("idUser"),
            "createdAtSwiper" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("sahira_hero_swiper", $data_swiper);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Swiper berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingSlider");
    }
    public function insertSiteSettingHeaderMeta()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $locale = $this->input->post("locale");
        $titleMetaHeader = $this->input->post("titleMetaHeader");
        $descriptionMetaHeader = $this->input->post("descriptionMetaHeader");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_meta_header = [
            "locale" => $locale,
            "titleMetaHeader" => $titleMetaHeader,
            "descriptionMetaHeader" => $descriptionMetaHeader,
        ];
        $this->db->insert("sahira_meta_header", $data_meta_header);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Meta Header berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingHeaderMeta");
    }
    public function insertSiteSettingSliderHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $locale = $this->input->post("locale");
        $titleSwiper = $this->input->post("titleSwiper");
        $subtitleSwiper = $this->input->post("subtitleSwiper");
        $statusSwiper = $this->input->post("statusSwiper");
        $imgSwiper = $this->input->post("photoPath1");
        $imgsmSwiper = $this->input->post("photoPath2");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_swiper = [
            "locale" => $locale,
            "idBusiness" => $idBusiness,
            "imgSwiper" => $imgSwiper,
            "imgsmSwiper" => $imgsmSwiper,
            "titleSwiper" => $titleSwiper,
            "subtitleSwiper" => $subtitleSwiper,
            "statusSwiper" => $statusSwiper,
            "expiredSwiper" => "2024-12-01",
            "idUser" => $this->session->userdata("idUser"),
            "createdAtSwiper" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("sahira_hero_swiper", $data_swiper);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Swiper berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingSliderHotel/".$idBusiness."/");
    }
    public function updateSiteSettingSlider()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $idSwiper = $this->input->post("idSwiper");
        $locale = $this->input->post("locale");
        $titleSwiper = $this->input->post("titleSwiper");
        $subtitleSwiper = $this->input->post("subtitleSwiper");
        $statusSwiper = $this->input->post("statusSwiper");
        $imgSwiper = $this->input->post("photoPathEdit");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_swiper = [
            "locale" => $locale,
            "imgSwiper" => $imgSwiper,
            "titleSwiper" => $titleSwiper,
            "subtitleSwiper" => $subtitleSwiper,
            "statusSwiper" => $statusSwiper,
            "expiredSwiper" => "2024-12-01",
            "idUser" => $this->session->userdata("idUser"),
            "createdAtSwiper" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idSwiper", $idSwiper);
        $this->db->update("sahira_hero_swiper", $data_swiper);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Swiper berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingSlider");
    }
    public function updateSiteSettingSliderHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $idSwiper = $this->input->post("idSwiper");
        $locale = $this->input->post("locale");
        $titleSwiper = $this->input->post("titleSwiper");
        $subtitleSwiper = $this->input->post("subtitleSwiper");
        $statusSwiper = $this->input->post("statusSwiper");
        $imgSwiper = $this->input->post("photoPathEdit");
        $imgsmSwiper = $this->input->post("photoPathEdit2");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_swiper = [
            "locale" => $locale,
            "idBusiness" => $idBusiness,
            "imgSwiper" => $imgSwiper,
            "imgsmSwiper" => $imgsmSwiper,
            "titleSwiper" => $titleSwiper,
            "subtitleSwiper" => $subtitleSwiper,
            "statusSwiper" => $statusSwiper,
            "expiredSwiper" => "2024-12-01",
            "idUser" => $this->session->userdata("idUser"),
            "createdAtSwiper" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idSwiper", $idSwiper);
        $this->db->update("sahira_hero_swiper", $data_swiper);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Swiper berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingSliderHotel/".$idBusiness."/");
    }
    public function insertSiteSettingHero()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $locale = $this->input->post("locale");
        $titleHero = $this->input->post("titleHero");
        $subtitleHero = $this->input->post("subtitleHero");
        $statusHero = $this->input->post("statusHero");
        // Upload file gambar
        $config["upload_path"] = "./assets/images/Hero/";
        $config["allowed_types"] = "jpg|jpeg|png|gif";
        $config["file_name"] = time() . "_" . $_FILES["imgHero"]["name"];
        $this->upload->initialize($config);
        $this->upload->do_upload("imgHero");
        $uploadData = $this->upload->data();
        $imgHero = $uploadData["file_name"];
        // Memasukkan data ke dalam tabel sahira_hero
        $data_hero = [
            "locale" => $locale,
            "imgHero" => $imgHero,
            "titleHero" => $titleHero,
            "subtitleHero" => $subtitleHero,
            "statusHero" => $statusHero,
            "idUser" => $this->session->userdata("idUser"),
            "createdAtHero" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("sahira_hero", $data_hero);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Hero berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingHero");
    }
    public function insertSiteSettingTestimonial()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $locale = $this->input->post("locale");
        $nmTestimonial = $this->input->post("nmTestimonial");
        $textTestimonial = $this->input->post("textTestimonial");
        $statusTestimonial = $this->input->post("statusTestimonial");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_swiper = [
            "locale" => $locale,
            "nmTestimonial" => $nmTestimonial,
            "textTestimonial" => $textTestimonial,
            "statusTestimonial" => $statusTestimonial,
            "idUser" => $this->session->userdata("idUser"),
            "createdAtTestimonial" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("sahira_hero_testimonial", $data_swiper);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Swiper berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingTestimonials");
    }
    public function insertSiteSettingTestimonialHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        // Mengambil data dari form
        $locale = $this->input->post("locale");
        $nmTestimonial = $this->input->post("nmTestimonial");
        $textTestimonial = $this->input->post("textTestimonial");
        $statusTestimonial = $this->input->post("statusTestimonial");
        // Memasukkan data ke dalam tabel sahira_hero_swiper
        $data_swiper = [
            "locale" => $locale,
            "idBusiness" => $idBusiness,
            "nmTestimonial" => $nmTestimonial,
            "textTestimonial" => $textTestimonial,
            "statusTestimonial" => $statusTestimonial,
            "idUser" => $this->session->userdata("idUser"),
            "createdAtTestimonial" => date("Y-m-d H:i:s"),
        ];
        $this->db->insert("sahira_hero_testimonial", $data_swiper);
        // Set pesan sukses dan redirect
        $this->session->set_flashdata(
            "pesansukses",
            "Data Swiper berhasil ditambahkan"
        );
        redirect("cms/home/viewSiteSettingTestimonialsHotel/".$idBusiness."/");
    }
    public function viewSiteSettingPage()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["page_template"] = $this->Home_m->getfile_page_template();
        $data["header"] = $this->Home_m->getfile_header();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_page", $data);
        $this->load->view("cms/footer", $data);
    }
    public function getHeadersByLocale()
    {
        // Ambil locale dari request (misalnya dari AJAX)
        $locale = $this->input->get("locale");

        // Ambil data header berdasarkan locale
        $headers = $this->Home_m->getHeadersByLocale($locale);

        // Kembalikan data dalam format JSON
        echo json_encode($headers);
    }
    public function insertSiteSettingPage()
    {
        // Ambil data dari POST
        $idPagetemplate = $this->input->post("idPagetemplate");
        $statusContent = $this->input->post("statusContent");
        $idHeader = $this->input->post("idHeader");
        $locale = $this->input->post("locale");
        $titleContent = $this->input->post("titleContent");
        $codePagetemplate = $this->input->post("codePagetemplate"); // menerima codePagetemplate
        $Name = $this->input->post("Name");
        $title = $this->input->post("title");
        $title2 = $this->input->post("title2");
        $subtitle = $this->input->post("subtitle");
        $addres = $this->input->post("addres");
        $descENBusiness = $this->input->post("descENBusiness");
        $image = $this->input->post("image");
        $image2 = $this->input->post("image2");
        $image3 = $this->input->post("image3");
        $urlmapBusiness = $this->input->post("urlmapBusiness");
        // Cek apakah idHeader ada di tabel sahira_header_left_sub dan sahira_header_left
        $headerExistsInSub = $this->db
            ->get_where("sahira_header_left_sub", ["idHeader" => $idHeader])
            ->row();
        $headerExistsInMain = $this->db
            ->get_where("sahira_header_left", ["idHeader" => $idHeader])
            ->row();
        // Jika idHeader ada di sahira_header_left, namun tidak di sahira_header_left_sub, tambahkan ke sahira_header_left_sub
        if ($headerExistsInMain && !$headerExistsInSub) {
            // Buat slug dari titleContent
            $slug = $this->create_slug($titleContent);
            // Tambahkan idHeader dan nmHeaderSub ke sahira_header_left_sub
            $dataHeaderSub = [
                "idHeader" => $idHeader,
                "nmHeaderSub" => $slug,
                "locale" => $locale,
                "linkHeaderSub" => "/" . $slug, // linkHeaderSub memiliki prefix /slug
                "statusHeaderSub" => 1, // misalkan 1 untuk aktif
                "createdAtHeaderSub" => date("Y-m-d H:i:s"),
            ];
            // Insert data ke tabel sahira_header_left_sub
            $this->db->insert("sahira_header_left_sub", $dataHeaderSub);
        }
        // Jika idHeader ditemukan di salah satu tabel atau telah diinsert ke sahira_header_left_sub
        if ($headerExistsInSub || $headerExistsInMain) {
            // Buat slug dari titleContent
            $slug = $this->create_slug($titleContent);
            // Cek apakah nmHeaderSub dengan $slug sudah ada di tabel sahira_header_left_sub
            $headerSubExists = $this->db
                ->get_where("sahira_header_left_sub", ["nmHeaderSub" => $slug])
                ->row();
            // Jika nmHeaderSub belum ada, tambahkan data baru ke sahira_header_left_sub
            if (!$headerSubExists) {
                $dataHeaderSub = [
                    "idHeader" => $idHeader,
                    "nmHeaderSub" => $slug,
                    "locale" => $locale,
                    "linkHeaderSub" => "/" . $slug, // linkHeaderSub memiliki prefix /slug
                    "statusHeaderSub" => 1, // misalkan 1 untuk aktif
                    "createdAtHeaderSub" => date("Y-m-d H:i:s"),
                ];
                // Insert data ke tabel sahira_header_left_sub
                $this->db->insert("sahira_header_left_sub", $dataHeaderSub);
            }
            // Jika image berformat base64 dan diawali dengan data:image/jpeg;base64, atau data:image/png;base64,
            if (preg_match("/^data:image\/(\w+);base64,/", $image, $type)) {
                $image = substr($image, strpos($image, ",") + 1); // Menghapus bagian data:image/jpeg;base64,
                $type = strtolower($type[1]); // Mendapatkan tipe file (jpeg, png, dll.)
                // Validasi tipe gambar
                if (!in_array($type, ["jpg", "jpeg", "png"])) {
                    throw new Exception(
                        "Invalid image type. Only JPG, JPEG, and PNG types are allowed."
                    );
                }
                // Decode base64 menjadi data biner
                $image = base64_decode($image);
                if ($image === false) {
                    throw new Exception("Base64 decoding of the image failed.");
                }
                // Simpan file di server, misalnya di folder uploads
                $filePath =
                    FCPATH .
                    "./assets/images/page-content/" .
                    uniqid() .
                    "." .
                    $type;
                file_put_contents($filePath, $image);
                // Set the path to the image file in the $dataContent array
                $dataContent["image"] = base_url(
                    "./assets/images/page-content/" . basename($filePath)
                );
            } else {
                // Jika input gambar tidak valid
                $dataContent["image"] = null;
            }
            // Jika image2 berformat base64 dan diawali dengan data:image2/jpeg;base64, atau data:image2/png;base64,
            if (preg_match("/^data:image\/(\w+);base64,/", $image2, $type)) {
                $image2 = substr($image2, strpos($image2, ",") + 1); // Menghapus bagian data:image2/jpeg;base64,
                $type = strtolower($type[1]); // Mendapatkan tipe file (jpeg, png, dll.)
                // Validasi tipe gambar
                if (!in_array($type, ["jpg", "jpeg", "png"])) {
                    throw new Exception(
                        "Invalid image2 type. Only JPG, JPEG, and PNG types are allowed."
                    );
                }
                // Decode base64 menjadi data biner
                $image2 = base64_decode($image2);
                if ($image2 === false) {
                    throw new Exception(
                        "Base64 decoding of the image2 failed."
                    );
                }
                // Simpan file di server, misalnya di folder uploads
                $filePath =
                    FCPATH .
                    "./assets/images/page-content/" .
                    uniqid() .
                    "." .
                    $type;
                file_put_contents($filePath, $image2);
                // Set the path to the image2 file in the $dataContent array
                $dataContent["image2"] = base_url(
                    "./assets/images/page-content/" . basename($filePath)
                );
            } else {
                // Jika input gambar tidak valid
                $dataContent["image2"] = null;
            }
            // Jika image3 berformat base64 dan diawali dengan data:image3/jpeg;base64, atau data:image3/png;base64,
            if (preg_match("/^data:image\/(\w+);base64,/", $image3, $type)) {
                $image3 = substr($image3, strpos($image3, ",") + 1); // Menghapus bagian data:image3/jpeg;base64,
                $type = strtolower($type[1]); // Mendapatkan tipe file (jpeg, png, dll.)
                // Validasi tipe gambar
                if (!in_array($type, ["jpg", "jpeg", "png"])) {
                    throw new Exception(
                        "Invalid image3 type. Only JPG, JPEG, and PNG types are allowed."
                    );
                }
                // Decode base64 menjadi data biner
                $image3 = base64_decode($image3);
                if ($image3 === false) {
                    throw new Exception(
                        "Base64 decoding of the image3 failed."
                    );
                }
                // Simpan file di server, misalnya di folder uploads
                $filePath =
                    FCPATH .
                    "./assets/images/page-content/" .
                    uniqid() .
                    "." .
                    $type;
                file_put_contents($filePath, $image3);
                // Set the path to the image3 file in the $dataContent array
                $dataContent["image3"] = base_url(
                    "./assets/images/page-content/" . basename($filePath)
                );
            } else {
                // Jika input gambar tidak valid
                $dataContent["image3"] = null;
            }
            // Buat array data untuk dimasukkan ke tabel sahira_page_template_content
            $dataContent = [
                "locale" => $locale,
                "idPagetemplate" => $idPagetemplate,
                "titleContent" => $slug,
                "idHeader" => $idHeader,
                "Name" => $Name,
                "title" => $title,
                "title2" => $title2,
                "subtitle" => $subtitle,
                "image" => $dataContent["image"], // Menggunakan kunci unik untuk masing-masing gambar
                "image2" => $dataContent["image2"], // Menggunakan kunci unik untuk masing-masing gambar
                "image3" => $dataContent["image3"], // Menggunakan kunci unik untuk masing-masing gambar
                "addres" => $addres,
                "descENBusiness" => $descENBusiness,
                "urlmapBusiness" => $urlmapBusiness,
                "statusContent" => $statusContent,
                "createdAtContent" => date("Y-m-d H:i:s"),
                "codePagetemplate" => $codePagetemplate,
            ];
            // echo json_encode(array("result" => $dataContent, "message" => "idHeader ditemukan di salah satu tabel atau telah diinsert ke sahira_header_left_sub"));
            // Simpan data ke tabel sahira_page_template_content
            $this->db->insert("sahira_page_template_content", $dataContent);
            // Path untuk file .php di folder ../views/
            $filePath = "../../sahirahotelsgroup.com/application/views/{$slug}.php";
            // Isi file .php yang akan dibuat
            $fileContent = "<!-- Template File for {$titleContent} -->\n";
            $fileContent .= $codePagetemplate; // masukkan kode template dari post
            // Buat file .php dengan slug sebagai nama filenya
            if (file_put_contents($filePath, $fileContent) !== false) {
                echo "File created successfully.";
                echo $filePath;
                // create routes.php
                // Update file routes.php untuk menambahkan slug
                $routesFilePath =
                    "../../sahirahotelsgroup.com/application/config/routes.php";
                // Baca isi file routes.php
                $routesContent = file_get_contents($routesFilePath);
                // Tambahkan rute baru untuk slug
                $newRoute = "\$route['{$slug}/(:any)/(:any)'] = 'home/{$slug}/\$1/\$2';\n";
                $newRoute .= "\$route['{$slug}'] = 'home/{$slug}';\n";
                // Insert new route before the catch-all route
                $routesContent = str_replace(
                    '$route[\'(:any)/(:any)\'] = \'$2\';',
                    $newRoute . '$route[\'(:any)/(:any)\'] = \'$2\';',
                    $routesContent
                );
                // Tulis kembali ke file routes.php
                file_put_contents($routesFilePath, $routesContent);
                // update controller/Home.php
                // Ubah file Home.php untuk menambahkan fungsi slug
                $homeFilePath =
                    "../../sahirahotelsgroup.com/application/controllers/Home.php";
                // Baca isi file Home.php
                $homeContent = file_get_contents($homeFilePath);
                // Mencari posisi untuk menyisipkan fungsi
                $insertPosition = strrpos($homeContent, "}"); // menemukan posisi penutup class
                // Konten fungsi baru
                $functionContent = "
                            public function {$slug}(\$lang = '', \$nmHeaderSub = '')  
                            {
                                // Cek apakah parameter lang ada di URL, jika tidak ambil dari session
                                if (\$lang == '') {
                                    \$lang = \$this->session->userdata('site_lang');
                                }
                                // Set default language jika tidak ada dalam session atau URL
                                if (\$lang == '') {
                                    \$lang = 'en'; // Atau bahasa default lainnya
                                }
                                \$this->lang->load('general', \$lang);
                                \$this->session->set_userdata('site_lang', \$lang);
                                // Load the view
                                \$data['home_hero_data'] = \$this->Home_m->getHomeHeroData(\$lang);
                                \$data['sahira_hero_swiper'] = \$this->Home_m->getsahira_hero_swiper(\$lang);
                                    \$data['content'] = \$this->Home_m->get{$slug}(\$lang, \$nmHeaderSub);
                                    \$data['Business_Detail'] = \$this->Home_m->getBusiness_Detail();
                                    \$data['places'] = \$this->Home_m->getplaces();
                                    \$data['heros'] = \$this->Home_m->getHerosHotel(\$lang);
                                    \$data['voucher_catalog'] = \$this->Home_m->getfile_voucher_catalog();
                                    \$data['testimonial'] = \$this->Home_m->getTestimonial(\$lang);
                                    \$data['date'] = date('Y-m-d');
                                \$this->load->view('header', \$data);
                                \$this->load->view('{$slug}', \$data);
                                \$this->load->view('footer', \$data);
                            }
                        ";
                // Sisipkan fungsi baru di posisi yang ditemukan
                $homeContent = substr_replace(
                    $homeContent,
                    $functionContent,
                    $insertPosition,
                    0
                );
                // Tulis kembali ke file Home.php
                file_put_contents($homeFilePath, $homeContent);
                // update models/Home_m.php
                // Ubah file Home.php untuk menambahkan fungsi slug
                $home_mFilePath =
                    "../../sahirahotelsgroup.com/application/models/Home_m.php";
                // Baca isi file Home_m.php
                $home_mContent = file_get_contents($home_mFilePath);
                // Mencari posisi untuk menyisipkan fungsi
                $insertModelsPosition = strrpos($home_mContent, "}"); // menemukan posisi penutup class
                // Konten fungsi baru
                $functionModelsContent = "
                            public function get{$slug}(\$locale, \$titleContent)  
                            {
                                \$data = array();
                                  \$this->db->from('sahira_page_template_content');
                                  \$this->db->where('titleContent', \$titleContent);
                                  \$this->db->where('locale', \$locale);
                                  \$query = \$this->db->get();
                                  if (\$query->num_rows() > 0)
                                  {
                                    \$data = \$query->row();
                                  }
                                  \$query->free_result();  
                                  return \$data;
                            }
                        ";
                // Sisipkan fungsi baru di posisi yang ditemukan
                $home_mContent = substr_replace(
                    $home_mContent,
                    $functionModelsContent,
                    $insertModelsPosition,
                    0
                );
                // Tulis kembali ke file Home.php
                file_put_contents($home_mFilePath, $home_mContent);
                // Redirect atau tampilkan pesan sukses
                redirect("cms/home/viewSiteSettingPage");
            } else {
                echo "Failed to create file.";
            }
        } else {
            // Jika idHeader tidak ditemukan di tabel yang diperlukan, tampilkan pesan error atau log error
            echo "Error: idHeader tidak ditemukan di tabel yang diperlukan.";
        }
    }
    public function getTemplate()
    {
        $code = $this->input->get("code");
        $template = $this->Home_m->getTemplateByCode($code); // Fetch the template from your model
        if ($template) {
            echo $template->codePagetemplate; // Assuming htmlContent contains your HTML
        } else {
            echo "Template not found!";
        }
    }
    public function getContent()
    {
        $code = $this->input->get("code");
        $template = $this->Home_m->getTemplateByCode($code); // Fetch the template from your model
        if ($template) {
            echo $template->contentPagetemplate; // Assuming htmlContent contains your HTML
        } else {
            echo "Template not found!";
        }
    }
    public function ajaxMetPixel()
    {
        $access_token = $this->config->item("tokenMeta");
        $pixel_id = "855303996242189";
        $url = "https://graph.facebook.com/v20.0/$pixel_id/stats?access_token=$access_token";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $stats = json_decode($response, true);
        $filteredData = [];
        foreach ($stats["data"] as $stat) {
            $newData = [];
            foreach ($stat["data"] as $event) {
                if ($event["value"] == "PageView") {
                    $newData[] = $event;
                }
            }
            if (!empty($newData)) {
                $filteredData[] = [
                    "start_time" => $stat["start_time"],
                    "data" => $newData,
                ];
            }
        }
        echo json_encode($filteredData);
    }
    public function ajaxMetPixelCart()
    {
        $access_token = $this->config->item("tokenMeta");
        $pixel_id = "855303996242189";
        $url = "https://graph.facebook.com/v20.0/$pixel_id/stats?access_token=$access_token";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $stats = json_decode($response, true);
        $filteredData = [];
        foreach ($stats["data"] as $stat) {
            $newData = [];
            foreach ($stat["data"] as $event) {
                if ($event["value"] == "AddToCart") {
                    $newData[] = $event;
                }
            }
            if (!empty($newData)) {
                $filteredData[] = [
                    "start_time" => $stat["start_time"],
                    "data" => $newData,
                ];
            }
        }
        echo json_encode($filteredData);
    }
    public function ajaxMetPixelPurchase()
    {
        $access_token = $this->config->item("tokenMeta");
        $pixel_id = "855303996242189";
        $url = "https://graph.facebook.com/v20.0/$pixel_id/stats?access_token=$access_token";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $stats = json_decode($response, true);
        $filteredData = [];
        foreach ($stats["data"] as $stat) {
            $newData = [];
            foreach ($stat["data"] as $event) {
                if ($event["value"] == "Purchase") {
                    $newData[] = $event;
                }
            }
            if (!empty($newData)) {
                $filteredData[] = [
                    "start_time" => $stat["start_time"],
                    "data" => $newData,
                ];
            }
        }
        echo json_encode($filteredData);
    }
    public function viewSiteSettingMetaPixel()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["testimonial"] = $this->Home_m->getfile_testimonial();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_meta_pixel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingAbout()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["about"] = $this->Home_m->getfile_about();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_about", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateSiteSettingAbout()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $idAbout = $this->input->post("idAbout");
        $extensi1 = explode(".", $_FILES["uploadbgheroAbout"]["name"]);
        $config1["upload_path"] = "./assets/images/about/";
        $config1["allowed_types"] = "jpg|png|jpeg|pdf";
        $this->upload->initialize($config1);
        $this->upload->do_upload("uploadbgheroAbout");
        $gbr1 = $this->upload->data();
        $extensi2 = explode(".", $_FILES["uploadimgAbout"]["name"]);
        $config2["upload_path"] = "./assets/images/about/";
        $config2["allowed_types"] = "jpg|png|jpeg|pdf";
        $this->upload->initialize($config2);
        $this->upload->do_upload("uploadimgAbout");
        $gbr2 = $this->upload->data();
        $data_header_sub = [
            "locale" => $this->input->post("locale"),
            "titleheroAbout" => $this->input->post("titleheroAbout"),
            "titleAbout" => $this->input->post("titleAbout"),
            "subtitleAbout" => $this->input->post("subtitleAbout"),
            "idUser" => $this->session->userdata("idUser"),
            // 'bgheroAbout'                => $gbr1['file_name'] || $this->input->post("bgheroAbout"),
            // 'imgAbout'               => $gbr2['file_name'] || $this->input->post("imgAbout"),
            "createdAtAbout" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idAbout", $idAbout);
        $this->db->update("sahira_hero_about", $data_header_sub);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingAbout/");
    }
    public function viewSiteSettingOurHotels()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["our_hotels"] = $this->Home_m->getfile_our_hotels();
        $data["hotels"] = $this->Home_m->getfile_hotels();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_our_hotels", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateSiteSettingOurHotels()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $detail_hotel = [
            "titleHero" => $this->input->post("titleHero"),
            "subtitleHero" => $this->input->post("subtitleHero"),
            "createdAtHero" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idHero", $this->input->post("idHero"));
        $this->db->update("sahira_hero", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingOurHotels/");
    }
    public function updateSiteSettingHotel()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $detail_hotel = [
            "Name" => $this->input->post("Name"),
            "addres" => $this->input->post("addres"),
            "emailReservationBusiness" => $this->input->post(
                "emailReservationBusiness"
            ),
            "emailCABusiness" => $this->input->post("emailCABusiness"),
            "emailARBusiness" => $this->input->post("emailARBusiness"),
            "mobileBusiness" => $this->input->post("mobileBusiness"),
            "urlmapBusiness" => $this->input->post("urlmapBusiness"),
            "feeBusiness" => $this->input->post("feeBusiness"),
            "feedokuMandiriBusiness" => $this->input->post(
                "feedokuMandiriBusiness"
            ),
            "descIDBusiness" => $this->input->post("descIDBusiness"),
            "descENBusiness" => $this->input->post("descENBusiness"),
            "growmemberBusiness" => $this->input->post("growmemberBusiness"),
            "extrabedBusiness" => $this->input->post("extrabedBusiness"),
            "createdAtBusiness" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idBusiness", $this->input->post("idBusiness"));
        $this->db->update("Business_Detail", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingOurHotels/");
    }
    public function viewSiteSettingHomeOffers()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["home_offers"] = $this->Home_m->getfile_home_offers();
        $data["offers"] = $this->Home_m->getfile_offers();
        $data[
            "user"
        ] = $this->Home_m->getfile_user_by_tokenpushnotificationAll();
        $data["packages"] = $this->BusinessDetail_m->getFile_packages();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_home_offers", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateSiteSettingHomeOffers()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $detail_hotel = [
            "titlehomeHero" => $this->input->post("titlehomeHero"),
            "titleHero" => $this->input->post("titleHero"),
            "createdAtHero" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idHero", $this->input->post("idHero"));
        $this->db->update("sahira_hero_special_offers", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingHomeOffers/");
    }
    public function updateSiteSettingOffers()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $extensi2 = explode(".", $_FILES["imgSpecialoffers"]["name"]);
        $config2["upload_path"] = "./assets/images/offers/";
        $config2["allowed_types"] = "jpg|png|jpeg|pdf";
        $this->upload->initialize($config2);
        $this->upload->do_upload("imgSpecialoffers");
        $gbr2 = $this->upload->data();
        $detail_hotel = [
            "urlSpecialoffers" => $this->input->post("urlSpecialoffers"),
            "titleSpecialoffers" => $this->input->post("titleSpecialoffers"),
            "subtitleSpecialoffers" => $this->input->post(
                "subtitleSpecialoffers"
            ),
            "imgSpecialoffers" => $gbr2["file_name"],
            "createdAtSpecialoffers" => date("Y-m-d H:i:s"),
        ];
        $this->db->where(
            "idSpecialoffers",
            $this->input->post("idSpecialoffers")
        );
        $this->db->update("sahira_special_offers", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingHomeOffers/");
    }
    public function viewSiteSettingLocalAttractions()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["local_attractions"] = $this->Home_m->getfile_local_attractions();
        $data["attractions"] = $this->Home_m->getfile_attractions();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_local_attractions", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateSiteSettingLocalAttractions()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $detail_hotel = [
            "titlelocalattractionHero" => $this->input->post(
                "titlelocalattractionHero"
            ),
            "subtitlelocalattractionHero" => $this->input->post(
                "subtitlelocalattractionHero"
            ),
            "createdAtHero" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idHero", $this->input->post("idHero"));
        $this->db->update("sahira_hero_special_offers", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingLocalAttractions/");
    }
    public function updateSiteSettingAttraction()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $detail_hotel = [
            "Name" => $this->input->post("Name"),
            "addres" => $this->input->post("addres"),
            "emailReservationBusiness" => $this->input->post(
                "emailReservationBusiness"
            ),
            "emailCABusiness" => $this->input->post("emailCABusiness"),
            "emailARBusiness" => $this->input->post("emailARBusiness"),
            "mobileBusiness" => $this->input->post("mobileBusiness"),
            "urlmapBusiness" => $this->input->post("urlmapBusiness"),
            "feeBusiness" => $this->input->post("feeBusiness"),
            "feedokuMandiriBusiness" => $this->input->post(
                "feedokuMandiriBusiness"
            ),
            "descIDBusiness" => $this->input->post("descIDBusiness"),
            "descENBusiness" => $this->input->post("descENBusiness"),
            "growmemberBusiness" => $this->input->post("growmemberBusiness"),
            "extrabedBusiness" => $this->input->post("extrabedBusiness"),
            "createdAtBusiness" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idBusiness", $this->input->post("idBusiness"));
        $this->db->update("Business_Detail", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingLocalAttractions/");
    }
    public function viewSiteSettingJoinMember()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["join_member"] = $this->Home_m->getfile_join_member();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_join_member", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingJoinMemberHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["join_member"] = $this->Home_m->getfile_join_member_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_join_member_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateSiteSettingJoinMember()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $extensi2 = explode(".", $_FILES["imgHero"]["name"]);
        $config2["upload_path"] = "./assets/images/";
        $config2["allowed_types"] = "jpg|png|jpeg|pdf";
        $this->upload->initialize($config2);
        $this->upload->do_upload("imgHero");
        $gbr2 = $this->upload->data();
        $detail_hotel = [
            "titlehomeHero" => $this->input->post("titlehomeHero"),
            "titlejoinmemberHero" => $this->input->post("titlejoinmemberHero"),
            "subtitlejoinmemberHero" => $this->input->post(
                "subtitlejoinmemberHero"
            ),
            "imgHero" => $gbr2["file_name"],
            "createdAtHero" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idHero", $this->input->post("idHero"));
        $this->db->update("sahira_hero_home", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingJoinMember/");
    }
    public function viewSiteSettingStayInTouch()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["stay_in_touch"] = $this->Home_m->getfile_stay_in_touch();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_stay_in_touch", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingStayInTouchHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["stay_in_touch"] = $this->Home_m->getfile_stay_in_touch_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_stay_in_touch_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function updateSiteSettingStayInTouch()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $extensi2 = explode(".", $_FILES["imgHero"]["name"]);
        $config2["upload_path"] = "./assets/images/";
        $config2["allowed_types"] = "jpg|png|jpeg|pdf";
        $this->upload->initialize($config2);
        $this->upload->do_upload("imgHero");
        $gbr2 = $this->upload->data();
        $detail_hotel = [
            "titlehomeHero" => $this->input->post("titlehomeHero"),
            "titlestayintouchHero" => $this->input->post(
                "titlestayintouchHero"
            ),
            "subtitlestayintouchHero" => $this->input->post(
                "subtitlestayintouchHero"
            ),
            "imgHero" => $gbr2["file_name"],
            "createdAtHero" => date("Y-m-d H:i:s"),
        ];
        $this->db->where("idHero", $this->input->post("idHero"));
        $this->db->update("sahira_hero_home_stay", $detail_hotel);
        $this->session->set_flashdata("pesansukses", "Menu telah ditambahkan");
        redirect("cms/home/viewSiteSettingStayInTouch/");
    }
    public function viewSiteSettingPressRelease()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["press_release"] = $this->Home_m->getfile_press_release();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_pressrelease", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingCareer()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["career"] = $this->Home_m->getfile_career();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_career", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingFacilitiesHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["facilities"] = $this->Home_m->getfile_facilities_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_facilities_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function viewSiteSettingGalleryHotel($idBusiness)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }

        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $data["gallery"] = $this->Home_m->getfile_gallery_hotel($idBusiness);
        $data['idBusiness'] = $idBusiness;
        $this->load->view("cms/header", $data);
        $this->load->view("cms/view_site_setting_gallery_hotel", $data);
        $this->load->view("cms/footer", $data);
    }
    public function dev()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/form_press_release", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertpressrelease()
    {
         $statusPressrelease = $this->input->post('statusPressrelease');
        $locale = $this->input->post('locale');
        $nmPressrelease = $this->input->post('nmPressrelease');
        $ketPressrelease = $this->input->post('ketPressrelease');
        $urlPressrelease = $this->input->post('urlPressrelease');

        // Prepare upload configurations
        $config['upload_path'] = './assets/images/';  // Make sure this folder exists and is writable
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;  // Maximum file size in KB

        // Load upload library with the specified configuration
        $this->load->library('upload', $config);

        // Upload and retrieve Logo file if exists
        

        // Upload and retrieve FotoHotel file if exists
        $imgPressrelease = null;
        if (!empty($_FILES['imgPressrelease']['name'])) {
            $config['file_name'] = 'imgPressrelease' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imgPressrelease')) {
                $imgPressrelease = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }

        $data = array(
            "statusPressrelease" => $statusPressrelease,
            "locale" => $locale,
            "nmPressrelease" => $nmPressrelease,
            "ketPressrelease" => $ketPressrelease,
            "urlPressrelease" => $urlPressrelease,
            "imgPressrelease" => $imgPressrelease,
        );

        $this->db->insert('sahira_hero_press_release', $data);
        redirect('cms/home/dev');
    }
    public function career()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 1,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/form_press_release", $data);
        $this->load->view("cms/footer", $data);
    }
    public function insertcareer()
    {
        $statusCarrer = $this->input->post('statusCarrer');
        $locale = $this->input->post('locale');
        $nmCarrer = $this->input->post('nmCarrer');
        $ketCarrer = $this->input->post('ketCarrer');
        $locationCarrer = $this->input->post('locationCarrer');


        $data = array(
            "statusCarrer" => $statusCarrer,
            "locale" => $locale,
            "nmCarrer" => $nmCarrer,
            "ketCarrer" => $ketCarrer,
            "locationCarrer" => $locationCarrer,
        );

        $this->db->insert('sahira_hero_carrer', $data);
        redirect('cms/home/viewSiteSettingCareer');
    }
    public function updatecareer()
    {
        $statusCarrer = $this->input->post('statusCarrer');
        $locale = $this->input->post('locale');
        $nmCarrer = $this->input->post('nmCarrer');
        $ketCarrer = $this->input->post('ketCarrer');
        $locationCarrer = $this->input->post('locationCarrer');


        $data = array(
            "statusCarrer" => $statusCarrer,
            "locale" => $locale,
            "nmCarrer" => $nmCarrer,
            "ketCarrer" => $ketCarrer,
            "locationCarrer" => $locationCarrer,
        );

        $this->db->insert('sahira_hero_carrer', $data);
        redirect('cms/home/viewSiteSettingCareer');
    }
    public function deletecareer($idCarrer)
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $this->db->where("idCarrer", $idCarrer);
        $this->db->delete("sahira_hero_carrer");
        redirect("cms/home/viewSiteSettingCareer");
    }
    public function insertjoinmember($idBusiness)
    {
        $statusjoinmemberHero = $this->input->post('statusjoinmemberHero');
        $locale = $this->input->post('locale');
        $titlehomeHero = $this->input->post('titlehomeHero');
        $titlejoinmemberHero = $this->input->post('titlejoinmemberHero');
        $subtitlejoinmemberHero = $this->input->post('subtitlejoinmemberHero');

        // Prepare upload configurations
        $config['upload_path'] = './assets/images/';  // Make sure this folder exists and is writable
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;  // Maximum file size in KB

        // Load upload library with the specified configuration
        $this->load->library('upload', $config);

        // Upload and retrieve Logo file if exists
        

        // Upload and retrieve FotoHotel file if exists
        $imgHero = null;
        if (!empty($_FILES['imgHero']['name'])) {
            $config['file_name'] = 'imgHero' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imgHero')) {
                $imgHero = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }

        $data = array(
            "statusjoinmemberHero" => $statusjoinmemberHero,
            "locale" => $locale,
            "idBusiness" => $idBusiness,
            "titlehomeHero" => $titlehomeHero,
            "titlejoinmemberHero" => $titlejoinmemberHero,
            "subtitlejoinmemberHero" => $subtitlejoinmemberHero,
            "imgHero" => $imgHero,
        );

        $this->db->insert('sahira_hero_home', $data);
        redirect('cms/home/viewSiteSettingJoinMemberHotel'.$idBusiness.'/');
    }
    public function insertstaymember($idBusiness)
    {
         $statusStay = $this->input->post('statusStay');
        $locale = $this->input->post('locale');
        $titlehomeHero = $this->input->post('titlehomeHero');
        $titlestayintouchHero = $this->input->post('titlestayintouchHero');
        $subtitlestayintouchHero = $this->input->post('subtitlestayintouchHero');
        $textstayintouchHero = $this->input->post('textstayintouchHero');
        $titlejoinmemberHero = $this->input->post('titlejoinmemberHero');

        // Prepare upload configurations
        $config['upload_path'] = './assets/images/';  // Make sure this folder exists and is writable
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;  // Maximum file size in KB

        // Load upload library with the specified configuration
        $this->load->library('upload', $config);

        // Upload and retrieve Logo file if exists
        

        // Upload and retrieve FotoHotel file if exists
        $imgHero = null;
        if (!empty($_FILES['imgHero']['name'])) {
            $config['file_name'] = 'imgHero' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imgHero')) {
                $imgHero = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }

        $data = array(
            "statusStay" => $statusStay,
            "locale" => $locale,
            "idBusiness" => $idBusiness,
            "titlehomeHero" => $titlehomeHero,
            "titlestayintouchHero" => $titlestayintouchHero,
            "subtitlestayintouchHero" => $subtitlestayintouchHero,
            "textstayintouchHero" => $textstayintouchHero,
            "titlejoinmemberHero" => $titlejoinmemberHero,
            "imgHero" => $imgHero,
        );

        $this->db->insert('sahira_hero_home_stay', $data);
        redirect('cms/home/dev');
    }
    public function insertfacilities($idBusiness)
    {
         $statusFacilities = $this->input->post('statusFacilities');
        $locale = $this->input->post('locale');
        $nmFacilities = $this->input->post('nmFacilities');
        $ketFacilities = $this->input->post('ketFacilities');
        $openFacilities = $this->input->post('openFacilities');
        $floorFacilities = $this->input->post('floorFacilities');

        // Prepare upload configurations
        $config['upload_path'] = './assets/images/kamar/';  // Make sure this folder exists and is writable
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 30720;  // Maximum file size in KB

        // Load upload library with the specified configuration
        $this->load->library('upload', $config);

        // Upload and retrieve Logo file if exists
        

        // Upload and retrieve FotoHotel file if exists
        $imgFacilities = null;
        if (!empty($_FILES['imgFacilities']['name'])) {
            $config['file_name'] = 'imgFacilities' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imgFacilities')) {
                $imgFacilities = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }
         $img2Facilities = null;
        if (!empty($_FILES['img2Facilities']['name'])) {
            $config['file_name'] = 'img2Facilities' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img2Facilities')) {
                $img2Facilities = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }
         $img3Facilities = null;
        if (!empty($_FILES['img3Facilities']['name'])) {
            $config['file_name'] = 'img3Facilities' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img3Facilities')) {
                $img3Facilities = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }

        $data = array(
            "statusFacilities" => $statusFacilities,
            "locale" => $locale,
            "idBusiness" => $idBusiness,
            "nmFacilities" => $nmFacilities,
            "ketFacilities" => $ketFacilities,
            "openFacilities" => $openFacilities,
            "floorFacilities" => $floorFacilities,
            "imgFacilities" => $imgFacilities,
            "img2Facilities" => $img2Facilities,
            "img3Facilities" => $img3Facilities,
        );

        $this->db->insert('sahira_hero_facilities', $data);
        redirect('cms/home/viewSiteSettingFacilitiesHotel/'.$idBusiness.'/');
    }
    public function insertgallery($idBusiness)
    {
         $typeGallery = $this->input->post('typeGallery');
        $kategoriGallery = $this->input->post('kategoriGallery');
        $ketGallery = $this->input->post('ketGallery');
        // Prepare upload configurations
        $config['upload_path'] = './assets/images/gallery/';  // Make sure this folder exists and is writable
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 30720;  // Maximum file size in KB

        // Load upload library with the specified configuration
        $this->load->library('upload', $config);

        // Upload and retrieve Logo file if exists
        

        // Upload and retrieve FotoHotel file if exists
        $imgGallery = null;
        if (!empty($_FILES['imgGallery']['name'])) {
            $config['file_name'] = 'imgGallery' . time();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('imgGallery')) {
                $imgGallery = $this->upload->data('file_name');
            } else {
                echo json_encode(array("error" => $this->upload->display_errors()));
                return;
            }
        }
         
        $data = array(
            "kategoriGallery" => $kategoriGallery,
            "idBusiness" => $idBusiness,
            "typeGallery" => $typeGallery,
            "ketGallery" => $ketGallery,
            "imgGallery" => $imgGallery,
            
        );

        $this->db->insert('sahira_gallery', $data);
        redirect('cms/home/viewSiteSettingGalleryHotel/'.$idBusiness.'/');
    }
    public function get_event_types()
    {
        $locale = $this->input->get('locale');
        $this->db->from('sahira_hero_offers');
        $this->db->where('locale', $locale);
        $query = $this->db->get();

        $data = [];
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }

        // Kembalikan hasil sebagai JSON
        echo json_encode($data);
    }

    public function reportemenu()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 36,
        ];
        $data["fnbMenu"] = $this->Fnb_m->getfile_fnb_menu();
        $this->load->view("reportemenu", $data);
    }

    public function reportkeuangan()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 6,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/report_keuangan", $data);
        $this->load->view("cms/footer", $data);
    }

    public function reportengineering()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 6,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/report_engineering", $data);
        $this->load->view("cms/footer", $data);
    }

    public function reporthousekeeping()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 6,
        ];
        $data['assignments'] = $this->Home_m->get_all_jobs_with_location();
        $data['housekeeping_users'] = $this->Home_m->get_housekeeping_users();
        $this->load->view("cms/header", $data);
        $this->load->view("cms/report_housekeeping", $data);
        $this->load->view("cms/footer", $data);
    }

    public function reportsecurity()
    {
        if ($this->session->userdata("logged_in") != "login") {
            redirect("login", "refresh");
        }
        $data = [
            "title" => "Madani Djourney | ONIXLABS",
            "nopage" => 6,
        ];
        $this->load->view("cms/header", $data);
        $this->load->view("cms/report_security", $data);
        $this->load->view("cms/footer", $data);
    }

}
