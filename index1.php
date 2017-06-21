<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--head-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="utf-8" http-equiv="encoding">
<head>
        <title>Лабораторная работа №6</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
        
        <h1>Чепрасова Елена
                <div>гр. Р3202, вар. 4012</div>
        </h1>

        <?php
                date_default_timezone_set('Europe/Moscow');
                $time_start = microtime(true); // setting start time
                
                
                function isInArea($x, $y, $r){
                        if (($x >= -$r && $x <= 0 && $y >=0 && $y <= $r) || // checking square
                                ($x >= 0 && $y <=0 && pow($p->x, 2) + pow($p->y, 2) <= pow($this->r, 2)) ||// checking circle
                                ($x <= 0 && $y <=0 && $y >= -0.5 * $x -0.5)) {
                                        return "Да";
                                }
                        else
                                return "Нет";
                }
                
                if (isset($_GET['y']) && isset($_GET['x']) && isset($_GET['radVal'])){
                
                        $myYes = $_Get['y'];
        
                        $x = $_GET['x'];
                        $y = $_GET['y'];
                        $yArr = preg_split("/[\s]*[;][\s]*/", $y);
                        $r = $_GET['radVal'];
                        
                        //print_r($yArr);
                        
                        //writing to file
                        $filename = "data.txt" ;
                        
                        for ($i = 0; $i < count($yArr); $i++){
                                $result = isInArea($x, $yArr[$i], $r);
                                $data = $x."\n".$yArr[$i]."\n".$r."\n".$result."\n"; // delete * later
                                //echo $data."\n"; // debugging
                                file_put_contents($filename, $data, FILE_APPEND);
                        }
                        
                }
                
                
        ?>
        
       
       <table border="1" cellspacing="1" cellpadding="1" align="left">
                <tr>
                        <td type="text" align="center" id="graphic" colspan="4">График:</td>
                        <!--id selector used-->
                </tr>
                
                <tr>
                        <td align="center" colspan="4" >
                                <img src="graphic.png">
                        </td>
                </tr>

                <!--VALUES-->
                <tr>
                        <td align="center" type="text" colspan="4">Начальные данные:</td>
                </tr>
                
                <tr>
                                <th colspan="1">X</th>
                                <th colspan="1">Y</th>
                                <th colspan="1">R</th>
                                <th colspan="1">Попадание:</th>
                </tr>
                
                <?php
                
                        if (isset($_GET['delete'])){
                                file_put_contents("data.txt", ""); // way 1
                                /* $handle = fopen ("./data.txt", "w+");
                                fclose($handle); */ // 2nd way
                                //header("Location: index.html");
                                header("Location: index1.php");
                        }
                        
                        else {
                                $cnt = 0; // variable to get track of values
                                
                                $file = fopen("data.txt","r");
                                
                                while( !feof($file) ) {
                                        $curLine = fgets($file);
                                        //$curLine = str_replace("\n", "", $curLine); // trying to cut the last \n
                                        if ($curLine != "" && $curLine != "\n" && $curLine != "\r") {
                                                if ($cnt % 4 == 0) { // if 1st element in the row
                                                        echo "<tr><td>".$curLine. "</td>";
                                                }
                                                else if ($cnt % 4 == 3) { // if the last element in the row
                                                        echo "<td>".$curLine."</td></tr>";
                                                }
                                                else{
                                                        echo "<td>".$curLine."</td>";
                                                }
                                        $cnt = $cnt + 1;
                                        }
                                }
                        }

                fclose($file);

                ?>
                
                <tr>
                        <td colspan="2">Время выполнения:</td>
                        <td colspan="2"><?php
                        $end_time = microtime(true); // end of running (time in secs)
                        $runtime = $end_time - $time_start; // runnung time in seconds
                        echo number_format ($runtime * 1000, 5) ?></td>
                </tr>
                
                <tr>
                        <td colspan="2">Текущее время:</td>
                        <td colspan="2"><?php
                                $curTime = date("h:i:sa")."<br />";
                                echo $curTime; ?>
                        </td>
                </tr>
                <tr>
                        <td colspan="4"><a href=index.html>Назад</a></td>
                </tr>
                
                <tr>
                        <td colspan="4"></td>
                </tr>
                
                <tr>
                        <td><a href='index1.php?delete=true'>Удалить сохраненные данные</a></td>
                </tr>
        </table>
</body>
</html>
