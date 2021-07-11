<?php
    function indonesian_date($waktu,$jam = false){

        $split = explode(' ',$waktu);
        $tanggal = explode('-',$split[0]);

        switch($tanggal[1]){
            case '01':$bulan = 'Januari'; break;
            case '02':$bulan = 'Februari'; break;
            case '03':$bulan = 'Maret'; break;
            case '04':$bulan = 'April'; break;
            case '05':$bulan = 'Mei'; break;
            case '06':$bulan = 'Juni'; break;
            case '07':$bulan = 'Juli'; break;
            case '08':$bulan = 'Agustus'; break;
            case '09':$bulan = 'September'; break;
            case '10':$bulan = 'Oktober'; break;
            case '11':$bulan = 'November'; break;
            case '12':$bulan = 'Desember'; break;
        }

        if(!$jam) {
            $join = $tanggal[2] . ' ' . $bulan . ' ' . $tanggal[0];
        } else {
            $join = $tanggal[2] . ' ' . $bulan . ' ' . $tanggal[0] . ' | ' . $split[1];
        }

        return $join;
    }

    function pushObjectData($data_array, $insert_data, $insert_name, $divide_by = null) {
        $length = count($insert_data) - 1;
        $temp = array();
        for ($i = 0; $i < count($insert_data); $i++) { 
            $temp[$i] = ($divide_by ? ($insert_data[$length] / $divide_by) : $insert_data[$length]);
            $length--;
        }
        $data_array->$insert_name = $temp;
        return $data_array;
    }

    function pushObjectDataTime($data_array, $insert_data, $insert_name) {
        $length = count($insert_data) - 1;
        $temp = array();
        for ($i = 0; $i < count($insert_data); $i++) { 
            $get_data = $insert_data[$length];
            $get_date = explode(' ', $get_data)[0];
            $get_time = explode(' ', $get_data)[1];
            $formated_time = indonesian_date($get_date) . ' | ' . $get_time;
            $temp[$i] = $formated_time;
            $length--;
        }
        $data_array->$insert_name = $temp;
        return $data_array;
    }

    function changeEnvironmentVariable($key, $value){
        $path = base_path('.env');

        if(is_bool(env($key))){
            $old = env($key )? 'true' : 'false';
        } elseif(env($key) === null){
            $old = 'null';
        } else{
            $old = env($key);
        }
        
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=".$old, "$key=".$value, file_get_contents($path)
            ));
        }
    }
?>