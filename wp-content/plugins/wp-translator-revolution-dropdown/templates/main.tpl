{{ on_before_load.empty.false:begin }}
<script type="text/javascript">
/*<![CDATA[*/
{{ on_before_load }}
/*]]>*/
</script>
{{ on_before_load.empty.false:end }}
<script type="text/javascript" src="{{ url_library }}"></script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery.translatorDropDown.loader({
{{ options_formatted }}	clsKey: "th5b159602e694fc2d5d7659ab928332"
});
/*]]>*/
</script>