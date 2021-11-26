<?php

function renderImage($path): string
{
    return ($path) && file_exists($path) ? asset($path)  : asset('images/default.jpg');
}
