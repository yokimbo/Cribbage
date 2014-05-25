<?php

################################
##
## function count_fifteens_pairs
##
################################
function count_fifteens_pairs($fcards) {
  if (!is_array($fcards)) {
    return false;
  }
  $points = 0;
  
  $num_cards = count($fcards);
  
  if ($count > 5) {
    return false;
  }
  
  for ($i=0; $i<$num_cards; $i++) {
    
    # Check two-card combinations for fifteens & pairs
    for ($j=$i+1; $j<$num_cards; $j++) {
      if ($fcards[$i] + $fcards[$j] == 15) {
        $points+=2;
      }
      if ($fcards[$i] == $fcards[$j]) {
        $points+=2;
      }
      
      # Check three-card combinations for fifteens
      for ($k=$j+1; $k<$num_cards; $k++) {
        if ($fcards[$i] + $fcards[$j] + $fcards[$k] == 15) {
          $points+=2;
        }
        
        # Check four-card combinations for fifteens
        for ($l=$k+1; $l<$num_cards; $l++) {
          if ($fcards[$i] + $fcards[$j] + $fcards[$k] + $fcards[$l] == 15) {
            $points+=2;
          }
          
          # Check five-card combinations for fifteens
          for ($m=$l+1; $m<$num_cards; $m++) {
            if ($fcards[$i] + $fcards[$j] + $fcards[$k] + $fcards[$l] + $fcards[$m] == 15) {
              $points+=2;
            }
          }
        }
      }
    }
  }
  
  echo "count_fifteens_pairs returning $points" . PHP_EOL;
  return $points;

}

################################
##
## function count_runs
##
################################
function count_runs($fcards) {
  $MIN_RUN = 3;
  $multiplier = 1;
  $runcount = 1;
  $num_cards = count($fcards);
  $last_repeat = 0;
  $points = 0;
  
  # Loop through the cards starting at the 2nd card
  # Then look back to determine runs
  for ($i = 1; $i < $num_cards; $i++) {
    # Check for sequential numbers
    if ($fcards[$i] - $fcards[$i-1] == 1) {
      $runcount++;
    }
    # If the cards are the same, increase multiplier
    else if ($fcards[$i] == $fcards[$i-1]) {
      # If we have a double-double (ex., 7, 7, 8, 8, 9) then increase the multiplier again
      if ( ($fcards[$i] != $last_repeat) && ($last_repeat != 0) ) {
        $multiplier++;
      }
      $multiplier++;
      $last_repeat = $fcards[$i];
    }
    # No sequence
    else {
      # Already have a run, can exit loop and return
      if ($runcount >= 3) {
        break;
      }
      # reset run count and multiplier
      else {
        $multiplier = 1;
        $runcount = 1;
      }
    }
    
  } # end of for loop
  
  if ($runcount >= 3) {
    $points = $runcount * $multiplier;
    echo "count_runs returning $points" . PHP_EOL;
    return $points;
  }
  else {
    echo "No runs" . PHP_EOL;
    return $points;
  }
}

function print_hand($hand) {
  echo PHP_EOL . "Hand is $hand" . PHP_EOL;
}

function print_score($score) {
  echo "=== Total points = $score" . PHP_EOL;
}

################################
##
## Main
##
################################

print_hand("(4, 4, 4, 7, 10)");
$cards = array(4, 4, 4, 7, 10);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(1, 1, 6, 7, 8)");
$cards = array(1, 1, 6, 7, 8);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(1, 2, 3, 7, 8)");
$cards = array(1, 2, 3, 7, 8);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(1, 2, 3, 4, 8)");
$cards = array(1, 2, 3, 4, 8);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(1, 2, 3, 4, 5)");
$cards = array(1, 2, 3, 4, 5);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(5, 5, 5, 5, 10)");
$cards = array(5, 5, 5, 5, 10);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(4, 5, 5, 6, 10)");
$cards = array(4, 5, 5, 6, 10);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(4, 5, 5, 6, 6)");
$cards = array(4, 5, 5, 6, 6);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(4, 4, 5, 6, 6)");
$cards = array(4, 4, 5, 6, 6);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(7, 8, 8, 8, 9)");
$cards = array(7, 8, 8, 8, 9);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

print_hand("(7, 7, 8, 8, 9)");
$cards = array(7, 7, 8, 8, 9);
$points = count_runs($cards);
$points += count_fifteens_pairs($cards);
print_score($points);

echo PHP_EOL;
?>