<?php
namespace PHPMaster\InstantNotifier;

class Notification {

    private $api_url = "https://instantnotifier.phpmaster.in/api";
    private $api_key;
    private $client_id;

    public function __construct($api_key, $client_id) {
        $this->api_key = $api_key;
        $this->client_id = $client_id;
    }
    
    public function formMessage($heading, $data=array()) {
        return "\n".$heading . "\n" . $this->lineMessageFromArray($data);
    }

    public function send($message) {
        $payload = [
            "api_key" => $this->api_key,
            "client_id" => $this->client_id,
            "title" => "Digitech Site Enquiry Details",
            "message"=>$message,
        ];
        return $this->sendRequest($payload, "/notifications");
    }

    private function sanitizeString($string) {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }

    private function sanitizePhone($phone) {
        return preg_replace('/\D/', '', $phone);
    }

    private function sendRequest($payload, $path) {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $this->api_url . $path,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
            ]);

            $response = curl_exec($curl);

            if ($response === false) {
                throw new \Exception(curl_error($curl));
            }

            $response = json_decode($response, true);
            curl_close($curl);

            if (isset($response['success']) && $response['success']) {
                return ["status" => 200, "message" => $response['message']];
            } else {
                return ["status" => 404, "message" => $response['message'] ?? 'Error processing request'];
            }
        } catch (\Exception $e) {
            return ["status" => 404, "message" => $e->getMessage()];
        }
    }

    private function lineMessageFromArray($data) {
        $message = '';
        $lastKey = array_key_last($data);  
        foreach ($data as $key => $value) {
            $message .= ucfirst(strtolower($key)) . " : " . $value;
            if ($key !== $lastKey) {
                $message .= "\n";
            }
        }
        return $message;
    }
    
}
