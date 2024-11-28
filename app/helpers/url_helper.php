<?php

function redireccion($url) {
    header("location:" . URL_PROJECT . $url);
}