<?php

$skiers = [
    ["id"=>1,"Hersteller"=>"Fischer", "preis"=>40],
    ["id"=>2,"Hersteller"=>"Rosignol", "preis"=>404],
    ["id"=>3,"Hersteller"=>"keine ahnuing", "preis"=>420]
];

foreach ($skiers as $ski) {
    echo "<ul>";
    foreach ($ski as $key=>$value) {
        echo "<li> $key: $value </li>";
    }
    echo "</ul>";
}
