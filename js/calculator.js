(function(){
	var charities = [];
<<<<<<< HEAD
	var jqXHR = $.getJSON('json/charities.json', function( data ) {
    	charities = data.charities;
    	        		
       	$('#sci').prop('checked', true);
  		$('#amount').val("100");
=======
	var jqXHR = $.getJSON('/impact/json/charities.json', function( data ) {
    	charities = data.charities;

    	$('#amount').val("100");
<<<<<<< HEAD
    	var charity = getCharityById(charities, 'sci');
    	updateCharity(charity);
    	updateImpacts(charity, 100);
=======
>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
  		var charity = getCharityById(charities, 'sci');
		updateCharity(charity);
  		updateImpacts(charity, 100);
>>>>>>> master
	})
  	.fail(function(data, textStatus, error) {
       	console.error("Could not load charities.json, status: " + textStatus + ", error: " + error);
  	});
<<<<<<< HEAD
		
=======

>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
	var getCharityById = function(charities, id) {
		for (var i = 0; i<charities.length; i++) {
			if (charities[i].id == id) return charities[i];
		}
		return charities[0];
	};
<<<<<<< HEAD
			
=======

>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
	var calculateImpacts = function(charity, donation) {
		var impacts = [];
		var overheadMultiplier = 1.0 - charity.overhead;
		var usableDonation = overheadMultiplier*donation;
<<<<<<< HEAD
		for (i = 0; i < charity.pricePoints.length; i++) {	
=======
		for (i = 0; i < charity.pricePoints.length; i++) {
>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
			pp = charity.pricePoints[i];
			if (usableDonation >= pp.price) {
				impacts.push({number: Math.floor(usableDonation/pp.price), action: pp.action, item: pp.item});
			}
		}
		return impacts;
	};
<<<<<<< HEAD
			
=======

>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
	var updateImpacts = function(charity, donation) {
		var impacts = calculateImpacts(charity, donation);
		var n = impacts.length;
		if (n == 0) {
			impacts = [{number: 0, action: charity.pricePoints[0].action, item: charity.pricePoints[0].item}];
			n = 1;
		}
		for (var j=0; j<impacts.length; j++) {
			var resultId = "#result"+String(j+1);
			$(resultId+" div.number span").html(String(impacts[j].number).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
			$(resultId+" div.thing span").html(impacts[j].action);
			$(resultId+" p.info").html(impacts[j].item);
			$(resultId).show();
		}
		for (var j=impacts.length; j<4; j++) {
			var resultId = "#result"+String(j+1);
			$(resultId).hide();
		}
	};
<<<<<<< HEAD
			
=======

>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
	var updateCharity = function(charity) {
		$('#donate span').html(charity.name);
		$('#learnmore span').html(charity.name);
		$('#organisation p').html(charity.organization);
		$('#numbers p').html(charity.numbers);
		$('#recommendation p').html(charity.recommendation);
	};
<<<<<<< HEAD
  			
	$('input:radio[name=charity]').change( function() {
		var charity = getCharityById(charities, this.id);
		var donation = parseInt($('#amount').val()) || 0;
		
		updateCharity(charity);
		updateImpacts(charity, donation);
	});
			
	$('#amount').change( function() {
		var charId = $('input:radio[name=charity]:checked')[0].id;
		var charity = getCharityById(charities, charId);
		var donation = parseInt($('#amount') .val()) || 0; 
		
		updateImpacts(charity, donation);
	});
			
=======

	$('input:radio[name=charity]').change( function() {
		var charity = getCharityById(charities, this.id);
		var donation = parseFloat($('#amount').val()) || 0;

		updateCharity(charity);
		updateImpacts(charity, donation);
		$(document).trigger('contentChange');
	});

	$('#amount').on("change input", function() {
		var charId = $('input:radio[name=charity]:checked')[0].id;
		var charity = getCharityById(charities, charId);
		var donation = parseFloat($('#amount') .val()) || 0;

		updateImpacts(charity, donation);
		$(document).trigger('contentChange');
	});


>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
	$('#amount').keypress( function(e) {
		if (e.which == 13) {
			e.preventDefault();
			var charId = $('input:radio[name=charity]:checked')[0].id;
			var charity = getCharityById(charities, charId);
<<<<<<< HEAD
			var donation = parseFloat($('#amount') .val()) || 0;
=======
			var donation = parseInt($('#amount') .val()) || 0;
<<<<<<< HEAD
				
			updateImpacts(charity, donation);
		}
	});
	
=======
>>>>>>> master

			updateImpacts(charity, donation);
			$(document).trigger('contentChange');
		}
	});

>>>>>>> 799750be285a64a02eddfe185798afc5c5d39021
}());