function confirmSetLocationWithLoadingMask(message, url){
    if( confirm(message) ) {
        setLocation(url);
	if ($('loading-mask')) {
		$('loading-mask').show()
	}
    }
    return false;
}