/* Author: 
	Nick Sheffield
	nick@nicksheffield.com
*/

$(document).ready(function(){
	$('p.date').prettyDate();
	
	setInterval(function(){
		$('p.date').prettyDate();
		console.log('prettyDate');
	},5000);
});