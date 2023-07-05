<?php
$shelving_len = 1310;
$shelving = array(1 => array(), 2 => array(), 3 => array(), 4 => array());
$boxes = [1 => 774, 2 => 214, 3 => 694, 4 => 321, 5 => 674, 6 => 527, 7 => 120, 8 => 567];
$shelf = 1;
arsort($boxes);

while (empty($boxes)==false) {
    if (current($boxes) == null) {
        reset($boxes);
    }
    elseif (current($boxes) + array_sum($shelving[$shelf]) <= $shelving_len)  {
        empty($shelving[$shelf]) ?
            $shelving[$shelf] = array(key($boxes) => current($boxes)) :
            $shelving[$shelf] += array(key($boxes) => current($boxes));
        unset($boxes[key($boxes)]);
    }
    elseif (min($boxes)+array_sum($shelving[$shelf]) <= $shelving_len) {
        next($boxes);
    }
    else {
        $shelving[$shelf] += array('empty' =>  $shelving_len-array_sum($shelving[$shelf]));
        $shelf += 1;
    }
}
$shelving[$shelf] += array('empty' =>  $shelving_len-array_sum($shelving[$shelf]));
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table width="100%" cellspacing="4" cellpadding="4" border="1">
    <?php foreach ($shelving as $shelf => $boxes) {?>
        <tr>
            <td bgcolor="#b0c4de" width="5%"> Полка <?php echo $shelf; foreach ($boxes as $num => $wid) {?> </td>
            <td style="width: <?php echo $wid; ?>px"><?php if ($num!='empty') { echo 'Коробка '.$num;} else {echo $num;} ?></td>
            <?php }?>
        </tr>
    <?php }?>
</table>
</body>
</html>
