<?php

if(!function_exists('fullname')) {
    function fullname($name, $front_title, $behind_title) {
        return $front_title . $name . ($behind_title != '' ? ', ' . $behind_title : $behind_title);
    }
}