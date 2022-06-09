<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/admin/voyages.js"></script>

<style type="text/css">
	.search-option-panel .heading-elements .icons-list {
		margin-top: 0;
	}
	.picker__select--year {
		width: unset;
	}
	.dataTables_wrapper {
		overflow-x: auto;
	}

	.total_count {
		font-weight: 500;
	}
	.form-horizontal .form-group {
		margin-left:  0px;
		margin-right:  0px;
	}
</style>

<div class="content">
	<div class="panel panel-flat panel-collapsed search-option-panel">
		<div class="panel-heading">
			<h6 class="panel-title">Search Options<a class="heading-elements-toggle"></a></h6>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><button class="btn btn-primary mr-20" onclick="add_voyages()"><i class="icon-plus2 position-left"></i>ADD VOYAGES</button></li>
					<li><button class="btn btn-info mr-20" onclick="show_all()">ALL VOYAGES</button></li>
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
					</div>
					<div class="form-group col-sm-3 col-xs-6">
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
							<input type="text" class="form-control pickadate" placeholder="28/02/1421" id="date_at_cape" name="date_at_cape">
						</div>
					</div>
					<div class="form-group col-sm-3 col-xs-6">
						<label class="control-label" for="date_from_cape">Date from Cape:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar22"></i></span>
							<input type="text" class="form-control pickadate" placeholder="28/02/1421" id="date_from_cape" name="date_from_cape">
						</div>
					</div>
					<div class="form-group col-sm-3 col-xs-6">
						<label class="control-label" for="date_arrival">Date arrival:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="icon-calendar22"></i></span>
							<input type="text" class="form-control pickadate" placeholder="28/02/1421" id="date_arrival" name="date_arrival">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="panel panel-flat">		
		<div class="panel-heading">
			<h6 class="panel-title">Search Results<a class="heading-elements-toggle"></a></h6>
			<div class="heading-elements">
				<ul class="icons-list">
            		<li>Total <span id="total_count">0</span> records</li>
            	</ul>
        	</div>
        	<!-- <button class="btn btn-primary" type="button" onclick="upload_data_from_excel()">Upload Voyages Table</button> -->
    	</div>
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
					<th>Srrival Port</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody id="table_content">	
			</tbody>
		</table>
	</div>
</div>

<div id="voyages_modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><span class="action-type"></span> Voyages</h5>
			</div>
			<input type="hidden" value="" id="m_sel_id">
			<input type="hidden" value="" id="m_action_type">

			<form action="#" class="form-horizontal" id="m_form">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Ship number</label>
								<input class="form-control" type="text" id="m_ship_nr" placeholder="" readonly value="<?=$new_number?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Ship name</label>
								<input class="form-control" type="text" id="m_ship_name" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Voyage number</label>
								<input class="form-control" type="text" id="m_voyage_nr" >
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Direction</label>
								<input class="form-control" type="text" id="m_direction" placeholder="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Captain</label>
								<input class="form-control" type="text" id="m_captain">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Chamber</label>
								<input class="form-control" type="text" id="m_chamber" >
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 1</label>
								<input class="form-control" type="text" id="m_streepje_1" value="-">
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 2</label>
								<input class="form-control" type="text" id="m_streepje_2" value="-">
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 3</label>
								<input class="form-control" type="text" id="m_streepje_3" value="-">
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 4</label>
								<input class="form-control" type="text" id="m_streepje_4" value="-">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 5</label>
								<input class="form-control" type="text" id="m_streepje_5" value="-">
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 6</label>
								<input class="form-control" type="text" id="m_streepje_6" value="-">
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 7</label>
								<input class="form-control" type="text" id="m_streepje_7" value="-">
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group">
								<label>Streepje 8</label>
								<input class="form-control" type="text" id="m_streepje_8" value="-">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Departure date</label>
								<input class="form-control" type="text" id="m_departure_date" placeholder="31/01/1400">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>At Cape date</label>
								<input class="form-control" type="text" id="m_cape_at_date" placeholder="31/01/1400">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>From Cape date</label>
								<input class="form-control" type="text" id="m_cape_from_date" placeholder="31/01/1400">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Aarrival date</label>
								<input class="form-control" type="text" id="m_arrival_date" placeholder="31/01/1400">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Port departure</label>
								<input class="form-control" type="text" id="m_port_departure" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Port arrival</label>
								<input class="form-control" type="text" id="m_port_arrival" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Corr voyage number</label>
								<input class="form-control" type="text" id="m_corr_voyage_nr" placeholder="1400-04-01">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Voyage_particulars</label>
								<textarea class="form-control" id="m_voyage_particulars"></textarea>
							</div>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="m_submit_btn" style="display: none;">TOEVOEGEN <i class="icon-spinner10 spinner position-right" style="display:none"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>