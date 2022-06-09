<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/admin/ships.js"></script>

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
		height: calc(100vh - 395px);
	}*/
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
						<button class="btn btn-sm btn-primary" type="button" onclick="add_ship_modal()"><i class="icon-plus2 position-left"></i>Add Ship</button>
						<!-- <button class="btn btn-sm btn-error" type="button" onclick="upload_data_from_excel()"><i class=" icon-file-excel position-left"></i>Upload to XLS</button> -->
                	</div>
				</div>
				
				<table class="table datatable-ajax" id="data_table">
					<thead>
						<tr>
							<th>Ship number</th>
							<th>Ship name</th>
							<th>Tonnage</th>
							<th>Type of ship</th>
							<th>Build year </th>
							<th>Build yard</th>
							<th>Wreck region</th>
							<th>Extra info</th>
							<th>Mentioned first</th>
							<th>Mentioned last</th>
							<th>Shipwreck</th>
							<th>Shipwreck story</th>
							<th>Fate of ship</th>
							<!-- <th>Whipwreck story</th> -->
							<th>Delete</th>
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
					<h5 class="modal-title"><span class="action-type"></span> Ship</h5>
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
									<select class="form-control" id="m_shipwreck">
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="form-group">
									<label>Shipwreck story</label>
									<select class="form-control" id="m_shipwreck_story">
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
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
									<textarea class="form-control" id="m_shipwreck_story_txt" rows="5"></textarea>
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