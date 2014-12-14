<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="10; url=impact_editor.php">
</head>

<body>
<!-- Save POST data from editor -->
<?php 
	$file = "json/charities.json";
	
	if ( isset($_POST['charity-data']) ) {
		$jdata = json_decode($_POST['charity-data']);
		if ($jdata === null) {
			echo "<p>ERROR: POST data must include valid JSON data in charity-data field</p>";
		} else {
			$jchars = $jdata->charities;
			if (!(is_array($jchars)) || empty($jchars)) {
				echo "<p>ERROR: \"charities\" field must be non-empty array";
			}
			else {
				$ctvalid = 0;
				foreach ($jchars as $jchar) {
					if (!(is_string($jchar->id)) || empty($jchar->id)) {
						echo "<p>ERROR: Charity \"id\" field must be non-empty string</p>";
						break;
					}
					if (!(is_string($jchar->name)) || empty($jchar->name)) {
						echo "<p>ERROR: Charity \"name\" field must be non-empty string</p>";
						break;
					}
					if ($jchar->overhead < 0 || $jchar->overhead > 1) {
						echo "<p>ERROR: Charity \"overhead\" field must be a numeric value between 0 and 1</p>";
						break;
					}
					if (!(is_string($jchar->organization)) || empty($jchar->organization)) {
						echo "<p>ERROR: Charity \"organization\" field must be a non-empty string</p>";
						break;
					}
					if (!(is_string($jchar->numbers)) || empty($jchar->numbers)) {
						echo "<p>ERROR: Charity \"numbers\" field must be a non-empty string</p>";
						break;
					}
					if (!(is_string($jchar->recommendation)) || empty($jchar->recommendation)) {
						echo "<p>ERROR: Charity \"recommendation\" field must be a non-empty string</p>";
						break;
					}
					$jcharpp = $jchar->pricePoints;
					if (!(is_array($jcharpp)) || empty($jcharpp)) {
						echo "<p>Error: Charity \"pricePoints\" field must non-empty array</p>";
						break;
					}
					else {
						$ppvalid = 0;
						foreach ($jcharpp as $pp) {
							if ($pp->price <= 0) {
								echo "<p>ERROR: Price Point \"price\" field must be a numeric value grater than 0</p>";
								break;
							}
							if (!(is_string($pp->action)) || empty($pp->action)) {
								echo "<p>ERROR: Price Point \"action\" field must be non-empty string</p>";
								break;
							}
							if (!(is_string($pp->item)) || empty($pp->item)) {
								echo "<p>ERROR: Price Point \"item\" field must be non-empty string</p>";
								break;
							}
							if (!(is_string($pp->iconURL)) || empty($pp->iconURL)) {
								echo "<p>ERROR: Price Point \"iconURL\" field must be non-empty string</p>";
								break;
							}
							if (($pp->color != "green") && ($pp->color != "blue") && ($pp->color != "red")) {
								echo "<p>ERROR: Price Point \"color\" field must be equal to \"green\", \"blue\", or \"red\"</p>";
								break;
							}
							$ppvalid++;
						}
						if ($ppvalid < count($jcharpp)) {
							break;
						}
					}
					$ctvalid++;
				}
				if ($ctvalid == count($jchars)) {
					$sv = file_put_contents($file, $_POST['charity-data']);
					if ($sv) {
						echo "<p>Data saved successfully</p>";
					}
					else {
						echo "<p>Error saving data</p>";
					}
				}
			}
		}
	}
	else {
		echo "<p>ERROR: POST data must include charity-data field</p>";
	}
?>

<p><a href="impact_editor.php">Return to editor</a>... Or wait to be automatically redirected</p>

</body>