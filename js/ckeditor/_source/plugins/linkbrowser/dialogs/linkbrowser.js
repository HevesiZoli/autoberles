CKEDITOR.dialog.add( 'linkBrowser', function( editor ) {
	var dialog,
		doc;

	function addItem(list, item) 
	{
		var _item = new CKEDITOR.dom.element( 'li' );
		_item.setAttribute( "_url", item.url );
		_item.setAttribute( "title", item.title );

		if ( item.hasChildren )
		{
			var _a = new CKEDITOR.dom.element( 'a' );
			_a.setHtml( '[+] ' );
			_a.setAttribute( 'href', 'javascript:void(0)' );
			_a.addClass( 'cke_collapsed' );
			_item.append( _a );
		}

		_item.appendHtml( item.title );

		if ( item.hasChildren )
		{
			var _list = new CKEDITOR.dom.element( 'ul' );
			_item.append( _list );
			_a.on( 'click', function( ev ) {
				if ( _a.hasClass('cke_collapsed') ) 
				{
					if ( !_a.hasClass( 'cke_loaded' ) )
					{
						loadChildLinks( _list, { url : item.url, web : item.web, type : item.type } );
						_a.addClass( 'cke_loaded' );
					}
					_a.removeClass( 'cke_collapsed' );
					_list.show();
					_a.setHtml( '[-] ' );
				}
				else
				{
					_list.hide();
					_a.addClass( 'cke_collapsed' );
					_a.setHtml( '[+] ' );
				}
				ev.data.preventDefault( true );
			});
		}

		_item.on( 'mouseover', function( ev ) {
			this.setStyle( 'background', '#DDD' );
			ev.data.preventDefault( true );
		});
		_item.on( 'mouseout', function( ev ) {
			this.removeStyle( 'background' );
			ev.data.preventDefault( true );
		});

		_item.on( 'click', function( ev ) {
			var alink = new CKEDITOR.dom.element( 'a' );
			alink.setAttribute( "href", this.getAttribute( '_url' ) );
			alink.setHtml( this.getAttribute( 'title' ) );
			// IE6: insertElement throws an error
			editor.getSelection().getRanges()[0].select();
			editor.insertHtml( alink.getOuterHtml() );
			ev.data.preventDefault( true );
			dialog.hide();
		});

		list.append(_item);
	}

	function loadChildLinks(list, parent)
	{
		if ( parent.url == "/" )
			addItem(list, { web : "/", url : "/", title : "/", type : "web", hasChildern : false } );

		CKEDITOR.ajax.loadXml( editor.config.linkbrowserPath + '?url=' + parent.url + '&type=' + parent.type + '&web=' + parent.web, function(xml) {
			var i, itemNodes = xml.selectNodes( 'links/link' );

			for ( i = 0 ; i < itemNodes.length ; i++ )
			{
				if ( itemNodes[i].getAttribute('hasChildren') == 'true' )
				{
					addItem(list, {
								web : itemNodes[i].getAttribute('weburl'),
								url : itemNodes[i].getAttribute('url'),
								title : itemNodes[i].getAttribute('title'), 
								type : itemNodes[i].getAttribute('type'),
								hasChildren : true
							});
				}
			}
			for ( i = 0 ; i < itemNodes.length ; i++ )
			{
				if ( itemNodes[i].getAttribute('hasChildren') != 'true' )
				{
					addItem(list, {
								web : itemNodes[i].getAttribute('weburl'),
								url : itemNodes[i].getAttribute('url'),
								title : itemNodes[i].getAttribute('title'), 
								type : itemNodes[i].getAttribute('type'),
								hasChildren : false
							});
				}
			}
		});
	}

	return {
		title : 'Link Browser',
		minWidth : 400,
		minHeight : 200,
		contents : [
			{
				id : 'linkTab',
				label : 'Link browser label',
				title : 'Link Browser title',
				elements :
				[
					{
						id : 'html',
						type : 'html',
						html :
						'<style type="text/css">' +
						'#linkarea {max-height:300px;overflow-y:scroll}' +
						'#links li a {cursor:pointer}' +
						'#links li {cursor:pointer;list-style-type: none; margin-left: 10px; padding-top: 5px;}' + 
						'</style>' + 
						'<div id="linkarea" style="overflow: auto; height:180px;">' +
						'<ul id="links"></ul>' +
						'</div>'
					}
				]
			}
		],
		onShow : function() {
			dialog = this;
			doc = this.getElement().getDocument();
			CKEDITOR.scriptLoader.load( [ CKEDITOR.basePath + '_source/core/xml.js', CKEDITOR.basePath + '_source/core/ajax.js' ], function( success ) {
				loadChildLinks(doc.getById( 'links' ), { url : "/", type : "web", hasChildren : true, web : "/" });
			});
		}
	};
});
