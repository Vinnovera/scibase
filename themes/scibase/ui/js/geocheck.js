/****
//
// Due to Australian legislation some content are not available to the Australian public
//
// This document need to be included before the ending </head> tag.
****/

(function(){
	if(document.cookie.indexOf("PASS") < 0) {
		init();
	}

	function init() {
		var html     = document.getElementsByTagName('html')[0],
		    overlay,
		    modal    = get_modal(),
		    readyStateCheckInterval;

		html.className = html.className + ' ozzie';

		//This is what jQuery's document.ready() do more or less
		readyStateCheckInterval = setInterval(function() {
			if (document.readyState === "interactive") {
				overlay  = document.getElementById('overlay'),
				overlay.appendChild(modal);

				clearInterval(readyStateCheckInterval);
			}
		}, 10);
	}

	function get_modal() {
		var modal       = document.createElement('div'),
		    h1          = document.createElement('h1'),
		    p           = document.createElement('p'),
		    confirm     = document.createElement('a'),
		    deny        = document.createElement('a'),
		    headingNode = document.createTextNode(heading),
		    messageNode = document.createTextNode(message),
		    confirmNode = document.createTextNode(label_confirm),
		    denyNode    = document.createTextNode(label_deny);

		h1.appendChild(headingNode);

		p.appendChild(messageNode);

		confirm.appendChild(confirmNode);
		confirm.className = 'confirm';
		confirm.href = window.location;

		if (!confirm.addEventListener) {
			// IE8
			confirm.attachEvent('onclick', setConfirmCookie);
		} else {
			confirm.addEventListener('click',setConfirmCookie);
		}

		deny.appendChild(denyNode);
		deny.className = 'deny';
		deny.href = wp_startpage_url;

		modal.className = 'geo-modal';

		modal.appendChild(h1);
		modal.appendChild(p);
		modal.appendChild(confirm);
		modal.appendChild(deny);
		return modal;
	}

	function setConfirmCookie(e){
		var date     = new Date(),
				html     = document.getElementsByTagName('html')[0],
				expires,
				classes;

		// attachEvent does not have the property
		if(e.preventDefault){
			e.preventDefault();
		}

		classes = html.className;

		classes = classes.split(' ');

		if(Array.prototype.indexOf){
			classes.splice(classes.indexOf('ozzie'),1);
		} else {
			// IE8 does not have indexOf
			for(var i = 0, len = classes.length; i < len; i++) {
				if(classes[i] === 'ozzie') {
					classes.splice(i,1);
					break;
				}
			}
		}

		html.className = classes.join(' ');

		// 2h in the future
		date.setTime(date.getTime()+(2*60*60*1000));
		expires = date.toGMTString();

		document.cookie = 'PASS=1;expires=' + expires + ';path=/;domain=.' + window.location.host;
	}
})();
