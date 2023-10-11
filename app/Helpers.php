<?php

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }

    return $hasil . " rupiah";
}

function format_rupiah($angka){
    $rupiah=number_format($angka,0,',','.');
    return $rupiah;
}




//make function to format date to indonesia format
function tgl_indo($tanggal){
    $tanggal = Carbon\Carbon::parse($tanggal)->format('d-m-Y');
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
}
//make function to format to rupiah indonesia

    function rupiah($angka){

        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;

    }


function br_bookmarks_tagify_json_to_array( $value ) {

    // Because the $value is an array of json objects
    // we need this helper function.

    // First check if is not empty
    if( empty( $value ) ) {

        return $output = array();

    } else {

        // Remove squarebrackets
        $value = str_replace( array('[',']') , '' , $value );

        // Fix escaped double quotes
        $value = str_replace( '\"', "\"" , $value );

        // Create an array of json objects
        $value = explode(',', $value);

        // Let's transform into an array of inputed values
        // Create an array
        $value_array = array();

        // Check if is array and not empty
        if ( is_array($value) && 0 !== count($value) ) {

            foreach ($value as $value_inner) {
                $value_array[] = json_decode( $value_inner );
            }

            // Convert object to array
            // Note: function (array) not working.
            // This is the trick: create a json of the values
            // and then transform back to an array
            $value_array = json_decode(json_encode($value_array), true);

            // Create an array only with the values of the child array
            $output = array();

            foreach($value_array as $value_array_inner) {
                foreach ($value_array_inner as $key=>$val) {
                    $output[] = $val;
                }
            }

        }

        return $output;

    }

}

if (!function_exists('sliderOne')) {

    function applicationSlider_one()
    {
        $sliderOne = Sliders::orderBy("created_at", "DESC")->first()->slider_one;
        return asset("/laravel/public/images/slider/" . $sliderOne);
    }
}

if (!function_exists('sliderTwo')) {

    function applicationSlider_two()
    {
        $sliderTwo = Sliders::orderBy("created_at", "DESC")->first()->slider_two;
        return asset("/laravel/public/images/slider/" . $sliderTwo);
    }
}

if(!function_exists('encrypt_ktp')) {
    /**
     * Encrypt KTP and save as file
     *
     * @param string $input
     * @param string $saveLocation
     * @return void
     */
    function encrypt_ktp($input, $saveFileName = 'encrypted_ktp.txt')
    {
        require_once __DIR__ . "/t_encrypt.php";
        $ktp_scan_folder = public_path("images");
        return t_encrypt::setPassword('huehue')
            -> input($input)
            -> saveAsFile($ktp_scan_folder . DIRECTORY_SEPARATOR . $saveFileName);
    }
}

if(!function_exists('decrypt_ktp_show')) {
    /**
     * Decrypt ktp file
     * and return as random string
     *
     * @param [type] $input
     * @return string
     */
    function decrypt_ktp_show($input)
    {
        require_once __DIR__ . "/t_encrypt.php";
        $ktp_scan_folder = public_path("images");
        $file = $ktp_scan_folder . DIRECTORY_SEPARATOR . $input;
        if (!is_file($file)) {
            // die("File KTP tidak ditemukan");
            return "File KTP tidak ditemukan";
        }

        if (!is_txt_file($file)) {
            // die("File KTP tidak valid, silahkan upload ulang");
            return "File KTP tidak valid, silahkan upload ulang";
        }

        return t_encrypt::setPassword('huehue')
            -> encrypted_string($file)
            -> show();
    }
}

if(!function_exists('decrypt_ktp_print')) {
    /**
     * Decrypt ktp file
     * and return as random string
     *
     * @param string $input
     * @return string
     */
    function decrypt_ktp_print($input)
    {
        require_once __DIR__ . "/t_encrypt.php";
        $ktp_scan_folder = public_path("images");
        $file = $ktp_scan_folder . DIRECTORY_SEPARATOR . $input;
        if (!is_file($file)) {
            // die("File KTP tidak ditemukan");
            return "File KTP tidak ditemukan";
        }

        if (!is_txt_file($file)) {
            // die("File KTP tidak valid, silahkan upload ulang");
            return "File KTP tidak valid, silahkan upload ulang";
        }

        echo t_encrypt::setPassword('huehue')
            -> encrypted_string($file)
            -> print();
    }
}

// helper to determine if file is txt file
if (!function_exists('is_txt_file')) {
    function is_txt_file($file)
    {
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExtension == 'txt') {
            return true;
        }

        return false;
    }
}
