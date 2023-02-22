<?php 

class Uploadfile extends CFormModel {
    public $image;
    public function rules () {
        return array (
            array ('image', 'file', 'types' => 'gif, jpg, png, pdf'),
        );
    }
}