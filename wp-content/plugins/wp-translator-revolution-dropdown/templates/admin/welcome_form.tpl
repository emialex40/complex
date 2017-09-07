<div id="surstudio_plugin_translator_revolution_dropdown_welcome">

	<div class="surstudio_plugin_translator_revolution_dropdown_page_title_container">
		<div class="surstudio_plugin_translator_revolution_dropdown_da_icon_main">
			<div class="dashicons-before dashicons-translation"></div>
		</div>
		<h2 class="surstudio_plugin_translator_revolution_dropdown_page_title">Translator Revolution DropDown</h2>
		<button onclick="window.open('{{ settings_url }}', '_self');">{{ settings_message }}</button>
	</div>

	{{ group_1 }}

</div>

<script type="text/javascript">
/*<![CDATA[*/
jQuery(document).ready(function() {
	SurStudioPluginTranslatorRevolutionDropDownWelcome.initialize("{{ ajax_url }}");
});
/*]]>*/
</script>