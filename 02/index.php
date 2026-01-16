<?php

//make PHP scrict, needs to be at the start of your script
declare(strict_types=1);
require_once "connect.php";

// 1. Code Commenting

// Inline comments look like this

/* 

Multiline comments look like this

*/

// 2. Variables, Data Types, Concatenation & Conditional Statements

$firstName = "Claire"; //string
$lastName = "Yon";

$age = 19;

$isInstructor = false;

echo "<p> Hello there, my name is " . $firstName . " " . $lastName . ".</p>";

if($isInstructor) {
    echo "<p> I am the teacher.</p>";
}
else {
    echo "<p> I am not the teacher.</p>";
}

// 3. PHP is loosely typed
// Create two variables, one called num1 and one called num2, in num1 store an integer and in num2 store an number but treat as string "10"

$num1 = 10;
$num2 = "10";

// function add(int $num1, int $num2) {
//     return $num1 + $num2;
// }

// echo "<p>" . add($num1, $num2) . "</p>";

class Person {

    public string $name;
    public int $age;
    public bool $isInstructor;
    public function __construct(string $name, int $age, bool $isInstructor) {
        $this->name = $name;
        $this->age = $age;
        $this->isInstructor = $isInstructor;
    }

    public function getBadge(): string {
        $role = $this->isInstructor ? "Instructor" : "Student";
        return "Name: {$this->name} | Age: {$this->age} | Role: $role";
    }
}

