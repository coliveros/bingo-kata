<?php

require __DIR__.'/vendor/autoload.php';

use Example\Manager\Infrastructure\InmemoryNumbersRepository;

$s = new InmemoryNumbersRepository();

$dd = [];
for($i =1; $i<=75; $i++) {
    $number = $s->number();
    $dd[]= $number;
}


print_r($dd);

