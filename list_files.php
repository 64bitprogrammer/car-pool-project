<?php
/*    foreach(glob('*') as $file) {
        echo "<a href='$file'>$file</a><br><br>";
    }*/
?>
<h1 align="center"> Directory Listing </h1> <br>
<?php
echo " <div align='center'>";
echo " <table width='20%' border='0' padding='0' spacing='0'>";
echo " <tr> <th> Files </th> </tr>";
if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
            if(is_dir($entry)){
                $style = "style='border:solid 1px;padding:5px;background-color:limegreen;'";
            }
            else{
                $style = "style='border:solid 1px;padding:5px;background-color:orange;'";
            }
            if($entry != "index.php"){
                echo "<tr align='left'> <td> <a href='$entry' $style>$entry</a> <br> <Br> </td> </tr> ";
            }
        }
    }
echo "</table>";
echo "</div>";
    closedir($handle);
}
?>
