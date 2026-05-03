<?php
header("Content-Type: application/json");

$data = [
    "name" => "Ahmad Zubayer",
    "id" => "21-44391-1",
    "department" => "CSE",
    "cgpa" => "3.95"
];

echo json_encode($data);
?>