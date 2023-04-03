<?php
$graph = array(
    array(0, 2, 4, 0, 0),
    array(2, 0, 1, 3, 0),
    array(4, 1, 0, 6, 7),
    array(0, 3, 6, 0, 1),
    array(0, 0, 7, 1, 0)
);

function minDistance($dist, $visited) {
    $min = PHP_INT_MAX;
    $minIndex = -1;
    
    for ($i = 0; $i < count($dist); $i++) {
        if ($visited[$i] == false && $dist[$i] <= $min) {
            $min = $dist[$i];
            $minIndex = $i;
        }
    }
    
    return $minIndex;
}

function printSolution($dist, $n) {
    echo "Uzel: \t Vzdálenost od zdroje:\n";
    for ($i = 0; $i < count($dist); $i++) {
        echo $i . "\t\t" . $dist[$i] . "\n";
    }
}

function dijkstra($graph, $src) {
    $dist = array();
    $visited = array();
    $n = count($graph);
    
    for ($i = 0; $i < $n; $i++) {
        $dist[$i] = PHP_INT_MAX;
        $visited[$i] = false;
    }
    
    $dist[$src] = 0;
    
    for ($count = 0; $count < $n-1; $count++) {
        $u = minDistance($dist, $visited);
        $visited[$u] = true;
        
        for ($v = 0; $v < $n; $v++) {
            if (!$visited[$v] && $graph[$u][$v] && $dist[$u] != PHP_INT_MAX && $dist[$u] + $graph[$u][$v] < $dist[$v]) {
                $dist[$v] = $dist[$u] + $graph[$u][$v];
            }
        }
    }
    
    printSolution($dist, $n);
}

dijkstra($graph, 0);
?>