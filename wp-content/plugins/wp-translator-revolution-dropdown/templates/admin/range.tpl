<div class="surstudio_plugin_translator_revolution_dropdown_section surstudio_plugin_translator_revolution_dropdown_{{ type }}{{ dependence.show.false:begin }} surstudio_plugin_translator_revolution_dropdown_no_display{{ dependence.show.false:end }}{{ has_dependence.true:begin }} surstudio_plugin_translator_revolution_dropdown_section_tabbed_{{ dependence_count }}{{ has_dependence.true:end }}" id="section_{{ id }}">

	<div class="surstudio_plugin_translator_revolution_dropdown_tooltip"></div>
	<div class="surstudio_plugin_translator_revolution_dropdown_description surstudio_plugin_translator_revolution_dropdown_no_display">{{ description_message }}</div>

	<h3 class="surstudio_plugin_translator_revolution_dropdown_title">{{ title_message }}</h3>
	<div class="surstudio_plugin_translator_revolution_dropdown_setting">
		<div class="surstudio_plugin_translator_revolution_dropdown_field">
			<div id="{{ id }}_range" class="surstudio_plugin_translator_revolution_dropdown_field_range"></div>
			<input type="text" name="{{ id }}" id="{{ id }}" value="{{ value }}" readonly="readonly" />
			<div class="surstudio_plugin_translator_revolution_dropdown_field_unit"><small>{{ unit }}</small></div>
			<script type="text/javascript">
			/*<![CDATA[*/
			jQuery(document).ready(function() {
				SurStudioPluginTranslatorRevolutionDropDownCommon.initializeRangeField({
					container: "#{{ id }}_range", 
					view: "#{{ id }}_value", 
					field: "#{{ id }}",
					value: {{ value }},
					min: {{ min }},
					max: {{ max }},
					step: {{ step }}
				});
			});
			/*]]>*/
			</script>
		</div>
	</div>
	{{ has_dependence.true:begin }}
	<input type="hidden" name="{{ id }}_dependence" id="{{ id }}_dependence" value="{{ formatted_dependence }}" />
	<input type="hidden" name="{{ id }}_dependence_show_value" id="{{ id }}_dependence_show_value" value="{{ formatted_dependence_show_value }}" />
	{{ has_dependence.true:end }}
	<div class="surstudio_plugin_translator_revolution_dropdown_clear"></div>

</div>
