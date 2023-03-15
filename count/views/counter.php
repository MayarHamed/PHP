<?php

$counter= new Counter();
$counter->incrementAndUpdate();
$count=$counter->getCount();
echo "<h1>Count = $count</h1>";