	<h3 class="surstudio_plugin_translator_revolution_dropdown_title surstudio_plugin_translator_revolution_dropdown_title_10">
		Cached translations (<span class="surstudio_plugin_translator_revolution_dropdown_selected_label">{{ from_language }} &gt; {{ to_language }}</span>)
		<span class="surstudio_plugin_translator_revolution_dropdown_cached_translations_search_container">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td><input class="surstudio_plugin_translator_revolution_dropdown_input" name="surstudio_translations_search" id="surstudio_translations_search" type="text" value="" onkeypress="return SurStudioPluginTranslatorRevolutionDropDownAdmin.preSearchTranslation(event);" /></td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td><input class="button submit-button reset-button" type="button" value="Search" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.searchTranslation(); return false;">
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td><input class="button submit-button reset-button" type="button" value="Reset" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.resetSearchTranslation(true); return false;">
				</tr>
			</table>
		</span>
	</h3>
	<div class="surstudio_plugin_translator_revolution_dropdown_setting">
		<div class="surstudio_plugin_translator_revolution_dropdown_field surstudio_plugin_translator_revolution_dropdown_cached_translations_container">
			<table border="0" cellpadding="0" cellspacing="0">
{{ cached_translations_fields_formatted }}
			</table>
		</div>	
	</div>
