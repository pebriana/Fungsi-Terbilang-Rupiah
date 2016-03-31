<?php
/**
 *	Sumber http://www.lesantoso.com/terbilang.html
 */
class Terbilang extends CApplicationComponent
{
	public function rupiah($uang)
	{
		$rp = $this->spellNumberInIndonesian($uang);
		return strtolower($rp.' rupiah');
	}

	protected function spellNumberInIndonesian($number)
	{
		$result = "";
		$number = strval($number);
		if (!preg_match("/^[0-9]{1,15}$/", $number)) return false;

		$ones           = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan");
		$majorUnits     = array("", "ribu", "juta", "milyar", "trilyun");
		$minorUnits     = array("", "puluh", "ratus");
		$length         = strlen($number);
		$isAnyMajorUnit = false;
		
		for ($i = 0, $pos = $length - 1; $i < $length; $i++, $pos--) {
			if ($number{$i} != '0') {
				if ($number{$i} != '1') {
					$result .= $ones[$number{$i}].' '.$minorUnits[$pos % 3].' ';
				} else if ($pos % 3 == 1 && $number{$i + 1} != '0') {
					if ($number{$i + 1} == '1')
						$result .= "sebelas ";
					else
						$result .= $ones[$number{$i + 1}]." belas ";
					$i++; $pos--;
				} else if ($pos % 3 != 0) {
					$result .= "se".$minorUnits[$pos % 3].' ';
				} else if ($pos == 3 && !$isAnyMajorUnit) {
					$result .= "se";
				} else {
					$result .= "satu ";
				}
				$isAnyMajorUnit = true;
			}

			if ($pos % 3 == 0 && $isAnyMajorUnit) {
				$result         .= $majorUnits[$pos / 3].' ';
				$isAnyMajorUnit = false;
			}
		}
		$result = trim($result);
		if ($result == "") $result = "nol";

		return $result;
 	}
}