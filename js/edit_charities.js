/*
*  edit_charities.js
*
*/

    
var PPModel = function (data) {
    var self = this;
    self.price = ko.observable(data.price);
    self.action = ko.observable(data.action);
    self.item = ko.observable(data.item);
    self.iconURL = ko.observable(data.iconURL);
    self.color = ko.observable(data.color);

    self.sampleText = ko.computed(function () {
        return " #  " + self.action() + "\n" + self.item();
    });
    
    self.toJSON = function() {
    	var copy = ko.toJS(self);
        delete copy.sampleText;
        return copy;
    };
};

var CharityModel = function (data) {
    var self = this;
    self.id = ko.observable(data.id);
    self.name = ko.observable(data.name);
    self.overhead = ko.observable(data.overhead);
    self.pricePoints = ko.observableArray(ko.utils.arrayMap(data.pricePoints, function (pricePoint) {
        return new PPModel(pricePoint);
    }));
    self.organization = ko.observable(data.organization);
    self.numbers = ko.observable(data.numbers);
    self.recommendation = ko.observable(data.recommendation);

    self.ovhdText = ko.computed(function () {
        return "(" + (100.0 * self.overhead()).toFixed(1) + "%)";
    });
    
    self.toJSON = function() {
    	var copy = ko.toJS(self);
        delete copy.ovhdText;
        return copy;
    };
};

var CharitiesModel = function (charities) {
    var self = this;
    self.charities = ko.observableArray(ko.utils.arrayMap(charities, function (charity) {
        return new CharityModel(charity);
    }));

    self.addCharity = function () {
        var newid = self.charities().length;
        self.charities.push(new CharityModel({
            id: newid,
            name: "",
            overhead: 0,
            pricePoints: ko.observableArray(),
            organization: "",
            numbers: "",
            recommendation: ""
        }));
    };

    self.removeCharity = function (charity) {
        self.charities.remove(charity);
        
    };

    self.addPricePoint = function (charity) {
        charity.pricePoints.push(new PPModel({
            price: 1,
            action: "",
            item: "",
            iconURL: "/impact_calculator/img/dummy-icon.png",
            color: "green"
        }));
    };

    self.removePricePoint = function (pricePoint) {
        $.each(self.charities(), function () {
            this.pricePoints.remove(pricePoint);
        });
    };

    self.save = function () {
    	var data = ko.toJSON(self);
        var jqxhr = $.post("/impact/save_json.php", function( data ) {
  			alert("Saving data");
		})
		.fail(function(data, textStatus, error) {
    	alert("Could not save charities.json, status: " + textStatus + ", error: " + error);
  		});
  		// TODO: Send post request to server-side script
    };
};

$(window).load(function() {
	var jqxhr = $.ajax({
		cache: false, 
		url: '/impact/json/charities.json', 
		dataType: 'json',
		success: function( data ) {
			//alert("Loading charities");
        	ko.applyBindings(new CharitiesModel(data.charities));
		},
  		error: function(data, textStatus, error) {
    		alert("Could not load charities.json, status: " + textStatus + ", error: " + error);
  		}
  	});
});