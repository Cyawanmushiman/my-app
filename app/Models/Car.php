<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $brand;
    public $color;

    public function __construct($brand = null, $color = null) {
        $this->brand = $brand;
        $this->color = $color;
    }

    public function drive() {
        echo "This " . $this->color . " " . $this->brand . " car is driving.\n";
    }
}
