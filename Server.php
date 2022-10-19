<?php
/**
 * @author Amir Sanni <amirsanni@gmail.com>
 * @date 4th November 2019
 */

class Server
{
    public function index()
    {
        $servers = $this->getIceServers();

        header('Content-Type: Application/json');
$iceservers=array(
//array("urls"=>"stun:stun.nextcloud.com:443"),
//array("urls"=>"stun:stun.zoiper.com:3478"),
array("urls"=>"stun:stun.voipbuster.com:3478"),
//array("urls"=>"turn:bphone.online:3478?transport=tcp","credential"=>"somepassword1","username"=>"guest"),
//array("urls"=>"turn:ws-turn5.xirsys.com:3478?transport=udp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turn:ws-turn5.xirsys.com:80?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turn:ws-turn5.xirsys.com:3478?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turns:ws-turn5.xirsys.com:443?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004","username"=>"245fS58-xCOT7Tn2jct4c-mgsSs5dSX4SPpQGpp2JECKhJNQ5TVoO29tuH0yUonJAAAAAGEn2c5qZXJ6aWxsYQ=="),
//array("urls"=>"turns:ws-turn5.xirsys.com:5349?transport=tcp","credential"=>"53debb48-0699-11ec-beba-0242ac140004")
);
$a["iceServers"]=$iceservers;
        echo json_encode($a);
    }


    private function getIceServers()
    {
        // PHP Get ICE STUN and TURN list
        $data = ["format"=>"urls"];
        $json_data = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => ["Content-Type: application/json", "Content-Length: " . strlen($json_data)],
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_URL => "https://global.xirsys.net/_turn/YOUR-CHANNEL-NAME",//Replace 'YOUR-CHANNEL-NAME' with the name of your xirsys channel
            CURLOPT_USERPWD => "YOUR PASSWORD",
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => TRUE
        ]);

        $res = curl_exec($curl);
        
        if(curl_error($curl)){
            echo "Curl error: " . curl_error($curl);
        };

        curl_close($curl);
        
        return $res;
    }
}


$server = new Server;

$server->index();
