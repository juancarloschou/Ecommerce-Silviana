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
<span id="pwbe-dialog-content-number" class="pwbe-dialog-content" data-function="pwbeBulkEditorNumberHandler">
	<fieldset class="pwbe-bulkedit-editor-number-mode">
		<input type="radio" value="fixed" name="pwbe-bulkedit-editor-number-mode" id="pwbe-bulkedit-editor-number-mode-fixed" /> <label for="pwbe-bulkedit-editor-number-mode-fixed">Set to fixed value</label><br />
		<input type="radio" value="increase" name="pwbe-bulkedit-editor-number-mode" id="pwbe-bulkedit-editor-number-mode-increase" /> <label for="pwbe-bulkedit-editor-number-mode-increase">Increase</label><br />
		<input type="radio" value="decrease" name="pwbe-bulkedit-editor-number-mode" id="pwbe-bulkedit-editor-number-mode-decrease" /> <label for="pwbe-bulkedit-editor-number-mode-decrease">Decrease</label>
	</fieldset>
	<div class="pwbe-bulkedit-editor-mode-container">
		<div class="form-field">
			<div class="pwbe-bulkedit-details pwbe-bulkedit-details-fixed">
				<label for="pwbe-bulkedit-fixed-value">Set <span class="pwbe-bulkedit-field-name"></span> to the following value:</label><br />
				<input type="text" id="pwbe-bulkedit-fixed-value" name="pwbe-bulkedit-fixed-value" />
			</div>

			<div class="pwbe-bulkedit-details pwbe-bulkedit-details-increase">
				<label for="pwbe-bulkedit-increase-value">Increase <span class="pwbe-bulkedit-field-name"></span> by the following value:</label><br />
				<input type="text" id="pwbe-bulkedit-increase-value" name="pwbe-bulkedit-increase-value" /><br />
			</div>

			<div class="pwbe-bulkedit-details pwbe-bulkedit-details-decrease">
				<label for="pwbe-bulkedit-decrease-value">Decrease <span class="pwbe-bulkedit-field-name"></span> by the following value:</label><br />
				<input type="text" id="pwbe-bulkedit-decrease-value" name="pwbe-bulkedit-decrease-value" />
				<p><input type="checkbox" class="pwbe-bulkedit-allow-negative" id="pwbe-bulkedit-decrease-allow-negative" checked><label for="pwbe-bulkedit-decrease-allow-negative">Allow values to be less than zero.</label></p>
			</div>

		</div>
	</div>
</span>
<style>
	#pwbe-dialog-content-number {
		white-space: nowrap;
	}

	.pwbe-bulkedit-editor-number-mode, .pwbe-bulkedit-editor-mode-container {
		display: inline-block;
		vertical-align: top;
	}

	.pwbe-bulkedit-editor-mode-container {
		padding-left: 30px;
		min-width: 300px;
	}

	.pwbe-bulkedit-details {
		display: none;
	}
</style>
<script>

	jQuery(function() {
		jQuery('.pwbe-bulkedit-editor-number-mode').find('input[type=radio]').change(function() {
			var dialog = jQuery('#pwbe-dialog-content-number');
			var details = dialog.find('.pwbe-bulkedit-details-' + jQuery(this).val());
			dialog.find('.pwbe-bulkedit-details').hide();
			details.show().find('input:first').focus();
		});

		jQuery('#pwbe-dialog-content-number').find('#pwbe-bulkedit-fixed-value, #pwbe-bulkedit-increase-value, #pwbe-bulkedit-decrease-value').keydown(function(e) {
			if (e.keyCode == 13) {
				jQuery('#pwbe-bulkedit-dialog-button-apply').trigger('click');
				e.preventDefault();
				return false;
			}
		});
	});

	function pwbeBulkEditorNumberHandler(action, oldValue) {
		var dialog = jQuery('#pwbe-dialog-content-number');
		var fieldName = dialog.attr('data-field-name');
		var fixed = dialog.find('#pwbe-bulkedit-fixed-value');
		var increase = dialog.find('#pwbe-bulkedit-increase-value');
		var decrease = dialog.find('#pwbe-bulkedit-decrease-value');
		var allowNegative = dialog.find('.pwbe-bulkedit-allow-negative:visible:first');
		var mode = dialog.find('input[name=pwbe-bulkedit-editor-number-mode]:checked').first();
        var thousandSeparator = jQuery('#pwbe-price-thousand-separator').val();
        var decimalSeparator = jQuery('#pwbe-price-decimal-separator').val();

		switch (action) {
			case 'init':
				dialog.find('.pwbe-bulkedit-field-name').text(fieldName);
			break;

			case 'apply':
				if (!mode.val()) {
					return oldValue;
				}

				var newValue = 0;

				if (oldValue) {
					oldValue = parseFloat(oldValue.replace(thousandSeparator, '').replace(decimalSeparator, '.'));
					newValue = oldValue;
				}

				switch (mode.val()) {
					case 'fixed':
						if (fixed.val()) {
							newValue = fixed.val();
						}
					break;

					case 'increase':
						if (increase.val()) {
							newValue = oldValue + parseFloat(increase.val().replace(thousandSeparator, '').replace(decimalSeparator, '.'));
						}
					break;

					case 'decrease':
						if (decrease.val()) {
							newValue = oldValue - parseFloat(decrease.val().replace(thousandSeparator, '').replace(decimalSeparator, '.'));
						}
					break;
				}

				if (allowNegative && !allowNegative.prop('checked') && newValue < 0) {
					newValue = 0;
				}

				return newValue;
			break;

			case 'reset':
				mode.prop('checked', false);
				fixed.val('');
				increase.val('');
				decrease.val('');
				dialog.find('.pwbe-bulkedit-allow-negative').prop('checked', true);
				dialog.find('.pwbe-bulkedit-details').hide();
			break;
		}
	}

</script>