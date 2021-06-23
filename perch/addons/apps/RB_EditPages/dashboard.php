<?php 

	include_once(PERCH_CORE.'/apps/content/PerchContent_Pages.class.php');
	include_once(PERCH_CORE.'/apps/content/PerchContent_Page.class.php');
	include_once(PERCH_CORE.'/apps/content/PerchContent_Regions.class.php');
	include_once(PERCH_CORE.'/apps/content/PerchContent_Region.class.php');
	include_once(PERCH_CORE.'/apps/content/PerchContent_Items.class.php');
	include_once(PERCH_CORE.'/apps/content/PerchContent_Item.class.php');
	include_once(PERCH_CORE.'/apps/content/PerchContent_NavGroup.class.php');
  include_once(PERCH_CORE.'/apps/content/PerchContent_NavGroups.class.php');
	
	$Pages = new PerchContent_Pages;
	$Regions = new PerchContent_Regions;
	$Items = new PerchContent_Items;

	// Stylesheet is loaded 
	// 	- Default Pages and Forms widgets are un-displayed
	//	- Styles for table 
	$stylesheet = $HTML->encode(PERCH_LOGINPATH.'/addons/apps/RB_EditPages/edit_pages_from_dashboard.css');


	// Retrieve all pages from navigationgroup (false = get all pages)
	// $pages = $Pages->get_by_parent(0, $navGroupID);
	$pages = $Pages->get_by_parent(0);

?>

<link rel="stylesheet" href="<?php echo $stylesheet ?>" />

<div class="no-widget">
	<header class="title-panel">
	<h1>Edit pages and region items</h1>
</header>
	<div class="bd">
		<?php
		
		// Loop through pages 
		if (PerchUtil::count($pages)) {
			foreach($pages as $Page) {

				$PageHtml  = "";	// Keeps the HTML for the page
				$ItemsHtml = "";	// Keeps the HTML for all the items on the pag				
				
				
				// Make html page string to echo on screen later
				$PageHtml .=  '<tr >';
				$PageHtml .=   	'<th colspan="2">';
				$PageHtml .=   		'<a class="pageName sidebar-back" href="'.PerchUtil::html(PERCH_LOGINPATH.'/core/apps/content/page/?id='.$Page->id()).'">';
				$PageHtml .=      	PerchUtil::html($Page->pageNavText());
				$PageHtml .=   		'</a>';
				$PageHtml .=   	'</th>';
				$PageHtml .=  '</tr>';

				
				// Start to fill the regions of this page
				$regions = $Regions->get_for_page($Page->id(), $include_shared=true, $new_only=false, $template=false);

					if (PerchUtil::count($regions)) {
						foreach($regions as $Region) {
							if ($Region->role_may_view($CurrentUser, $Settings)) {
																
								// Show the Content Items
								$cols = $Region->get_edit_columns();
								$items = $Items->get_for_Region($Region->regionID(), $Region->regionRev());
								
								if (PerchUtil::count($items)) {
																
									
									// Echo all the items from this page that are visibile to this user
									foreach($items as $Item) {

										$details = PerchUtil::json_safe_decode($Item->itemJSON());

										// I put the class 'index' on here, its a default Perch class for hover color 
										$ItemsHtml	.= '<tr><td><a class="dashboardItem index" href="'.PerchUtil::html(PERCH_LOGINPATH)
													.'/core/apps/content/edit/?id=' 
													.PerchUtil::html($Region->id()) 
													.'&amp;itm='.PerchUtil::html($Item->itemId()).'">';
										if ($details->_title != "") {
											$ItemsHtml .= $details->_title;  // Make sure you have a template field which has the argument: title="true"
										} else {
											// There is no template field which has the argument: title="true", so display 'Item' and a warning
											// old text: (add title=true-field in template)
											$ItemsHtml .= "item <span class='special'>(no title=true in template for this item)</span>";
										}			
										$ItemsHtml .= '</a></td>';
										$ItemsHtml .= '<td class="regionName">'.$Region->regionKey().'</td>';
									}
							
								}
							}	
						}
						// Only echo the Page if there are showable items on it
						if ($ItemsHtml != ""){
							echo '<table class="pageslist">';
							echo $PageHtml;
							echo $ItemsHtml;
							echo '</table>';
							
						}
					}

			}
		}
				
		
		?>

		
	</div>

</div>