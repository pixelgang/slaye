(function() {
// Storing common selections
var allEndpoints = $('li.endpoint'),
allEndpointsLength = allEndpoints.length,
allMethodLists = $('ul.methods'),
allMethodListsLength = allMethodLists.length;		
function listMethods(context) {
	var methodsList = $('ul.methods', context || null);
	for (var i = 0, len = methodsList.length; i < len; i++) {
		$(methodsList[i]).slideDown();
	}
}
// Toggle show/hide of method details, form, and results
$('li.method > div.title').click(function() {
	
	$('form', this.parentNode).slideToggle();
})
// Toggle an endpoint
$('li.endpoint > h3.title span.name').click(function() {
	$('ul.methods', this.parentNode.parentNode).slideToggle();
	$(this.parentNode.parentNode).toggleClass('expanded')
})
// Toggle all endpoints
$('#toggle-endpoints').click(function(event) {
	event.preventDefault();
// Check for collapsed endpoints (hidden methods)
var endpoints = $('ul.methods:not(:visible)'),
endpointsLength = endpoints.length;
if (endpointsLength > 0) {
// Some endpoints are collapsed, expand them.
for (var x = 0; x < endpointsLength; x++) {
	var methodsList = $(endpoints[x]);
	methodsList.slideDown();
	methodsList.parent().toggleClass('expanded', true)
}
} else {
// All endpoints are expanded, collapse them
var endpoints = $('ul.methods'),
endpointsLength = endpoints.length;
for (var x = 0; x < endpointsLength; x++) {
	var methodsList = $(endpoints[x]);
	methodsList.slideUp();
	methodsList.parent().toggleClass('expanded', false)
}
}
})
// Toggle all methods
$('#toggle-methods').click(function(event) {
	
	event.preventDefault();
var methodForms = $('ul.methods form:not(:visible)'), // Any hidden method forms
methodFormsLength = methodForms.length;
// Check if any method is not visible. If so, expand all methods.
if (methodFormsLength > 0) {
var methodLists = $('ul.methods:not(:visible)'), // Any hidden methods
methodListsLength = methodLists.length;
// First make sure all the hidden endpoints are expanded.
for (var x = 0; x < methodListsLength; x++) {
	$(methodLists[x]).slideDown();
}
// Now make sure all the hidden methods are expanded.
for (var y = 0; y < methodFormsLength; y++) {
	$(methodForms[y]).slideDown();
}
} else {
// Hide all visible method forms
var visibleMethodForms = $('ul.methods form:visible'),
visibleMethodFormsLength = visibleMethodForms.length;
for (var i = 0; i < visibleMethodFormsLength; i++) {
	$(visibleMethodForms[i]).slideUp();
}
}
for (var z = 0; z < allEndpointsLength; z++) {
	$(allEndpoints[z]).toggleClass('expanded', true);
}
})
// List methods for a particular endpoint.
// Hide all forms if visible
$('li.list-methods a').click(function(event) {
	
	event.preventDefault();
// Make sure endpoint is expanded
var endpoint = $(this).closest('li.endpoint'),
methods = $('li.method form', endpoint);
listMethods(endpoint);
// Make sure all method forms are collapsed
var visibleMethods = $.grep(methods, function(method) {
	return $(method).is(':visible')
})
$(visibleMethods).each(function(i, method) {
	$(method).slideUp();
})
$(endpoint).toggleClass('expanded', true);
})
// Expand methods for a particular endpoint.
// Show all forms and list all methods
$('li.expand-methods a').click(function(event) {
	event.preventDefault();
// Make sure endpoint is expanded
var endpoint = $(this).closest('li.endpoint'),
methods = $('li.method form', endpoint);
listMethods(endpoint);
// Make sure all method forms are expanded
var hiddenMethods = $.grep(methods, function(method) {
	return $(method).not(':visible')
})
$(hiddenMethods).each(function(i, method) {
	$(method).slideDown();
})
$(endpoint).toggleClass('expanded', true);
});
// Toggle headers section
$('div.headers h4').click(function(event) {
	event.preventDefault();
	$(this.parentNode).toggleClass('expanded');
	$('div.fields', this.parentNode).slideToggle();
});
// Auth with OAuth
$('#credentials').submit(function(event) {
	event.preventDefault();
	var params = $(this).serializeArray();
	$.post('/auth', params, function(result) {
		if (result.signin) {
			window.open(result.signin,"_blank","height=900,width=800,menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,toolbar=0");
		}
	})
});
})();
// JavaScript Document