<?php

$GET_INPUT = file_get_contents('php://input');

const TOKEN ='6110346712:AAE8D1ek9AAdpaEmIt1w-hJC-zEYaL_51lc';

const API_URL = 'https://core.telegram.org/bots/api';

function printAnswer($str) {
    echo "<pre>";
    print_r($str);
    echo "<pre>";
}

function getTelegramApi($method, $options = null){

    $str_request = API_URL . TOKEN . '/' . $method;

    if($options){
        $str_request .= '?' . http_build_query($options);
    }
    $request = file_get_contents($str_request);

    return json_decode($request, 1);
}

function setHook($set = 1) {
    $url = 'https://' . $_SERVER('HTTP_HOST') . $_SERVER('REQUETS_URI');
    printAnswer{
        getTelegramApi('setWebhook',
        [
            'url' => $set?url:''
        ]
        )
    };
    exit();
}

setHook(1);

$event = json_decode($GET_INPUT, 1);

if (mb_strtolower($event['message']['text']) == 'привет'){
    $autoAnswer = 'Салам братан!';
} else {
    $autoAnswer = 'Не пон! ' . $event['message']['text'] . "?\nI dont understand you";
}

getTelegramApi('sendMessage',
[
    'text' => $autoAnswer,
    'chat_id' => $event['message']['chat']['id']
]
);