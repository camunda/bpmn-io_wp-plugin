(function() {
	tinymce.create('tinymce.plugins.bpmn', {
		init : function(ed, url) {
			ed.addButton('bpmn', {
				title : 'BPMN XML',
				image : url + '/camunda_icon.png',
				dialog_type : "modal",
				onclick : function() {
					// Opens a HTML page inside a TinyMCE dialog and pass in two parameters
/*					ed.windowManager.open({
						title: "BPMN XML",
						url: url + '/bpmn.html',
						width: 700,
						height: 600
					}, {
						arg1: 42,
						arg2: "Hello world"
					});
*/
					var text = prompt("Paste your BPMN XML here", "");
					if (text != null && text != '') {
							ed.execCommand('mceInsertContent', false, '[bpmn url="' + text + '"]');
					} else {
						ed.execCommand('mceInsertContent', false,'[bpmn]');
					}
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "BPMN",
				author : 'Camunda Services GmbH',
				authorurl : 'http://www.camunda.org',
				infourl : 'http://bpmn.io/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('bpmn', tinymce.plugins.bpmn);
})();