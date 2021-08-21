<?php
require_once('./database/db_config.php');
require_once('./php-action-scripts/session.php');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<title>BMIS | Barangay Officials</title>
<!-- BEGIN: Head-->
<?php include ('./page-layout/html-assets.php'); ?>



<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <?php include ('./page-layout/header.php'); ?>
    <!-- END: Header-->
 

    <!-- BEGIN: SideNav-->
    <?php include ('./page-layout/sidebar.php'); ?>
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div id="breadcrumbs-wrapper" data-image="./app-assets/images/gallery/breadcrumb-bg.jpg" class="breadcrumbs-bg-image" style="background-image: url(&quot;./app-assets/images/gallery/breadcrumb-bg.jpg&quot;);">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Barangay Officials Org Chart</span></h5>
                        </div>
                        <!-- <div class="col s12 m6 l6 right-align-md">
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Pages</a>
                                </li>
                                <li class="breadcrumb-item active">Blank Page
                                </li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="test">
        <?php 
$sql =   mysqli_query($conn,"SELECT * FROM `brgy_official_detail` bod 
INNER JOIN resident_detail rd ON rd.res_ID = bod.res_ID
LEFT JOIN ref_suffixname rs ON rs.suffix_ID = rd.suffix_ID
LEFT JOIN ref_position rp ON rp.position_ID = bod.commitee_assignID
WHERE bod. commitee_assignID = 2 AND visibility = 1");
$cap_data = mysqli_fetch_array($sql);
$cap_data['res_Img'];
$suffix = $cap_data['suffix'];
 if ($suffix == "N/A") {
   $suffix = "";
 }
 else{
    $suffix = $cap_data['suffix'];
 }


 if (isset($cap_data[7])) {
     $img  = $cap_data[7];
     $cimg = "data:image/jpeg;base64,".base64_encode($img);
     
 } 
 else{
  
    $cimg = "../../Img/Icon/logo.png";
 
 }
 $sql =   mysqli_query($conn,"SELECT * FROM `brgy_official_detail` bod 
INNER JOIN resident_detail rd ON rd.res_ID = bod.res_ID
LEFT JOIN ref_suffixname rs ON rs.suffix_ID = rd.suffix_ID
LEFT JOIN ref_position rp ON rp.position_ID = bod.commitee_assignID
WHERE bod. commitee_assignID = 3 AND visibility = 1");
$sec_data = mysqli_fetch_array($sql);
$sec_data['res_Img'];
$suffix1 = $sec_data['suffix'];
 if ($suffix1 == "N/A") {
   $suffix1 = "";
 }
 else{
    $suffix1 = $sec_data['suffix'];
 }


 if (isset($sec_data[7])) {
     $img  = $sec_data[7];
     $secimg = "data:image/jpeg;base64,".base64_encode($img);
     
 } 
 else{
  
    $secimg = "../../Img/Icon/logo.png";
 
 }
$sql =   mysqli_query($conn,"SELECT * FROM `brgy_official_detail` bod 
INNER JOIN resident_detail rd ON rd.res_ID = bod.res_ID
LEFT JOIN ref_suffixname rs ON rs.suffix_ID = rd.suffix_ID
LEFT JOIN ref_position rp ON rp.position_ID = bod.commitee_assignID
WHERE bod. commitee_assignID = 4 AND visibility = 1 ORDER by official_ID DESC");
$tre_data = mysqli_fetch_array($sql);
$tre_data['res_Img'];
$suffix2 = $tre_data['suffix'];
 if ($suffix2 == "N/A") {
   $suffix2 = "";
 }
 else{
    $suffix2 = $tre_data['suffix'];
 }


 if (isset($tre_data[7])) {
     $img  = $tre_data[7];
     $treimg = "data:image/jpeg;base64,".base64_encode($img);
     
 } 
 else{
  
    $treimg = "../../Img/Icon/logo.png";
 
 }


$sql = mysqli_query($conn,"SELECT * FROM `brgy_official_detail` bod 
INNER JOIN resident_detail rd ON rd.res_ID = bod.res_ID
LEFT JOIN ref_suffixname rs ON rs.suffix_ID = rd.suffix_ID
LEFT JOIN ref_position rp ON rp.position_ID = bod.commitee_assignID
WHERE visibility = 1 AND  position_Name LIKE 'Barangay Official%'");       

$count_official = mysqli_num_rows($sql);

$name = array();
$position_Name = array();
$official_img = array();


while($official_data = mysqli_fetch_array($sql)){
  $suffix = $official_data['suffix'];
   if ($suffix == "N/A") {
     $suffix = "";
   }
   else{
      $suffix = $official_data['suffix'];
   }
  $name[] =  $official_data['res_fName'].' '.$official_data['res_mName'].' '.$official_data['res_lName'].' '.$suffix;
  $position_Name[] = $official_data['position_Name'];

  if (isset($official_data['res_Img'])) {
    $z  = $official_data['res_Img'];
    $official_img[] = "data:image/jpeg;base64,".base64_encode($z);
     
  } 
  else{
    $official_img[] = "../../Img/Icon/logo.png";
   
  }
    
}


?>
        </div>
     
    </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <?php include ('./page-layout/footer.php'); ?>

    <!-- END: Footer-->


    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <?php include ('./page-layout/html-vendors.php');  ?>
    <!-- END PAGE LEVEL JS-->


</body>

</html>
<script type="text/javascript">

var bigOrganogramData = [
  {
    "id": "1",
    "width": 250,
    "text": "<?php echo $cap_data['position_Name'];?>",
    "title": "<?php echo $cap_data['res_fName'].' '.$cap_data['res_mName'].' '.$cap_data['res_lName'].' '.$suffix;?>",
    "img": "<?php echo $cimg;?>"
  },
  {
    "id": "2",
    "width": 250,
    "text": "<?php echo $sec_data['position_Name'];?>",
    "title": "<?php echo $sec_data['res_fName'].' '.$sec_data['res_mName'].' '.$sec_data['res_lName'].' '.$suffix1;?>",
    "img": "<?php echo $secimg;?>",
    "parent": 1,
    "dir": "vertical"
  },
  {
    "id": "3",
    "text": "Barangay Officials",
    "title": "",
    "img": "",
    "parent": 1
  },
  
  {
    "id": "4",
    "width": 250,
    "text": "<?php echo $tre_data['position_Name'];?>",
    "title": "<?php echo $tre_data['res_fName'].' '.$tre_data['res_mName'].' '.$tre_data['res_lName'].' '.$suffix2;?>",
    "img": "<?php echo $treimg;?>",
    "parent": 1,
    "dir": "vertical"
  },
  <?php 

function loop(array $parents, $need,$index,$name,$position_Name,$official_img)
{
    
    $children = [];
    $isLast = $need === 1;
    $lastKey = count($parents) - 1;
    
    foreach ($parents as $key => $parent) {
        $p_name = $name[$index];
        $pos_Name = $position_Name[$index];
        $img = $official_img[$index];
        $id = $parent === 3 ? $key + 1 : 1;
        $children[] = $child = "$parent.$id";
        $comma = $isLast && $key === $lastKey ? '' : ',';
        echo "{
        \"id\":\"$child\",
        \"text\": \"$pos_Name\",
        \"title\": \"$p_name\",
        \"width\": 350,
        \"img\": \"$img\",
        \"parent\":\"$parent\"
         }$comma";
    }
    $index++;
    $need--;

    if ($need) {
        return loop($children, $need,$index,$name,$position_Name,$official_img);
    }

    return $children;
}

$index = 0;
loop([3], $count_official,$index,$name,$position_Name,$official_img);
  ?>

];


    var diagram = new dhx.Diagram(document.body, { 
      type: "org",
      defaultShapeType: "img-card",
      scale : 0.9,
      controls: { 
        import: true,
        export: true,
        gridStep: false,
        autoLayout: false,
        apply: false,
        reset: false
    }
    });
    diagram.data.parse(bigOrganogramData);

    $(".dhx_diagram").appendTo("#test");

    

  </script>