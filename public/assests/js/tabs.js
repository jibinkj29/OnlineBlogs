$(function(e) {
	$(".first_tab").champ();
	$(".accordion_example").champ({
		plugin_type: "tab",
		side: "left",
		active_tab: "5",
		controllers: "false"
	});
	
	

	$(".second_tab").champ({
		plugin_type: "tab",
		side: "right",
		active_tab: "5",
		controllers: "false"
	});
	


});