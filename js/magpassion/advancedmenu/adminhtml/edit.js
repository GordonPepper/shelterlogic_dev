/**
 * MagPassion.com extension
 * 
 * @category   	MagPassion
 * @package		MagPassion.com
 * @copyright  	Copyright (c) 2013 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Edit menu item js
 *
 * @category	MagPassion
 * @package		MagPassion.com
 * @author MagPassion
 */
 
function hideCategory() {
	jQuery('#menuitem_url').parent().parent().removeClass('mp_tr_hide');
	jQuery('#menuitem_category_id').parent().parent().addClass('mp_tr_hide');
}

function showCategory() {
	jQuery('#menuitem_url').parent().parent().addClass('mp_tr_hide');
	jQuery('#menuitem_category_id').parent().parent().removeClass('mp_tr_hide');
}

function changeMenuItemType() {
	if (jQuery('#menuitem_type').val() !== 'category') 
		hideCategory();
	else showCategory();
}

function changeCategory() {
	var cateTitle = jQuery("#menuitem_category_id :selected").text();
	while (cateTitle[0] === '-') cateTitle = cateTitle.substring(1);
	
	jQuery('#menuitem_category').val(cateTitle);
}

function changeParent() {
	var parentTitle = jQuery("#menuitem_menu_parent_id :selected").text();
	while (parentTitle[0] === '-') parentTitle = parentTitle.substring(1);
	
	jQuery('#menuitem_parent_item').val(parentTitle);
}

jQuery( document ).ready(function() {
	jQuery('#menuitem_parent_item').parent().parent().addClass('mp_tr_hide');
	jQuery('#menuitem_category').parent().parent().addClass('mp_tr_hide');
	
	changeMenuItemType();
});