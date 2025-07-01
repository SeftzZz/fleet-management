<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('FIREBASE_JSON_URL', 'https://cms.sahirahotelsgroup.com/application/libraries/sahira-hotels-22cc474f98eb.json');
define('OAUTH2_TOKEN_URL', 'https://www.googleapis.com/oauth2/v4/token');
define('FCM_ENDPOINT', 'https://fcm.googleapis.com/v1/projects/sahira-hotels/messages:send');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . 'helpers/doku_helper.php';
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';
require_once "vendor/autoload.php";
// use namespace
use Restserver\Libraries\REST_Controller;
use \Firebase\JWT\JWT;
use DOKU\Common\Config;
use DOKU\Common\Utils;
use WebSocket\Client;
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('user_agent');
    $this->load->model('Login_m');
    $this->load->model('Api_m');
    $this->load->library("curl");
    date_default_timezone_set('Asia/Jakarta');
    $this->load->database();
    // Memuat koneksi ke database 'sql_salamdjourney_affiliate'
    $this->db2 = $this->load->database('sql_salamdjourney_affiliate', TRUE); // Load database kedua
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: no-cache, must-revalidate');
    header('Content-type: application/json');
    header('enctype: multipart/form-data');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization, token, X-Api-Key');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
  }
  public function processing_post() {
    header("Content-Type:application/json");
    $arr = json_decode(file_get_contents("php://input"), true);

    // Validate required parameters
    $requiredParams = ['email', 'customerName', 'amount', 'invoiceNumber', 'expiredTime', 'info1', 'info2', 'info3', 'reusableStatus'];
    foreach ($requiredParams as $param) {
        if (!isset($arr[$param])) {
            http_response_code(400);
            echo json_encode(['error' => "Missing parameter: $param"]);
            return;
        }
    }

    // Setup Parameter VA
    $paramsVa = array(
        'customerEmail' => $arr["email"],
        'customerName' => $arr["customerName"],
        'amount' => $arr["amount"],
        'invoiceNumber' =>  $arr["invoiceNumber"],
        'expiryTime' => $arr["expiredTime"],
        'info1' => $arr["info1"],
        'info2' => $arr["info2"],
        'info3' => $arr["info3"],
        'reusableStatus' => $arr["reusableStatus"]
    );

    $dokuClient = new DOKU\Client();
    $dokuClient->setClientId('BRN-0206-1706856229947');
    $dokuClient->setSharedKey('SK-t688X3HJjy7KBRs7othG');
    $dokuClient->isProduction(true);

    $obj_response = $dokuClient->generateDokuVa($paramsVa);

    if ($obj_response === null) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to generate virtual account']);
        return;
    }

    echo json_encode($obj_response);
  }
  public function paymentDokuVA_post() {
    $headers = $this->input->get_request_header('array');
    $dokuRequestId = $this->input->get_request_header('Request-Id', TRUE);
    $jsonString = file_get_contents('php://input');
    $jsonData = json_decode($jsonString, true);
    $virtual_account_number = $jsonData['virtual_account_info']['virtual_account_number'];
    $dokuPayment = $this->db->get_where('payment_doku', array('dokuId' => $dokuRequestId))->row();
    if ($dokuPayment != null) {
      $this->response([
        'status' => 'error',
        'message' => 'Payment with this request ID already exists.'
      ], REST_Controller::HTTP_BAD_REQUEST);
      return;
    }
    $dataDoku = array(
      'invoiceBooking' => $virtual_account_number,
      'dokuId' => $dokuRequestId,
      'dokuHeader' => json_encode($headers),
      'dokuData' => json_encode($jsonData),
    );
    $this->db->insert('payment_doku', $dataDoku);
    // FOR TESTING
    // $virtual_account_number = $this->input->post('virtual_account_number');
    $data['dataDoku'] = $this->Api_m->getfile_doku_by_id($virtual_account_number);
    if($data['dataDoku'] != null) {
      $virtual_doku = $data['dataDoku']->invoiceBooking;
      $dataBooking = $this->Api_m->getfile_reservation_by_id($virtual_doku);
      if($dataBooking) {
        echo json_encode(array("type" => "ROOM", "data" => $dataBooking, "VA" => $virtual_doku));
        $rateNow = $dataBooking->RateNow;
        $idBooking = $dataBooking->idBooking;
        $idCustomer = $dataBooking->idCustomer;
        $idBusiness = $dataBooking->idBusiness;
        $idUser = $dataBooking->idUser;
        $emailBooking = $dataBooking->emailBooking;
        $firstnameBooking = $dataBooking->firstnameBooking;
        $lastnameBooking = $dataBooking->lastnameBooking;
        $createdAtBooking = $dataBooking->createdAtBooking;
        $arrivalBooking = $dataBooking->arrivalBooking;
        $departureBooking = $dataBooking->departureBooking;
        $roomtypeBooking = $dataBooking->roomtypeBooking;
        $roompaxBooking = $dataBooking->roompaxBooking;
        $paxBooking = $dataBooking->paxBooking;
        $childBooking = $dataBooking->childBooking;
        $extrabedBooking = $dataBooking->extrabedBooking;
        $invoiceBooking = $dataBooking->invoiceBooking;
        $rateafterdiscountBooking = $dataBooking->rateafterdiscountBooking;
        $hotelName = $dataBooking->Name;
        $hotelAddress = $dataBooking->addres;
        $feeBusiness = $dataBooking->feeBusiness;
        $CABusiness = $dataBooking->emailCABusiness;
        $ARBusiness = $dataBooking->emailARBusiness;
        $statuspayDoku = $jsonData['transaction']['status'];
        if($statuspayDoku == 'SUCCESS') {
          $statuspayBooking = 'PAID';
        } else {
          $statuspayBooking = 'UNPAID';
        }
        $bookingdetail = $this->Api_m->getfile_booking_by_id($idBooking);
        if($bookingdetail->rateafterdiscountBooking != 0) {
          $payment = $bookingdetail->additionalBooking + $bookingdetail->chargeBooking + $bookingdetail->rateafterdiscountBooking;
          $totalratebooking = number_format($payment);
        } else {
          $payment = $bookingdetail->additionalBooking + $bookingdetail->chargeBooking + $bookingdetail->totalrateBooking;
          $totalratebooking = number_format($payment);
        }
        // $additionalBooking = number_format($bookingdetail->numberroomBooking);
        $chargeBooking = number_format($bookingdetail->chargeBooking);
        $sessionBusiness = $idBusiness;
        $sessionAddressBusiness = $hotelAddress;
        $sessionEmailUser = $emailBooking;
        $arrivalBooking = $this->fppfunction->format_tgl1($bookingdetail->arrivalBooking);
        $departureBooking = $this->fppfunction->format_tgl1($bookingdetail->departureBooking);
        $JumlahPoin = $bookingdetail->totalrateBooking * 0.05;
        $data_invoice = array(
          'idUser'            => $idUser,
          'idBooking'         => $idBooking,
          'priceInvoice'      => $rateafterdiscountBooking,
          'ketInvoice'        => $virtual_account_number,
          'refInvoice'        => $virtual_account_number,
          'idCustomer'        => $idCustomer,
          'idBusiness'        => $idBusiness,
          'createdAtInvoice'  => date('Y-m-d H:i:s'),
        );
        $this->db->insert('invoice', $data_invoice);
        $idInvoice = $this->db->insert_id();
        $data_update_booking = array(
          'statuspayBooking'  => $statuspayBooking,
          'statusBooking'     => 'Reservation',
          'editAt'            => date('Y-m-d H:i:s'),
        );
        $this->db->where('idBooking', $idBooking);
        $this->db->update('booking', $data_update_booking);
        $JumlahKomisi = $bookingdetail->totalrateBooking * 0;
        $data_CustomerPoin = array(
          'idUser'      => $idUser,
          'idCustomer'  => $idCustomer,
          'idBooking'   => $idBooking,
          'JumlahPoin'  => $JumlahPoin,
          'createdAtPoin'=> date('Y-m-d H:i:s'),
        );
        $this->db->insert('CustomerPoin', $data_CustomerPoin);
        $data_KomisiAsalam = array(
          'idUser'        => $idUser,
          'idBooking'     => $idBooking,
          'JumlahKomisi'  => $JumlahKomisi,
          'RateNow'       => $rateNow,
          'idBusiness'    => $idBusiness,
          'createdAt'     => date('Y-m-d H:i:s'),
        );
        $this->db->insert('Salam', $data_KomisiAsalam);
        // ADP SECTION
          $current_investment = 0;
          $get_totalInvestment = $this->Api_m->getfile_total_investment_ota($idBusiness);
          $priceInvoice = $rateafterdiscountBooking;
          $business = $idBusiness;
          $current_investment = $get_totalInvestment - $priceInvoice;
          $data_invoice = array(
            'adpInvoice'          => 1,
          );
          $this->db->where('idInvoice', $idInvoice);
          $this->db->update('invoice', $data_invoice);
          // AFTER SEND TO ADP
          $investments = $this->Api_m->getfile_investment_onOTA($idBusiness);
          // Update the last row with 'on' status to 'expired'
          $lastInvestment = end($investments);
          $data_investment_expired = array(
            'idInvoice'           => $idInvoice,
            'statusInvestment'    => 'expired',
            'createdAtInvestment' => date('Y-m-d H:i:s'),
          );
          $this->db->where('idInvestment', $lastInvestment->idInvestment);
          $this->db->update('investment', $data_investment_expired);
          echo json_encode(array('lastInvestment' => $lastInvestment->idInvestment));
          // Calculate the sum of totalInvestment values
          $totalInvestmentSum = 0;
          $totalagreementInvest = 0;
          foreach ($investments as $investment) {
            $totalInvestmentSum += $investment->totalInvestment;
            $totalagreementInvest = $investment->agreementInvestment;
          }
          $feeInvestment = $rateafterdiscountBooking * $feeBusiness / 100;
          $grossInvestment = $totalagreementInvest + $feeInvestment;
          $marginInvestment = $priceInvoice - $grossInvestment;
          $percentBase = $rateafterdiscountBooking / $marginInvestment;
          $percmarginInvestment = $percentBase * 10;
          $percentInvestment = $feeBusiness;
          // Format the percentage value
          $formatted_percent = number_format($percmarginInvestment, 2); // Rounds to 2 decimal places and adds '%' symbol
          // echo json_encode(array("invoice" => $priceInvoice, "agreement" => $totalagreementInvest, "fee" => $feeInvestment, "gross" => $grossInvestment, "margin" => $marginInvestment, "percent" => $formatted_percent));
          $data_investment_add = array(
            'nmSegment'             => 'OTA-WEB',
            'idBusiness'            => $idBusiness,
            'idInvoice'             => $idInvoice,
            'dateInvestment'        => date('Y-m-d'),
            'agreementInvestment'   => $totalagreementInvest,
            'kreditInvestment'      => $rateafterdiscountBooking,
            'totalInvestment'       => $current_investment,
            'statusInvestment'      => 'on',
            'ketInvestment'         => 'CONFIRMED INVOICE '.$idInvoice,
            'feeInvestment'         => $feeInvestment,
            'percentInvestment'     => $feeBusiness,
            'grossInvestment'       => $grossInvestment,
            'marginInvestment'      => $marginInvestment,
            'percmarginInvestment'  => $formatted_percent,
            'idUser'                => $idUser,
            'createdAtInvestment'   => date('Y-m-d H:i:s'),
          );
          $this->db->insert('investment', $data_investment_add);
        // ADP SECTION
        // PDF GENERATOR RESERVATION SECTION
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
          // Set document information
          $pdf->SetCreator(PDF_CREATOR);
          $pdf->SetAuthor('Sahira Hotels Group');
          $pdf->SetTitle('Invoice Sahira Hotels Group');
          $pdf->SetSubject('Reservation from Sahira Hotels Group');
          $pdf->SetKeywords('Invoice, Reservation, PDF');
          // Add a page
          $pdf->AddPage();
          // Set invoice HTML content
          $html = '<br>';
          $html .= '<br>';
          $html .= '<img src="./assets/images/logo_sahira_group_black.png" style="padding: 20px;margin: 20px;width: 200px;">';
          $html .= '<br>';
          // Add the provided HTML content
          $html .= '<section class="content invoice">';
          $html .= '<div class="row invoice-info">';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<thead>';
          $html .= '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">'.$hotelName.'</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>'.$invoiceBooking.'</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>'.$statuspayBooking.'</th></tr>';
          $html .= '</thead>';
          $html .= '<tbody>';
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
          $html .= '</tbody>';
          $html .= '</table>';
          $html .= '<hr>';
          $html .= '<br>';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<tbody>';
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
          $html .= '</tbody>';
          $html .= '</table>';
          
          $html .= '<hr>';
          $html .= '<br>';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<thead>';
          $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
          $html .= '</thead>';
          $html .= '</table>';
          $html .= '</div>';
          $html .= '</section>';
          $html .= '<div style="text-align: center;">';
          $html .= '<h4>Have any questions?</h4>';
          $html .= '<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>';
          $html .= '<p>info@sahirahotelsgroup.com</p>';
          $html .= '<p>+62-877-90400-030</p>';
          $html .= '</div>';
          $html .= '<hr>';
          $html .= '<div style="text-align: center;">';
          $html .= '<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>';
          $html .= '<br>';
          $html .= '<br>';
          $html .= '<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>';
          $html .= '</div>';
          // Print HTML content
          $pdf->writeHTML($html, true, false, true, false, '');
          // Define the file path to save the PDF
          $file_path = FCPATH . 'assets/pdfs/booking-'.$invoiceBooking.'.pdf'; // Modify the path as needed
          // Save the PDF file to the specified path
          $pdf->Output($file_path, 'F');
          echo 'PDF file saved successfully to: ' . $file_path;
        // PDF GENERATOR RESERVATION SECTION
        // EMAIL RESERVATION SECTION
          $config = [
            "protocol"  => "smtp",  
            "smtp_host" => "mail.sahirahotelsgroup.com",
            "smtp_port" => "587",  
            "smtp_user" => "noreply@sahirahotelsgroup.com",   
            "smtp_pass" => "noreply@sahirahotelsgroup.com",
            "mailtype"  => "html",
            "charset"   => "iso-8859-1",
            "wordwrap"  => true,
            "crlf"      => "\r\n",
            "newline"   => "\r\n",
          ];
          $this->load->library("email", $config);
          // Path to the file you want to attach
          $file_path = 'assets/pdfs/booking-'.$invoiceBooking.'.pdf'; // Update with the actual file path
          // Attach the file
          $this->email->attach($file_path);
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          $this->email->from("noreply@sahirahotelsgroup.com", "noreply-sahirahotelsgroup");
          $this->email->to($emailBooking);
          $this->email->bcc('sahirahotelspayment@gmail.com');
          $this->email->subject('Confirmation of Your Hotel Room Booking at '.$hotelName.'');
          $isi_email  = "<html>";
          $isi_email .= "<body>";
          $isi_email .= "<h4>Dear $firstnameBooking,</h4>";
          $isi_email .= '<br>';
          $isi_email .= "<p>We are pleased to inform you that your hotel room booking has been successfully received. Thank you for choosing $hotelName for your stay.</p>";
          $isi_email .= '<br>';
          $isi_email .= "<p>Booking Details:</p>";
          $isi_email .= "<p>Name of the Guest: $firstnameBooking $lastnameBooking</p>";
          $isi_email .= "<p>Check-in Date: $arrivalBooking</p>";
          $isi_email .= "<p>Check-out Date: $departureBooking</p>";
          $isi_email .= "<p>Room Type: $roomtypeBooking</p>";
          $isi_email .= "<p>Number of Guests: $paxBooking</p>";
          $isi_email .= '<br>';
          $isi_email .= "<p>We will promptly process your booking and send an official confirmation along with further details via email shortly.</p>";
          $isi_email .= '<br>';
          $isi_email .= "<p>If you have any questions or specific requests, feel free to contact us at +62-877-90400-030 or info@sahirahotelsgroup.com.</p>";
          $isi_email .= '<br>';
          $isi_email .= "<p>Thank you for your choice, and we look forward to welcoming you at $hotelName!</p>";
          $isi_email .= '<br>';
          $isi_email .= "<p>Warm Regards,</p>";
          $isi_email .= "<p>Hotel Reservation Team</p>";
          $isi_email .= "<p>$hotelName</p>";
          $isi_email .= "</body>";
          $isi_email .= "</html>";
          $this->email->message($isi_email);
          $this->email->send();
        // EMAIL RESERVATION SECTION
        // PDF GENERATOR FINANCE SECTION
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
          // Set document information
          $pdf->SetCreator(PDF_CREATOR);
          $pdf->SetAuthor('Sahira Hotels Group');
          $pdf->SetTitle('Finance Invoice Sahira Hotels Group');
          $pdf->SetSubject('Finance Reservation from Sahira Hotels Group');
          $pdf->SetKeywords('Finance, Invoice, Reservation, PDF');
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
          $html = '<br>';
          $html .= '<br>';
          $html .= '<img src="./assets/images/logo_sahira_group_black.png" style="padding: 20px;margin: 20px;width: 200px;">';
          $html .= '<br>';
          // Add the provided HTML content
          $html .= '<section class="content invoice">';
          $html .= '<div class="row invoice-info">';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<thead>';
          $html .= '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">'.$hotelName.'</th><th style="border: 1px solid #000; padding: 8px;">Invoice ID<br>'.$invoiceBooking.'</th><th style="border: 1px solid #000; padding: 8px;color: #385645;">Status Payment<br>'.$statuspayBooking.'</th></tr>';
          $html .= '</thead>';
          $html .= '<tbody>';
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>First Name<br>$firstnameBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Last Name<br>$lastnameBooking</td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-in</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$arrivalBooking</td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Check-out</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>$departureBooking</td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Booking time (UTC+0)</th><th style='border: 1px solid #000; padding: 8px;'>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'></th></tr>";
          $html .= '</tbody>';
          $html .= '</table>';
          $html .= '<hr>';
          $html .= '<br>';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<tbody>';
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Room Information<br>$roompaxBooking $roomtypeBooking</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Guest Information<br>$paxBooking Adult(s), $childBooking Child(ren)</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Extra Bed Information<br>$extrabedBooking per room</td></tr>";
          $html .= '</tbody>';
          $html .= '</table>';
          
          $html .= '<hr>';
          $html .= '<br>';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<thead>';
          $html .= "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #000; padding: 8px;'>Date<br>$createdAtBooking</th><th style='border: 1px solid #000; padding: 8px;'>Room Rates<br>IDR $priceInvoice</th><th style='border: 1px solid #000; padding: 8px;'>Subtotal<br>IDR $rateafterdiscountBooking</th></tr>";
          $html .= '</thead>';
          $html .= '</table>';
          $html .= '<hr>';
          $html .= '<br>';
          $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width: 100%;">';
          $html .= '<thead>';
          $html .= '<tr style="background-color: #f2f2f2;"><th style="border: 1px solid #000; padding: 8px;">ADP INFORMATION :<br>'.$hotelName.'</th><th style="border: 0.5px solid #212121; padding: 8px;font-size: 12px;">Total Agreement Investment<br>IDR '.$totalagreementInvest.'</th><th></th></tr>';
          $html .= '</thead>';
          $html .= '<tbody>';
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Fee OTA<br>$percentInvestment%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Fee OTA<br>IDR $feeInvestment</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Income from OTA<br>IDR $grossInvestment</td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td></td><td></td><td></td></tr>";
          $html .= "<tr style='background-color: #e6e6e6;'><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Persentasi Hotel<br>$formatted_percent%</td><td style='border: 0.5px solid #212121; padding: 8px;font-size: 12px;'>Total Margin Hotel<br>IDR $marginInvestment</td><td></td></tr>";
          $html .= '</tbody>';
          $html .= '</table>';
          $html .= '</div>';
          $html .= '</section>';
          $html .= '<div style="text-align: center;">';
          $html .= '<h4>Have any questions?</h4>';
          $html .= '<p>For hotel-related questions & queries, kindly contact our Hotel Support Team:</p>';
          $html .= '<p>info@sahirahotelsgroup.com</p>';
          $html .= '<p>+62-877-90400-030</p>';
          $html .= '</div>';
          $html .= '<hr>';
          $html .= '<div style="text-align: center;">';
          $html .= '<p>If the guests need to contact Sahira Hotels Group, kindly reach our Customer Service: cs@sahirahotelsgroup.com or +62-877-90400-030</p>';
          $html .= '<br>';
          $html .= '<br>';
          $html .= '<p>© 2024 Sahira Hotels Group. All Rights Reserved.</p>';
          $html .= '</div>';
          // Print HTML content
          $pdf->writeHTML($html, true, false, true, false, '');
          // Define the file path to save the PDF
          $file_path = FCPATH . 'assets/pdfs/finance-'.$invoiceBooking.'.pdf'; // Modify the path as needed
          // Save the PDF file to the specified path
          $pdf->Output($file_path, 'F');
          echo 'PDF file saved successfully to: ' . $file_path;
        // PDF GENERATOR FINANCE SECTION
        // EMAIL FINANCE SECTION
          $config = [
            "protocol"  => "smtp",  
            "smtp_host" => "mail.sahirahotelsgroup.com",
            "smtp_port" => "587",  
            "smtp_user" => "noreply@sahirahotelsgroup.com",   
            "smtp_pass" => "noreply@sahirahotelsgroup.com",
            "mailtype"  => "html",
            "charset"   => "iso-8859-1",
            "wordwrap"  => true,
            "crlf"      => "\r\n",
            "newline"   => "\r\n",
          ];
          $this->load->library("email", $config);
          // Path to the file you want to attach
          $file_path = 'assets/pdfs/finance-'.$invoiceBooking.'.pdf'; // Update with the actual file path
          // Attach the file
          $this->email->attach($file_path);
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          $this->email->from("noreply@sahirahotelsgroup.com", "noreply-sahirahotelsgroup");
          $this->email->to($CABusiness);
          $this->email->cc($ARBusiness);
          $this->email->subject('Payment From Sahira Hotels Group - '.$hotelName.'');
          $isi_email  = "<html>";
          $isi_email .= "<body>";
          $isi_email .= "<h4>This is recap for Hotel Finance.</h4>";
          $isi_email .= "</body>";
          $isi_email .= "</html>";
          $this->email->message($isi_email);
          $this->email->send();
        // EMAIL FINANCE SECTION
        // NOTIFICATION SECTION
          $data_notification = array(
            'idBusiness'                => $idBusiness,
            'typeNotification'          => 'Reservation Payment',
            'nmNotification'            => 'Payment PAID - '.$invoiceBooking,
            'descNotification'          => $roomtypeBooking.' - IDR '.number_format($rateafterdiscountBooking),
            'idBooking'                 => $idBooking,
            'idUser'                    => $idUser,
            'createdAtNotification'     => date('Y-m-d H:i:s'),
          );
          $this->db->insert('notification', $data_notification);
          $data['user'] = $this->Api_m->cek_user_by_id($idUser);
          $currentToken = $data['user']->tokenPushNotification;
          $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
          $url = OAUTH2_TOKEN_URL;
          $params = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => JWT::encode([
              'iss'   => $serviceAccount['client_email'],
              'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
              'aud'   => $url,
              'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
              'iat'   => time(),
            ], $serviceAccount['private_key'], 'RS256'),
          ];
          $options = [
            'http' => [
              'header'  => 'Content-Type: application/x-www-form-urlencoded',
              'method'  => 'POST',
              'content' => http_build_query($params),
            ],
          ];
          $context = stream_context_create($options);
          $response = file_get_contents($url, false, $context);
          $accessToken = json_decode($response, true)['access_token'];
          $message = [
            'message' => [
              'token' => $currentToken,
              'notification' => [
                'title' => 'PAID - '.$invoiceBooking,
                'body'  => 'IDR'.number_format($rateafterdiscountBooking)
                // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
                // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
              ],
              'data' => [
                'url' => 'https://cms.sahirahotelsgroup.com/cms/home/viewBuktiPembayaran/'.$idBusiness,
                'transaction' => 'payment'
              ]
            ],
          ];
          $headers = [
            'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
            'Content-Type: application/json',
          ];
          $ch = curl_init(FCM_ENDPOINT);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
          $result = curl_exec($ch);
          curl_close($ch);
        // NOTIFICATION SECTION
      } else {
        $data['dataFNB'] = $this->Api_m->getfile_fnb_by_id($virtual_doku);
        echo json_encode(array("type" => "FNB", "data" => $data['dataFNB'], "VA" => $virtual_doku));
        $statuspayDoku = $jsonData['transaction']['status'];
        if($statuspayDoku == 'SUCCESS') {
          $statuspayFnbcooking = 'PAID';
        } else {
          $statuspayFnbcooking = 'UNPAID';
        }
        $data_form = [      
          "statuspayFnbcooking"   => $statuspayFnbcooking,
          "createdAtFnbcooking"   => date('Y-m-d H:i:s'),
          "finishAtFnbcooking"    => date('Y-m-d H:i:s'),
        ];
        $this->db->where('idBooking', $virtual_doku);
        $this->db->update('fnb_additional_cooking', $data_form);
        $voucherCatalog = array();
        $this->db->from('voucher_catalog');
        $this->db->where('nmVouchercatalog', $data['dataFNB']->ketFnbadditional);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
          $voucherCatalog = $query->row();
        }
        $query->free_result();
        $data_form_claim = [      
          "nmVoucher"     => $voucherCatalog->nmVouchercatalog,
          'idUser'        => $data['dataFNB']->idUser,
          'idBooking'     => $data['dataFNB']->idBooking,
          'idBusiness'    => $data['dataFNB']->idBusiness,
          'ownerVoucher'  => $voucherCatalog->idBusiness,
          'createdAtClaim'=> date('Y-m-d H:i:s'),
        ];
        $this->db->insert('voucher_claim', $data_form_claim);
        // NOTIFICATION SECTION
          $data_notification = array(
            'idBusiness'                => $data['dataFNB']->idBusiness,
            'typeNotification'          => 'Food Order Payment',
            'nmNotification'            => 'Food Order PAID - '.$data['dataFNB']->invoiceFnbadditional,
            'descNotification'          => $data['dataFNB']->ketFnbadditional.' - IDR '.number_format($data['dataFNB']->subtotalPrice).' PAID',
            'idBooking'                 => $data['dataFNB']->idBooking,
            'idUser'                    => $data['dataFNB']->idUser,
            'createdAtNotification'     => date('Y-m-d H:i:s'),
          );
          $this->db->insert('notification', $data_notification);
          $data['user'] = $this->Api_m->cek_user_by_id($data['dataFNB']->idUser);
          $currentToken = $data['user']->tokenPushNotification;
          $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
          $url = OAUTH2_TOKEN_URL;
          $params = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => JWT::encode([
              'iss'   => $serviceAccount['client_email'],
              'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
              'aud'   => $url,
              'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
              'iat'   => time(),
            ], $serviceAccount['private_key'], 'RS256'),
          ];
          $options = [
            'http' => [
              'header'  => 'Content-Type: application/x-www-form-urlencoded',
              'method'  => 'POST',
              'content' => http_build_query($params),
            ],
          ];
          $context = stream_context_create($options);
          $response = file_get_contents($url, false, $context);
          $accessToken = json_decode($response, true)['access_token'];
          $message = [
            'message' => [
              'token' => $currentToken,
              'notification' => [
                'title' => 'PAID - '.$data['dataFNB']->invoiceFnbadditional,
                'body'  => 'IDR'.number_format($data['dataFNB']->subtotalPrice)
                // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
                // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
              ],
              'data' => [
                'url' => 'https://cms.sahirahotelsgroup.com/cms/home/viewBuktiPembayaran/'.$data['dataFNB']->idBusiness,
                'transaction' => 'payment'
              ]
            ],
          ];
          $headers = [
            'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
            'Content-Type: application/json',
          ];
          $ch = curl_init(FCM_ENDPOINT);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
          $result = curl_exec($ch);
          curl_close($ch);
        // NOTIFICATION SECTION
      }
      $this->response([
        'status' => 'success',
        'message' => 'Payment recorded successfully.'
      ], REST_Controller::HTTP_OK);
    } else {
      echo json_encode(array("response" => "Virtual number error"));
    }
  }
  public function generatePaymentCodeMandiriVA_post() {
    require_once "vendor/autoload.php";
    require_once "vendor/autoload.php";
    header("Content-Type:application/json");
    $arr = json_decode(file_get_contents("php://input"), true);
    $url = "/mandiri-virtual-account/v2/payment-code"; // API endpoint
    $clientId = $this->config->item('dokuClientId'); // Client ID retrieved from DOKU Back Office
    $secretKey = $this->config->item('dokuSecretKey');
    $requestId = rand(1, 100000); // Unique random string generated from merchant side to protect duplicate request
    $dateTime = gmdate("Y-m-d H:i:s");
    $dateTime = date(DATE_ISO8601, strtotime($dateTime));
    $dateTimeFinal = substr($dateTime, 0, 19) . "Z";
    $dokuClient = new DOKU\Client;
    // echo json_encode($clientId);
    // Setup Config
    $dokuClient->setClientID($clientId);
    $dokuClient->setSharedKey($secretKey);
    $dokuClient->isProduction(false); // Sandbox environment. For example project only.
    $header = array();
    $data = array(
      "order" => array(
        "invoice_number" => $arr["invoiceNumber"],
        "amount" => $arr["amount"]
      ),
      "virtual_account_info" => array(
        "expired_time" => $arr["expiredTime"],
        "reusable_status" => $arr["reusableStatus"],
        "info1" => $arr["info1"],
        "info2" => $arr["invoiceNumber"],
        "info3" => $arr["info3"],
      ),
      "customer" => array(
        "name" => trim($arr["customerName"]),
        "email" => $arr["email"]
      ),
      "additional_info" => array(
        "integration" => array(
            "name" => "php-library",
            "version" => "2.0.0"
        )
      )
    );
    $regId = rand(1, 100000);
    $dateTime = gmdate("Y-m-d H:i:s");
    $dateTime = date(DATE_ISO8601, strtotime($dateTime));
    $dateTimeFinal = substr($dateTime, 0, 19) . "Z";
    $targetPath = $url;
    $url = 'https://api.doku.com' . $targetPath;
    // $this->response($url);
    $header['Client-Id'] = $clientId;
    $header['Request-Id'] = $regId;
    $header['Request-Timestamp'] = $dateTimeFinal;
    $header['Request-Target'] = $targetPath;
    $signature = "";
    if (!isset($params['sigver'])) {
        $signature = Utils::generateSignature($header, json_encode($data), $secretKey);
    } else {
        $signature = Utils::generateSignatureV1_3($header, json_encode($data), $secretKey);
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Signature:' . $signature,
        'Request-Id:' . $regId,
        'Client-Id:' . $clientId,
        'Request-Timestamp:' . $dateTimeFinal,
        'Request-Target:' . $targetPath,
    ));
    $responseJson = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (is_string($responseJson) && $httpcode == 200) {
      $this->response(json_decode($responseJson, true));
    } else {
      echo $responseJson;
      $this->response(null);
    }
  }
  private function generateSignature($clientId, $requestId, $dateTimeFinal, $url, $body, $secret) {
    $digest = base64_encode(hash('sha256', $body, true));
    $rawSignature = "Client-Id:" . $clientId . "\n"
        . "Request-Id:" . $requestId . "\n"
        . "Request-Timestamp:" . $dateTimeFinal . "\n"
        . "Request-Target:" . $url . "\n"
        . "Digest:" . $digest;
    $signature = base64_encode(hash_hmac('sha256', $rawSignature, $secret, true));
    return 'HMACSHA256=' . $signature;
    // $this->response($rawSignature);
  }
  public function getB2BToken_post() {
    $url = "https://api-sandbox.doku.com/token"; // API endpoint
    $clientId = $this->config->item('dokuClientIdDev'); // Client ID retrieved from DOKU Back Office
    $secretKey = $this->config->item('dokuSecretKeyDev');
    $headers = array(
      "Content-type: application/json",
      "X-PARTNER-ID: $clientId",
      "X-SECRET-KEY: $secretKey"
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        // Handle error
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
    $this->response(json_decode($result));
  }
  public function insert_data_kamar_post() {
    $ketKamar = explode(', ', 'Deluxe Single Bed, Deluxe Twin Bed, Deluxe Family, Junior Suite Single Bed, Sahira Suite Single Bed');
    $qtyKamar = explode(', ', '22, 61, 34, 4, 2');
    $hargaROKamar = explode(', ', '805000, 805000, 875000, 1550000, 2255000');
    $hargaRBKamar = explode(', ', '905000, 905000, 1055000, 1750000, 2455000');
    $soldKamar = array_fill(0, count($ketKamar), 0);
    $year = date('Y');
    $date = strtotime($year . '-01-01');
    $lastDate = strtotime($year . '-12-31');
    $data = array();
    while ($date <= $lastDate) {
      for ($i = 0; $i < count($ketKamar); $i++) {
        $data[] = array(
          'ketKamar'    => $ketKamar[$i],
          'qtyKamar'    => $qtyKamar[$i],
          'soldKamar'   => $soldKamar[$i],
          'hargaROKamar'=> $hargaROKamar[$i],
          'hargaRBKamar'=> $hargaRBKamar[$i],
          'idBusiness'  => $idBusiness,
          'idUser'      => $idUser,
          'dateKamar'   => date('Y-m-d', $date)
        );
      }
      // Increment date by one day for the next iteration
      $date = strtotime('+1 day', $date);
    }
    foreach ($data as $row) {
      $this->Kamar_m->insert_kamar($row);
    }
    echo "Data inserted successfully.";
  }
  public function index_get() {
      $this->response([
          'status' => true,
          'message' => 'Pesan dikirim via WebSocket'
      ], REST_Controller::HTTP_OK);
  }
  public function generateInvoice_post() {
    $noInvoice = $this->Api_m->noUrut_orderan();
    $this->response($noInvoice);
  }
  public function generateInvoiceFNB_post() {
    $noInvoice = $this->Api_m->noUrut_orderanFNB();
    $this->response($noInvoice);
  }
  public function generateidBookingFNB_post() {
    $noInvoice = $this->Api_m->noUrut_idBookingFood();
    $this->response($noInvoice);
  }
  public function index_post() { 
  }
  public function authRegister_post() { 
    // Login Action
    $nmUser = $this->post('nmUser');
    $mobileUser = $this->post('mobileUser');
    $emailUser = $this->post('emailUser');
    $passUser = $this->post('passUser');
    $data_user = array(
      'nmUser'          => $nmUser,
      'mobileUser'      => $mobileUser,
      'emailUser'       => $emailUser,
      'passUser'        => sha1($passUser),
      'createdAt'       => date('Y-m-d H:i:s'),
    );
    $this->db->insert('user', $data_user);
    
    $data = $this->Api_m->cek_user($emailUser, sha1($passUser));
    // JWT Token
    $kunci = $this->config->item('thekey'); // From config/config.php
    $val = $this->Api_m->cek_username($emailUser);
    $token['idUser'] = $val->idUser;
    $token['Email'] = $emailUser;
    $output = JWT::encode($token, $kunci, 'HS256'); //This is the output token
    if($data->idUser) {
      $this->session->set_userdata(array(
        'logged_in'       => "login",
        'email_user'      => $data->emailUser,
      ));
      $session_email = $this->session->userdata('email_user');
      $data_log = array(
        'ipLog'         => $this->input->ip_address(),
        'platformLog'   => $this->agent->browser(),
        'versionLog'    => $this->agent->version(),
        'attemptLog'    => 1, // level 1
        'ketLog'        => 'login by sahirahotels '.$this->session->userdata('email_user'),
        'dateLog'       => date('Y-m-d H:i:s')
      );
      $this->Api_m->user_log($data_log);
    }
    
    if($data->idUser) {
      $this->response(array('status' => 'success', 'data' => $data, 'token' => $output, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('status' => 'error', 'http_status' => REST_Controller::HTTP_UNAUTHORIZED));
    }
  }
  public function authLogin_post() { 
    // Login Action
    $emailUser = $this->post('emailUser');
    $passUser = $this->post('passUser');
    $data = $this->Api_m->cek_user($emailUser, sha1($passUser));
    // JWT Token
    $kunci = $this->config->item('thekey'); // From config/config.php
    $val = $this->Api_m->cek_username($emailUser);
    $token['idUser'] = $val->idUser;
    $token['Email'] = $emailUser;
    $output = JWT::encode($token, $kunci, 'HS256'); //This is the output token
    if($data->idUser) {
      $this->session->set_userdata(array(
        'logged_in'       => "login",
        'email_user'      => $data->emailUser,
      ));
      $session_email = $this->session->userdata('email_user');
      $data_log = array(
        'ipLog'         => $this->input->ip_address(),
        'platformLog'   => $this->agent->browser(),
        'versionLog'    => $this->agent->version(),
        'attemptLog'    => 1, // level 1
        'ketLog'        => 'login by sahirahotels '.$this->session->userdata('email_user'),
        'dateLog'       => date('Y-m-d H:i:s')
      );
      $this->Api_m->user_log($data_log);
    }
    
    if($data->idUser) {
      $this->response(array('status' => 'success', 'data' => $data, 'token' => $output, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('status' => 'error', 'http_status' => REST_Controller::HTTP_UNAUTHORIZED));
    }
  }
  public function authLoginGoogle_post() { 
    // Login Action
    $emailUser = $this->post('emailUser');
    $nmUser = $this->post('nmUser');
    $mobileUser = '';
    $passUser = $this->post('emailUser');
    $data = array();
    $this->db->from('user');
    $this->db->where('emailUser', $emailUser);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      $data = $query->row();
    }
    $query->free_result();
    if($data == []) {
      // Insert Action
      $data_user = array(
        'nmUser'          => $nmUser,
        'mobileUser'      => $mobileUser,
        'emailUser'       => $emailUser,
        'passUser'        => sha1($passUser),
        'createdAt'       => date('Y-m-d H:i:s'),
      );
      $this->db->insert('user', $data_user);
      // Login Action
      $emailUser = $this->post('emailUser');
      $data = $this->Api_m->cek_user_google($emailUser);
      
      // JWT Token
      $kunci = $this->config->item('thekey'); // From config/config.php
      $val = $this->Api_m->cek_username($emailUser);
      $token['idUser'] = $val->idUser;
      $token['Email'] = $emailUser;
      $output = JWT::encode($token, $kunci, 'HS256'); //This is the output token
      if($data->idUser) {
        $this->session->set_userdata(array(
          'logged_in'       => "login",
          'email_user'      => $data->emailUser,
        ));
        $session_email = $this->session->userdata('email_user');
        $data_log = array(
          'ipLog'         => $this->input->ip_address(),
          'platformLog'   => $this->agent->browser(),
          'versionLog'    => $this->agent->version(),
          'attemptLog'    => 1, // level 1
          'ketLog'        => 'login by sahirahotels '.$this->session->userdata('email_user'),
          'dateLog'       => date('Y-m-d H:i:s')
        );
        $this->Api_m->user_log($data_log);
      }
      // EMAIL SECTION
        $config = [
          "protocol"  => "smtp",
          "smtp_host" => "mail.sahirahotelsgroup.com",
          "smtp_port" => "587",
          "smtp_user" => "noreply@sahirahotelsgroup.com",
          "smtp_pass" => "noreply@sahirahotelsgroup.com",
          "mailtype"  => "html",
          "charset"   => "iso-8859-1",
          "wordwrap"  => true,
          "crlf"      => "\r\n",
          "newline"   => "\r\n",
        ];
        $this->load->library("email", $config);
        $createdAtBooking = date('Y-m-d H:i:s');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from("noreply@sahirahotelsgroup.com", "noreply-sahirahotelsgroup");
        $this->email->to($emailUser);
        $this->email->bcc("yerblues6@gmail.com");
        $this->email->subject('Registration Member Sahira Hotels Group <NEW MEMBER>');
        $isi_email  = "<html>";
        $isi_email .= "<body>";
        $isi_email .= "<h2>Selamat bergabung di Sahira Hotels Group Member Benefits🎉!</h2>";
        $isi_email .= "<h4>Yang terhormat : $nmUser</h4>";
        $isi_email .= "<p>dengan senang hati meyambut Anda sebagai member baru.</p>";
        $isi_email .= "<p>First Name : $nmUser</p>";
        $isi_email .= "<p>Anda dapat menikmati keuntungan langsung di properti Sahira Hotels Group mana pun, untuk kamar, restoran, atau fasilitas hotel lainnya.</p>";
        $isi_email .= "<p>Semakin banyak kunjungan (visit) Anda, semakin besar keuntungan (benefits) yang akan Anda dapatkan.</p>";
        $isi_email .= "<p>Setiap kunjungan Anda; menginap, makan di restoran atau layanan hotel lainnya akan membawa Anda ke milestone dan keuntungan lebih tinggi.</p>";
        $isi_email .= "<br>";
        $isi_email .= "<h4>Cek benefits dan perjalanan keanggotaan Anda melalui Member's Zone :</h4>";
        $isi_email .= "<p>Kami menantikan kunjungan Anda sebagai anggota istimewa kami.</p>";
        $isi_email .= "<p>Salam Hangat,</p>";
        $isi_email .= "</body>";
        $isi_email .= "</html>";
        $this->email->message($isi_email);
        $this->email->send();
      // EMAIL SECTION
      
      if($data->idUser) {
        $this->response(array('status' => 'success', 'data' => $data, 'token' => $output, 'registration-email' => $isi_email, 'http_status' => REST_Controller::HTTP_OK));
      } else {
        $this->response(array('status' => 'error', 'http_status' => REST_Controller::HTTP_UNAUTHORIZED));
      }
    } else {
      // JWT Token
      $kunci = $this->config->item('thekey'); // From config/config.php
      $val = $this->Api_m->cek_username($emailUser);
      $token['idUser'] = $val->idUser;
      $token['Email'] = $emailUser;
      $output = JWT::encode($token, $kunci, 'HS256'); //This is the output token
      if($data->idUser) {
        $this->session->set_userdata(array(
          'logged_in'       => "login",
          'email_user'      => $data->emailUser,
        ));
        $session_email = $this->session->userdata('email_user');
        $data_log = array(
          'ipLog'         => $this->input->ip_address(),
          'platformLog'   => $this->agent->browser(),
          'versionLog'    => $this->agent->version(),
          'attemptLog'    => 1, // level 1
          'ketLog'        => 'login by sahirahotels '.$this->session->userdata('email_user'),
          'dateLog'       => date('Y-m-d H:i:s')
        );
        $this->Api_m->user_log($data_log);
      }
      
      if($data->idUser) {
        $this->response(array('status' => 'success', 'data' => $data, 'token' => $output, 'http_status' => REST_Controller::HTTP_OK));
      } else {
        $this->response(array('status' => 'error', 'http_status' => REST_Controller::HTTP_UNAUTHORIZED));
      }
    }
  }
  public function getLastSeenhotels_post() {
    $business_detail = array();
    $this->db->from('Business_Detail');
    $this->db->not_like('idBusiness', 4);
    $this->db->not_like('idBusiness', 5);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $business_detail[] = $row;
      }
    }
    $query->free_result(); 
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function gethotels_post() {
    // Coordinates of your hotels
    $hotelCoordinates = $this->Api_m->getNearbyHotels();
    // Check if no hotels were found
    if (empty($hotelCoordinates)) {
      $this->response(array('status' => 'error', 'message' => 'No hotels found within the specified radius'), REST_Controller::HTTP_NOT_FOUND);
    } else {
      // Convert the entire response into an associative array
      $response = array('response' => array_values($hotelCoordinates), 'http_status' => REST_Controller::HTTP_OK);
      $this->response($response);
    }
  }
  public function gethotelsbyid_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getHotelsbyId($idBusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getDetailHotelsbyId_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getDetailHotelsbyId($idBusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsGallerybyId_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getHotelsGallerybyId($idBusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsGuestroombyId_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getHotelsGuestroombyId($idBusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsGuestroombyIdKamar_post() {
    $idKamar = $this->input->post('idKamar'); // Get the search query from the client
    $business_detail = $this->Api_m->getHotelsGuestroombyIdKamar($idKamar);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsSwimmingpoolbyId_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getHotelsSwimmingpoolbyId($idBusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsOffers_post() {
    $business_detail = $this->Api_m->getHotelsOffers();
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsOffersOnSlide_post() {
    $business_detail = $this->Api_m->getHotelsOffersOnSlide();
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsOffersbyId_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getHotelsOffersbyId($idBusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getHotelsFacility_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getBusinessDetail($idBusiness);
    if ($business_detail) {
      $facilities = explode(',', $business_detail->facilityBusiness);
      $facility_data = $business_detail->facility_data;
      foreach ($facilities as &$facility) {
        $facility = array(
          'nameIcon'  => $facility,
          'imgIcon'   => $facility_data[$facility],
        );
      }
      $response = array(
        'Name'        => $business_detail->Name,
        'facilities'  => $facilities,
      );
      $this->response($response, REST_Controller::HTTP_OK);
    } else {
      $this->response(['message' => 'Business not found'], REST_Controller::HTTP_NOT_FOUND);
    }
  }
  public function getRoomsFacility_post() {
    $idKamar = $this->input->post('idKamar'); // Get the search query from the client
    $kamar_detail = $this->Api_m->getKamarDetail($idKamar);
    if ($kamar_detail) {
      $facilities = explode(',', $kamar_detail->kamarFacility);
      $facility_data = $kamar_detail->facility_data;
      foreach ($facilities as &$facility) {
        $facility = array(
          'nameIcon'  => $facility,
          'imgIcon'   => $facility_data[$facility],
        );
      }
      $response = array(
        'Name'        => $kamar_detail->idKamar,
        'facilities'  => $facilities,
      );
      $this->response($response, REST_Controller::HTTP_OK);
    } else {
      $this->response(['message' => 'Business not found'], REST_Controller::HTTP_NOT_FOUND);
    }
  }
  public function getHotelsRating_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getBusinessRating($idBusiness);
    $this->response($business_detail, REST_Controller::HTTP_OK);
  }
  public function getMembershipBusiness_post() {
    $idBusiness = $this->input->post('idBusiness'); // Get the search query from the client
    $categoryMembershipbusiness = $this->input->post('categoryMembershipbusiness'); // Get the search query from the client
    $business_detail = $this->Api_m->getMembershipBusiness($idBusiness, $categoryMembershipbusiness);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getOffersbyId_post() {
    $idVouchercatalog = $this->input->post('idVouchercatalog'); // Get the search query from the client
    $business_detail = $this->Api_m->getOffersbyId($idVouchercatalog);
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function ajaxCheckHotels_byDate_arrival_post() {
    $business_detail = array();
    $this->db->from('business_detail');
    $this->db->not_like('idBusiness', 4);
    $this->db->not_like('idBusiness', 5);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $business_detail[] = $row;
      }
    }
    $query->free_result(); 
  
    $this->response(array('response' => $business_detail, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getcity_get() {
    $query = $this->input->get('query'); // Get the search query from the client
    $cities = $this->Api_m->get_citybyname($query);
    if($cities) {
      $this->response($cities);
    } else {
      $this->response(array('status' => 'Failed get data !', 'http_status' => REST_Controller::HTTP_UNAUTHORIZED));
    }
  }
  public function ajaxCheckOccupancy_byDate_arrival_post() {
    $arrival = $this->input->post("arrival");
    $departure = $this->input->post("departure");
    $idBusiness = $this->input->post("idBusiness");
    $available = $this->Api_m->getfile_available_kamar_arrival($arrival, $idBusiness);
    $booking = $this->Api_m->getfile_booking_kamar_arrival($arrival, $idBusiness);
    $sum = $this->Api_m->getfile_sum_kamar_arrival($arrival, $idBusiness);
    if ($available > 0) {
      $percentageInUse = ($booking / $available) * 100;
    } else {
      $percentageInUse = 0; // Handle the case where $available is 0 to avoid division by zero.
    }
    $percentageInUseFormatted = number_format($percentageInUse);
    $occupancy = $this->Api_m->get_occupancy_room($arrival, $departure, $idBusiness);
    $this->response(array('available' => $available, 'booking' => $booking, 'sum' => $sum, 'level_occupancy' => $percentageInUseFormatted, 'response' => $occupancy, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function ajaxCheckOccupancy_byLowest_arrival_post() {
    $arrival = $this->input->post("arrival");
    $idBusiness = $this->input->post("idBusiness");
    $available = $this->Api_m->getfile_available_kamar_arrival($arrival, $idBusiness);
    $booking = $this->Api_m->getfile_booking_kamar_arrival($arrival, $idBusiness);
    $sum = $this->Api_m->getfile_sum_kamar_arrival($arrival, $idBusiness);
    if ($available > 0) {
      $percentageInUse = ($booking / $available) * 100;
    } else {
      $percentageInUse = 0; // Handle the case where $available is 0 to avoid division by zero.
    }
    $percentageInUseFormatted = number_format($percentageInUse);
    $occupancy = $this->Api_m->get_occupancy_room_lowest($arrival, $percentageInUseFormatted);
    $this->response(array('available' => $available, 'booking' => $booking, 'sum' => $sum, 'level_occupancy' => $percentageInUseFormatted, 'response' => $occupancy, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function search_packages_post() {
    $idKamar = $this->input->post('idKamar');
    $dateKamar = $this->input->post('arrival');
    $kamar = $this->Api_m->get_package_by_arrival_ketKamar($idKamar, $dateKamar);
    $this->response(array('response' => $kamar, 'http_status' => REST_Controller::HTTP_OK));
  }
  function checkVoucherUser_post() {
    $voucher = $this->Api_m->checkVoucherUser();
    $this->response(array('response' => $voucher, 'http_status' => REST_Controller::HTTP_OK));
  }
  function claimVoucherId_post() {
    $idUser = $this->input->post('idUser');
    $idVoucher = $this->input->post('idVoucher');
    $voucher = $this->Api_m->checkVoucherClaimed($idUser, $idVoucher);
    if($voucher) {
      $this->response(array('response' => $voucher, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $data_claim_voucher = array(
        'idUser'          => $idUser,
        'idVoucher'       => $idVoucher,
        'createdAtClaim'=> date('Y-m-d H:i:s'),
      );  
      $this->db->insert('voucher_claim', $data_claim_voucher);
      $this->response(array('response' => $data_claim_voucher, 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  function checkVoucherClaimed_post() {
    $idUser = $this->input->post('idUser');
    $idVoucher = $this->input->post('idVoucher');
    $voucher = $this->Api_m->checkVoucherClaimed($idUser, $idVoucher);
    $this->response(array('response' => $voucher, 'http_status' => REST_Controller::HTTP_OK));
  }
  function setActualPrice_post() {
    $actualPrice = $this->input->post('actualPrice');
    $this->response($actualPrice);
  }
  public function insertBooking_post() {
    // Decode the JSON payload
    $data_booking = json_decode($this->input->raw_input_stream, true);
    // Memastikan data_booking adalah array dan memiliki kunci 'data'
    if (is_array($data_booking) && isset($data_booking['data'])) {
        $bookingData = $data_booking['data'];
        // Memeriksa kunci yang diperlukan
        if (isset($bookingData['idUser'], $bookingData['customerName'], $bookingData['address'], $bookingData['phoneNumber'], $bookingData['email'])) {
            $idUser = $bookingData['idUser'];
            $customerName = $bookingData['customerName'];
            $address = $bookingData['address'];
            $notel = $bookingData['phoneNumber'];
            $email = $bookingData['email'];
            $createdAt = date('Y-m-d H:i:s');
            // Mengakses data lainnya
            $idBusiness = $bookingData['idBusiness'];
            $idKamar = $bookingData['idKamar'];
            $invoiceNumber = $bookingData['invoiceNumber'];
            $arrivalDate = $bookingData['arrivalDate'];
            $dateIntervalText = $bookingData['dateIntervalText'];
            $departureDate = $bookingData['departureDate'];
            $paxBooking = $bookingData['paxBooking'];
            $childBooking = $bookingData['childBooking'];
            $extrabedBooking = $bookingData['extrabedBooking'];
            $idnumberBooking = $bookingData['idnumberBooking'];
            $ratecodeBooking = $bookingData['ratecodeBooking'];
            $country = $bookingData['country'];
            $province = $bookingData['province'];
            $amount = $bookingData['amount'];
            $totalrateBooking = $bookingData['totalrateBooking'];
            $channel = $bookingData['channel'];
            $DateInterval = $bookingData['DateInterval'];
            $discountBooking = $bookingData['discountBooking'];
            $reasonBooking = $bookingData['reasonBooking'];
            $rateafterdiscountBooking = $bookingData['rateafterdiscountBooking'];
            // Menghitung waktu finish
            $finishTime = new DateTime($createdAt);
            $finishTime->add(new DateInterval('PT60M')); // Menambahkan 60 menit
            $finishAt = $finishTime->format('Y-m-d H:i:s'); // Memformat waktu finish
            // Menyusun data untuk tabel "Customer"
            $data_customer = array(
                'idUser'          => $idUser,
                'FirstName'       => $customerName,
                'IDNumber'        => $idnumberBooking,
                'addres'          => $address,
                'notel'           => $notel,
                'gmail'           => $email,
                'regfromCustomer' => 'WEB',
                'createdAt'       => $createdAt,
            );
            // Memasukkan data ke dalam tabel "Customer"
            $this->db->insert('Customer', $data_customer);
            $idCustomer = $this->db->insert_id(); // Mengambil ID customer yang baru saja dimasukkan
            // Mengambil virtual_account_number dan urldokuBooking
            $virtual_account_number = $data_booking['virtual_account_number'] ?? null;
            $urldokuBooking = $data_booking['urldokuBooking'] ?? null;
            // Lanjutkan dengan memproses data booking seperti yang diinginkan...
        } else {
            // Log error jika kunci-kunci tidak ada
            log_message('error', 'Data booking tidak lengkap atau tidak valid.');
        }
    } else {
        // Log error jika JSON tidak sesuai atau tidak terdekode dengan benar
        log_message('error', 'Payload JSON tidak valid.');
    }
    $departure_time = '13:00:00';
    $checkout_datetime = $this->input->post('departureDate') . ' ' . $departure_time;
    $data_booking = array(
      'idBusiness'                => $idBusiness,
      'idUser'                    => $idUser,
      'idKamar'                   => $idKamar,
      'checkouttimeBooking'       => $checkout_datetime,
      // 'RateNow'                   => $RateNow,
      'invoiceBooking'            => $invoiceNumber,
      'arrivalBooking'            => $arrivalDate,
      'nightBooking'              => $dateIntervalText,
      'departureBooking'          => $departureDate,      
      'statusBooking'             => 'Reservation',
      'roomtypeBooking'           => $idKamar,
      'numberroomBooking'         => $virtual_account_number,
      'roompaxBooking'            => 1,
      'paxBooking'                => $paxBooking,
      'childBooking'              => $childBooking,
      'extrabedBooking'           => $extrabedBooking,
      'arrivaltimeBooking'        => '14:00',
      'departuretimeBooking'      => '12:00',
      'firstnameBooking'          => $customerName,
      'idnumberBooking'           => $idnumberBooking,
      'emailBooking'              => $email,
      'mobileBooking'             => $notel,
      'addressBooking'            => $address,
      'companyBooking'            => 'PERSONAL ACCOUNT',
      'ratecodeBooking'           => $ratecodeBooking,
      'nationalityBooking'        => $country,
      'originareaBooking'         => $province,
      'totalrateBooking'          => intval(str_replace('.', '', $totalrateBooking)),
      'discountBooking'           => $discountBooking,
      'reasonBooking'             => $reasonBooking,
      'rateafterdiscountBooking'  => intval(str_replace('.', '', $rateafterdiscountBooking)),
      'paymentBooking'            => $channel,
      'segmentBooking'            => 'OTA-WEB',
      'currencyBooking'           => 'IDR',
      'billinginstructionBooking' => $channel.'-'.$virtual_account_number.' - Reservation From Sahira Hotels Group',
      'checkinremarkBooking'      => $invoiceNumber.' - Reservation From Sahira Hotels Group',
      'statuspayBooking'          => 'UNPAID',
      'idCustomer'                => $idCustomer,
      'urldokuBooking'            => $urldokuBooking,
      'createdAtBooking'          => date('Y-m-d H:i:s'),
      'finishAtBooking'           => $finishAt,
    );
    $this->db->insert('booking', $data_booking);
    $idBooking = $this->db->insert_id();
    $data_membership = array(
      'idUser'                => $idUser,
      'idCustomer'            => $idCustomer,
      'idBooking'             => $idBooking,
      'idBusiness'            => $idBusiness,
      'idnumberBooking'       => $idnumberBooking,
      'createdAtMembership'   => date('Y-m-d H:i:s'),
    );
    $this->db->insert('membership', $data_membership);
    if($DateInterval != null) {
      $intervalDate = $DateInterval;
      // Remove square brackets and backslashes
      $intervalDates = str_replace(['[', ']', '\"'], '', $intervalDate);
      foreach($intervalDates as $interval) {
        $this->db->set('qtyKamar', 'qtyKamar - 1', FALSE);
        $this->db->set('soldKamar', 'soldKamar + 1', FALSE);
        $this->db->set('soldKamar', 'soldKamar + 1', FALSE);
        $data_update_kamar = array(
          'idUser'     => $idUser,
          'updateAt'   => date('Y-m-d H:i:s'),
        );
        $this->db->where('ketKamar', $idKamar);
        $this->db->where('dateKamar', $interval);
        $this->db->update('kamar_all', $data_update_kamar);
      }
    }
    // EMAIL SECTION
      $config = [
        "protocol"  => "smtp",
        "smtp_host" => "mail.sahirahotelsgroup.com",
        "smtp_port" => "587",
        "smtp_user" => "noreply@sahirahotelsgroup.com",
        "smtp_pass" => "noreply@sahirahotelsgroup.com",
        "mailtype"  => "html",
        "charset"   => "iso-8859-1",
        "wordwrap"  => true,
        "crlf"      => "\r\n",
        "newline"   => "\r\n",
      ];
      $this->load->library("email", $config);
      $createdAtBooking = date('Y-m-d H:i:s');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from("noreply@sahirahotelsgroup.com", "noreply-sahirahotelsgroup");
      $this->email->to($email);
      $this->email->bcc("sahirahotelspayment@gmail.com");
      $this->email->subject('Reservation from Sahira Hotels Group');
      $isi_email  = "<html>";
      $isi_email .= "<body>";
      $isi_email .= "<h2>Thank you for reservation from Sahira Hotels Group. This is your reservation data :</h2>";
      $isi_email .= "<h4>Customer Data :</h4>";
      $isi_email .= "<p>ID Number : $idnumberBooking</p>";
      $isi_email .= "<p>First Name : $customerName</p>";
      $isi_email .= "<p>Last Name : $customerName</p>";
      $isi_email .= "<p>Email : $email</p>";
      $isi_email .= "<p>Phone Number : $notel</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Room Data :</h4>";
      $isi_email .= "<p>Room Type : $idKamar</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Itenerary :</h4>";
      $isi_email .= "<p>Arrival Date : $arrivalDate</p>";
      $isi_email .= "<p>Departure Date : $departureDate</p>";
      $isi_email .= "<p>Night : $dateIntervalText</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Adult & Child :</h4>";
      $isi_email .= "<p>Pax : $paxBooking Adult(s)</p>";
      $isi_email .= "<p>Child : $childBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<p>Extrabed : $extrabedBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<p>Subtotal Price : $totalrateBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<p>Total Rate Price : $rateafterdiscountBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Payment Data :</h4>";
      $isi_email .= "<p>Payment Methode : $channel</p>";
      $isi_email .= "<p>Status Payment : UNPAID</p>";
      $isi_email .= "<p>Booking Time : $createdAtBooking</p>";
      $isi_email .= "</body>";
      $isi_email .= "</html>";
      $this->email->message($isi_email);
      $this->email->send();
    // EMAIL SECTION
    $data_notification = array(
      'idBusiness'                => $idBusiness,
      'typeNotification'          => 'Reservation',
      'nmNotification'            => 'Reservation - '.$invoiceNumber,
      'descNotification'          => $idKamar.' - IDR '.number_format($rateafterdiscountBooking).' UNPAID',
      'idBooking'                 => $idBooking,
      'idUser'                    => $idUser,
      'createdAtNotification'     => date('Y-m-d H:i:s'),
    );
    $this->db->insert('notification', $data_notification);
    $this->response(array('data_customer' => $data_customer, 'data_booking' => $data_booking, 'idBooking' => $idBooking, 'data_membership' => $data_membership, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function insertBookingInternal_post() {
    // Decode the JSON payload
    $data_booking = json_decode($this->input->raw_input_stream, true);
    // Memastikan data_booking adalah array dan memiliki kunci 'data'
    if (is_array($data_booking) && isset($data_booking['data'])) {
        $bookingData = $data_booking['data'];
        // Memeriksa kunci yang diperlukan
        if (isset($bookingData['idUser'], $bookingData['customerName'], $bookingData['address'], $bookingData['phoneNumber'], $bookingData['email'])) {
            $idUser = $bookingData['idUser'];
            $customerName = $bookingData['customerName'];
            $address = $bookingData['address'];
            $notel = $bookingData['phoneNumber'];
            $email = $bookingData['email'];
            $createdAt = date('Y-m-d H:i:s');
            // Mengakses data lainnya
            $idBusiness = $bookingData['idBusiness'];
            $idKamar = $bookingData['idKamar'];
            $invoiceNumber = $bookingData['invoiceNumber'];
            $arrivalDate = $bookingData['arrivalDate'];
            $dateIntervalText = $bookingData['dateIntervalText'];
            $departureDate = $bookingData['departureDate'];
            $paxBooking = $bookingData['paxBooking'];
            $childBooking = $bookingData['childBooking'];
            $extrabedBooking = $bookingData['extrabedBooking'];
            $idnumberBooking = $bookingData['idnumberBooking'];
            $ratecodeBooking = $bookingData['ratecodeBooking'];
            $numberroomBooking = $bookingData['numberroomBooking'];
            $byBooking = $bookingData['byBooking'];
            $genderBooking = $bookingData['gender'];
            $country = $bookingData['country'];
            $province = $bookingData['province'];
            $amount = $bookingData['amount'];
            $totalrateBooking = $bookingData['totalrateBooking'];
            $channel = $bookingData['channel'];
            $DateInterval = $bookingData['DateInterval'];
            $discountBooking = $bookingData['discountBooking'];
            $reasonBooking = $bookingData['reasonBooking'];
            $rateafterdiscountBooking = $bookingData['rateafterdiscountBooking'];
            // Menghitung waktu finish
            $finishTime = new DateTime($createdAt);
            $finishTime->add(new DateInterval('PT60M')); // Menambahkan 60 menit
            $finishAt = $finishTime->format('Y-m-d H:i:s'); // Memformat waktu finish
            // Menyusun data untuk tabel "Customer"
            $data_customer = array(
                'idUser'          => $idUser,
                'FirstName'       => $customerName,
                'IDNumber'        => $idnumberBooking,
                'addres'          => $address,
                'notel'           => $notel,
                'gmail'           => $email,
                'regfromCustomer' => 'WEB',
                'createdAt'       => $createdAt,
            );
            // Memasukkan data ke dalam tabel "Customer"
            $this->db->insert('Customer', $data_customer);
            $idCustomer = $this->db->insert_id(); // Mengambil ID customer yang baru saja dimasukkan
            // Mengambil virtual_account_number dan urldokuBooking
            $virtual_account_number = $data_booking['virtual_account_number'] ?? null;
            $urldokuBooking = $data_booking['urldokuBooking'] ?? null;
            // Lanjutkan dengan memproses data booking seperti yang diinginkan...
        } else {
            // Log error jika kunci-kunci tidak ada
            log_message('error', 'Data booking tidak lengkap atau tidak valid.');
        }
    } else {
        // Log error jika JSON tidak sesuai atau tidak terdekode dengan benar
        log_message('error', 'Payload JSON tidak valid.');
    }
    $departure_time = '13:00:00';
    $checkout_datetime = $this->input->post('departureDate') . ' ' . $departure_time;
    $data_booking = array(
      'idBusiness'                => $idBusiness,
      'idUser'                    => $idUser,
      'idKamar'                   => $idKamar,
      'checkouttimeBooking'       => $checkout_datetime,
      // 'RateNow'                   => $RateNow,
      'invoiceBooking'            => $invoiceNumber,
      'arrivalBooking'            => $arrivalDate,
      'nightBooking'              => $dateIntervalText,
      'departureBooking'          => $departureDate,      
      'statusBooking'             => 'Reservation',
      'roomtypeBooking'           => $idKamar,
      'numberroomBooking'         => $numberroomBooking,
      'roompaxBooking'            => 1,
      'paxBooking'                => $paxBooking,
      'childBooking'              => $childBooking,
      'extrabedBooking'           => $extrabedBooking,
      'arrivaltimeBooking'        => '14:00',
      'departuretimeBooking'      => '12:00',
      'firstnameBooking'          => $customerName,
      'idnumberBooking'           => $idnumberBooking,
      'emailBooking'              => $email,
      'mobileBooking'             => $notel,
      'addressBooking'            => $address,
      'companyBooking'            => 'PERSONAL ACCOUNT',
      'ratecodeBooking'           => $ratecodeBooking,
      'byBooking'                 => $byBooking,
      'genderBooking'             => $genderBooking,
      'nationalityBooking'        => $country,
      'originareaBooking'         => $province,
      'totalrateBooking'          => intval(str_replace('.', '', $totalrateBooking)),
      'discountBooking'           => $discountBooking,
      'reasonBooking'             => $reasonBooking,
      'rateafterdiscountBooking'  => intval(str_replace('.', '', $rateafterdiscountBooking)),
      'paymentBooking'            => $channel,
      'segmentBooking'            => 'OTA-WEB',
      'currencyBooking'           => 'IDR',
      'billinginstructionBooking' => $channel.'-'.$virtual_account_number.' - Reservation From Sahira Hotels Group',
      'checkinremarkBooking'      => $invoiceNumber.' - Reservation From Sahira Hotels Group',
      'statuspayBooking'          => 'UNPAID',
      'idCustomer'                => $idCustomer,
      'urldokuBooking'            => $urldokuBooking,
      'createdAtBooking'          => date('Y-m-d H:i:s'),
      'finishAtBooking'           => $finishAt,
    );
    $this->db->insert('booking', $data_booking);
    $idBooking = $this->db->insert_id();
    $data_membership = array(
      'idUser'                => $idUser,
      'idCustomer'            => $idCustomer,
      'idBooking'             => $idBooking,
      'idBusiness'            => $idBusiness,
      'idnumberBooking'       => $idnumberBooking,
      'createdAtMembership'   => date('Y-m-d H:i:s'),
    );
    $this->db->insert('membership', $data_membership);
    if($DateInterval != null) {
      $intervalDate = $DateInterval;
      // Remove square brackets and backslashes
      $intervalDates = str_replace(['[', ']', '\"'], '', $intervalDate);
      foreach($intervalDates as $interval) {
        $this->db->set('qtyKamar', 'qtyKamar - 1', FALSE);
        $this->db->set('soldKamar', 'soldKamar + 1', FALSE);
        $this->db->set('soldKamar', 'soldKamar + 1', FALSE);
        $data_update_kamar = array(
          'idUser'     => $idUser,
          'updateAt'   => date('Y-m-d H:i:s'),
        );
        $this->db->where('ketKamar', $idKamar);
        $this->db->where('dateKamar', $interval);
        $this->db->update('kamar_all', $data_update_kamar);
      }
    }
    // EMAIL SECTION
      $config = [
          "protocol"  => "smtp",
          "smtp_host" => "mail.sahirahotelsgroup.com",
          "smtp_port" => "587",
          "smtp_user" => "noreply@sahirahotelsgroup.com",
          "smtp_pass" => "noreply@sahirahotelsgroup.com",
          "mailtype"  => "html",
          "charset"   => "utf-8",
          "wordwrap"  => true,
          "crlf"      => "\r\n",
          "newline"   => "\r\n",
      ];

      $this->load->library("email", $config);
      $createdAtBooking = date('Y-m-d H:i:s');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from("noreply@sahirahotelsgroup.com", "Sahira Hotels Group");
      $this->email->to($email);
      $this->email->subject('Membership from Sahira Hotels Group');

      // Isi email dengan header, footer, dan detail reservasi
      $isi_email = "<html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    color: #333;
                }
                .container {
                    width: 100%;
                    max-width: 640px;
                    margin: 20px auto;
                    background: #fff;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    overflow: hidden;
                }
                .header {
                    width: 640px;
                    height: 448px;
                    background-size: cover;
                    background-position: center;
                    background-image: url('https://riauaktual.com/application/views/web/berita/745021522-member_card.jpg');
                }
                .content {
                    padding: 20px;
                }
                .columns {
                    display: flex;
                    justify-content: space-between;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border-top: 1px solid #ddd;
                }
                .column {
                    width: 30%;
                    text-align: left;
                }
                .column h4 {
                    margin-bottom: 10px;
                    font-size: 16px;
                    color: #4CAF50;
                }
                .column p,
                .column a {
                    font-size: 14px;
                    line-height: 1.6;
                    margin: 5px 0;
                    color: #333;
                    text-decoration: none;
                }
                .column img {
                    max-width: 100%;
                    height: auto;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <!-- Header -->
                <div class='header'></div>

                <!-- Konten -->
                <div class='content'>
                    <h4>Dear, $genderBooking $customerName</h4>
                    <h4>Registration Number $idUser</h4>
                    <p>Welcome to the Sahira Hotels Group family! We are delighted to have you join us as a valued member with a Bronze Tier membership.</p>
                    <p>As a Bronze member, you must click My Account in email footer to access your member page</p>
                    <p>We look forward to creating unforgettable moments for you. Should you have any questions or need assistance, our dedicated team is always ready to help.</p>
                    <p>Thank you for choosing Sahira Hotels Group. We can’t wait to serve you!</p>
                    <p>Warm regards,</p>
                    <h4>Sahira Hotels Group</h4>
                </div>

                <!-- New Section with 3 Columns -->
                <div class='columns'>
                    <!-- Column 1 -->
                    <div class='column'>
                        <a href='https://sahirahotelsgroup.com/register-page/en/'><h4>My Account</h4></a>
                        <a href='https://sahirahotelsgroup.com/special-offers'><p>Special Offers</p></a>
                    </div>
                    
                    <!-- Column 2 -->
                    <div class='column'>
                        <h4>Follow Us</h4>
                        <p><a href='https://www.instagram.com/sahirahotelsgroup/'>Instagram</a></p>
                        <p><a href='https://www.facebook.com/sahirahotelsgroup'>Facebook</a></p>
                        <p><a href='https://www.tiktok.com/@sahirahotelsgroup'>TikTok</a></p>
                    </div>

                    <!-- Column 3 -->
                    <div class='column'>
                        <img src='https://sahirahotelsgroup.com/img/Sahira%20Group%20Coklat%20New%20(1).png' alt='Sahira Hotels Group Logo'>
                    </div>
                </div>
            </div>
        </body>
      </html>";

      // Mengatur isi email
      $this->email->message($isi_email);

      // Mengirim email
      $this->email->send();
    // EMAIL SECTION
    $data_notification = array(
      'idBusiness'                => $idBusiness,
      'typeNotification'          => 'Reservation',
      'nmNotification'            => 'Reservation - '.$invoiceNumber,
      'descNotification'          => $idKamar.' - IDR '.number_format($rateafterdiscountBooking).' UNPAID',
      'idBooking'                 => $idBooking,
      'idUser'                    => $idUser,
      'createdAtNotification'     => date('Y-m-d H:i:s'),
    );
    $this->db->insert('notification', $data_notification);
    $this->response(array('data_customer' => $data_customer, 'data_booking' => $data_booking, 'idBooking' => $idBooking, 'data_membership' => $data_membership, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getBookingCheckout_post() {
    $idUser = $this->input->post('idUser');
    $checkout = $this->Api_m->getBookingCheckout($idUser);
    if($checkout) {
      $this->response(array('response' => $checkout, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => [], 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  function getBookingCheckin_post() {
    $idUser = $this->input->post('idUser');
    $checkin = $this->Api_m->getBookingCheckin($idUser);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getBookingExpired_post() {
    $idUser = $this->input->post('idUser');
    $expired = $this->Api_m->getBookingExpired($idUser);
    if($expired) {
      $this->response(array('response' => $expired, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => [], 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  function getBookingCheckinRoomService_post() {
    $idUser = $this->input->post('idUser');
    $checkin = $this->Api_m->getBookingCheckinRoomService($idUser);
    if($checkin) {
      $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  function getBookingCheckinDetail_post() {
    $idUser = $this->input->post('idUser');
    $idBooking = $this->input->post('idBooking');
    $checkin = $this->Api_m->getBookingCheckinDetail($idUser, $idBooking);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNB_post() {
    $idBusiness = $this->input->post('idBusiness');
    $checkin = $this->Api_m->getFNB($idBusiness);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNBByName_post() {
    $nmMenu = $this->input->post('nmMenu');
    $idBusiness = $this->input->post('idBusiness');
    $checkin = $this->Api_m->getFNBByName($nmMenu, $idBusiness);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNBBeverage_post() {
    $idBusiness = $this->input->post('idBusiness');
    $checkin = $this->Api_m->getFNBBeverage($idBusiness);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNBType_post() {
    $idBusiness = $this->input->post('idBusiness');
    $fnbmenutype = $this->Api_m->getFNBType($idBusiness);
    $this->response(array('response' => $fnbmenutype, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNBTypePackages_post() {
    $idBusiness = $this->input->post('idBusiness');
    $fnbmenutype = $this->Api_m->getFNBTypePackages($idBusiness);
    $this->response(array('response' => $fnbmenutype, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNBByType_post() {
    $idBusiness = $this->input->post('idBusiness');
    $name = $this->input->post('name');
    $checkin = $this->Api_m->getFNBByType($idBusiness, $name);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  function getFNBByTypePackages_post() {
    $idBusiness = $this->input->post('idBusiness');
    $name = $this->input->post('name');
    $checkin = $this->Api_m->getFNBByTypePackages($idBusiness, $name);
    $this->response(array('response' => $checkin, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function insertFNB_post() {
    $virtual_account_number = $this->input->post('virtual_account_number');
    $urldokuFnbcooking = $this->input->post('how_to_pay_page');
    // Decode the JSON payload
    $fnbData = json_decode($this->input->post('data'), true);
    // Check if "data" exists in the decoded JSON
    if (isset($fnbData['data'])) {
      $dataArray = $fnbData['data'];
      $idBusiness = $fnbData['idBusiness'];
      $paymentFnbcooking = $fnbData['paymentFnbcooking'];
      if($fnbData['idBooking'] != null) {
        $idBooking = $fnbData['idBooking'];
      } else {
        $idBooking = $virtual_account_number;
      }
      $invoiceNumber = $fnbData['invoiceNumber'];
      $subtotalPrice = $fnbData['subtotalPrice'];
      $statuspayFnbcooking = $fnbData['statuspayFnbcooking'];
      // $numberroomBooking = $fnbData['numberroomBooking'];
      $idUser = $fnbData['idUser'];
      // Now $dataArray contains the value of "data"
      $createdAt = date('Y-m-d H:i:s'); // Current date and time
      $finishTime = new DateTime($createdAt); // Creating a DateTime object from $createdAt
      $finishTime->add(new DateInterval('PT60M')); // Adding 60 minutes
      $finishAt = $finishTime->format('Y-m-d H:i:s'); // Formatting the finish time
      $data_fnb_cooking = array(
        'statuspayFnbcooking'   => $statuspayFnbcooking,
        'invoiceFnbadditional'  => $invoiceNumber,
        'subtotalPrice'         => $subtotalPrice,
        'idBooking'             => $idBooking,
        'idBusiness'            => $idBusiness,
        'idUser'                => $idUser,
        'paymentFnbcooking'     => $paymentFnbcooking,
        'urldokuFnbcooking'     => $urldokuFnbcooking,
        'createdAtFnbcooking'   => $createdAt, // Using the original $createdAt value
        'finishAtFnbcooking'    => $finishAt,
      );
      $this->Api_m->insert_fnb_cooking($data_fnb_cooking);

      $getFNBKasir = $this->Api_m->getFNBKasir($idBusiness);
      // Insert data into the database
      foreach ($dataArray as $item) {
        $menuName = $item['menuName'];
        $updatedQty = $item['updatedQty'];
        $priceMenu = $item['priceMenu'];
        $optional = $item['optional'];
        // if(!$item['packages']) {
        //   $packageFnbadditional = NULL;
        // } else {
        //   $packageFnbadditional = $item['packages'];
        // }
        $packageFnbadditional = NULL;
        
        $numberroomBooking = $item['numberroomBooking'];
        $segmentFnbadditional = $item['segmentFnbadditional'];
        $createdAt = date('Y-m-d H:i:s');
        // Assuming you have a model or a database helper method to handle the insertion
        $this->Api_m->insert_fnb($idUser, $idBooking, $menuName, $updatedQty, $priceMenu, $optional, $packageFnbadditional, $numberroomBooking, $invoiceNumber, $createdAt, $segmentFnbadditional);
        $fnb_menu = $this->Api_m->getfile_fnb_menu_by_name($menuName);
        $data_update_fnb = [
          "idUser" => $idUser,
          "stockMenu" => $fnb_menu->stockMenu - $updatedQty,
        ];
        $this->db->where("nmMenu", $menuName);
        $this->db->update("fnb_menu", $data_update_fnb);

        // Header untuk request ke Firebase Cloud Messaging
        $headers = [
            'Authorization: Bearer ' . $getFNBKasir->tokenPushNotification,  // Bearer token untuk otentikasi
            'Content-Type: application/json',  // Konten adalah JSON
        ];

        // WebSocket connection to send notification
        $message = json_encode([
            'type' => 'fnb',  // Type of notification
            'notification' => [
                'title' => 'UNPAID - ' . $invoiceNumber . ' a/n ' . $statuspayFnbcooking,  // Notification title
                'body'  => $numberroomBooking,  // Notification body
            ],
            'payload' => [
                'data' => [
                    'value' => json_encode($dataArray),  // Data to be received by the client
                    'transaction' => 'fnb-room',  // Transaction type
                    'playSound' => 'true',  // Flag to play notification sound
                ]
            ]
        ]);

        // WebSocket connection (assuming it's on localhost or another IP, replace accordingly)
        $socket = new Client("ws://127.0.0.1:8082");
        // Send the message via WebSocket
        $socket->send($message);
        $socket->close();

        $ch = curl_init(FCM_ENDPOINT);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        $result = curl_exec($ch);
        curl_close($ch);
        // var_dump($getFNBKasir);
        // EMAIL SECTION
          $config = [
            "protocol"  => "smtp",
            "smtp_host" => "mail.sahirahotelsgroup.com",
            "smtp_port" => "587",
            "smtp_user" => "noreply@sahirahotelsgroup.com",
            "smtp_pass" => "noreply@sahirahotelsgroup.com",
            "mailtype"  => "html",
            "charset"   => "iso-8859-1",
            "wordwrap"  => true,
            "crlf"      => "\r\n",
            "newline"   => "\r\n",
          ];
          $this->load->library("email", $config);
          $createdAtBooking = date('Y-m-d H:i:s');
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          $this->email->from("noreply@sahirahotelsgroup.com", "noreply-sahirahotelsgroup");
          $this->email->to('yerblues6@gmail.com');
          $this->email->bcc("yerblues6@gmail.com");
          $this->email->subject('Food Order from Sahira Hotels Group');
          $isi_email  = "<html>";
          $isi_email .= "<body>";
          $isi_email .= "<h2>Thank you for order Food Order from Sahira Hotels Group. This is your Food Order data :</h2>";
          $isi_email .= "<h4>Menu Data :</h4>";
          $isi_email .= "<p>Menu Name : $menuName</p>";
          $isi_email .= "<p>Quantity : $updatedQty</p>";
          $isi_email .= "<p>Price : IDR $priceMenu</p>";
          $isi_email .= "<p>Optional : $optional</p>";
          $isi_email .= "<p>Order Time : $createdAt</p>";
          $isi_email .= "</body>";
          $isi_email .= "</html>";
          $this->email->message($isi_email);
          $this->email->send();
        // EMAIL SECTION
        // NOTIFICATION SECTION
          $data_notification = array(
            'idBusiness'                => $idBusiness,
            'typeNotification'          => 'Food Order',
            'nmNotification'            => 'Food Order - '.$invoiceNumber,
            'descNotification'          => $menuName.' - IDR '.number_format($subtotalPrice).' UNCONFIRM',
            'idBooking'                 => $idBooking,
            'idUser'                    => $idUser,
            'createdAtNotification'     => date('Y-m-d H:i:s'),
          );
          $this->db->insert('notification', $data_notification);
        // NOTIFICATION SECTION
        // Print or use $item values as needed
        $this->response($data_update_fnb);
      }
    } else {
      // Handle the case where "data" is not present in the JSON payload
      echo "The 'data' key is missing in the JSON payload.";
    }
  }
  public function getProfile_post() {
    $idUser = $this->post('idUser');
    $detail = $this->Api_m->getProfile($idUser);
    if($detail) {
      $this->response($detail);
    } else {
      $this->response(array('status' => 'error', 'keterangan' => 'Data not found !'));
    }
  }
  function addCheckIn_post() {
    $idUser = $this->input->post('idUser');
    $idBooking = $this->input->post('idBooking');
    $data_update_booking = array(
      'statusBooking' => 'Confirm',
      'editAt'        => date('Y-m-d H:i:s'),
    );
    $this->db->where('idUser', $idUser);
    $this->db->where('idBooking', $idBooking);
    $this->db->update('booking', $data_update_booking);
    $this->response(array('response' => $data_update_booking, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getAllbusiness_post() {
    $places = array();
    $this->db->from('Business_Detail');
    $this->db->where('typeBusiness', 'HOTEL');
    $this->db->or_where('typeBusiness', 'CAFE');
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $places[] = $row;
      }
    }
    $query->free_result(); 
  
    $this->response(array('response' => $places, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getCities_post() {
    $places = array();
    $this->db->from('discovery');
    $this->db->where('active', 0);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $places[] = $row;
      }
    }
    $query->free_result(); 
  
    $this->response(array('response' => $places, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getCitiesById_post() {
    $id = $this->input->post('id');
    $places = array();
    $this->db->from('discovery');
    $this->db->where('idDiscover', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $places = $query->row();
    }
    $query->free_result();
  
    $this->response(array('response' => $places, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getPlaces_post() {
    $places = array();
    $this->db->from('Business_Detail');
    // $this->db->join('discovery', 'discovery.idBusiness = Business_Detail.idBusiness');
    $this->db->where('typeBusiness', 'PLACE');
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $places[] = $row;
      }
    }
    $query->free_result(); 
  
    $this->response(array('response' => $places, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getPlacesById_post() {
    $idBusiness = $this->input->post('idBusiness');
    $places = array();
    $this->db->from('Business_Detail');
    $this->db->where('idBusiness', $idBusiness);
    $this->db->where('typeBusiness', 'PLACE');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $places = $query->row();
    }
    $query->free_result();
  
    $this->response(array('response' => $places, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getPackages_post() {
    $getPackage = $this->Api_m->getPackage();
    $this->response($getPackage);
  }
  public function getPackagesbyId_post() {
    $idKamar = $this->post('idKamar');
    $getPackagesbyId = $this->Api_m->getPackagesbyId($idKamar);
    if($getPackagesbyId) {
      $this->response(array('response' => $getPackagesbyId, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('status' => 'error', 'keterangan' => 'Data not found !'));
    }
  }
  public function nearbyHotel_post() {
    $latitude = $this->input->post('latitude');
    $longitude = $this->input->post('longitude');
    $radius = $this->input->post('radius') ?: 1000000; // Default radius is 10000 meters
    // Coordinates of your hotels
    $hotelCoordinates = $this->Api_m->getNearbyHotels();
    // Calculate distances and filter nearby hotels
    $nearbyHotels = array_filter($hotelCoordinates, function ($hotel) use ($latitude, $longitude, $radius) {
      $distance = $this->calculateDistance(
        $latitude,
        $longitude,
        $hotel['latitude'],
        $hotel['longitude']
      );
      return $distance <= $radius;
    });
    // Convert the entire response into an associative array
    $response = array('response' => array_values($nearbyHotels), 'http_status' => REST_Controller::HTTP_OK);
    $this->response($response);
  }
  private function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $longitude = floatval($lon1);
    $longitude_loct = floatval($lon2);
    $latitude = floatval($lat1);
    $latitude_loct = floatval($lat2);
    $theta = $longitude - $longitude_loct;
    $dist = sin(deg2rad($latitude)) * sin(deg2rad($latitude_loct)) + cos(deg2rad($latitude)) * cos(deg2rad($latitude_loct)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $kilometers = $miles * 1.609344;
    return $kilometers * 1000;
  }
  public function getAllWishlist_post() {
    $idUser = $this->post('idUser');
    $getAllWishlist = $this->Api_m->getAllWishlist($idUser);
    // Check if no hotels were found
    if($getAllWishlist) {
      $this->response(array('response' => $getAllWishlist, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('status' => 'error', 'response' => $getAllWishlist));
    }
  }
  public function getWishlistbyId_post() {
    $idUser = $this->post('idUser');
    $idBusiness = $this->post('idBusiness');
    $getWishlist = $this->Api_m->getWishlist($idUser, $idBusiness);
    // Check if no hotels were found
    if($getWishlist) {
      $this->response(array('response' => $getWishlist, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('status' => 'error', 'response' => $getWishlist));
    }
  }
  public function setWhistlist_post() {
    $idUser = $this->post('idUser');
    $idBusiness = $this->post('idBusiness');
    $getWishlist = $this->Api_m->getWishlist($idUser, $idBusiness);
    if(!$getWishlist) {
      $data_insert_wishlist = array(
        'idUser'            => $idUser,
        'idBusiness'        => $idBusiness,
        'statusWishlist'    => 'Active',
        'createdAtWishlist' => date('Y-m-d H:i:s'),
      );
      $this->db->insert('wishlist', $data_insert_wishlist);
      $this->response(array('response' => $data_insert_wishlist, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      if($getWishlist->statusWishlist != 'Active') {
        $data_update_wishlist = array(
          'statusWishlist'    => 'Active',
          'editAtWishlist'    => date('Y-m-d H:i:s'),
        );
        $this->db->where('idUser', $idUser);
        $this->db->where('idBusiness', $idBusiness);
        $this->db->update('wishlist', $data_update_wishlist);
        $this->response(array('response' => $getWishlist, 'http_status' => REST_Controller::HTTP_OK));
      } else {
        $this->db->where('idUser', $idUser);
        $this->db->where('idBusiness', $idBusiness);
        $this->db->delete('wishlist');
        $this->response(array('response' => $getWishlist, 'http_status' => REST_Controller::HTTP_OK));
      }
    }
  }
  public function chat() {
    if($this->session->userdata('logged_in') != "login") {
      redirect('login','refresh');
      }
        $data=array(
          'title'=>'Madani Djourney | ONIXLABS',
          'nopage'=>10
        );
    $data=array(
      'title'=>'Madani Djourney | ONIXLABS',
      'nopage'=>18
    );
    $this->load->view('cms/header', $data);
    $this->load->view('cms/view_chat', $data);
    $this->load->view('cms/footer', $data);
  }
  public function ajaxGetFcmToken_post() {
    $idUser = $this->input->post('idUser');
    $data = array();
    $this->db->from('user');
    $this->db->where('user.idUser', $idUser);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $data = $query->row();
    }
    $query->free_result();
    $this->response(array('response' => $idUser, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function postNotificationBid_mp_post()
  {
    $idUser = $this->input->post('idUser');
    $tokenPushNotification = $this->input->post('currentToken');
    $data_form = [
      "idUser" => $idUser,
      "tokenPushNotification" => $tokenPushNotification,
    ];
    $this->db->where('idUser', $idUser);
    $this->db->update('user', $data_form);
    $this->response(json_encode(array("response" => $data_form)));
  }
  public function uploadTF_post() {
    $invoiceFnbadditional = $this->input->post('invoiceFnbadditional'); // Assuming 'invoiceFnbadditional' is sent from Angular
    $idUser = $this->input->post('idUser'); // Assuming 'idUser' is sent from Angular
    $idBusiness = $this->input->post('idBusiness'); // Assuming 'idUser' is sent from Angular
    // Add other form data processing if needed
    // Handle the file upload
    $config['upload_path'] = './assets/images/invoice/'; // Set your upload path
    $config['allowed_types'] = 'gif|jpg|png'; // Set allowed file types
    $config['max_size'] = 10240; // Set maximum file size in KB
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('file')) {
        $uploadData = $this->upload->data();
        // Process the uploaded file as needed
        $data_form = [
          "invoiceFnbadditional"  => $invoiceFnbadditional,
          "idUser"                => $idUser,
          "idBusiness"            => $idBusiness,
          "file"                  => $uploadData['file_name'],
          "createdAtInvoicetemp"  => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('invoice_temp', $data_form);
        echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully']);
    } else {
        $error = $this->upload->display_errors();
        echo json_encode(['status' => 'error', 'message' => $error]);
    }
  }
  public function checkNotif_post() {
    $idUser = $this->input->post('idUser');
    $data = array();
    $this->db->from('booking');
    $this->db->join('notification', 'notification.idBooking=booking.idBooking');
    $this->db->where('notification.idUser', $idUser);
    $this->db->where('notification.statusNotification', 0);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $data = $query->row();
    }
    $query->free_result();
    if($data) {
      $this->response(array('response' => $data, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }  
  public function updateNotif_post() {
    $idUser = $this->input->post('idUser');
    $data_form = [
      "idUser"                => $idUser,
      "readNotification"      => 1,
      "createdAtNotification" => date('Y-m-d H:i:s'),
    ];
    $this->db->where('idUser', $idUser);
    $this->db->update('notification', $data_form);
    if($data_form) {
      $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }  
  public function getNotif_post() {
    $idUser = $this->input->post('idUser');
    $data = array();
    $this->db->from('notification');
    $this->db->where('idUser', $idUser);
    $this->db->order_by('idNotification', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
    }
    $query->free_result();
    if($data) {
      $this->response(array('response' => $data, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }  
  public function updateNotifbyId_post() {
    $idNotification = $this->input->post('idNotification');
    $data_form = [      
      "statusNotification"    => 1,
      "createdAtNotification" => date('Y-m-d H:i:s'),
    ];
    $this->db->where('idNotification', $idNotification);
    $this->db->update('notification', $data_form);
    if($data_form) {
      $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  } 
  public function updateNotifAll_post() {
    $idUser = $this->input->post('idUser');
    $data_form = [      
      "statusNotification"    => 1,
      "createdAtNotification" => date('Y-m-d H:i:s'),
    ];
    $this->db->where('idUser', $idUser);
    $this->db->update('notification', $data_form);
    if($data_form) {
      $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }  
  public function getAllFoodOrder_post() {
    $idUser = $this->input->post('idUser');
    $data = array();
    $this->db->from('fnb_additional_cooking');
    $this->db->where('idUser', $idUser);
    $this->db->where('statuspayFnbcooking !=', 'EXPIRED');
    $this->db->where('statuspayFnbcooking !=', 'PAID');
    $this->db->order_by('finishAtFnbcooking', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
    }
    $query->free_result();
    if($data) {
      $this->response(array('response' => $data, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  public function getAllFoodOrderByInvoice_post() {
    $idUser = $this->input->post('idUser');
    $invoice = $this->input->post('invoice');
    $data = array();
    $this->db->from('fnb_additional_cooking');
    $this->db->join('fnb_additional_booking', 'fnb_additional_booking.invoiceFnbadditional=fnb_additional_cooking.invoiceFnbadditional');
    $this->db->where('fnb_additional_cooking.idUser', $idUser);
    $this->db->where('fnb_additional_cooking.invoiceFnbadditional', $invoice);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
    }
    $query->free_result();
    if($data) {
      $this->response(array('response' => $data, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  public function finishOrderById_post() {
    $idUser = $this->input->post('idUser');
    $invoiceFnbadditional = $this->input->post('invoiceFnbadditional');
    $data_form = [      
      "statusFnbfeedback"   => 1,
      "finishAt"            => date('Y-m-d H:i:s'),
    ];
    $this->db->where('idUser', $idUser);
    $this->db->where('invoiceFnbadditional', $invoiceFnbadditional);
    $this->db->update('fnb_additional_cooking', $data_form);
    if($data_form) {
      $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  } 
  public function getFNBUser_post() {
    // Coordinates of your hotels
    $getFNBUser = $this->Api_m->getFNBUser();
    // Check if no hotels were found
    if (empty($getFNBUser)) {
      $this->response(array('status' => 'error', 'message' => 'No hotels found within the specified radius'), REST_Controller::HTTP_NOT_FOUND);
    } else {
      // Convert the entire response into an associative array
      $response = array('response' => array_values($getFNBUser), 'http_status' => REST_Controller::HTTP_OK);
      $this->response($response);
    }
  }
  public function getFinanceUser_post() {
    // Coordinates of your hotels
    $getFinanceUser = $this->Api_m->getFinanceUser();
    // Check if no hotels were found
    if (empty($getFinanceUser)) {
      $this->response(array('status' => 'error', 'message' => 'No hotels found within the specified radius'), REST_Controller::HTTP_NOT_FOUND);
    } else {
      // Convert the entire response into an associative array
      $response = array('response' => array_values($getFinanceUser), 'http_status' => REST_Controller::HTTP_OK);
      $this->response($response);
    }
  } 
  public function postNotificationFO_post()
  {
    $arr = json_decode(file_get_contents("php://input"), true);
    $nmUser = $this->input->post('nmUser');
    $message = $this->input->post('message');
    $currentToken = $this->input->post('currentToken');
    $idBooking = $this->input->post('idBooking');
    $data = json_decode($message, true);
    // Extract specific fields
    $extracted_data = array(
      'idKamar' => $data['idKamar'],
      'invoiceNumber' => $data['invoiceNumber'],
      'idBusiness' => $data['idBusiness'],
      'idUser' => $data['idUser'],
      'expiredTime' => $data['expiredTime']
    );
    $extracted_json = json_encode($extracted_data);
    // Output the extracted data
    // echo $extracted_json;
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => $data['invoiceNumber'],
          'body'  => $data['idKamar']
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'value' => $message,
          'transaction' => 'reservation'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function postNotificationFNBOrderRoom_post()
  {
    $arr = json_decode(file_get_contents("php://input"), true);
    $idBooking = $this->input->post('idBooking');
    $invoiceFnbadditional = $this->input->post('invoiceFnbadditional');
    $statuspayFnbcooking = $this->input->post('statuspayFnbcooking');
    $nmUser = $this->input->post('nmUser');
    $message = $this->input->post('message');
    $currentToken = $this->input->post('currentToken');
    $data = json_decode($message, true);
    // Extract specific fields
    $extracted_data = array(
      'data' => $data['data'],
      'numberroomBooking' => $data['numberroomBooking'],
      'invoiceNumber' => $data['invoiceNumber'],
      'idBooking' => $data['idBooking'],
      'idBusiness' => $data['idBusiness'],
      'idUser' => $data['idUser'],
      'expiredTime' => $data['expiredTime']
    );
    $extracted_json = json_encode($extracted_data);
    // Initialize an empty array to store the formatted menu items
    $formatted_menu_items = [];
    // Iterate over each menu item in $data['data']
    foreach ($data['data'] as $menu_item) {
      // Add the formatted menu item to the array
      $formatted_menu_items[] = [
        'menuName' => $menu_item['menuName'],
        'updatedQty' => $menu_item['updatedQty'],
        'optional' => $menu_item['optional'],
        'priceMenu' => $menu_item['priceMenu'],
        'numberroomBooking' => $menu_item['numberroomBooking']
      ];
    }
    // Output the extracted data
    // echo $data['numberroomBooking'];
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => $data['invoiceNumber'].' a/n '.$data['numberroomBooking'],
          'body'  => 'Room Order - '.$data['numberroomBooking']
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'value' => json_encode($data['data']),
          'transaction' => 'fnb-room'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function postNotificationFNBOrderTable_post()
  {
    $arr = json_decode(file_get_contents("php://input"), true);
    $nmUser = $this->input->post('nmUser');
    $message = $this->input->post('message');
    $currentToken = $this->input->post('currentToken');
    $data = json_decode($message, true);
    // Extract specific fields
    $extracted_data = array(
      'data' => $data['data'],
      'numberroomBooking' => $data['numberroomBooking'],
      'invoiceNumber' => $data['invoiceNumber'],
      'idBooking' => $data['idBooking'],
      'idBusiness' => $data['idBusiness'],
      'idUser' => $data['idUser'],
      'expiredTime' => $data['expiredTime']
    );
    $extracted_json = json_encode($extracted_data);
    // Initialize an empty array to store the formatted menu items
    $formatted_menu_items = [];
    // Iterate over each menu item in $data['data']
    foreach ($data['data'] as $menu_item) {
      // Add the formatted menu item to the array
      $formatted_menu_items[] = [
        'menuName' => $menu_item['menuName'],
        'updatedQty' => $menu_item['updatedQty'],
        'optional' => $menu_item['optional'],
        'priceMenu' => $menu_item['priceMenu'],
        'numberroomBooking' => $menu_item['numberroomBooking']
      ];
    }
    // Output the extracted data
    // echo $data['numberroomBooking'];
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => $data['invoiceNumber'].' a/n '.$data['numberroomBooking'],
          'body'  => 'Room Order - '.$data['numberroomBooking']
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'value' => json_encode($data['data']),
          'transaction' => 'fnb-table'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function postNotificationPayment_post()
  {
    $arr = json_decode(file_get_contents("php://input"), true);
    $invoiceBooking = $this->input->post('invoiceBooking');
    $currentToken = $this->input->post('currentToken');
    $idBusiness = $this->input->post('idBusiness');
    $rateafterdiscountBooking = $this->input->post('rateafterdiscountBooking');
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => 'PAID - '.$invoiceBooking,
          'body'  => 'IDR'.number_format($rateafterdiscountBooking)
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'url' => 'https://cms.sahirahotelsgroup.com/cms/home/viewBuktiPembayaran/'.$idBusiness,
          'transaction' => 'payment'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function updatestatuspayFNB_post() {
    $invoiceFnbadditional = $this->input->post('invoiceFnbadditional');
    $statusPay = $this->input->post('statusPay');
    $data_form = [      
      "statuspayFnbcooking"   => $statusPay,
      "createdAtFnbcooking"   => date('Y-m-d H:i:s'),
      "finishAtFnbcooking"    => date('Y-m-d H:i:s'),
    ];
    $this->db->where('invoiceFnbadditional', $invoiceFnbadditional);
    $this->db->update('fnb_additional_cooking', $data_form);
    $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
  } 
  public function updatestatuspayBooking_post() {
    $invoiceBooking = $this->input->post('invoiceBooking');
    $statusPayBooking = $this->input->post('statusPayBooking');
    $data_form = [      
      "statuspayBooking"      => $statusPayBooking,
      "editAt"                => date('Y-m-d H:i:s'),
    ];
    $this->db->where('invoiceBooking', $invoiceBooking);
    $this->db->update('booking', $data_form);
    $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
  } 
  public function postNotificationPaymentFinance_post()
  {
    // $arr = json_decode(file_get_contents("php://input"), true);
    $invoiceBooking = $this->input->post('invoiceBooking');
    $currentToken = $this->input->post('currentToken');
    $idBusiness = $this->input->post('idBusiness');
    $rateafterdiscountBooking = $this->input->post('rateafterdiscountBooking');
    // $this->response(array("arr" => $arr, "invoice" => $invoiceBooking, "currentToken" => $currentToken, "idBusiness" => $idBusiness, "rateafterdiscountBooking" => $rateafterdiscountBooking));
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => 'PAID - '.$invoiceBooking,
          'body'  => 'IDR'.number_format($rateafterdiscountBooking)
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'url' => 'https://cms.sahirahotelsgroup.com/cms/home/viewBuktiPembayaran/'.$idBusiness,
          'transaction' => 'payment'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function postNotificationNewsletter_post()
  {
    // $arr = json_decode(file_get_contents("php://input"), true);
    $titleNewsletter = $this->input->post('titleNewsletter');
    $currentToken = $this->input->post('currentToken');
    $bodyNewsletter = $this->input->post('bodyNewsletter');
    $imgNewsletter = $this->input->post('imgNewsletter');
    // $this->response(array("arr" => $arr, "invoice" => $invoiceBooking, "currentToken" => $currentToken, "idBusiness" => $idBusiness, "rateafterdiscountBooking" => $rateafterdiscountBooking));
    $data = array();
    $this->db->from('user');
    // $this->db->where('idUser', 110);
    $this->db->where('tokenPushNotification !=', '');
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
    }
    $query->free_result();
    foreach($data as $row) {
      $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
      $url = OAUTH2_TOKEN_URL;
      $params = [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion'  => JWT::encode([
          'iss'   => $serviceAccount['client_email'],
          'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
          'aud'   => $url,
          'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
          'iat'   => time(),
        ], $serviceAccount['private_key'], 'RS256'),
      ];
      $options = [
        'http' => [
          'header'  => 'Content-Type: application/x-www-form-urlencoded',
          'method'  => 'POST',
          'content' => http_build_query($params),
        ],
      ];
      $context = stream_context_create($options);
      $response = file_get_contents($url, false, $context);
      $accessToken = json_decode($response, true)['access_token'];
      $message = [
        'message' => [
          'token' => $row->tokenPushNotification,
          'notification' => [
            'title' => $titleNewsletter,
            'body'  => $bodyNewsletter,
            'image' => 'https://cms.sahirahotelsgroup.com/assets/images/newsletter/'.$imgNewsletter,
            // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
            // "click_action" => "com.madanidjourney.app://tabs/profile",
          ],
          'data' => [
            'transaction' => 'newsletter',
            'url' => 'com.madanidjourney.app://tabs/profile'
          ],
        ],
      ];
      $headers = [
        'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
        'Content-Type: application/json',
      ];
      $ch = curl_init(FCM_ENDPOINT);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
      $result = curl_exec($ch);
      curl_close($ch);
      echo $result;
    }
  }
  public function postNotificationOffers_post()
  {
    // $arr = json_decode(file_get_contents("php://input"), true);
    $nmVoucher = $this->input->post('nmVoucher');
    $currentToken = $this->input->post('currentToken');
    $ketVoucher = $this->input->post('ketVoucher');
    $imgVoucher = $this->input->post('imgVoucher');
    // $this->response(array("arr" => $arr, "invoice" => $invoiceBooking, "currentToken" => $currentToken, "idBusiness" => $idBusiness, "rateafterdiscountBooking" => $rateafterdiscountBooking));
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => $nmVoucher,
          'body'  => $ketVoucher,
          'image' => 'https://cms.sahirahotelsgroup.com/assets/images/voucher/'.$imgVoucher
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'transaction' => 'voucher'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function postNotificationPackages_post()
  {
    // $arr = json_decode(file_get_contents("php://input"), true);
    $nmPackage = $this->input->post('nmPackage');
    $currentToken = $this->input->post('currentToken');
    $ketPackage = $this->input->post('ketPackage');
    $imgPackage = $this->input->post('imgPackage');
    // $this->response(array("arr" => $arr, "invoice" => $invoiceBooking, "currentToken" => $currentToken, "idBusiness" => $idBusiness, "rateafterdiscountBooking" => $rateafterdiscountBooking));
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => $nmPackage,
          'body'  => $ketPackage,
          'image' => 'https://cms.sahirahotelsgroup.com/assets/images/package/'.$imgPackage
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'transaction' => 'package'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function getChatTools_post() {
    $chatTools = array();
    $this->db->from('chat');
    $this->db->where('statusChat', '1');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $chatTools = $query->row();
    }
    $query->free_result();
  
    $this->response(array('response' => $chatTools, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function setClaimBooking_post() {
    $idUser = $this->input->post('idUser');
    $idBooking = $this->input->post('idBooking');
    $invoiceBooking = $this->input->post('invoiceBooking');
    $idBusiness = $this->input->post('idBusiness');
    $nmVouchercatalog = 'Free Coffee & Tea';
    $data_form = [      
      "claimFreedrinkBooking" => '1',
      "editAt"                => date('Y-m-d H:i:s'),
    ];
    $this->db->where('idUser', $idUser);
    $this->db->where('idBooking', $idBooking);
    $this->db->update('booking', $data_form);
    $createdAt = date('Y-m-d H:i:s'); // Current date and time
    $finishTime = new DateTime($createdAt); // Creating a DateTime object from $createdAt
    $finishTime->add(new DateInterval('PT10M')); // Adding 60 minutes
    $finishAt = $finishTime->format('Y-m-d H:i:s'); // Formatting the finish time
    $data_fnb_cooking = array(
      'statuspayFnbcooking'   => 'FREE',
      'invoiceFnbadditional'  => $invoiceBooking,
      'subtotalPrice'         => 0,
      'idBooking'             => $idBooking,
      'idBusiness'            => $idBusiness,
      'idUser'                => $idUser,
      'createdAtFnbcooking'   => $createdAt, // Using the original $createdAt value
      'finishAtFnbcooking'    => $finishAt,
    );
    $this->Api_m->insert_fnb_cooking($data_fnb_cooking);
    $voucherCatalog = array();
    $this->db->from('voucher_catalog');
    $this->db->where('nmVouchercatalog', $nmVouchercatalog);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $voucherCatalog = $query->row();
    }
    $query->free_result();
    $data_form_claim = [      
      "nmVoucher"     => $voucherCatalog->nmVouchercatalog,
      'idUser'        => $idUser,
      'idBooking'     => $idBooking,
      'idBusiness'    => $idBusiness,
      'ownerVoucher'  => $voucherCatalog->idBusiness,
      'createdAtClaim'=> date('Y-m-d H:i:s'),
    ];
    $this->db->insert('voucher_claim', $data_form_claim);
    $this->response(array('response' => $data_form, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getClaimBooking_post() {
    $idUser = $this->input->post('idUser');
    $idBooking = $this->input->post('idBooking');
    $invoiceBooking = $this->input->post('invoiceBooking');
    $idBusiness = $this->input->post('idBusiness');
    $data = array();
    $this->db->from('fnb_additional_cooking');
    $this->db->where('idUser', $idUser);
    $this->db->where('invoiceFnbadditional', $invoiceBooking);
    $this->db->where('idBooking', $idBooking);
    $this->db->where('idBusiness', $idBusiness);
    $this->db->where('statuspayFnbcooking !=', 'EXPIRED');
    $this->db->where('statusFnbfeedback', '0');
    $this->db->order_by('createdAtFnbcooking', 'ASC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $data = $query->row();
    }
    $query->free_result();
    if($data) {
      $this->response(array('response' => $data, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }
  public function getTokenUser_post()
  {
    $Name = $this->input->post('Name');
    // Coordinates of your hotels
    $token = $this->Api_m->getTokenUser($Name);
    echo json_encode(array("response" => $token->tokenPushNotification));
  }
  public function postNotificationChat_post()
  {
    // $arr = json_decode(file_get_contents("php://input"), true);
    $titleChat = $this->input->post('titleChat');
    $currentToken = $this->input->post('currentToken');
    $textChat = $this->input->post('textChat');
    $serviceAccount = json_decode(file_get_contents(FIREBASE_JSON_URL), true);
    $url = OAUTH2_TOKEN_URL;
    $params = [
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion'  => JWT::encode([
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => $url,
        'exp'   => time() + 60 * 60, // Token expiration time (1 hour)
        'iat'   => time(),
      ], $serviceAccount['private_key'], 'RS256'),
    ];
    $options = [
      'http' => [
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($params),
      ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $accessToken = json_decode($response, true)['access_token'];
    $message = [
      'message' => [
        'token' => $currentToken,
        'notification' => [
          'title' => $titleChat,
          'body'  => $textChat,
          // "icon"  => "https://cms.sahirahotelsgroup.com/assets/iamges/logo-sahira.jpg", 
          // "click_action" => "https://cms.sahirahotelsgroup.com/tabs/home",
        ],
        'data' => [
          'transaction' => 'livechat'
        ]
      ],
    ];
    $headers = [
      'Authorization: Bearer ' . $accessToken, // Change 'bearer' to 'Bearer', and add a space after 'Bearer'
      'Content-Type: application/json',
    ];
    $ch = curl_init(FCM_ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
  }
  public function updateDataUser_post() {
    // Decode the JSON payload
    $data = json_decode($this->input->post('data'), true);
    $idUser = $this->input->post('idUser');
    $token = $this->input->post('key');
    $nmUser = $data['nmUser'];
    $emailUser = $data['emailUser'];
    $mobileUser = $data['mobileUser'];
    $cardmemberUser = $data['cardmemberUser'];
    $data_user = array(
      'nmUser'          => $nmUser,
      'mobileUser'      => $mobileUser,
      'cardmemberUser'  => $cardmemberUser,
      'editAt'          => date('Y-m-d H:i:s'),
    );
    $this->db->where('idUser', $idUser);
    $this->db->update('user', $data_user);
    $val = $this->Api_m->cek_username($emailUser);
    $this->response(array('data' => $val, 'status' => 'success', 'token' => $token, 'http_status' => REST_Controller::HTTP_OK));
  }
  public function getKamarDetailByID_post() {
    // Coordinates of your hotels
    $roomtypeBooking = $this->input->post('roomtypeBooking');
    $getKamarDetailByID = $this->Api_m->getKamarDetailByID($roomtypeBooking);
    // Check if no hotels were found
    if (empty($getKamarDetailByID)) {
      $this->response(array('status' => 'error', 'message' => 'No hotels found within the specified radius'), REST_Controller::HTTP_NOT_FOUND);
    } else {
      // Convert the entire response into an associative array
      $this->response($getKamarDetailByID);
    }
  }
  public function getApplicationData_post() {
    // Coordinates of your hotels
    $nmApplication = $this->input->post('nmApplication');
    $getApplicationData = $this->Api_m->getApplicationData($nmApplication);
    // Check if no hotels were found
    if (empty($getApplicationData)) {
      $this->response(array('status' => 'error', 'message' => 'No Application found'), REST_Controller::HTTP_NOT_FOUND);
    } else {
      // Convert the entire response into an associative array
      $this->response($getApplicationData);
    }
  }
  public function insertInquiry_post() {
    // Decode the JSON payload
    $data_booking = json_decode($this->input->raw_input_stream, true);
    $bookingData = $data_booking;
    $idUser = $bookingData['idUser'];
    $customerName = $bookingData['customerName'];
    $address = $bookingData['address'];
    $notel = $bookingData['phoneNumber'];
    $email = $bookingData['email'];
    $createdAt = date('Y-m-d H:i:s');
    // Mengakses data lainnya
    $idBusiness = $bookingData['idBusiness'];
    $idKamar = $bookingData['idKamar'];
    $invoiceNumber = $bookingData['invoiceNumber'];
    $arrivalDate = $bookingData['arrivalDate'];
    $dateIntervalText = $bookingData['dateIntervalText'];
    $departureDate = $bookingData['departureDate'];
    $paxBooking = $bookingData['paxBooking'];
    $paxBooking = $bookingData['paxBooking'];
    // $childBooking = $bookingData['childBooking'];
    $space = $bookingData['spaceBooking'];
    $extrabedBooking = $bookingData['extrabedBooking'];
    $idnumberBooking = $bookingData['idnumberBooking'];
    $ratecodeBooking = $bookingData['ratecodeBooking'];
    $country = $bookingData['country'];
    $province = $bookingData['province'];
    $amount = $bookingData['amount'];
    $totalrateBooking = $bookingData['totalrateBooking'];
    $channel = $bookingData['channel'];
    $DateInterval = $bookingData['DateInterval'];
    $discountBooking = $bookingData['discountBooking'];
    $reasonBooking = $bookingData['reasonBooking'];
    $rateafterdiscountBooking = $bookingData['rateafterdiscountBooking'];
    // Menghitung waktu finish
    $finishTime = new DateTime($createdAt);
    $finishTime->add(new DateInterval('PT60M')); // Menambahkan 60 menit
    $finishAt = $finishTime->format('Y-m-d H:i:s'); // Memformat waktu finish
    // Menyusun data untuk tabel "Customer"
    $data_customer = array(
        'idUser'          => $idUser,
        'FirstName'       => $customerName,
        'IDNumber'        => $idnumberBooking,
        'addres'          => $address,
        'notel'           => $notel,
        'gmail'           => $email,
        'regfromCustomer' => 'WEB',
        'createdAt'       => $createdAt,
    );
    // Memasukkan data ke dalam tabel "Customer"
    $this->db->insert('Customer', $data_customer);
    $idCustomer = $this->db->insert_id(); // Mengambil ID customer yang baru saja dimasukkan
    // EMAIL SECTION
      $config = [
        "protocol"  => "smtp",
        "smtp_host" => "mail.sahirahotelsgroup.com",
        "smtp_port" => "587",
        "smtp_user" => "noreply@sahirahotelsgroup.com",
        "smtp_pass" => "noreply@sahirahotelsgroup.com",
        "mailtype"  => "html",
        "charset"   => "iso-8859-1",
        "wordwrap"  => true,
        "crlf"      => "\r\n",
        "newline"   => "\r\n",
      ];
      $this->load->library("email", $config);
      $createdAtBooking = date('Y-m-d H:i:s');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from("noreply@sahirahotelsgroup.com", "noreply-sahirahotelsgroup");
      $this->email->to($email);
      $this->email->bcc("sahirahotelspayment@gmail.com");
      $this->email->subject('Events Inqury from Sahira Hotels Group');
      $isi_email  = "<html>";
      $isi_email .= "<body>";
      $isi_email .= "<h2>Thank you for send inqury from Sahira Hotels Group. This is your inqury data :</h2>";
      $isi_email .= "<h4>Customer Data :</h4>";
      $isi_email .= "<p>ID Number : $idnumberBooking</p>";
      $isi_email .= "<p>First Name : $customerName</p>";
      $isi_email .= "<p>Last Name : $customerName</p>";
      $isi_email .= "<p>Email : $email</p>";
      $isi_email .= "<p>Phone Number : $notel</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Room Data :</h4>";
      $isi_email .= "<p>Room Type : $idKamar</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Itenerary :</h4>";
      $isi_email .= "<p>Arrival Date : $arrivalDate</p>";
      $isi_email .= "<p>Departure Date : $departureDate</p>";
      $isi_email .= "<p>Night : $dateIntervalText</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Space :</h4>";
      $isi_email .= "<p>Pax : $space Adult(s)</p>";
      $isi_email .= "<h4>Guest Room(s) :</h4>";
      $isi_email .= "<p>Pax : $paxBooking Room(s)</p>";
      // $isi_email .= "<p>Child : $childBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<p>Subtotal Price : $totalrateBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<p>Total Rate Price : $rateafterdiscountBooking</p>";
      $isi_email .= "<br>";
      $isi_email .= "<h4>Payment Data :</h4>";
      $isi_email .= "<p>Payment Methode : $channel</p>";
      $isi_email .= "<p>Status Payment : UNPAID</p>";
      $isi_email .= "<p>Booking Time : $createdAtBooking</p>";
      $isi_email .= "</body>";
      $isi_email .= "</html>";
      $this->email->message($isi_email);
      $this->email->send();
    // EMAIL SECTION
    $this->response(array('data_customer' => $data_customer, 'data_booking' => $data_booking, 'http_status' => REST_Controller::HTTP_OK));
  }

  // Mendapatkan laporan berdasarkan periode
  public function getKeuanganByPeriode_post() {
    $input = json_decode(trim(file_get_contents('php://input')), true);
    $periode = $input['periode'] ?? '';

    if (!$periode) {
        $this->response([
            'status' => false,
            'message' => 'Periode harus diisi'
        ], REST_Controller::HTTP_BAD_REQUEST);
        return;
    }

    $this->db->select('*')->from('report_keuangan');

    switch ($periode) {
        case 'harian':
            $this->db->where('DATE(tanggal)', date('Y-m-d'));
            break;
        case 'mingguan':
            $this->db->where('YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)');
            break;
        case 'bulanan':
            $this->db->where('MONTH(tanggal)', date('m'));
            $this->db->where('YEAR(tanggal)', date('Y'));
            break;
        case 'semesteran':
            $this->db->where('MONTH(tanggal) BETWEEN MONTH(CURDATE())-5 AND MONTH(CURDATE())');
            break;
        case 'tahunan':
            $this->db->where('YEAR(tanggal)', date('Y'));
            break;
        default:
            $this->response([
                'status' => false,
                'message' => 'Periode tidak valid'
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
    }

    $query = $this->db->get();
    $data = $query->result_array();

    if (!empty($data)) {
        $this->response([
            'status' => true,
            'data' => $data
        ], REST_Controller::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Data tidak ditemukan',
            'data' => []
        ], REST_Controller::HTTP_OK); // Jangan pakai HTTP_NOT_FOUND agar lebih mudah di-handle di frontend
    }
  }

  // Menambahkan data laporan keuangan
  public function insertKeuanganByPeriode_post() {
    $config['upload_path']   = './uploads/report_keuangan/';
    $config['allowed_types'] = 'pdf|jpg|png|jpeg';
    $config['max_size']      = 2048; // Maks 2MB
    $config['encrypt_name']  = TRUE; // Supaya nama file unik

    $this->load->library('upload', $config);

    // Cek apakah ada file yang diunggah
    if (!empty($_FILES['fileUploads']['name'])) {
        if (!$this->upload->do_upload('fileUploads')) {
            $this->response([
                'status' => false,
                'message' => $this->upload->display_errors()
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        } else {
            $fileData = $this->upload->data();
            $file_path = 'uploads/report_keuangan/' . $fileData['file_name']; // Path file yang disimpan di DB
        }
    } else {
        $file_path = null; // Jika tidak ada file diunggah
    }

    // Ambil data JSON dari body
    $input = $this->input->post();

    // Validasi input
    if (!isset($input['tanggal'])) {
        $this->response([
            'status' => false, 
            'message' => 'Semua field harus diisi'
        ], REST_Controller::HTTP_BAD_REQUEST);
        return;
    }

    // Simpan data ke database
    $data = [
        'tanggal' => $input['tanggal'],
        // 'pemasukan' => $input['pemasukan'],
        // 'pengeluaran' => $input['pengeluaran'],
        // 'laba_rugi' => $input['pemasukan'] - $input['pengeluaran'],
        'keterangan' => isset($input['keterangan']) ? $input['keterangan'] : null,
        'status_report' => isset($input['status_report']) ? $input['status_report'] : 'draft',
        'file_path' => $file_path // Simpan path file di database
    ];

    $this->db->insert('report_keuangan', $data);

    $this->response([
        'status' => true, 
        'message' => 'Data berhasil ditambahkan'
    ], REST_Controller::HTTP_CREATED);
  }

  // Mengupdate status laporan keuangan
  public function update_status_put($id) {
      $input = json_decode(trim(file_get_contents('php://input')), true);

      if (!$id || !$input['status_report']) {
          $this->response(['status' => false, 'message' => 'ID dan status_report harus diisi'], REST_Controller::HTTP_BAD_REQUEST);
      }

      $this->db->where('id', $id);
      $this->db->update('report_keuangan', ['status_report' => $input['status_report']]);

      $this->response(['status' => true, 'message' => 'Status laporan diperbarui'], REST_Controller::HTTP_OK);
  }

  // Mendapatkan laporan engineering berdasarkan periode
  public function getEngineeringByPeriode_post() {
      $input = json_decode(trim(file_get_contents('php://input')), true);
      $periode = $input['periode'] ?? '';

      if (!$periode) {
          $this->response([
              'status' => false,
              'message' => 'Periode harus diisi'
          ], REST_Controller::HTTP_BAD_REQUEST);
          return;
      }

      $this->db->select('*')->from('report_engineering');

      switch ($periode) {
          case 'harian':
              $this->db->where('DATE(tanggal)', date('Y-m-d'));
              break;
          case 'mingguan':
              $this->db->where('YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)');
              break;
          case 'bulanan':
              $this->db->where('MONTH(tanggal)', date('m'));
              $this->db->where('YEAR(tanggal)', date('Y'));
              break;
          case 'semesteran':
              $this->db->where('MONTH(tanggal) BETWEEN MONTH(CURDATE())-5 AND MONTH(CURDATE())');
              break;
          case 'tahunan':
              $this->db->where('YEAR(tanggal)', date('Y'));
              break;
          default:
              $this->response([
                  'status' => false,
                  'message' => 'Periode tidak valid'
              ], REST_Controller::HTTP_BAD_REQUEST);
              return;
      }

      $query = $this->db->get();
      $data = $query->result_array();

      if (!empty($data)) {
          $this->response([
              'status' => true,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      } else {
          $this->response([
              'status' => false,
              'message' => 'Data tidak ditemukan',
              'data' => []
          ], REST_Controller::HTTP_OK);
      }
  }

  // Menambahkan laporan engineering
  public function insertEngineering_post() {
      $config['upload_path']   = './uploads/report_engineering/';
      $config['allowed_types'] = 'pdf|jpg|png|jpeg';
      $config['max_size']      = 2048;
      $config['encrypt_name']  = TRUE;

      $this->load->library('upload', $config);

      if (!empty($_FILES['fileUploads']['name'])) {
          if (!$this->upload->do_upload('fileUploads')) {
              $this->response([
                  'status' => false,
                  'message' => $this->upload->display_errors()
              ], REST_Controller::HTTP_BAD_REQUEST);
              return;
          } else {
              $fileData = $this->upload->data();
              $file_path = 'uploads/report_engineering/' . $fileData['file_name'];
          }
      } else {
          $file_path = null;
      }

      $input = $this->input->post();

      if (!isset($input['tanggal']) || !isset($input['lokasi']) || !isset($input['jenis_kerusakan']) || !isset($input['status']) || !isset($input['shift'])) {
          $this->response([
              'status' => false, 
              'message' => 'Semua field harus diisi'
          ], REST_Controller::HTTP_BAD_REQUEST);
          return;
      }

      $data = [
          'tanggal' => $input['tanggal'],
          'lokasi' => $input['lokasi'],
          'jenis_kerusakan' => $input['jenis_kerusakan'],
          'deskripsi' => $input['deskripsi'] ?? null,
          'shift' => $input['shift'],
          'status' => $input['status'],
          'file_path' => $file_path
      ];

      $this->db->insert('report_engineering', $data);

      $this->response([
          'status' => true, 
          'message' => 'Laporan engineering berhasil ditambahkan'
      ], REST_Controller::HTTP_CREATED);
  }

  // Mengupdate status laporan engineering
  public function updateEngineeringStatus_put($id) {
      $input = json_decode(trim(file_get_contents('php://input')), true);

      if (!$id || !$input['status']) {
          $this->response(['status' => false, 'message' => 'ID dan status harus diisi'], REST_Controller::HTTP_BAD_REQUEST);
      }

      $this->db->where('id', $id);
      $this->db->update('report_engineering', ['status' => $input['status']]);

      $this->response(['status' => true, 'message' => 'Status laporan engineering diperbarui'], REST_Controller::HTTP_OK);
  }

  // Mendapatkan laporan housekeeping berdasarkan periode
  public function getHousekeepingByPeriode_post() {
      $input = json_decode(trim(file_get_contents('php://input')), true);
      $periode = $input['periode'] ?? '';

      if (!$periode) {
          $this->response([
              'status' => false,
              'message' => 'Periode harus diisi'
          ], REST_Controller::HTTP_BAD_REQUEST);
          return;
      }

      $this->db->select('*')->from('report_housekeeping');

      switch ($periode) {
          case 'harian':
              $this->db->where('DATE(tanggal)', date('Y-m-d'));
              break;
          case 'mingguan':
              $this->db->where('YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)');
              break;
          case 'bulanan':
              $this->db->where('MONTH(tanggal)', date('m'));
              $this->db->where('YEAR(tanggal)', date('Y'));
              break;
          case 'semesteran':
              $this->db->where('MONTH(tanggal) BETWEEN MONTH(CURDATE())-5 AND MONTH(CURDATE())');
              break;
          case 'tahunan':
              $this->db->where('YEAR(tanggal)', date('Y'));
              break;
          default:
              $this->response([
                  'status' => false,
                  'message' => 'Periode tidak valid'
              ], REST_Controller::HTTP_BAD_REQUEST);
              return;
      }

      $query = $this->db->get();
      $data = $query->result_array();

      if (!empty($data)) {
          $this->response([
              'status' => true,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      } else {
          $this->response([
              'status' => false,
              'message' => 'Data tidak ditemukan',
              'data' => []
          ], REST_Controller::HTTP_OK);
      }
  }

  // Menambahkan laporan housekeeping
  public function insertHousekeepingReport_post() {
    // 1. Handle file upload untuk laporan housekeeping
    $config['upload_path']   = './uploads/report_housekeeping/';
    $config['allowed_types'] = 'pdf|jpg|png|jpeg';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;
    
    $this->load->library('upload', $config);
    
    // Proses upload file
    if (!empty($_FILES['fileUploads']['name'])) {
        if (!$this->upload->do_upload('fileUploads')) {
            $this->response([
                'status' => false,
                'message' => $this->upload->display_errors()
            ], REST_Controller::HTTP_BAD_REQUEST);
            return;
        } else {
            $fileData = $this->upload->data();
            $file_path = 'uploads/report_housekeeping/' . $fileData['file_name'];
        }
    } else {
        $file_path = null;
    }

    // 2. Ambil data dari form input
    $input = $this->input->post();

    // Validasi input
    if (!isset($input['tanggal']) || !isset($input['kamar']) || !isset($input['housekeeper']) || !isset($input['status'])) {
        $this->response([
            'status' => false, 
            'message' => 'Semua field harus diisi'
        ], REST_Controller::HTTP_BAD_REQUEST);
        return;
    }

    // 4. Simpan laporan housekeeping ke database
    $data_report = [
        'tanggal' => $input['tanggal'],
        'kamar' => $input['kamar'],
        'housekeeper' => implode(',', $input['housekeeper']), // Daftar petugas yang dikerjakan
        'kondisi_awal' => $input['kondisi_awal'] ?? null,
        'masalah' => $input['masalah'] ?? null,
        'tindakan' => $input['tindakan'] ?? null,
        'status' => $input['status'],
        'file_path' => $file_path
    ];

    // Insert laporan housekeeping
    $this->db->insert('report_housekeeping', $data_report);
    $report_id = $this->db->insert_id();

    // 5. Jika ada kerusakan dan perlu report ke engineering
    if ($input['kondisi_awal'] == 'perbaikan') {
        $data_engineer = [
            'tanggal' => $input['tanggal'],
            'lokasi' => $input['kamar'],
            'jenis_kerusakan' => $input['kondisi_awal'],
            'deskripsi' => $input['masalah'] ?? null,
            'status' => $input['status']
        ];

        // Insert laporan engineering
        $this->db->insert('report_engineering', $data_engineer); 
    }

    // 3. Simpan data tugas untuk setiap petugas (multiple petugas)
    $selected_users = $input['housekeeper']; // array of user IDs

    if ($selected_users) {
        foreach ($selected_users as $user_id) {
            $data_task = [
                'job_id' => $input['kamar'],
                'location_id' => $input['kamar'], // Atau ID lokasi yang sesuai
                'idUser' => $user_id,
                'scheduled_date' => $input['tanggal'],
                'status' => $input['status'],
                'file_path' => $file_path, // Menyimpan file path jika ada
                'report_id' => $report_id,
            ];

            // Simpan tugas untuk masing-masing petugas
            $this->db->insert('hk_assignments', $data_task);
        }
    }

    // 6. Response sukses
    $this->response([
        'status' => true, 
        'message' => 'Tugas dan laporan housekeeping berhasil ditambahkan'
    ], REST_Controller::HTTP_CREATED);
  }

  // Mengupdate status laporan housekeeping
  public function updateHousekeepingStatus_put($id) {
      $input = json_decode(trim(file_get_contents('php://input')), true);

      if (!$id || !$input['status']) {
          $this->response(['status' => false, 'message' => 'ID dan status harus diisi'], REST_Controller::HTTP_BAD_REQUEST);
      }

      $this->db->where('id', $id);
      $this->db->update('report_housekeeping', ['status' => $input['status']]);

      $this->response(['status' => true, 'message' => 'Status laporan housekeeping diperbarui'], REST_Controller::HTTP_OK);
  }

    // Mendapatkan laporan security berdasarkan periode
  public function getSecurityReportsByPeriode_post() {
      $input = json_decode(trim(file_get_contents('php://input')), true);
      $periode = $input['periode'] ?? '';

      if (!$periode) {
          $this->response([
              'status' => false,
              'message' => 'Periode harus diisi'
          ], REST_Controller::HTTP_BAD_REQUEST);
          return;
      }

      $this->db->select('*')->from('security_reports');

      switch ($periode) {
          case 'harian':
              $this->db->where('DATE(tanggal)', date('Y-m-d'));
              break;
          case 'mingguan':
              $this->db->where('YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)');
              break;
          case 'bulanan':
              $this->db->where('MONTH(tanggal)', date('m'));
              $this->db->where('YEAR(tanggal)', date('Y'));
              break;
          case 'semesteran':
              $this->db->where('MONTH(tanggal) BETWEEN MONTH(CURDATE())-5 AND MONTH(CURDATE())');
              break;
          case 'tahunan':
              $this->db->where('YEAR(tanggal)', date('Y'));
              break;
          default:
              $this->response([
                  'status' => false,
                  'message' => 'Periode tidak valid'
              ], REST_Controller::HTTP_BAD_REQUEST);
              return;
      }

      $query = $this->db->get();
      $data = $query->result_array();

      if (!empty($data)) {
          $this->response([
              'status' => true,
              'data' => $data
          ], REST_Controller::HTTP_OK);
      } else {
          $this->response([
              'status' => false,
              'message' => 'Data tidak ditemukan',
              'data' => []
          ], REST_Controller::HTTP_OK);
      }
  }

  // Menambahkan laporan security
  public function insertSecurityReport_post() {
      $input = $this->input->post();

      if (!isset($input['tanggal']) || !isset($input['petugas']) || !isset($input['lokasi']) || !isset($input['status_keamanan'])) {
          $this->response([
              'status' => false, 
              'message' => 'Semua field harus diisi'
          ], REST_Controller::HTTP_BAD_REQUEST);
          return;
      }

      $data = [
          'tanggal' => $input['tanggal'],
          'petugas' => $input['petugas'],
          'lokasi' => $input['lokasi'],
          'status_keamanan' => $input['status_keamanan'],
          'kejadian' => $input['kejadian'] ?? null,
          'shift' => $input['shift'] ?? null
      ];

      $this->db->insert('security_reports', $data);

      $this->response([
          'status' => true, 
          'message' => 'Laporan security berhasil ditambahkan'
      ], REST_Controller::HTTP_CREATED);
  }

  // Mengupdate status laporan security
  public function updateSecurityStatus_put($id) {
      $input = json_decode(trim(file_get_contents('php://input')), true);

      if (!$id || !$input['status_keamanan']) {
          $this->response(['status' => false, 'message' => 'ID dan status harus diisi'], REST_Controller::HTTP_BAD_REQUEST);
      }

      $this->db->where('id', $id);
      $this->db->update('security_reports', ['status_keamanan' => $input['status_keamanan']]);

      $this->response(['status' => true, 'message' => 'Status laporan security diperbarui'], REST_Controller::HTTP_OK);
  }

  public function getAvailableVouchers_post() {
    $data = array();
    $this->db2->from('vouchers');
    $query = $this->db2->get();
    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
    }
    $query->free_result();
    if($data) {
      $this->response(array('response' => $data, 'http_status' => REST_Controller::HTTP_OK));
    } else {
      $this->response(array('response' => 'empty', 'http_status' => REST_Controller::HTTP_OK));
    }
  }  

  public function getAvailableVoucherById_post() {
    $voucherId = $this->input->post('voucherId');

    // Ambil data voucher utama
    $this->db2->from('vouchers');
    $this->db2->where('id', $voucherId);
    $voucherQuery = $this->db2->get();

    if ($voucherQuery->num_rows() > 0) {
        $voucherData = $voucherQuery->row_array(); // hanya satu baris
        $voucherQuery->free_result();

        // Simpan image_url dari voucher
        $voucherImage = isset($voucherData['image_url']) ? $voucherData['image_url'] : null;
        $voucherPrice = isset($voucherData['price']) ? $voucherData['price'] : null;
        $voucherCustomerPrice = isset($voucherData['customer_price']) ? $voucherData['customer_price'] : null;

        // Ambil semua stok berdasarkan voucher_id
        $this->db2->from('voucher_stocks');
        $this->db2->where('voucher_id', $voucherId);
        $stocksQuery = $this->db2->get();
        $stocks = $stocksQuery->result_array();
        $stocksQuery->free_result();

        // Tambahkan image_url ke setiap stock
        foreach ($stocks as &$stock) {
            $stock['image_url'] = $voucherImage;
            $stock['price'] = $voucherPrice;
            $stock['customer_price'] = $voucherCustomerPrice;
        }

        // Tambahkan ke dalam response
        $voucherData['stocks'] = $stocks;

        $response = [$voucherData];

        $this->response([
            'response' => $response,
            'http_status' => REST_Controller::HTTP_OK
        ]);
    } else {
        $this->response([
            'response' => 'empty',
            'http_status' => REST_Controller::HTTP_OK
        ]);
    }
  }

}