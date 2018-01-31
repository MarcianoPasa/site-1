function mascaraData(campo, e) {
	var keyCode = (document.all) ? event.keyCode : e.keyCode;
	var data = campo.value;

	if ((keyCode === 47) || (keyCode > 47 && keyCode < 58)) {
		if ((data.length === 2) && (keyCode !== 47)) {
			campo.value = data += '/';
		}
		else if ((data.length === 5) && (keyCode !== 47)) {
			campo.value = data += '/';
		}
		else {
			campo.value = data;
		}
	}	
}
