<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endpoint extends CI_Controller {
   public function index()
   {
      $this->load->view('welcome_message');
    }
    public function send() 
    {
      $url = 'https://fcm.googleapis.com/fcm/send';
      $message = $_GET['message'];
      $title = $_GET['title'];
      $fcmToken = $_GET['fcmToken'];
      $fields = array (
         'registration_ids' => array (
                 $fcmToken
         ),
         'data' => array (
                  "title"     => $title,
                 "message" => $message,
         ),
         'notification' => array (
            "title"     => $title,
           "body" => $message,
         )
      );
      $fields = json_encode ( $fields );

      $headers = array (
               'Authorization: key=' . "AAAAMsXgReE:APA91bFgUypeCMJl_U_cttjx6gjNhOSF4CFSTr_IytqqwJaeTiTjdSVujgQ8Kyc2o5_O8tu3CsX0rIDoRNN42pwtD20seu3P_9TpyfJ0TXd-2RCt1zZhjC740gupiFqjNkrxkktb54Fs",
               'Content-Type: application/json'
      );

      $ch = curl_init ();
      curl_setopt ( $ch, CURLOPT_URL, $url );
      curl_setopt ( $ch, CURLOPT_POST, true );
      curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
      curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
      $result = curl_exec ( $ch );
      $result1=json_decode($result,true);
      if($result1['success']==1){
         echo 'ok';
      }
      else{
         echo 'ko';
      }
      curl_close ( $ch );
    }
    public function sendAll()
    {
      $url = 'https://fcm.googleapis.com/fcm/send';
      $message = $_GET['message'];
      $title = $_GET['title'];
      $fields = array (
         'data' => array (
                  "title"     => $title,
                 "message" => $message
         ),
         'notification' => array (
            "title"     => $title,
           "body" => $message,
         ),
         "condition"   => "!('anytopicyoudontwanttouse' in topics)"
      );
      $fields = json_encode ( $fields );
      $headers = array (
               'Authorization: key=' . "AAAAMsXgReE:APA91bFgUypeCMJl_U_cttjx6gjNhOSF4CFSTr_IytqqwJaeTiTjdSVujgQ8Kyc2o5_O8tu3CsX0rIDoRNN42pwtD20seu3P_9TpyfJ0TXd-2RCt1zZhjC740gupiFqjNkrxkktb54Fs",
               'Content-Type: application/json'
      );

      $ch = curl_init ();
      curl_setopt ( $ch, CURLOPT_URL, $url );
      curl_setopt ( $ch, CURLOPT_POST, true );
      curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
      curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

      $result = curl_exec ( $ch );
      echo $result;
      curl_close ( $ch );
    }
}

