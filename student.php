<?php
    require 'connections.php';
    $keyword=$_GET["searchbar"];
    $students=studentSearch($keyword);
?>
<table class="table-index">
    <tr style="position: absolute; top: 253px;">
        <th class="indexnumbertable">No.</th>
        <th style="width: 150px;">Action</th>
        <th style="width: 160px;">Student ID</th>
        <th style="width: 170px;">Name</th>
        <th style="width: 85px;">Faculty</th>
        <th style="width: 88px;">Major</th>
    </tr>
    <?php $i=1; foreach($students as $student):?>
    <tr>
        <td class="indexnumbertable"><?= $i; $i++?></td>
        <td style="width: 150px;">
            <a href="edit.php?ssid=<?= $student['ssid']?>" id="act1">Edit</a>
            <a href="delete.php?ssid=<?= $student['ssid']?>" id="act2" onclick="return confirm('Are you Sure?');">Delete</a>
        </td>
        <td style="width: 160px;"><?= $student["ssid"]?></td>
        <td style="width: 170px;"><?= $student["fullname"]?></td>
        <td style="width: 85px;"><?= $student["faculty"]?></td>
        <td style="width: 85px;"><?= $student["major"]?></td>
    </tr>
    <?php endforeach;?>
</table>