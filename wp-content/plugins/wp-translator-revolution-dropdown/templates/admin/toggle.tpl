<div class="surstudio_plugin_translator_revolution_dropdown_section surstudio_plugin_translator_revolution_dropdown_{{ type }}{{ dependence.show.false:begin }} surstudio_plugin_translator_revolution_dropdown_no_display{{ dependence.show.false:end }}{{ has_dependence.true:begin }} surstudio_plugin_translator_revolution_dropdown_section_tabbed_{{ dependence_count }}{{ has_dependence.true:end }}" id="section_{{ id }}">
	
	<div class="surstudio_plugin_translator_revolution_dropdown_tooltip"></div>
	<div class="surstudio_plugin_translator_revolution_dropdown_description surstudio_plugin_translator_revolution_dropdown_no_display">{{ description_message }}</div>
		
	<h3 class="surstudio_plugin_translator_revolution_dropdown_title">{{ title_message }}</h3>
	<div class="surstudio_plugin_translator_revolution_dropdown_setting">
		<div class="surstudio_plugin_translator_revolution_dropdown_field" id="{{ id }}">
			<div class="surstudio_plugin_translator_revolution_dropdown_toggle_container">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><input type="radio" name="{{ name }}" value="{{ value_true }}"{{ value_true.checked.true:begin }} checked="checked"{{ value_true.checked.true:end }} id="{{ id }}_true" class="surstudio_plugin_translator_revolution_dropdown_radio_option"></td>
						<td><label for="{{ id }}_true">{{ option_true }}</label></td>
					</tr>
				</table>
			</div>
			<div class="surstudio_plugin_translator_revolution_dropdown_toggle_container">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><input type="radio" name="{{ name }}" value="{{ value_false }}"{{ value_false.checked.true:begin }} checked="checked"{{ value_false.checked.true:end }} id="{{ id }}_false" class="surstudio_plugin_translator_revolution_dropdown_radio_option"></td>
						<td><label for="{{ id }}_false">{{ option_false }}</label></td>
					</tr>
				</table>
			</div>
		</div>
		{{ has_dependence.true:begin }}
		<input type="hidden" name="{{ id }}_dependence" id="{{ id }}_dependence" value="{{ formatted_dependence }}" />
		<input type="hidden" name="{{ id }}_dependence_show_value" id="{{ id }}_dependence_show_value" value="{{ formatted_dependence_show_value }}" />
		{{ has_dependence.true:end }}
		<div class="surstudio_plugin_translator_revolution_dropdown_clear"></div>
	
	</div>
</div>
