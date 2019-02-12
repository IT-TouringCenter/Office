<?php

use App\bank as bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder{
	public function run(){
		bank::truncate();
		bank::create(["bank_th"=>"ธ.กรุงเทพ จำกัด (มหาชน)", "bank_en"=>"Bangkok Bank Public Company Limited", "tel"=>"1333", "website"=>"https://www.bangkokbank.com/"]);
        bank::create(["bank_th"=>"ธ.กรุงไท​ย จำกัด (มหาชน)", "bank_en"=>"Krung Thai Bank Public Company Limited", "tel"=>"021111111", "website"=>"https://www.ktb.co.th"]);
        bank::create(["bank_th"=>"​ธ.ศรีอยุธยา จำกัด (มหาชน)", "bank_en"=>"Bank of Ayudhya Public Company Limited", "tel"=>"1572", "website"=>"https://www.krungsri.com"]);
        bank::create(["bank_th"=>"​​​ธ.กสิกรไทย จำกัด (มหาชน)​", "bank_en"=>"Kasikornbank Public Company Limited", "tel"=>"028888888", "website"=>"https://www.kasikornbank.com"]);
        bank::create(["bank_th"=>"​​​​ธ.เกียรตินาคิน จำกัด (มหาชน)​​​", "bank_en"=>"Kiatnakin Bank Public Company Limited", "tel"=>"021655555", "website"=>"http://www.kiatnakin.co.th"]);
        bank::create(["bank_th"=>"ธ.ซีไอเอ็มบี ไทย จำกัด (มหาชน)", "bank_en"=>"CIMB Thai Bank Public Company Limited", "tel"=>"026267777", "website"=>"https://www.cimbthai.com"]);
        bank::create(["bank_th"=>"​​​​​​ธ.ทหารไทย จำกัด (มหาชน)​", "bank_en"=>"TMB Bank Public Company Limited", "tel"=>"1558", "website"=>"https://www.tmbbank.com"]);
        bank::create(["bank_th"=>"ธ.นิสโก้ จำกัด (มหาชน)", "bank_en"=>"TISCO Bank Public Company Limited", "tel"=>"026336000", "website"=>"https://www.tisco.co.th"]);
        bank::create(["bank_th"=>"ธ.ไทยพาณิชย์ จำกัด (มหาชน)", "bank_en"=>"The Siam Commercial Bank Public Company Limited", "tel"=>"027777777", "website"=>"https://www.scb.co.th"]);
        bank::create(["bank_th"=>"ธ.​ธนชาต จำกัด (มหาชน)", "bank_en"=>"Thanachart Bank Public Company Limited (TBANK)", "tel"=>"1770", "website"=>"https://www.thanachartbank.co.th"]);
        bank::create(["bank_th"=>"ธ.ยูโอบี จำกัด (มหาชน)​", "bank_en"=>"United Overseas Bank (Thai) Public Company Limited", "tel"=>"022851555", "website"=>"https://www.uob.co.th"]);
        bank::create(["bank_th"=>"ธ.แลนด์ แอนด์ เฮ้าส์ จำกัด (มหาชน)​​​", "bank_en"=>"Land and Houses Public Company Limited", "tel"=>"023590000", "website"=>"https://www.lhbank.co.th"]);
        bank::create(["bank_th"=>"​ธ.สแตนดาร์ด ชาร์เตอร์ด (ไทย) จำกัด (มหาชน)", "bank_en"=>"Standard Chartered (Thai) Public Company Limited", "tel"=>"1553", "website"=>"https://www.sc.com"]);
        bank::create(["bank_th"=>"ธ.ไอซีบีซี (ไทย) จำกัด (มหาชน)", "bank_en"=>"Industrial and Commercial Bank of China (Thai) Public Company Limited (ICBC)", "tel"=>"026295588", "website"=>"http://www.icbcthai.com"]);
        bank::create(["bank_th"=>"อื่นๆ", "bank_en"=>"Other", "tel"=>"-", "website"=>"-"]);
	}
}
?>