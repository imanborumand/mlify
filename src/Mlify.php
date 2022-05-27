<?php namespace Imanborumand\Mlify;

class Mlify
{

    /**
     * @var string
     */
    private  static  string $title;


    /**
     * @var string
     */
    private static  string $body;


    /**
     * @var array
     */
    protected static array $customData = [];


    /**
     * set title and body and customData
     * custom data `More information you want to get on the side of your app` like:
     * ['post_id' => 1, 'slug' => 'this-is-mlify]
     *
     * @param string $title
     * @param string $body
     * @param array  $customData
     * @return Mlify
     */
    public static function setParams( string $title, string $body, array $customData) : Mlify
    {
        self::$title = $title;
        self::$body = $body;
        self::$customData = $customData;
        return new self;
    }


    /**
     * send notification
     * you can call in dispatch for add in queue
     * @param array $tokens
     * @return array
     */
    public function sendTo( array $tokens) : array
    {

       return $this->doRequest([
            "registration_ids" => $tokens,
            "notification" => [
                "title" => self::$title,
                "body" => self::$body,
            ],
            'data' => [
                'custom' => self::$customData
            ]
       ]);

    }


    private  function doRequest(array $payload = []) : array
    {
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POSTREDIR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getRequestHeader());
        curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($payload));

        curl_setopt($ch, CURLOPT_HEADER, 1);
        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        $body = substr($response, $header_size);
        curl_close($ch);
        return (array) json_decode($body);
    }


    private function getRequestHeader() : array
    {
        return [
            'Authorization: key=' . config('mlify.auth_key'),
            'Content-Type: application/json',
        ];
    }


}
