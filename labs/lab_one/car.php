<?php
//make PHP strict
declare(strict_types=1);

class Car {
    //create properties
    public string $make;
    public string $model;
    public int $year;

    //construct the car
    public function __construct(string $make, string $model, int $year) {
        
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    //function returns a string explaining the cars information
    public function explainCar(): string {
        return "Car Make: {$this->make} | Model: {$this->model} | Year Made: {$this->year}";
    }
}

$car = new Car("Toyota Tacoma", "Base", 2020);

echo $car->explainCar();