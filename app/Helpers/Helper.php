<?php

function groupDates($dates)
{
    $netCalendar = $dates;
    $date_in = null;
    $date_out = null;
    $compared_value = null;
    $count = 0;
    $responseArray = array();
    foreach ($netCalendar as $date => $datePrice) {
        $count++;
        $loop_date = new \DateTime($date);
        if ($count == 1) {
            $date_in = $loop_date;
            $date_out = $loop_date;
            $compared_value = $datePrice;
            continue;
        }
        $diffDays = $date_out->diff($loop_date)->format("%R%a");
        if ($diffDays == 1) {
            if ($datePrice == $compared_value) {
                $date_out = $loop_date;
                continue;
            }
        }
        $responseArray[] = [
            'StartDate' => $date_in->format('Y-m-d'),
            'EndDate' => $date_out->format('Y-m-d'),
            'Value' => $compared_value
        ];
        $date_in = $loop_date;
        $date_out = $loop_date;
        $compared_value = $datePrice;
    }
    if (!empty($date_in) && !empty($date_out)) {
        $responseArray[] = [
            'StartDate' => $date_in->format('Y-m-d'),
            'EndDate' => $date_out->format('Y-m-d'),
            'Value' => $compared_value
        ];
    }
    return $responseArray;
}
