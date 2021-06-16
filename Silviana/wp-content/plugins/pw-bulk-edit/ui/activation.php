<?php

/*
Copyright (C) 2016-2017 Pimwick, LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="pwbe-activation-main" class="pwbe-activation-main">
	<div class="pwbe-activation-p">Need more power? Upgrade to Pro and you can do things like: <span id="pwbe-features"></span></div>
	<div class="pwbe-heading"><a href="https://www.pimwick.com/pw-bulk-edit/" target="_blank">See what else the Pro version can do</a></div>
</div>
<br />
<script>
	var pwbeFeatures = [
		"Bulk edit Sale Price, Sale Start Date, and Sale End Date",
		"Bulk change the Sale price based on Regular price",
		"Edit any of YOUR custom Attributes",
		"Set default values for Variable products",
		"Edit Categories",
		"Edit the Short Description field",
		"Edit the Sold Individually field",
		"Edit Tags",
		"Edit Variation Descriptions",
		"Edit dimensions (Weight, Length, Width, and Height)",
		"Edit the Shipping Class",
		"Use \"Is Empty\" and \"Is Not Empty\" filter options",
		"Filter by Status, Variation Description, and more",
		"Save and load filters"
	];

	jQuery(document).ready(function() {
		pwbeFeatureTicker();
		setInterval(pwbeFeatureTicker, 5000);
	});

	function pwbeFeatureTicker() {
		var feature = pwbeFeatures[Math.floor(Math.random() * pwbeFeatures.length)];
		jQuery('#pwbe-features').text(feature);
	}

</script>