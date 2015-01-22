<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MapUnit
 *
 * @author igor
 */
class MapUnit extends Eloquent {
    public $timestamps = false;
    public function toArray() {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'latlon' => (new \Geo\MapLatLon($this->latitude, $this->longitude))->toArray()
        );
    }
}
