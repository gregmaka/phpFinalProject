<?php


class FormatDate
{



    function dateFM($dateFromDb)
    {
        //convert to date
        $phpdate = strtotime($dateFromDb);
        //format date and return
        return date( 'M jS, Y', $phpdate );

    }


}



?>}