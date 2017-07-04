<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 7/4/17
 * Time: 17:22
 */

require __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
}
