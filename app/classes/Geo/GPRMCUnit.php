<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Geo;

/**
 * Description of GPRMCUnit
 *
 * @author igor
 */
class GPRMCUnit extends MapUnit {
    
    /**
     * GPSUnit constructor
     * 
     * @param string $grpmc GPRMC string only
     * 
     * Description: This method throws UnexpectedArgumentException when
     * incorrect GPRMC string passed
     */
    public function __construct($gprmc) {
        $this->checkGPRMC($gprmc);
        $latlon = $this->parseGPRMC($gprmc);
        $this->latlon = new MapLatLon($latlon['latitude'], $latlon['longitude']);
    }
    
    /**
     * Check the line correctness
     * 
     * @param string $gprmc
     * @return boolean
     * 
     * Description: The correct GPRMC string format is 
     * $GPRMC,hhmmss.sss,A,GGMM.MM,P,gggmm.mm,J,v.v,b.b,ddmmyy,x.x,n,m*hh<CR><LF>.
     * If the string is a correct GPRMC string then the method returns TRUE
     * otherwise FALSE
     */
    private function checkGPRMC($gprmc) {
        if(preg_match('~\$(GPRMC),(\d{6}\.\d+)?,(A|V),(\d{4}\.\d+)?,(N|S)?,(\d{5}\.\d+)?,(E|W)?,(\d+\.\d+)?,(\d+\.\d+)?,(\d{6})?,(\d+\.\d+)?,(.*?),(A|D|E|N)\*(.+?)(\r\n)?~',
                $gprmc, $match)) {
            if($match[3] == 'V' || !$this->checkGPRMCHashSum($gprmc) ||
                    empty($match[4]) || empty($match[5]) || empty($match[6]) ||
                    empty($match[7])) {
                return FALSE;
            }
        } else {
            return FALSE;
        }
        return TRUE;
    }
    
    private function checkGPRMCHashSum($gprmc) {
        if(preg_match('~\$(.+?)\*(.+)(\r\n)?~', $gprmc, $match)) {
            if($this->calculateGPRMCHashSum($match[1]) == $match[2]) {
                return TRUE;
            }
        }
        return FALSE;
    }
    
    private function calculateGPRMCHashSum($gprmc_data) {
        $sum = 0;
        for($i = 0; $i < strlen($gprmc_data); $i++){
            $sum = ord($gprmc_data{$i}) ^ $sum;
        }
        return dechex($sum);
    }
    
    private function parseGPRMC($gprmc) {
        if(preg_match('~\$(GPRMC),(\d{6}\.\d+)?,(A|V),(\d{4}\.\d+)?,(N|S)?,(\d{5}\.\d+)?,(E|W)?,(\d+\.\d+)?,(\d+\.\d+)?,(\d{6})?,(\d+\.\d+)?,(.*?),(A|D|E|N)\*(.+?)(\r\n)?~',
                $gprmc, $match)) {
            $lat = (floatval(substr($match[4], 0, 2)) + floatval(substr($match[4], 2)) / 60) * ($match[5] == 'N' ? 1 : -1);
            $lon = (floatval(substr($match[6], 0, 3)) + floatval(substr($match[6], 3)) / 60) * ($match[7] == 'E' ? 1 : -1);
            return array('latitude' => $lat, 'longitude' => $lon);
        }
        throw new \UnexpectedValueException("Couldn't parse GPRMC string '$gprmc'");
    }
    
}
