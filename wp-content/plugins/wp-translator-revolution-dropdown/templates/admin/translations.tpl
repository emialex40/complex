<div id="surstudio_plugin_translator_revolution_dropdown_{{ type }}_loading" class="surstudio_plugin_translator_revolution_dropdown_section_loading surstudio_plugin_translator_revolution_dropdown_no_display"></div>
<div class="surstudio_plugin_translator_revolution_dropdown_section surstudio_plugin_translator_revolution_dropdown_{{ type }}{{ dependence.show.false:begin }} surstudio_plugin_translator_revolution_dropdown_no_display{{ dependence.show.false:end }}{{ has_dependence.true:begin }} surstudio_plugin_translator_revolution_dropdown_section_tabbed_{{ dependence_count }}{{ has_dependence.true:end }}" id="section_{{ id }}">
	
	<div class="surstudio_plugin_translator_revolution_dropdown_tooltip"></div>
	<div class="surstudio_plugin_translator_revolution_dropdown_description surstudio_plugin_translator_revolution_dropdown_no_display">{{ description_message }}</div>
		
	<h3 class="surstudio_plugin_translator_revolution_dropdown_title">{{ title_message }}</h3>
	<div class="surstudio_plugin_translator_revolution_dropdown_setting">
		<div class="surstudio_plugin_translator_revolution_dropdown_field">
{{ resource_formatted }}
		</div>	
	</div>
	
	<div id="{{ id }}_languages_container" class="surstudio_plugin_translator_revolution_dropdown_no_display">
		<h3 class="surstudio_plugin_translator_revolution_dropdown_title surstudio_plugin_translator_revolution_dropdown_title_10">Available languages (<span id="{{ id }}_language_resource" class="surstudio_plugin_translator_revolution_dropdown_selected_label"></span>)</h3>	
		<div class="surstudio_plugin_translator_revolution_dropdown_setting">
			<div class="surstudio_plugin_translator_revolution_dropdown_field">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<select class="surstudio_plugin_translator_revolution_dropdown_select" name="{{ id }}_languages" id="{{ id }}_languages">
							</select>
						</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>
							<input class="button submit-button reset-button" type="button" value="Select" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.selectLanguage(); return false;" />
						</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>
							<input class="button submit-button reset-button" type="button" value="Reset" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.resetLanguage(); return false;" />
						</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td id="{{ id }}_languages_loading"></td>
					</tr>
				</table>
			</div>	
		</div>
	</div>

	<div id="{{ id }}_cached_translations" class="surstudio_plugin_translator_revolution_dropdown_no_display"></div>
	
	<div id="{{ id }}_cached_translations_buttons" class="surstudio_plugin_translator_revolution_dropdown_no_display">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<input name="reset" type="button" value="Cancel &amp; close" class="button submit-button reset-button cancel-n-close-translations" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.resetCachedTranslations(); return false;" />
				</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td>
					<input class="button-primary save-translations" type="button" name="save" value="Save translations" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.saveCachedTranslations(); return false;" />
				</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td id="{{ id }}_cached_translations_loading"></td>
			</tr>
		</table>
		<div class="surstudio_plugin_translator_revolution_dropdown_cached_translations_saved surstudio_plugin_translator_revolution_dropdown_message surstudio_plugin_translator_revolution_dropdown_no_display">
			<p>{{ cached_translations_saved_message }}</p>
		</div>
	</div>
	
	{{ has_dependence.true:begin }}
	<input type="hidden" name="{{ id }}_dependence" id="{{ id }}_dependence" value="{{ formatted_dependence }}" />
	<input type="hidden" name="{{ id }}_dependence_show_value" id="{{ id }}_dependence_show_value" value="{{ formatted_dependence_show_value }}" />
	{{ has_dependence.true:end }}	
	<div class="surstudio_plugin_translator_revolution_dropdown_clear"></div>
	
</div>
