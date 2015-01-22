<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnitController
 *
 * @author igor
 */
class UnitController extends BaseController {
    
    protected $layout = 'home';
    
    public function __construct() {
        $this->beforeFilter('auth', array('except' => 'getLogin'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }
    
    public function getIndex() {
        $units = MapUnit::paginate(20);
        
        View::share('page_key', 'units');
        View::share('page_title', 'Map Units');
        $this->layout->header = View::make('header');
        $this->layout->content = View::make('unit.list');
        $this->layout->content->units = $units;
    }
    
    public function getEdit($id) {
        $unit = MapUnit::find($id);
        if(empty($unit->id)) {
            return Redirect::to('unit')->with(array('unit-error' => 'Unit not found!'));
        }
        
        View::share('page_key', 'units');
        View::share('page_title', 'Edit Unit #' . $unit->id);
        $this->layout->header = View::make('header');
        $this->layout->content = View::make('unit.edit');
        $this->layout->content->unit = $unit;
    }
    
    public function postEdit($id) {
        $unit = MapUnit::find($id);
        if(empty($unit->id)) {
            return Redirect::to('unit')->with(array('unit-error' => 'Unit not found!'));
        }
        $unit->name = e(Input::get('name'));
        $unit->save();
        return Redirect::to('unit');
    }
    
}
