function doValidation(id, actionUrl, formName) {

	function showErrors(resp) {
		$("#" + id).parent().parent().find('.errors').html(' ');
		$("#" + id).parent().parent().find('.errors').html(getErrorHtml(resp[id]));
	}

	$.ajax({
		type : 'POST',
		url : actionUrl,
		data : $("#" + formName).serialize(),
		dataType : 'json',
		success : showErrors
	});
}

function getErrorHtml(formErrors) {
	if (( typeof (formErrors) === 'undefined') || (formErrors.length < 1))
		return;

	var out = '<div>';
	for (errorKey in formErrors) {
		out += '<p>' + formErrors[errorKey] + '</p>';
	}
	out += '</div>';
	return out;
}

