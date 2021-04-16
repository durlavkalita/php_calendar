<?php

$pdo = require_once "../database.php";

$statement = $pdo->prepare('SELECT date FROM events');
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_COLUMN);

?>

<?php require_once "../views/layout.php"; ?>
  <?php 
    $months=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $current_month=date('n');
    $current_year=date('Y');
    $current_day=date('d');
    $month=0;
    echo '<div class="flex flex-col justify-center items-center">';
    echo '<h1 class="text-3xl text-red-600 font-bold">'.$current_year.'</h1>';
    
    // Table of months
    for ($row=1; $row<=3; $row++) {
      echo '<div class="flex">';
      for ($column=1; $column<=4; $column++) {
        echo '<div class="flex py-4 px-6">';
    
        $month++;
    
        // Month Cell
        $first_day_in_month=date('w',mktime(0,0,0,$month,1,$current_year));
        $month_days=date('t',mktime(0,0,0,$month,1,$current_year));
        
        // in PHP, Sunday is the first day in the week with number zero (0)
        // to make our calendar works we will change this to (7)
        if ($first_day_in_month==0){
          $first_day_in_month=7;
        }
        echo '<table>';
        echo '<th colspan="7" class="text-red-500">'.$months[$month-1].'</th>';
        echo '<tr class="days">
              <td class="p-2 text-center border-b-2">M</td>
              <td class="p-2 text-center border-b-2">T</td>
              <td class="p-2 text-center border-b-2">W</td>
              <td class="p-2 text-center border-b-2">T</td>
              <td class="p-2 text-center border-b-2">F</td>';
        echo '<td class="p-2 text-center border-b-2">S</td>
              <td class="p-2 text-center border-b-2 text-red-500">S</td>
              </tr>';
        echo '<tr>';
        for($i=1; $i<$first_day_in_month; $i++) {
          echo '<td> </td>';
        }
        for($day=1; $day<=$month_days; $day++) {
          $pos=($day+$first_day_in_month-1)%7;
          $class = (($day==$current_day) && ($month==$current_month)) ? 'today bg-green-500 rounded-full' : 'rounded-sm';
          $class .= ($month<$current_month) ? ' bg-gray-200' : '';
          $class .= (($day<$current_day) && ($month==$current_month)) ? ' bg-gray-200' : '';
          $class .= ($pos==6) ? ' sat' : '';
          $class .= ($pos==0) ? ' sun' : '';
          if (strlen($month)==1) {
            $checkMonth = '0'.$month;
          }else {
            $checkMonth = $month;
          }
          if (strlen($day)==1) {
            $checkDay = '0'.$day;
          }else {
            $checkDay = $day;
          }
          if (in_array(($current_year.'-'.$checkMonth.'-'.$checkDay), $events))
          {
            $class .= ' bg-blue-500';
          }
          echo '<td class="'.$class.' p-2 text-center">
              <a href="show.php?id='.($current_year.'-'.$checkMonth.'-'.$checkDay).'">'.$day.
              '</a></td>';
          if ($pos==0) echo '</tr><tr>';
        }
        echo '</tr>';
      echo '</table>';
    
        echo '</div>';
      }
      echo '</div>';
    }
    
    echo '</div>';
  ?>
</body>
</html>