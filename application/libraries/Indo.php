<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Indo
{

	public function konversi($date)
	{
		$date 	= date('Y-m-d', strtotime($date));
		$d 		= explode("-", $date);

		$bulan = $this->bulan($d[1]);

		$tanggal = $d[2] . ' ' . $bulan . ' ' . $d[0];
		return $tanggal;
	}

	public function bulan($bl)
	{
		switch ($bl) {
			case '01':
				$bulan = "Januari";
				break;
			case '02':
				$bulan = "Februari";
				break;
			case '03':
				$bulan = "Maret";
				break;
			case '04':
				$bulan = "April";
				break;
			case '05':
				$bulan = "Mei";
				break;
			case '06':
				$bulan = "Juni";
				break;
			case '07':
				$bulan = "Juli";
				break;
			case '08':
				$bulan = "Agustus";
				break;
			case '09':
				$bulan = "September";
				break;
			case '10':
				$bulan = "Oktober";
				break;
			case '11':
				$bulan = "November";
				break;
			case '12':
				$bulan = "Desember";
				break;
			default:
				break;
		}

		return $bulan;
	}

	public function pageBulan($date)
	{
		$hari 	= date('d', strtotime($date));
		$bl 	= date('m', strtotime($date));

		switch ($bl) {
			case '01':
				$bulan = $hari . "-Jan";
				break;
			case '02':
				$bulan = $hari . "-Feb";
				break;
			case '03':
				$bulan = $hari . "-Mar";
				break;
			case '04':
				$bulan = $hari . "-Apr";
				break;
			case '05':
				$bulan = $hari . "-Mei";
				break;
			case '06':
				$bulan = $hari . "-Jun";
				break;
			case '07':
				$bulan = $hari . "-Jul";
				break;
			case '08':
				$bulan = $hari . "-Ags";
				break;
			case '09':
				$bulan = $hari . "-Sep";
				break;
			case '10':
				$bulan = $hari . "-Okt";
				break;
			case '11':
				$bulan = $hari . "-Nov";
				break;
			case '12':
				$bulan = $hari . "-Des";
				break;
			default:
				break;
		}

		return $bulan;
	}
}
