<?php

function format_duration($seconds) {
    if ($seconds < 0) {
        return;
    } elseif ($seconds == 0) {
        return "now";
    } elseif ($seconds > 0) {
        $result = create_result($seconds);
        return $result;
    }
}


function create_result($seconds) {
    $resultStr = "";
    $arrValues = array();

    $countMinutes = (int)($seconds / 60);
    $remSecondsFromSeconds = $seconds - $countMinutes*60;
    array_push($arrValues, $remSecondsFromSeconds);

    $countHours = (int)($countMinutes / 60);
    $remMinutesFromHours = $countMinutes - $countHours*60;
    array_unshift($arrValues, $remMinutesFromHours);

    $countDays = (int)($countHours / 24);
    $remHoursFromDays = $countHours - $countDays*24;
    array_unshift($arrValues, $remHoursFromDays);

    $countYears = (int)($countDays / 365);
    $remDaysfromYears = $countDays - $countYears*365;
    array_unshift($arrValues, $remDaysfromYears);

    $resultStr = add_years($resultStr, $countYears);
    $countValuesForYears = take_count_values_for_years($arrValues);
    $resultStr = add_marks($resultStr, $countYears, $countValuesForYears);
    
    $resultStr = add_days($resultStr, $remDaysfromYears);
    $countValuesForDays = take_count_values_for_days($arrValues);
    $resultStr = add_marks($resultStr, $remDaysfromYears, $countValuesForDays);
    
    $resultStr = add_hours($resultStr, $remHoursFromDays);
    $countValuesForHours = take_count_values_for_hours($arrValues);
    $resultStr = add_marks($resultStr, $remHoursFromDays, $countValuesForHours);
    
    $resultStr = add_minutes($resultStr, $remMinutesFromHours);
    if($remMinutesFromHours > 0 and $remSecondsFromSeconds > 0) {
        $resultStr = $resultStr." and ";
    }
    
    $resultStr = add_seconds($resultStr, $remSecondsFromSeconds);
    
    return $resultStr;
}

function add_years($resultStr, $countYears) {
    if($countYears > 1) {
        $resultStr = $resultStr.$countYears." years";
    } elseif($countYears == 1) {
        $resultStr = $resultStr.$countYears." year";
    }

    return $resultStr;
}

function add_days($resultStr, $remDaysfromYears) {
    if($remDaysfromYears == 1) {
        $resultStr = $resultStr.$remDaysfromYears." day";
    } elseif($remDaysfromYears > 1) {
        $resultStr = $resultStr.$remDaysfromYears." days";
    }

    return $resultStr;
}

function add_hours($resultStr, $remHoursFromDays) {
    if($remHoursFromDays == 1) {
        $resultStr = $resultStr.$remHoursFromDays." hour";
    } elseif($remHoursFromDays > 1) {
        $resultStr = $resultStr.$remHoursFromDays." hours";
    }

    return $resultStr;
}

function add_minutes($resultStr, $remMinutesFromHours) {
    if($remMinutesFromHours == 1) {
        $resultStr = $resultStr.$remMinutesFromHours." minute" ;
    } elseif($remMinutesFromHours > 1) {
        $resultStr = $resultStr.$remMinutesFromHours." minutes" ;
    }

    return $resultStr;
}

function add_seconds($resultStr, $remSecondsFromSeconds) {
    if($remSecondsFromSeconds == 1) {
        $resultStr = $resultStr.$remSecondsFromSeconds." second";
    } elseif ($remSecondsFromSeconds > 1) {
        $resultStr = $resultStr.$remSecondsFromSeconds." seconds";
    }

    return $resultStr;
}

function take_count_values_for_years($arrValues) {
    $count = 0;
    foreach ($arrValues as $value) {
        if($value > 0) {
            $count++;
        }
    }

    return $count;
}

function take_count_values_for_days($arrValues) {
    unset($arrValues[0]);
    $count = 0;
    foreach ($arrValues as $value) {
        if($value > 0) {
            $count++;
        }
    }

    return $count;
}

function take_count_values_for_hours($arrValues) {
    unset($arrValues[0]);
    unset($arrValues[1]);
    $count = 0;
    foreach ($arrValues as $value) {
        if($value > 0) {
            $count++;
        }
    }

    return $count;
}


function add_marks($resultStr, $remData, $countValues) {
    if($remData > 0 and $countValues >= 2) {
        $resultStr = $resultStr.", ";
    } elseif ($remData > 0 and $countValues == 1) {
        $resultStr = $resultStr." and ";
    }

    return $resultStr;
}

?>