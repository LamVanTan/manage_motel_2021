<?php
if( !function_exists('explodeString')) {

    function explodeString($priceRoom){
        $priceRoom = explode(" ", $priceRoom);
        $priceRoom = explode(".", $priceRoom[0]);
        $middleName = implode("", $priceRoom);
        return $middleName;
    }

}