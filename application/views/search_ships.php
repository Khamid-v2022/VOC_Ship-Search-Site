<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/search_ships.js"></script>

<style type="text/css">
	.datatable-scroll {
	    width: 100%;
	    overflow-x: scroll;
	}

	.form-horizontal .form-group {
		margin-left:  0px;
		margin-right:  0px;
	}

	/*.datatable-scroll {
		height: calc(100vh - 575px);
	}*/

	.alphabet-btn {
		margin:  2px;
	}

	.alphabet-btn.active {
		background-color: #827397;
		border-color: #827397;
	}
</style>
<!-- Content area -->
<div class="content">
	<!-- Main charts -->
	<div class="row">
		<div class="col-lg-12">
			<!-- Traffic sources -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">Ships</h5>
					<div class="heading-elements">
						
                	</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-md-4">
							<label class="control-label" for="ship_name">Ship name:</label>
							<select class="search-select-2" id="ship_name">
								<option value=""></option>
								<?php 
								foreach($ship_names as $item)
									echo '<option value="' . $item['ship_name'] . '">' . $item['ship_name'] . '</option>';
								?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="ship_type">Ship type:</label>
							<select class="search-select-2" id="ship_type">
								<option value=""></option>
								<?php 
								foreach($ship_types as $item)
									echo '<option value="' . $item['type_of_ship'] . '">' . $item['type_of_ship'] . '</option>';
								?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label class="control-label" for="yard_build">Yard build:</label>
							<select class="search-select-2" id="yard_build">
								<option value=""></option>
								<?php 
								foreach($yard_build as $item){
									echo '<option value="' . $item['yard_build'] . '">' . $item['yard_build'] . '</option>';
								}
								?>
							</select>
						</div>
						
					</div>
					<div style="display: flex; justify-content: space-between;">
						<div style="display: inline-block;">
							<?php 
								foreach(range('A', 'Z') as $char)
								echo '<button class="btn btn-primary alphabet-btn" sel_key="' . $char . '">' . $char . '</button>';
							?>
						</div>
						<div style="display: inline-block;">
							<button class="btn btn-info" onclick="show_all()">Show All</button>
						</div>
					</div>
					<div class="mt-10 text-right">
						
						<b>Total <span id="total_count">0</span> records</b>
					</div>
				</div>
				
				<table class="table datatable-ajax" id="data_table">
					<thead>
						<tr>
							<th>Ship number</th>
							<th>Ship name</th>
							<th>Type of ship</th>
							<th>Build year </th>
							<th>Build yard</th>
						</tr>
					</thead>
					<tbody id="table_content">	
					</tbody>
				</table>
			</div>
			<!-- /traffic sources -->
		</div>
	</div>
	<!-- /main charts -->

	<div id="ship_modal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Ship Info</h5>
				</div>

				<form action="#" class="form-horizontal" id="m_form">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Ship number</label>
									<input class="form-control" type="text" id="m_ship_nr" placeholder="" readonly >
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
									<label>Tonnage</label>
									<input class="form-control" type="text" id="m_tonnage" >
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Type of ship</label>
									<input class="form-control" type="text" id="m_type_of_ship" placeholder="" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Year build</label>
									<input class="form-control" type="text" id="m_year_build" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Yard build</label>
									<input class="form-control" type="text" id="m_yard_build" >
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Wreck region</label>
									<input class="form-control" type="text" id="m_wreck_region">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Ship extra info</label>
									<textarea class="form-control" id="m_ship_extra_info"></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3 col-sm-6">
								<div class="form-group">
									<label>Mentioned first</label>
									<input class="form-control" type="number" id="m_mentioned_first" min=0 max=2022>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="form-group">
									<label>Mentioned last</label>
									<input class="form-control" type="number" id="m_mentioned_last" min=0 max="<?=date("Y")?>">
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="form-group">
									<label>Shipwreck</label>
									<input class="form-control" id="m_shipwreck">
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="form-group">
									<label>Shipwreck story</label>
									<input class="form-control" id="m_shipwreck_story">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Fate of ship</label>
									<textarea class="form-control" id="m_fate_of_ship"></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Shipwreck story</label>
									<textarea class="form-control" id="m_shipwreck_story_txt" rows="10"></textarea>
								</div>
							</div>
						</div>
						
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>