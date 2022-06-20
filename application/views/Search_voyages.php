<style type="text/css">
	.heading-elements .icons-list {
		margin-top: 0;
	}
	.picker__select--year {
		width: unset;
	}
	.dataTables_wrapper {
		overflow-x: auto;
	}
</style>
<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/voyages.js"></script>

<div class="container">
	<div class="page-title">
		<h1>Search Voyages</h1>
	</div>
	<div>
		<div class="panel panel-flat panel-collapsed">
			<div class="panel-heading">
				<h6 class="panel-title">Search Options<a class="heading-elements-toggle"></a></h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><button class="btn btn-primary mr-20" onclick="show_all()">ALL VOYAGES</button></li>
                		<li><a data-action="collapse" class=""></a></li>
                	</ul>
            	</div>
            	<!-- <button class="btn btn-primary" type="button" onclick="upload_data_from_excel()">Upload Voyages Table</button> -->
        	</div>

			<div class="panel-body" style="">
				<form>
					<div class="row">
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="direction">Direction:</label>
							<select class="search-select-2" id="direction" name="direction">
								<option value=""></option>
								<?php 
								foreach($directions as $item)
									echo '<option value="' . $item['direction'] . '">' . $item['direction'] . '</option>';
								?>
							</select>
						</div>
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="chamber">Chamber:</label>
							<select class="search-select-2" id="chamber" name="chamber">
								<option value=""></option>
								<?php 
								foreach($chambers as $item)
									echo '<option value="' . $item['chamber'] . '">' . $item['chamber'] . '</option>';
								?>
							</select>
						</div>
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="port_arrival">Port arrival:</label>
							<select class="search-select-2" id="port_arrival" name="port_arrival">
								<option value=""></option>
								<?php 
								foreach($arrivals as $item)
									echo '<option value="' . $item['port_arrival'] . '">' . $item['port_arrival'] . '</option>';
								?>
							</select>
						</div>
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="port_departure">Port departure:</label>
							<select class="search-select-2" id="port_departure" name="port_departure">
								<option value=""></option>
								<?php 
								foreach($departures as $item)
									echo '<option value="' . $item['port_departure'] . '">' . $item['port_departure'] . '</option>';
								?>
							</select>
						</div>
						<!-- <div class="form-group col-sm-2 col-xs-6">
							<label class="control-label" for="shipwreck">Shipwreck:</label>
							<select class="form-control" id="shipwreck" name="shipwreck">
								<option value=""></option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div> -->
						<!-- <div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="location">Wreck location:</label>
							<select class="search-select-2" id="location" name="location">
								<option value=""></option>
								<?php 
								foreach($wreck_regions as $item)
									echo '<option value="' . $item['wreck_region'] . '">' . $item['wreck_region'] . '</option>';
								?>
							</select>
						</div> -->
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="date_at_cape">Date at Cape:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
								<input type="text" class="form-control pickadate" placeholder="1421-02-28" id="date_at_cape" name="date_at_cape">
							</div>
						</div>
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="date_from_cape">Date from Cape:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
								<input type="text" class="form-control pickadate" placeholder="1421-02-28" id="date_from_cape" name="date_from_cape">
							</div>
						</div>
						<div class="form-group col-sm-3 col-xs-6">
							<label class="control-label" for="date_arrival">Date arrival:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar22"></i></span>
								<input type="text" class="form-control pickadate" placeholder="1421-02-28" id="date_arrival" name="date_arrival">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="panel panel-flat">		
			<table class="table datatable-ajax" id="data_table">
				<thead>
					<tr>
						<th>Ship Number</th>
						<th>Ship Name</th>
						<th>Direction</th>
						<th>Captain</th>
						<th>Chamber</th>
						<th>Departure Date</th>
						<th>Departure Port</th>
						<th>At Cape</th>
						<th>From Cape</th>
						<th>Arrival Date</th>
						<th>Arrival Port</th>
					</tr>
				</thead>
				<tbody id="table_content">	
				</tbody>
			</table>
		</div>
	</div>
</div>