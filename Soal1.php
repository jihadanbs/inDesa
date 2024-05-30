<?php
foreach(range(1, 100) as $msib) {
    if ($msib % 3 != 0 && $msib % 5 != 0) {
      echo $msib . '<br>';
      continue;
    }
    if ($msib % 3 == 0) echo 'BIZZ';
    if ($msib % 5 == 0) echo 'BUZZ';
    echo '<br>';
  }
  ?>