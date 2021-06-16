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
<div class="pwbe-filter">
	<?php require( 'activation.php' ); ?>
	<div class="pwbe-filter-container">
		<span class="pwbe-filter-toolbar-right">
			<a href="<?php echo $help_url; ?>" target="_blank" id="pwbe-help" class="pwbe-link pwbe-help-link"><i class="fa fa-fw fa-life-ring pwbe-link"></i> Help</a>
		</span>
		<div class="pwbe-filter-form">
			<div class="pwbe-pull-right">
				<span id="pwbe-hide-filters-button" class="pwbe-link pwbe-hidden" title="Hide Filters"><i class="fa fa-eye-slash fa-fw" aria-hidden="true"></i> Hide Filters</span>
				<span id="pwbe-show-filters-button" class="pwbe-link pwbe-hidden" title="Show Filters"><i class="fa fa-eye fa-fw" aria-hidden="true"></i> Show Filters</span>
			</div>
			<form id="pwbe-filters-form">
				<input type="hidden" id="pwbe-order-by" name="order_by" value="post_title" />
				<input type="hidden" id="pwbe-order-by-desc" name="order_by_desc" value="" />

				<div class="pwbe-filter-header">
					<span id="pwbe-header-multiple-filters" class="pwbe-pull-left">
						Find products that match
						<select id="pwbe-filter-group" name="main_group_type">
							<option value="pwbe_and">all</option>
							<option value="pwbe_or">any</option>
						</select>
						of the following rules:
					</span>
				</div>
				<div class="pwbe-filter-row-container">
					<hr class="pwbe-filter-container-break"/>
				</div>

				<button type="submit" id="pwbe-search-button" class="button"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
				<?php
					echo apply_filters( 'pwbe_html_after_search_button', '' );
				?>
			</form>
		</div>
	</div>
	<?php require( 'filters_help.php' ); ?>
</div>

<div class="pwbe-row-template-group pwbe-filter-row pwbe-filter-group-row" data-suffix="">
	<input type="hidden" name="row[]" value="group">

	<select name="filter_name" class="pwbe-filter-field pwbe-filter-name">
  		<option value="pwbe_and">all</option>
		<option value="pwbe_or">any</option>
	</select> of the following are true

	<input type="hidden" name="filter_type" class="pwbe-filter-type" value="" />

	<span class="pwbe-pull-right">
		<span class="pwbe-filter-link pwbe-filter-icon pwbe-filter-remove" title="Remove"><i class="fa fa-minus-square-o"></i></span>
		<span class="pwbe-filter-link pwbe-filter-icon pwbe-filter-add" title="Add a filter"><i class="fa fa-plus-square-o"></i></span>
	</span>

	<br />
	<span class="pwbe-filter-link pwbe-filter-criteria pwbe-filter-add" title="Add a filter"><i class="fa fa-plus-square-o"></i> Add a filter</span>
	<span class="pwbe-filter-link pwbe-filter-criteria pwbe-filter-add-group" title="Add a group of filters"><i class="fa fa-plus-square-o"></i> Add a Group of Filters</span>
	<span class="pwbe-filter-link pwbe-filter-criteria pwbe-filter-remove" title="Remove"><i class="fa fa-minus-square-o"></i> Remove</span>
	<hr class="pwbe-filter-container-break"/>
</div>

<div class="pwbe-row-template pwbe-filter-row" data-suffix="">
	<input type="hidden" name="row[]" value="">

	<select name="filter_name" class="pwbe-filter-field pwbe-filter-name">
		<?php
			foreach (PWBE_Filters::get() as $filter_name => $criteria) {
				$name = $criteria['name'];
				$type = $criteria['type'];

				echo "<option value=\"$filter_name\" data-type=\"$type\">$name</option>\n";
			}
		?>
	</select>

	<select name="filter_type" class="pwbe-filter-field pwbe-filter-type"></select>

	<input name="filter_value" class="pwbe-filter-field pwbe-filter-field-input pwbe-filter-value" type="text" value="" autocomplete="off" />

	<span class="pwbe-filter-required">
		* required
	</span>

	<span class="pwbe-pull-right">
		<span class="pwbe-filter-link pwbe-filter-icon pwbe-filter-remove" title="Remove"><i class="fa fa-minus-square-o"></i></span>
		<span class="pwbe-filter-link pwbe-filter-icon pwbe-filter-add" title="Add a filter"><i class="fa fa-plus-square-o"></i></span>
	</span>

	<br />
	<span class="pwbe-filter-link pwbe-filter-criteria pwbe-filter-add" title="Add a filter"><i class="fa fa-plus-square-o"></i> Add a filter</span>
	<span class="pwbe-filter-link pwbe-filter-criteria pwbe-filter-add-group" title="Add a group of filters"><i class="fa fa-plus-square-o"></i> Add a group of filters</span>
	<span class="pwbe-filter-link pwbe-filter-criteria pwbe-filter-remove" title="Remove"><i class="fa fa-minus-square-o"></i> Remove</span>
	<hr class="pwbe-filter-container-break"/>
</div>

<input name="filter_value" class="pwbe-filter-value-template pwbe-filter-field pwbe-filter-field-input pwbe-filter-value" type="text" value="" autocomplete="off" />

<span class="pwbe-filter-value2-template pwbe-filter-value2-container">
	to <input name="filter_value2" class="pwbe-filter-field pwbe-filter-field-input pwbe-filter-value2" type="text" value="" autocomplete="off" />
</span>

<span class="pwbe-filter-attributes-template pwbe-multiselect pwbe-filter-attributes-container">
	<select name="filter_select[]" class="pwbe-filter-field pwbe-filter-select pwbe-filter-value" multiple="multiple" ></select>
</span>

<span class="pwbe-multiselect pwbe-filter-categories-container pwbe-filter-categories-template">
	<select name="filter_select[]" class="pwbe-filter-field pwbe-filter-select pwbe-filter-value" multiple="multiple" ></select>
</span>

<span class="pwbe-multiselect pwbe-filter-tags-container pwbe-filter-tags-template">
	<select name="filter_select[]" class="pwbe-filter-field pwbe-filter-select pwbe-filter-value" multiple="multiple" ></select>
</span>
