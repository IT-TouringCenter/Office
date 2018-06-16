<?php

use App\tour_commission_price_rate as tour_commission_price_rate;
use Illuminate\Database\Seeder;

class TourCommissionPriceRateSeeder extends Seeder{
	public function run(){
		tour_commission_price_rate::truncate();
        // tour_commission_price_rate::create(["tour_type"=>"Half Day","min_pax"=>"1","max_pax"=>"99","adult_price"=>"50","child_price"=>"25"]);
        // tour_commission_price_rate::create(["tour_type"=>"Half Day","min_pax"=>"100","max_pax"=>"199","adult_price"=>"75","child_price"=>"37.5"]);
        // tour_commission_price_rate::create(["tour_type"=>"Half Day","min_pax"=>"200","max_pax"=>"299","adult_price"=>"100","child_price"=>"50"]);
        // tour_commission_price_rate::create(["tour_type"=>"Half Day","min_pax"=>"300","max_pax"=>"399","adult_price"=>"125","child_price"=>"62.5"]);
        // tour_commission_price_rate::create(["tour_type"=>"Half Day","min_pax"=>"400","max_pax"=>"999","adult_price"=>"150","child_price"=>"75"]);
        // tour_commission_price_rate::create(["tour_type"=>"Full Day","min_pax"=>"1","max_pax"=>"99","adult_price"=>"100","child_price"=>"50"]);
        // tour_commission_price_rate::create(["tour_type"=>"Full Day","min_pax"=>"100","max_pax"=>"199","adult_price"=>"150","child_price"=>"75"]);
        // tour_commission_price_rate::create(["tour_type"=>"Full Day","min_pax"=>"200","max_pax"=>"299","adult_price"=>"200","child_price"=>"100"]);
        // tour_commission_price_rate::create(["tour_type"=>"Full Day","min_pax"=>"300","max_pax"=>"399","adult_price"=>"250","child_price"=>"125"]);
        // tour_commission_price_rate::create(["tour_type"=>"Full Day","min_pax"=>"400","max_pax"=>"999","adult_price"=>"300","child_price"=>"150"]);
        // tour_commission_price_rate::create(["tour_type"=>"Seasonal Program","min_pax"=>"1","max_pax"=>"99","adult_price"=>"120","child_price"=>"60"]);
        // tour_commission_price_rate::create(["tour_type"=>"Seasonal Program","min_pax"=>"100","max_pax"=>"199","adult_price"=>"170","child_price"=>"85"]);
        // tour_commission_price_rate::create(["tour_type"=>"Seasonal Program","min_pax"=>"200","max_pax"=>"299","adult_price"=>"220","child_price"=>"110"]);
        // tour_commission_price_rate::create(["tour_type"=>"Seasonal Program","min_pax"=>"300","max_pax"=>"399","adult_price"=>"270","child_price"=>"135"]);
        // tour_commission_price_rate::create(["tour_type"=>"Seasonal Program","min_pax"=>"400","max_pax"=>"999","adult_price"=>"320","child_price"=>"160"]);

        tour_commission_price_rate::create(["min_pax"=>"1","max_pax"=>"20","price_rate"=>"10"]);
	}
}
?>