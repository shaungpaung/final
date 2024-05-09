<?php

include ('db.php');
$totalBranches = 100;

$stmt = $conn->prepare("INSERT INTO branches (name, address, branchPhoneNumber) VALUES (?, ?, ?)");

// Loop branches
for ($i = 1; $i <= $totalBranches; $i++) {
    // Generate data for each branch
    $branchName = generateBranchName();
    $address = generateAddress();
    $branchPhoneNumber = generatePhoneNumber();

    // Bind parameters and execute
    $stmt->bind_param("sss", $branchName, $address, $branchPhoneNumber);
    $stmt->execute();
}

$stmt->close();
$conn->close();

function generateBranchName()
{
    $words = ['Central', 'North', 'South', 'East', 'West', 'Downtown', 'Main', 'Park', 'Square', 'River'];
    $name = $words[array_rand($words)] . ' Branch';
    return $name;
}

function generateAddress()
{
    $streets = ['Main Street', 'First Avenue', 'Elm Street', 'Maple Avenue', 'Oak Street', 'Pine Road', 'Cedar Lane'];
    $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose'];
    $zipcode = rand(10000, 99999);
    $address = $streets[array_rand($streets)] . ', ' . $cities[array_rand($cities)] . ', ' . $zipcode;
    return $address;
}

function generatePhoneNumber()
{
    $phoneNumber = '(' . rand(100, 999) . ') ' . rand(100, 999) . '-' . rand(1000, 9999);
    return $phoneNumber;
}