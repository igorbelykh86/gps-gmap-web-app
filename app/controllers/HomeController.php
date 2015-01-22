<?php

//use Geo\MapUnit;
//use Geo\GPRMCUnit;

class HomeController extends BaseController {
    
    protected $layout = 'home';

    public function index() {
        $map_units = array();
        //$map_units[] = (new MapUnit('53.076455,82.357315'))->getLatLon();
        //$map_units[] = (new GPRMCUnit('$GPRMC,123347.000,A,4313.7477,N,02752.4516,E,0.00,284.40,080811,,,D*63'))->getLatLon();
        
        $comet_token = Auth::user()->createCometToken();
        Cookie::queue('comet_token', $comet_token);
        
        $map_units = MapUnit::all()->toArray();
        
        View::share('page_key', 'home');
        View::share('page_title', 'Test');
        $this->layout->header = View::make('header');
        $this->layout->map_part = View::make('show-map');
        $this->layout->map_part->map_units = $map_units;
    }

}
