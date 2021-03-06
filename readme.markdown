# Adegga API Wrapper

Official Adegga API documentation is available here:
[http://www.adegga.com/help/api/](http://www.adegga.com/help/api/)

It's a very simple wrapper for now but it should be updated as soon as the API becomes stable.

## Example Usage

	require('adegga_core.php');
	require('adegga.php');

	$adegga = new Adegga('YOUR_API_KEY');

	# GET PRODUCER
	$producer = $adegga->getProducerByID(16);
	var_dump($producer);

	# MANUAL EXAMPLE
	$wine = $adegga->get('GetWineByAvin', array('AVIN6452997073019'));
	var_dump($wine);

	# HELPER FOR THE EXAMPLE ABOVE
	$wine = $adegga->getWineByAvin('AVIN6452997073019');
	var_dump($wine);
	
if you want to use the internal cache, just instantiate like this:

	$adegga = new Adegga('YOUR_API_KEY', MY_CACHE_FOLDER);
	
The default life time of the cached files is 1 hour, if you want to change it:

	$adegga = new Adegga('YOUR_API_KEY', MY_CACHE_FOLDER, '+1 day');