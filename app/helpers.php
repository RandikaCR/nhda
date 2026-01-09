<?php

function priceWithCurrency($price){
    return defaultCurrency() . number_format($price, 2);
}

function defaultCurrency(){
    return 'Rs. ';
}

function dateTimeFormat($date){
    return date('d-F-Y h:i A', strtotime($date));
}

function dateFormat($date){
    return date('d-F-Y', strtotime($date));
}

function orderIdFormat($orderId){
    return str_pad($orderId, 6, '0', STR_PAD_LEFT);
}

function stringLimitLength($string, $limit){
    $str = strip_tags($string);
    $str = substr($str, 0, $limit);
    return $str;
}

function status($getStatus){

        $status = 'Inactive';
        $statusClass = 'bg-warning';

        if ($getStatus == 1){
            $status = 'Active';
            $statusClass = 'bg-success';
        }

        return (Object)[
            'text' => $status,
            'class' => $statusClass,
        ];
    }

?>
