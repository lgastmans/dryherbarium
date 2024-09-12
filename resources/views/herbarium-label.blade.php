<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<title>Auroville Herbarium Label</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="description" content="Auroville Herbarium Label">
		<meta name="author" content="Luk Gastmans">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

		<style type="text/css">
			
			.roboto-light {
			  font-family: "Roboto", sans-serif;
			  font-weight: 300;
			  font-style: normal;
			}
			.roboto-regular {
			  font-family: "Roboto", sans-serif;
			  font-weight: 400;
			  font-style: normal;
			}
			.roboto-medium {
			  font-family: "Roboto", sans-serif;
			  font-weight: 500;
			  font-style: normal;
			}
			.roboto-bold {
			  font-family: "Roboto", sans-serif;
			  font-weight: 700;
			  font-style: normal;
			}
			.roboto-black {
			  font-family: "Roboto", sans-serif;
			  font-weight: 900;
			  font-style: normal;
			}


			.auro {
				position: absolute; /* Position text absolutely within the table */
				top: -5px; /* Place it at the top */
				right: 0; /* Place it at the right */
				padding: 0px; /* Add some padding for better separation */
				font-family: "Roboto", sans-serif;
				font-weight: 400;
				font-style: normal;
				font-size: 2.3rem; /* Adjust font size as needed */
			}

			.title {
				font-family: "Roboto", sans-serif;
				font-weight: 400;
				font-style: normal;
				font-size: 1.3rem;
			}
			
			.address {
				font-family: "Roboto", sans-serif;
				font-weight: 400;
				font-style: normal;
				font-size: 1rem;
				padding-bottom: 20px;
			}

			table {
			  font-family: "Roboto", sans-serif;
			  font-weight: 400;
			  font-style: normal;
			  font-size: 0.7rem;
			  border: 0px solid;
			}

			th, td {
				padding-top: 1px;
				padding-bottom: 1px;
				padding-left: 3px;
				padding-right: 3px;
				border: 0px solid;
				width: 85px;
			}


		</style>

	</head>

	<body>
		<!-- 
			The width of the label is set to 10.5 cm
			In pixels that comes to ~ 400 px
			( https://www.unitconverters.net/typography/centimeter-to-pixel-x.htm )
			Used this reference to set the layout so that it would export to PDF 
			( https://stackoverflow.com/questions/47507279/dompdf-table-fixed-column-width-and-break-long-text )
 		-->
		    
		    <table>
		        <tbody>
		            <tr >
		                <td colspan="4" class="title" align="center">
		                	<div style="position:relative;">
								<span class="auro">
									Auro
								</span>
		                    	{{ $title }}
		                	</div>
		                </td>
		            </tr>
		            <tr >
		                <td colspan="4" class="address" align="center">
		                    {{ $address }}
		                </td>
		            </tr>
		            <tr >
		                <td >
		                    <b>Family</b>
		                </td>
		                <td colspan="3" >
		                    {{ $herbarium->family->family }}
		                </td>
		            </tr>
		            <tr >
		                <td scope="row" >
		                    <b>Name Bot.</b>
		                </td>
		                <td colspan="3" >
		                    {{ $herbarium->genus->name }}
		                </td>
		            </tr>
		            <tr >
		                <td >
		                    <b>Vernacular</b>
		                </td>
		                <td colspan="3" >
		                    {{ $herbarium->vernacular_name }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Collection #</b>
		                </td>
		                <td >
		                    {{ $herbarium->collection_number }}
		                </td>
		                <td align="right">
		                    <b>Date</b>
		                </td>
		                <td >
		                    {{ $herbarium->display_collected_on }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Location</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->place->name ?? '' }}
		                </td>
		            </tr>
		            <tr>
		            	<td colspan="4" style="padding:0px;">
		            		<table cellpadding="0" cellspacing="0" border="0">
		            			<tr>
		            				<td style="width: 12%"><b>Taluk</b></td>
		            				<td style="width: 20%">{{ $herbarium->taluk->name ?? '' }}</td>
		            				<td style="width: 12%" align="right"><b>District</b></td>
		            				<td style="width: 20%">{{ $herbarium->district->name ?? '' }}</td>
		            				<td style="width: 12%" align="right"><b>State</b></td>
		            				<td style="width: 20%">{{ $herbarium->state->name ?? ''}}</td>
		            			</tr>
		            		</table>
		            	</td>
		            </tr>
		            <tr>
		            	<td colspan="4" style="padding:0px;">
		            		<table cellpadding="0" cellspacing="0" border="0">
		            			<tr>
		            				<td style="width: 12%"><b>Latitude</b></td>
		            				<td style="width: 20%">{{ $herbarium->latitude }}</td>
		            				<td style="width: 12%" align="right"><b>Longitude</b></td>
		            				<td style="width: 20%">{{ $herbarium->longitude }}</td>
		            				<td style="width: 12%" align="right"><b>Altitude</b></td>
		            				<td style="width: 20%">{{ $herbarium->altitude }}</td>
		            			</tr>
		            		</table>
		            	</td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Habit</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->habit }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Frequency</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->frequency }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Phenology</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->phenology }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Leaf</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->leaf }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Flower</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->flower }}
		                </td>
		            </tr>
		            <tr>
		                <td >
		                    <b>Notes</b>
		                </td>
		                <td colspan="3">
		                    {{ $herbarium->notes }}
		                </td>
		            </tr>
		            <tr>
		            	<!-- The width was 100 but it seemed to wide still -->
        				<td ><b>Collectors</b></td>
        				<td >{{ $herbarium->display_collector1 ?? '' }}</td>
        				<td >{{ $herbarium->display_collector2 ?? '' }}</td>
        				<td >{{ $herbarium->display_collector3 ?? '' }}</td>
		            </tr>

		        </tbody>
		    </table>

	</body>

</html>