<?php require __DIR__.'/Partial/head.php'; ?>

<h1>Serialfolio</h1>
<h2>A basic software serials and licensing management web application to get rid of those loose sheets of paper.</h2>

<hr>

<h2>Add new serial</h2>

<form method="post" action="/">
    <label for="sName">Name:</label><br>
    <input type="text" name="sName" placeholder="Microsoft Windows 10 Professional OEM" style="width: 400px;"></input><br>
    <label for="sSerial">Serial:</label><br>
    <input type="text" name="sSerial" placeholder="AAAAA-BBBBB-CCCCC-00000-12345" style="width: 400px;"></input><br>
    <input type="submit" value="Submit">
</form>

<hr>

<h2>Existing serials</h2>

<table style="width:100%">

    <tr>
        <th>Product name</th>
        <th>Serial</th>
    </tr>

<?php if ($serials !== 'null' && $serials !== 'false') { 
    foreach($serials as $serial) { ?>
    <tr>
        <td><?php echo $serial["serialName"]; ?></td>
        <td><?php echo $serial["serialKey"]; ?></td>
    </tr>

<?php }
} else { ?>
    <tr>
        <td>No records found</td>
    </tr>
<?php } ?>

</table>

<?php require __DIR__.'/Partial/footer.php'; ?>