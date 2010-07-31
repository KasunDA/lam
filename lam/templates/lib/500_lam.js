/**

$Id$

  This code is part of LDAP Account Manager (http://www.ldap-account-manager.org/)
  Copyright (C) 2003 - 2010  Roland Gruber

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/


function list_over(list, box, scope) {
	jQuery(list).addClass('highlight');
}

function list_out(list, box, scope) {
	jQuery(list).removeClass('highlight');
}

function list_click(list, box, scope) {
	cbox = document.getElementsByName(box)[0];
	if (cbox.checked == true) {
		cbox.checked = false;
	}
	else {
		cbox.checked = true;
	}
}

/**
 * The user changed the value in the OU selection box. This will reload the list view with the new suffix.
 * 
 * @param type account type
 * @param element dropdown box
 */
function listOUchanged(type, element) {
	location.href='list.php?type=' + type + '&suffix=' + element.options[element.selectedIndex].value;
}

function SubmitForm(id, e) {
	if (e.keyCode == 13) {
		document.getElementsByName(id)[0].click();
		return false;
	}
}

function addResizeHandler(item, min, max) {
	jQuery(item).toggle(
		function(){
			jQuery(item).animate({
				height: max
			});
		},
		function(){
			jQuery(item).animate({
				height: min
			});
		}
	);	
}

/**
 * Selects/deselects all accounts on the page.
 */
function list_switchAccountSelection() {
	// set checkbox selection
	jQuery('.accountBoxUnchecked').attr('checked', 'checked');
	jQuery('.accountBoxChecked').removeAttr('checked');
	// switch CSS class
	nowChecked = jQuery('.accountBoxUnchecked');
	nowUnchecked = jQuery('.accountBoxChecked');
	nowChecked.addClass('accountBoxChecked');
	nowChecked.removeClass('accountBoxUnchecked');
	nowUnchecked.addClass('accountBoxUnchecked');
	nowUnchecked.removeClass('accountBoxChecked');
}

/**
 * The user changed the value in the profile selection box. This will reload the login page with the new profile.
 * 
 * @param element dropdown box
 */
function loginProfileChanged(element) {
	location.href='login.php?useProfile=' + element.options[element.selectedIndex].value;
}

/**
 * Hides/unhides input fields for the login method.
 */
function configLoginMethodChanged() {
	selectLoginMethod = document.getElementsByName('loginMethod')[0];
	if ( selectLoginMethod.options[selectLoginMethod.selectedIndex].value == 'list' ) {
		 document.getElementById('trAdminList').style.display = '';
		 document.getElementById('trLoginSearchSuffix').style.display = 'none';
		 document.getElementById('trLoginSearchFilter').style.display = 'none';
	}
	else {
		 document.getElementById('trAdminList').style.display = 'none';
		 document.getElementById('trLoginSearchSuffix').style.display = '';
		 document.getElementById('trLoginSearchFilter').style.display = '';
	}
}
