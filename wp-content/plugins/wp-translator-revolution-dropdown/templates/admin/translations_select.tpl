			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<select class="surstudio_plugin_translator_revolution_dropdown_select" name="{{ id }}" id="{{ id }}">
{{ collection_formatted }}
						</select>
					</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>
						<input class="button submit-button reset-button" type="button" value="Select" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.selectResource(); return false;" />
					</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td>
						<input class="button submit-button reset-button" type="button" value="Reset" onclick="SurStudioPluginTranslatorRevolutionDropDownAdmin.resetResource(); return false;" />
					</td>
					<td>&nbsp;&nbsp;&nbsp;</td>
					<td id="{{ id }}_loading"></td>
				</tr>
			</table>