<?php
/**
 * Created by PhpStorm.
 * User: davidwibergh
 * Date: 2014-02-24
 * Time: 08:51
 */

namespace captaindoe;


use Unirest;

class Wali {

    public $apiKey;
    public $protocolID;
    public $apiBase    = 'https://www.wali.io/v1';

    /**
     * Körs när Wali initieras.
     *
     * @param string $apiKey API-nyckel. Finns i din kontrollpanel.
     * @param string $protocolID Protokollet som ska användas. Finns i din kontrollpanel.
     * @throws \Exception
     */
    public function __construct($apiKey, $protocolID) {

        // Verifiera att API-nyckel & protokoll har angivits
        if(empty($apiKey) || empty($protocolID) || strlen($protocolID) != 15) {
            throw new \Exception('Du måste specificera API-nyckel och ett giltigt protokoll.');
        }

        $this->apiKey = $apiKey;
        $this->protocolID = $protocolID;
    }

    /**
     * Används för att generera en engångskod för ett telefonnummer.
     *
     * @param string $recipient Svenskt mobilnummer. Tillåter flera olika format.
     * @return boolean
     * @throws \Exception
     */
    public function generate($recipient)
    {

        // Verifiera att API-nyckel & protokoll har angivits
        if(is_null($this->apiKey) || is_null($this->protocolID)) {
            throw new \Exception('Du måste specificera API-nyckel och ett giltigt protokoll.');
        }

        // Bygg upp anropet.
        $params = array(
            'api_key'   => $this->apiKey,
            'protocol'  => $this->protocolID,
            'recipient' => $recipient
        );

        $response = Unirest::post( $this->apiBase . '/generate',
            array( "Accept" => "application/json" ),
            $params
        );

        // Validera
        if($response->code != 200) {
            throw new \Exception($response->body->error);
        }

        return true;
    }

    /**
     * Används för att verifiera en engångskod som har skickats till en användare.
     *
     * @param string $recipient Svenskt mobilnummer. Tillåter flera olika format.
     * @param mixed $code Koden som användaren angav.
     * @throws \Exception
     * @return boolean
     */
    public function verify($recipient, $code)
    {

        // Verifiera att API-nyckel & protokoll har angivits
        if(is_null($this->apiKey) || is_null($this->protocolID)) {
            throw new \Exception('Du måste specificera API-nyckel och ett giltigt protokoll.');
        }

        // Bygg upp anropet.
        $params = array(
            'api_key'   => $this->apiKey,
            'protocol'  => $this->protocolID,
            'recipient' => $recipient,
            'code'      => $code
        );

        $response = Unirest::get( $this->apiBase . '/verify',
            array( "Accept" => "application/json" ),
            $params
        );

        // Validera
        if($response->code != 200) {
            throw new \Exception($response->body->error);
        }

        return true;
    }
}