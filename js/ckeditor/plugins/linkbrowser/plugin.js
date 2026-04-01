// TODO Aria support
// TODO Keyboard navigation
// TODO [+], [-] -> images
// TODO Loader
// TODO Localization
// TODO Integration with Image, Flash, Link dialogs
CKEDITOR.plugins.add( 'linkbrowser',
{
	init: function( editor )
	{
		CKEDITOR.dialog.add( 'linkBrowser', this.path + 'dialogs/linkbrowser.js' );

		editor.addCommand( 'LinkBrowserCmd', new CKEDITOR.dialogCommand( 'linkBrowser' ) );

		editor.ui.addButton( 'LinkBrowser',
			{
				label : 'LinkBrowser',
				icon : this.path + 'images/link.png',
				command : 'LinkBrowserCmd'
			} );
	}
});