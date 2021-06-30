<?php

class Message  {
    public $host='rslr.connectbind.com';
    public $port = '8080';
    public $strUserName = "ssms-piclaim";
    public $strPassword = "P2cla!ms";
    public $strMessageType = '0';
    public $strDlr = '0';
    public $strSender = 'Corner Inn'; //Food Factory
    public $strphone;
    public $strMessage;
    public $strname;
    public $stramount;



    public function Sender($name, $contact, $amount, $message){
        $this->strname = $name;
        $this->strphone = $contact;
        $this->stramount = $amount;
        $this->strMessage = $message;
    }

    public function Submit(){
        $this->strSender = urlencode($this->strSender);
        $this->strMessage = urlencode($this->strMessage);
        $params = [
            'username' => $this->strUserName,
            'password' =>  $this->strPassword,
            'type' => $this->strMessageType,
            'dlr' => $this->strDlr,
            'destination' => $this->strphone,
            'source' => $this->strSender,
            'message' => $this->strMessage
        ];

        $content = http_build_query($params);

        $context = stream_context_create([
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                "Content-Length: ".strlen($content)."\r\n".
                "User-Agent: MyAgent/1.0\r\n",
                'method' => 'GET',
                'content' => $content, 
            ]
        ]);

        $path = '';

        $count = 1;
        $len = count(array_keys($params));
        foreach ($params as $key => $value) {
            $path = "$path$key=$value". (($count < $len) ? "&" : "");
            $count++;
        }
        
        //http://rslr.connectbind.com:8080/bulksms/bulksms?username=ssms-piclaim&password=P2cla!ms&type=0&dlr=0&
        //destination=233541312238&source=Food&message=Hello
        
        $use_url = "http://".$this->host.":".$this->port."/bulksms/bulksms?$path";
        $output = file_get_contents($use_url, null, $context);
        $response = json_decode($output);
        return $response;

        
    }
}