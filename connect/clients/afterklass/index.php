






<style>
table {
    width: 100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;

}
table-layout: fixed;
width: 100%;
</style>
<?php
include('simplehtmldom_1_9_1/simple_html_dom.php');

$i=$_GET['start'];
if($i==""){$i=7020;}
$start="";
$smartcount = 0;
$bizcount   = 0;
$playcount  = 0;
$greenerycount=0;
$LISTSMART="";
$LISTGREENERY="";
$LISTBIZ ="";
$LISTPLAY="";

while($i<7024){
 
    $url = 'https://www.afterklass.com/post/detail/'.$i;



   if (strpos($url, "Site หรือ Server ไม่สามารถเรียกไฟล์ หรือหาไฟล์หน้าเว็บที่เราเรียกได้ webmaster อาจลบหน้าเว็บนั้นๆ ออกจากระบบแล้ว")) {
        echo '***.';
    } else {
        echo 'No cars.';
    }





    // Create a new instance of the HTML parser
    $html = new simple_html_dom();
    
    // Load the webpage into the HTML parser
    $html->load_file($url);
    
    $SMART = $html->find('label[class=lbCategories lbCategories-SMART]', 0);
    $BIZ = $html->find('label[class=lbCategories lbCategories-BIZ]', 0);
    $PLAY = $html->find('label[class=lbCategories lbCategories-PLAY]', 0);
    $GREENERY = $html->find('label[class=lbCategories lbCategories-GREENERY]', 0);

    $Title1 = $html->find('title', 0)->plaintext;
    $word = "- AFTERKLASS เว็บให้ความรู้สำหรับวัยรุ่น";
    $Title = str_replace($word, "",$Title1);
   
    if($SMART!="") {
        $smartcount++;
        $LISTSMART.= "<tr><td>".$smartcount."</td><td><a href='".$url."' target='_blank'>".$Title."</a> </td><td>".$SMART->innertext."</td><td>".$url."</td>";
        $SMART="";
    } 
    if($BIZ!="") {
        $bizcount++;
        $LISTBIZ .= "<tr><td>".$bizcount."</td><td><a href='".$url."' target='_blank'>".$Title."</a> </td><td>".$BIZ->innertext."</td><td>".$url."</td>";
        $BIZ="";
    } 
    if($PLAY) {
        $playcount++; 
        $LISTPLAY .= "<tr><td>".$playcount."</td><td><a href='".$url."' target='_blank'>".$Title."</a> </td><td>".$PLAY->innertext."</td><td>".$url."</td>";
        $PLAY="";
     }
    if($GREENERY!="") {
        $greenerycount++; 
        $LISTGREENERY.= "<tr><td>".$greenerycount."</td><td><a href='".$url."' target='_blank'>".$Title."</a> </td><td>".$GREENERY->innertext."</td><td>".$url."</td>";
        $GREENERY="";
     }

    
    $html->clear();
    unset($html);
   
$i++;
}

echo "<br>GO GREEN Together :".$greenerycount;
echo "<br>BIZ SMART :".$bizcount;
echo "<br>SMART Society :".$smartcount;
echo "<br>PLAY YARD :".$playcount;
echo "<br><hr>";


echo "GO GREEN Together :";
if($greenerycount>0){
    echo "<table cellspacing='0'>
	<thead>
		<tr>
			<th width=10%>No.</th>
			<th width=50%>Title</th>
            <th width=10%>Categories</th>
			<th width=30%>Link</th>
		</tr>
	</thead>
	<tbody>";
    echo $LISTGREENERY;  
    echo "</tbody></table>";  
}

echo "<hr> BIZ SMART :";
if($bizcount>0){
    echo "<table cellspacing='0'>
	<thead>
		<tr>
        <th width=10%>No.</th>
        <th width=50%>Title</th>
        <th width=10%>Categories</th>
        <th width=30%>Link</th>
		</tr>
	</thead>
	<tbody>";
    echo $LISTBIZ;  
    echo "</tbody></table>";  
    }

echo "<hr> SMART Society :";
if($bizcount>0){
    echo "<table cellspacing='0'>
	<thead>
		<tr>
        <th width=10%>No.</th>
        <th width=50%>Title</th>
        <th width=10%>Categories</th>
        <th width=30%>Link</th>
		</tr>
	</thead>
	<tbody>";
    echo $LISTSMART;  
    echo "</tbody></table>";  
    }

echo "<hr> PLAY YARD :";
if($playcount>0){
    echo "<table cellspacing='0'>
	<thead>
		<tr>
        <th width=10%>No.</th>
        <th width=50%>Title</th>
        <th width=10%>Categories</th>
        <th width=30%>Link</th>
		</tr>
	</thead>
	<tbody>";
    echo $LISTPLAY;  
    echo "</tbody></table>";  
    }






?>
