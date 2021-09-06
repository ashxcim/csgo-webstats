<?php

use Medoo\Medoo;
use SteamID\SteamID;

class main {
    private function db() {
        return new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'csgo_activity', //<--- Database name
            'server' => 'localhost', //<--- Database host
            'username' => 'csgo_activity', //<--- Database user
            'password' => 'Florin12#', //<--- Database password
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'port' => 3306,
            'logging' => false,
        ]);
    }

    public function sc_convert($seconds) {
        $data = new DateTime('@' . $seconds, new DateTimeZone('UTC'));
        $text = "";
        if($data->format('z') > 0)
            if($data->format('z') <= 9)
                $text .= "0".$data->format('z')." Z, ";
            else
                $text .= $data->format('z')." Z, ";
        if($data->format('H') !== "00")
            $text .= $data->format('G')." O, ";
        if($data->format('i') !== "00")
            $text .= $data->format('i')." M și ";
        $text .= $data->format('s')." S";
        return $text;
    }

    private function steam_profile($id) {
        $steamid = new SteamID($id);
        return "<a href='https://steamcommunity.com/profiles/".$steamid->getSteamID64()."'><img src='img/STEAM.png' height='25' width='25' style='margin-top: 5px;'></a>";
    }

    public function read_db() {
        $dbs = $this->db()->select("mostactive", "*", [
            "total[>=]" => 43200
        ]);
        $data = [];
        foreach ($dbs as $row) {
            $row = (object) $row;
            $data[] = [
                "user" => $row->playername,
                "seen" => date("d-m-Y H:i",$row->last_accountuse),
                "ct" => $this->sc_convert($row->timeCT),
                "tt" => $this->sc_convert($row->timeTT),
                "spe" => $this->sc_convert($row->timeSPE),
                "total" => "<span onclick='alert('da')'>".$this->sc_convert($row->total)."</span>",
                "steam"=> $this->steam_profile($row->steamid)
            ];
        }
        return $data;
    }
    public function search_db($sh) {
        $dbs = $this->db()->select("mostactive", "*", [
            "total[>=]" => 43200,
            "playername[~]" => $sh
        ]);
        if(!empty($dbs)) {
            $data = [];
            foreach ($dbs as $row) {
                $row = (object)$row;
                $data[] = [
                    "user" => $row->playername,
                    "seen" => date("d-m-Y H:i", $row->last_accountuse),
                    "ct" => $this->sc_convert($row->timeCT),
                    "tt" => $this->sc_convert($row->timeTT),
                    "spe" => $this->sc_convert($row->timeSPE),
                    "total" => $this->sc_convert($row->total),
                    "steam" => $this->steam_profile($row->steamid)
                ];
            }
            return $data;
        }
        else
            return array([
                "user" => "NU EXISTA",
                "seen" => "",
                "ct" => "",
                "tt" => "",
                "spe" => "",
                "total" => "",
                "steam" => ""
            ]);
    }
}