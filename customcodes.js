(function() {
	"use strict";
	tinymce.PluginManager.add( 'tt_shortcode_plugin', function( editor, url ) {
		editor.addButton( 'tt_button_key', {
		    type: 'listbox',
		    text: 'Shortcodes',
		    values: [
			    { // CAIXAS
				text: 'Caixas',
				icon: 'cube',
				onclick: function() {
					var get_select;
					if (tinyMCE.activeEditor.selection.getContent() === '' ) {
						get_select = '';
					}
					else {
						get_select = tinyMCE.activeEditor.selection.getContent();
					}
					editor.windowManager.open({
						title: 'Configuração da Caixa',
						body: [
							{
								type:'textbox',
								name: 'caixa_conteudo',
								label: 'Conteúdo',
								value: get_select
							}
						]
					});
				}
			}]
	});
} );
} )();
