<?php include("base.php"); 
$_SESSION['login']=1;
$home=new main();
unset($_SESSION['login']);
$cselect="<option value=''>Select</option>".$home->__list_country();
$sselect="<option value=''>--None--</option>";
$dselect="<option value=''>--None--</option>";
$tselect="<option value=''>--None--</option>";
 $query="select * from company_name where  Blocked=0 and Deleted=0 and main=?";
 $array=array(2);
 $address="Perundurai, Tamilnadu, India";
 $zoom=10;
 $result=array();
 $result11=array();
 $result12=array();
 $result13=array();
 $result14=array();
 $noresult="";
 if(isset($_POST['submit']))
{
	
	if(!empty($_POST['country']))
	{
		
		$country=$home->sanitize($_POST['country'],'numeric',500);
		$address=$home->get_country($country);
		$ncountry=$home->get_country($country);
		$query="select * from company_name where country=? AND Blocked=0 and Deleted=0";
		$array=array($country);
		$cselect=$home->__select_country($country);
		$sselect="<option value=''>Select</option>".$home->__list_state($country);
		$dselect="<option value=''>--None--</option>";
		$tselect="<option value=''>--None--</option>";
		$stmt=$home->db->prepare($query);
		$stmt->bind_param('s',$array[0]);
		$stmt->execute();
		$res = $stmt->get_result();
		while($row=$res->fetch_assoc())
		{
				$result11[]=$row;
		}
		if(empty($result11))
		{
			$noresult="No Result Found in ".$address;
		}
	}
	if(!empty($_POST['state']))
	{
		$country=$home->sanitize($_POST['country'],'numeric',500);
		$state=$home->sanitize($_POST['state'],'numeric',500);
		$nstate=$home->get_country($state);
		$address=$home->get_state($state).", ".$home->get_country($country);
		$query="select * from company_name where state=? AND Blocked=0 and Deleted=0";
		$array=array($state);
		$cselect=$home->__select_country($country);
		$sselect="<option value=''>--None--</option>".$home->__select_state($country,$state);
		$dselect="<option value=''>Select</option>".$home->__list_district($state);
		$tselect="<option value=''>--None--</option>";
		$stmt2=$home->db->prepare($query);
		$stmt2->bind_param('s',$array[0]);
		$stmt2->execute();
		$res2 = $stmt2->get_result();
		while($row2=$res2->fetch_assoc())
		{
				$result12[]=$row2;
		}
		if(empty($result12))
		{
			$noresult="No Result Found in ".$address;
		}
	}
	if(!empty($_POST['district']))
	{
		$country=$home->sanitize($_POST['country'],'numeric',500);
		$state=$home->sanitize($_POST['state'],'numeric',500);
		$district=$home->sanitize($_POST['district'],'numeric',500);
		$ndist=$home->get_country($district);
		$address=$home->get_district($district).", ".$home->get_state($state).", ".$home->get_country($country);
		$query="select * from company_name where district=? AND Blocked=0 and Deleted=0";
		$array=array($district);
		$cselect=$home->__select_country($country);
		$sselect="<option value=''>--None--</option>".$home->__select_state($country,$state);
		$dselect="<option value=''>--None--</option>".$home->__select_district($state,$district);
		$tselect="<option value=''>Select</option>".$home->__list_taluk($district);
		$stmt3=$home->db->prepare($query);
		$stmt3->bind_param('s',$array[0]);
		$stmt3->execute();
		$res3 = $stmt3->get_result();
		while($row3=$res3->fetch_assoc())
		{
				$result13[]=$row3;
		}
		if(empty($result13))
		{
			$noresult="No Result Found in ".$address;
		}
	}
	if(!empty($_POST['taluk']))
	{
		$country=$home->sanitize($_POST['country'],'numeric',500);
		$state=$home->sanitize($_POST['state'],'numeric',500);
		$district=$home->sanitize($_POST['district'],'numeric',500);
		$taluk=$home->sanitize($_POST['taluk'],'numeric',500);
		$address=$home->get_taluk($taluk).", ".$home->get_district($district).", ".$home->get_state($state).", ".$home->get_country($country);
		$ntaluk=$home->get_country($taluk);
		$query="select * from company_name where Taluk=? AND Blocked=0 and Deleted=0";
		$array=array($taluk);
		$cselect=$home->__select_country($country);
		$sselect="<option value=''>--None--</option>".$home->__select_state($country,$state);
		$dselect="<option value=''>--None--</option>".$home->__select_district($state,$district);
		$tselect="<option value=''>--None--</option>".$home->__select_taluk($district,$taluk);
		$stmt4=$home->db->prepare($query);
		$stmt4->bind_param('s',$array[0]);
		$stmt4->execute();
		$res4 = $stmt4->get_result();
		while($row4=$res4->fetch_assoc())
		{
				$result14[]=$row4;
		}
		if(empty($result13))
		{
			$noresult="No Result Found in ".$address;
		}
	}
}
$query1="select * from company_name where  Blocked=0 and Deleted=0 and main=?";
 $array1=array(1);
 $stmt1=$home->db->prepare($query1);
$stmt1->bind_param('s',$array1[0]);
$stmt1->execute();

$res1= $stmt1->get_result();
$result1=array();
while($row1=$res1->fetch_assoc())
{
	
	$result1[]=$row1;
}
if(!empty($result14))
{
	$result=$result14;
}
elseif(!empty($result13))
{
	$result=$result13;
}
elseif(!empty($result12))
{
	$result=$result12;
}
elseif(!empty($result11))
{
	$result=$result11;
}
/*print_r($result);*/
//$googlemaps=['Perundurai Head Office', 11.281826,77.595853, 4];
$maps2="";
$i=0;
$count=count($result);
/*print_r($result);
print_r($count);*/
foreach($result as $maps)
{
	if(!empty($maps['latlang']))
	{
		
	
	$i++;
	
	    $maps2.="['".$maps['Company']."', ".$maps['latlang'].", ".$i."],";	
	
	}
	
}
/*print_r($maps2);*/
		
?>
<!DOCTYPE html>

<!--[if IE 7]>

<html class="ie ie7" lang="en-US">

<![endif]-->

<!--[if IE 8]>

<html class="ie ie8" lang="en-US">

<![endif]-->

<!--[if !(IE 7) | !(IE 8)  ]><!-->

<html lang="en-US">

<!--<![endif]-->

<head>

<meta charset="UTF-8" />

<meta name="viewport" content="width=device-width" />

<title>About us | MWS Sales</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="http://demo.mwssales.in/xmlrpc.php" />


<!--[if lt IE 9]>

<script src="http://demo.mwssales.in/wp-content/themes/iconic-one/js/html5.js" type="text/javascript"></script>



<![endif]-->

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


<script type="text/javascript">
window.document.onkeydown = function (e)
{
if (!e) e = event;
if (e.keyCode == 27)
{
document.getElementById('contact').style.display='none';
document.getElementById('bg').style.display='none';
document.getElementById('cross').style.display='none';
}
}
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjX31r0KWLWmzWUCuz4XKZxcqhj9v84eE"></script>
<script>
// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to
// (0,32) to correspond to the base of the flagpole.

function initialize() {
  var mapOptions = {
    zoom: <?php echo $zoom; ?>,
    center: new google.maps.LatLng(11.2,77.5)
  }
  var address = "<?php echo $address; ?>";
var geocoder = new google.maps.Geocoder();
geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        map.fitBounds(results[0].geometry.bounds);
    } else {
        alert("Geocode was not successful for the following reason: " + status);
    }
});
  var map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);

  setMarkers(map, beaches);
}

/**
 * Data for the markers consisting of a name, a LatLng and a zIndex for
 * the order in which these markers should display on top of each
 * other.
 */

 var beaches = [
 <?php  echo $maps2; ?>
];
  


function setMarkers(map, locations) {
  // Add markers to the map

  // Marker sizes are expressed as a Size of X,Y
  // where the origin of the image (0,0) is located
  // in the top left of the image.

  // Origins, anchor positions and coordinates of the marker
  // increase in the X direction to the right and in
  // the Y direction down.
  var image = {
    url: 'administrator/img/map-icon.png',
    // This marker is 20 pixels wide by 32 pixels tall.
   size: new google.maps.Size(30, 42),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    anchor: new google.maps.Point(20, 42)
  };
  // Shapes define the clickable region of the icon.
  // The type defines an HTML &lt;area&gt; element 'poly' which
  // traces out a polygon as a series of X,Y points. The final
  // coordinate closes the poly by connecting to the first
  // coordinate.
  var shape = {
      coords: [1, 1, 1, 30, 42, 30, 42 , 1],
      type: 'poly'
  };
  for (var i = 0; i < locations.length; i++) {
    var beach = locations[i];
    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image,
        shape: shape,
        title: beach[0],
        zIndex: beach[3]
    });
    
  }
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>



<meta name='robots' content='noindex,follow' />
<link rel="alternate" type="application/rss+xml" title="MWS Sales &raquo; Feed" href="http://demo.mwssales.in/feed/" />
<link rel="alternate" type="application/rss+xml" title="MWS Sales &raquo; Comments Feed" href="http://demo.mwssales.in/comments/feed/" />
<link rel='stylesheet' id='cssnews-css'  href='http://demo.mwssales.in/wp-content/plugins/sp-news-and-widget/css/stylenews.css?ver=4.1.5' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='http://demo.mwssales.in/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='colorbox_style-css'  href='http://demo.mwssales.in/wp-content/plugins/form-lightbox/colorbox/style-1/colorbox.css?ver=4.1.5' type='text/css' media='all' />
<link rel='stylesheet' id='bwg_frontend-css'  href='http://demo.mwssales.in/wp-content/plugins/photo-gallery/css/bwg_frontend.css?ver=1.2.41' type='text/css' media='all' />
<link rel='stylesheet' id='bwg_font-awesome-css'  href='http://demo.mwssales.in/wp-content/plugins/photo-gallery/css/font-awesome/font-awesome.css?ver=4.2.0' type='text/css' media='all' />
<link rel='stylesheet' id='bwg_mCustomScrollbar-css'  href='http://demo.mwssales.in/wp-content/plugins/photo-gallery/css/jquery.mCustomScrollbar.css?ver=1.2.41' type='text/css' media='all' />
<link rel='stylesheet' id='themonic-fonts-css'  href='http://fonts.googleapis.com/css?family=Ubuntu:400,700&#038;subset=latin,latin-ext' type='text/css' media='all' />
<link rel='stylesheet' id='themonic-style-css'  href='http://demo.mwssales.in/wp-content/themes/iconic-one/style.css?ver=4.1.5' type='text/css' media='all' />
<link rel='stylesheet' id='custom-style-css'  href='http://demo.mwssales.in/wp-content/themes/iconic-one/custom.css?ver=4.1.5' type='text/css' media='all' />
<!--[if lt IE 9]>
<link rel='stylesheet' id='themonic-ie-css'  href='http://demo.mwssales.in/wp-content/themes/iconic-one/css/ie.css?ver=20130305' type='text/css' media='all' />
<![endif]-->
<link rel='stylesheet' id='msl-main-css'  href='http://demo.mwssales.in/wp-content/plugins/master-slider/public/assets/css/masterslider.main.css?ver=2.1.2' type='text/css' media='all' />
<link rel='stylesheet' id='msl-custom-css'  href='http://demo.mwssales.in/wp-content/uploads/master-slider/custom.css?ver=15.7' type='text/css' media='all' />
<script type='text/javascript' src='http://demo.mwssales.in/wp-includes/js/jquery/jquery.js?ver=1.11.1'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/sp-news-and-widget/js/jcarousellite.js?ver=4.1.5'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/form-lightbox/colorbox/jquery.colorbox-min.js?ver=1.4.33'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/photo-gallery/js/bwg_frontend.js?ver=1.2.41'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/photo-gallery/js/jquery.mobile.js?ver=1.2.41'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/photo-gallery/js/jquery.mCustomScrollbar.concat.min.js?ver=1.2.41'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/photo-gallery/js/jquery.fullscreen-0.4.1.js?ver=0.4.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var bwg_objectL10n = {"bwg_field_required":"field is required.","bwg_mail_validation":"This is not a valid email address.","bwg_search_result":"There are no images matching your search."};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/photo-gallery/js/bwg_gallery_box.js?ver=1.2.41'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://demo.mwssales.in/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://demo.mwssales.in/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 4.1.5" />
<link rel='canonical' href='http://demo.mwssales.in/about-us/' />
<link rel='shortlink' href='http://demo.mwssales.in/?p=7' />
<script>var ms_grabbing_curosr = 'http://demo.mwssales.in/wp-content/plugins/master-slider/public/assets/css/common/grabbing.cur', ms_grab_curosr = 'http://demo.mwssales.in/wp-content/plugins/master-slider/public/assets/css/common/grab.cur';</script>
<meta name="generator" content="MasterSlider 2.1.2 - Responsive Touch Image Slider | www.avt.li/msf" />
	<script type="text/javascript">
	
jQuery(function() {
	 jQuery(".newsticker-jcarousellite").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 3,
		auto: 500,
		speed:2000,
	});  
	 jQuery(".newstickerthumb-jcarousellite").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 3,
		auto: 500,
		speed:2000,  
	}); 
});
</script>
	
</head>

<body class="page page-id-7 page-template-default _masterslider _ms_version_2.1.2 custom-font-enabled single-author">



<ul class="floater">

<li><a href="https://www.facebook.com/mobitechwireless"><img src="http://getln.com/mws/wp-content/uploads/2015/02/facebook-icon.png"></a></li>

<li><a href="https://twitter.com/mobilestarter"><img src="http://getln.com/mws/wp-content/uploads/2015/02/twitter-icon.png"></a></li>

<li><a href="https://www.linkedin.com/company/mobitech-wireless-solution"><img src="http://getln.com/mws/wp-content/uploads/2015/02/google-plus.png"></a></li>

<li><a href="http://www.pinterest.com"><img src="http://getln.com/mws/wp-content/uploads/2015/02/pinterest-icon.png"></a></li>

<li><a href="https://www.linkedin.com/company/mobitech-wireless-solution"><img src="http://getln.com/mws/wp-content/uploads/2015/02/linkedin-icon.png"></a></li>

</ul>



<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">



		

	

		<hgroup>

			<a class="logo" href="http://demo.mwssales.in/" title="MWS Sales" rel="home"><img src="http://getln.com/mws/wp-content/uploads/2015/02/logo.png"></a>

		</hgroup>



	



		<nav id="site-navigation" class="themonic-nav" role="navigation">

			<a class="assistive-text" href="#content" title="Skip to content">Skip to content</a>

			<div class="menu-menu-1-container"><ul id="menu-top" class="nav-menu"><li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-98"><a href="http://demo.mwssales.in/">Home</a></li>
<li id="menu-item-97" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-7 current_page_item menu-item-97"><a href="http://demo.mwssales.in/about-us/">About us</a></li>
<li id="menu-item-604" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-604"><a href="#">Products</a>
<ul class="sub-menu">
	<li id="menu-item-681" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-681"><a href="#">Agri Automation</a>
	<ul class="sub-menu">
		<li id="menu-item-684" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-684"><a href="http://demo.mwssales.in/direct-online-starter-dol/">Direct Online Starter DOL</a></li>
		<li id="menu-item-685" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-685"><a href="http://demo.mwssales.in/drip-irrigation-valve-controller-v5/">Drip Irrigation Valve Controller V5</a></li>
		<li id="menu-item-608" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-608"><a href="http://demo.mwssales.in/drip-irrigation-valve-controller-v20/">Drip Irrigation Valve Controller V20</a></li>
		<li id="menu-item-686" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-686"><a href="http://demo.mwssales.in/star-delta-starter/">Star Delta Starter</a></li>
	</ul>
</li>
	<li id="menu-item-682" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-682"><a href="#">Industrial Automation</a>
	<ul class="sub-menu">
		<li id="menu-item-687" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-687"><a href="http://demo.mwssales.in/wireless-temperature-indicator/">Wireless Temperature Indicator</a></li>
	</ul>
</li>
	<li id="menu-item-683" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-683"><a href="#">Building Management System</a>
	<ul class="sub-menu">
		<li id="menu-item-688" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-688"><a href="http://demo.mwssales.in/water-level-indicator/">Water Level Indicator</a></li>
	</ul>
</li>
</ul>
</li>
<li id="menu-item-208" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-208"><a href="http://find.mwssales.in/find-reseller.php">Find Reseller</a></li>
<li id="menu-item-95" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-95"><a href="http://demo.mwssales.in/contact/">Contact</a></li>
</ul></div>
		</nav><!-- #site-navigation -->

		<div class="clear"></div>

	</header><!-- #masthead -->



	<div id="main" class="wrapper">
	<div id="primary" class="site-content1">
		<div id="content" role="main">

							
	<div id="content" role="main">
		<div class="company_list">
	
		<ul>
		<?php foreach($result1 as $data1){ ?>
			<li <?php if($data1['main']) { ?> class="special1" <?php } ?>>
				<span class="title11"><?php echo $data1['Company']; ?></span>
				<span class="title">Contact</span><span class="title1"><?php echo $data1['PhoneNo1']; if(!empty($data1['PhoneNo2'])){ echo ", ".$data1['PhoneNo2'];} ?></span>
				<span class="title">Address</span><span class="title1"><?php echo $data1['Address']."<br>".$home->get_taluk($data1['Taluk'])."(Tk)  ,".$home->get_district($data1['District'])."(Dt)  ,".$home->get_state($data1['State'])." - ".$home->get_country($data1['Country']); ?></span>
				<span class="clear"></span>
				<span class="title">Email</span><span class="title1"><?php echo $data1['Email']; ?></span>
				
			</li>
			<?php } ?>
			</ul>
	</div>
		<form action="find-reseller.php" method="post" id="frm">
			<h1 class="index-head">Find Reseller</h1>
			<div class="entry-summary">
				<div class="col-md-6 margin-form">
			     <label class="labe1">Country</label>
			     <select class="select1 form-control"  required id="drop1" name="country"  style="width:100%" >
			     
			     <?php echo $cselect; ?>
			     </select>
			     </div>
			     <div class="col-md-6 margin-form"> <label class="labe1">State</label>
			     <select class="select1 form-control"  id="drop2" name="state" style="width:100%" >
			     <?php echo $sselect; ?>
			     </select></div>
			     <div class="col-md-6 margin-form"><label class="labe1">District</label>
			     <select class="select1 form-control"  id="drop3" name="district" style="width:100%" >
			     <?php echo $dselect; ?>
			     </select></div>
			     <div class="col-md-6 margin-form"><label class="labe1">Taluk</label>
			     <select class="select1 form-control"  id="drop4" name="taluk" style="width:100%" >
			    <?php echo $tselect; ?>
			     </select></div>
     <div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="margin-form">
		<input type="submit" value="Search" name="submit" id="submit" >
	</div>
			</form>
		</div><!-- #content -->
	
	<div class="company_list">
	<?php 
		/*echo "<div class='no'>".$noresult."</div>";*/
	 ?>
		<ul>
		<?php foreach($result as $data){ ?>
			<li <?php if($data['main']) { ?> class="special" <?php } ?>>
				<span class="title11"><?php echo $data['Company']; ?></span>
				<span class="title">Contact</span><span class="title1"><?php echo $data['PhoneNo1']; if(!empty($data['PhoneNo2'])){ echo ", ".$data['PhoneNo2'];} ?></span>
				<span class="title">Address</span><span class="title1"><?php echo $data['Address']."<br>".$home->get_taluk($data['Taluk'])."(Tk)  ,".$home->get_district($data['District'])."(Dt)  ,".$home->get_state($data['State'])." - ".$home->get_country($data['Country']); ?></span>
				<span class="clear"></span>
				<span class="title">Email</span><span class="title1"><?php echo $data['Email']; ?></span>
				
			</li>
			<?php } ?>
			</ul>
	</div><!-- #post -->
				
			<!-- #comments -->

			
		</div><!-- #content -->
	</div><!-- #primary -->
	<div id="secondary" class="widget-area" role="complementary">


<div id="map-canvas"></div>
		</div>


	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">


		<div class="footer-box f-box-w" style="width:200px;">
			<h4>Products</h4>
			<ul>
				<li><a href="http://demo.mwssales.in/category/products/agri-automation/">Agriculture Automation</a></li>
				<li><a href="http://demo.mwssales.in/category/products/industrial-automation/">Industrial Automation</a></li>
				<li><a href="http://demo.mwssales.in/category/products/building-management-system/">Building Management</a></li>
			</ul>
		</div><!-- .footer-box -->


		<div class="footer-box">
			<p><b>Mobitech Wireless Solution</b><br/>
			1/4 Vengamedu, Erode Road, Perundurai(Tk), 
			Erode(Dt), Tamil Nadu - India.
			</p>

<div class="quote">
<a href="#" class="fl_box-1" title="Send me a message">Request Quote</a><div style="display:none"><div id="form-lightbox-1" style="padding: 10px; width:350px"><div class="wpcf7" id="wpcf7-f193-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form name="" action="/about-us/#wpcf7-f193-o1" method="post" class="wpcf7-form" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="193" />
<input type="hidden" name="_wpcf7_version" value="4.1.1" />
<input type="hidden" name="_wpcf7_locale" value="en_US" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f193-o1" />
<input type="hidden" name="_wpnonce" value="6d8b813dfd" />
</div>
<p>Your Name (required)<br />
    <span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span> </p>
<p>Your Email (required)<br />
    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></span> </p>
<p>Subject<br />
    <span class="wpcf7-form-control-wrap your-subject"><input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span> </p>
<p>Your Message<br />
    <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span> </p>
<p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit" /></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div></div></div>
		<script type="text/javascript">
			jQuery(document).ready(function() {jQuery(".fl_box-1").colorbox({
						inline: true, 
						transition : "elastic",speed : 350,scrolling : true,opacity : 0.85,returnFocus : true,fastIframe : true,closeBtn : true,escKey : true,
						href:"#form-lightbox-1"
					});});
		</script></div>
		</div><!-- .footer-box -->



		<div class="footer-address-box">
			<div style="color: #FFF;">
				<span>For Enquiry</span>
				<li><i class="fa fa-envelope-o"></i>sales@mobitechwireless.in<br/></li>
				<li><i class="fa fa-phone"></i>+91 80123 30000<br/></li>
				<li><i class="fa fa-mobile"></i>04294 226300</li>
			</div>
		</div>


		</footer><!-- #colophon -->

				<div class="clear"></div>

</div><!-- #page -->



<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/demo.mwssales.in\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ..."};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.1.1'></script>
<script type='text/javascript' src='http://demo.mwssales.in/wp-content/themes/iconic-one/js/selectnav.js?ver=1.0'></script>
<script>
 /*$('#spinner').ajaxStart(function () {
        $(this).fadeIn('fast');
    }).ajaxStop(function () {
        $(this).stop().fadeOut('fast');
    });*/
        	$(document).ready(function(){
        		$("#drop1").change(function(){

			var id=$("#drop1").val();
			$("#drop2").html("");
			$("#drop3").html("<option value=''>--None--</option>");
			$("#drop4").html("<option value=''>--None--</option>");
			
			
$.ajax({
				type: "POST",
				url: "fetch.php",
				data: "id="+id ,
				success: function(html){
					$('#drop2').html(html);
				}
			});
			});
			$("#drop2").change(function(){
				

			var id=$("#drop2").val();
			
			$("#drop3").html("");
			$("#drop4").html("<option value=''>--None--</option>");
			
			
$.ajax({
				type: "POST",
				url: "fetch.php",
				data: "sid="+id ,
				success: function(html){
					$('#drop3').html(html);
				}
			});
			});
			$("#drop3").change(function(){
				

			var id=$("#drop3").val();
			
			$("#drop4").html("");
			
			
$.ajax({
				type: "POST",
				url: "fetch.php",
				data: "did="+id ,
				success: function(html){
					$('#drop4').html(html);
				}
			});
			});
        		
        		});
        		
		/**/
			/*$("#frm").submit(function(e){
				$('.ajax').html("");
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "find.php",
				data: $("#frm").serialize() ,
				success: function(html){
					$('.ajax').html(html);
				}
			});
			
			
				});
        		*/
        		
        	
        	
        </script>
</body>

</html>