<?php 
namespace App\Repositories\EasyBook\Reservation\Discount;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class ConfigurationDiscountRepository extends Repository{
    function model(){return "App\configuration_discount";}
}