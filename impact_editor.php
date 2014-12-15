<!DOCTYPE html>
<head>
	<meta charset="utf-8">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js""></script>
	<script src="http://knockoutjs.com/downloads/knockout-3.2.0.js"></script>
	<script src="/impact/js/edit_charities.js"></script>

	<style>
	table, th, td {
		border: 1px solid black;
	}
	th, td {
		background-color: #F0F5FF;
	}
	input, p, textarea {
	    vertical-align: top;
	    font-size: 90%;
	}
	p {
		margin: 5px;
	}
	button {
	    margin: 5px;
 	   font-size: 100%;
	    font-weight: bold;
	    background-color: #F2F2F2;
	}
	h3, h4 {
		margin: 0;
		text-align: center;
	}
	</style>
</head>

<body>

<div class='editor'>
     <h2>Charities:</h2>

    <div id='charitiesList'>
        <table class='charitiesEditor'>
            <tr>
                <th colspan='3'>Charity Info</th>
                <th>Price Points</th>
            </tr>
            <tbody data-bind="foreach: charities">
                <tr>
                    <td>
                    	<h4>Id:</h4>
                        <input data-bind='value: id' />
                    </td>
                    <td>
                    	<h4>Name:</h4>
                        <input data-bind='value: name' size="28"/>
                    </td>
                    <td>
                    	<h4>Overhead:</h4>
                        <input data-bind='value: overhead' size="4"/>
                        <span data-bind='text: ovhdText'></span>
                    </td>
                    <td rowspan='5'>
                        <table>
                            <tbody data-bind="foreach: pricePoints">
                                <tr>
                                    <td>
                                    	<h4>Price:</h4>
                                        <div><span style="font-size: 120%">$</span><input data-bind='value: price' size="6"/></div>
                                    </td>
                                    <td>
                                    	<h4>Action:</h4>
                                        <input data-bind='value: action' />
                                    </td>
                                    <td>
                                    	<h4>Item:</h4>
                                        <textarea rows='4' cols='40' data-bind='value: item'></textarea>
                                    </td>
                                    <td>
                                    	<h4>Icon URL:</h4>
                                    	<input data-bind='value: iconURL' size="25"></input>
                                    	<div><img data-bind='attr: {src: iconURL}' height="50" width="50" alt="/impact/img/dummy-icon.png" />
                                    </td>
                                    <td>
                                    	<h4>Color:</h4>
                                    	<select data-bind='value: color'>
                                    		<option value='green'>Green</option>
                                    		<option value='blue'>Blue</option>
                                    		<option value='red'>Red</option>
                                    	</select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><p style="text-align: right">Sample text:</p></td>
                                    <td colspan='3'>
                                        <p style="white-space: pre-wrap" data-bind='text: sampleText'></p>
                                    </td>
                                    <td>
                                        <button data-bind='click: $root.removePricePoint'>Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button data-bind='click: $root.addPricePoint'>Add price point</button>
                    </td>
                </tr>
                <tr>
                	<td colspan='3'>
                		<div><h3>The Organization:</h3></div>
                		<textarea rows='5' cols='75' data-bind='value: organization'></textarea>
        			</td>
                </tr>
                <tr>
                	<td colspan='3'>
                		<div><h3>The Numbers:</h3></div>
                		<textarea rows='5' cols='75' data-bind='value: numbers'></textarea>
                	</td>
                </tr>
                <tr>
                	<td colspan='3'>
                		<div><h3>Recommendation:</h3></div>
                		<textarea rows='5' cols='75' data-bind='value: recommendation'></textarea>
                	</td>
                </tr>
                <tr>
                	<td colspan='3'>
                		<div>
                    		<button data-bind='click: $root.removeCharity'>Delete</button><span style="font-size:120%">&nbsp;(<strong data-bind='text: name'></strong>)</span>
                		</div>
                	</td>
                </tr>
            </tbody>
            <tr>
                <td colspan='4'>
                    <button data-bind='click: $root.addCharity'>Add charity</button>
                </td>
            </tr>
        </table>
    </div>
    <h2>JSON:</h2>
    <textarea data-bind="value: ko.toJSON($root, null, 2)" rows='24' cols='160' readonly='readonly'></textarea>
    <form action="save_json.php" method="post">
    	<input type="hidden" data-bind="value: ko.toJSON($root, null, 2)" name="charity-data" />
    	<button type="submit" style="margin-bottom: 100px;">Save JSON to file</button>
    </form>
    
</div>

</body>

 