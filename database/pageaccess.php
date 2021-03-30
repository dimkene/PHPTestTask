<?php
    session_start();

    
    function page_privilege_catch($page_name, $link)
    {
        $page_privilege = '';
        
        $res_query = "SELECT * FROM `Pages`";
        $res = mysqli_query($link, $res_query);
        $rows = mysqli_num_rows($res);
        for ($i = 0; $i < $rows; ++$i)
        {
            $row = mysqli_fetch_row($res);
            for ($j = 0 ; $j < 3 ; ++$j)
            {
                if ($row[$j] == $page_name)
                {
                    $page_privilege = $row[2];
                }
            }
        }
        
        return $page_privilege;
    }
?>