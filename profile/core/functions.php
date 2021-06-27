<?php

function date_parser($date_time) {
    $date = new DateTime($date_time);
    return date_format($date, "d-M-Y");
}