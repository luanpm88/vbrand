/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.enterMode = CKEDITOR.ENTER_BR;
	
	config.toolbar_Full =
[
['Source','-','Save','NewPage','Preview','-','Templates'],
['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],

['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
['BidiLtr', 'BidiRtl' ],
['Link','Unlink','Anchor'],
['Styles','Format','Font','FontSize'],
['TextColor','BGColor'],
['Maximize', 'ShowBlocks','-','About']
];
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'http://canho.club/quanly/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'http://canho.club/quanly/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'http://canho.club/quanly/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'http://canho.club/quanly/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'http://canho.club/quanly/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://canho.club/quanly/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};

