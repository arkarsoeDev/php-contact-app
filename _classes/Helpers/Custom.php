<?php

namespace Helpers;

class Custom 
{
    static function h($str) {
        return htmlspecialchars($str);
    }
}