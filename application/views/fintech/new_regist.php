	<div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>/f_home">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tables</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> New Registration Today</div>
        <div class="card-body">
          <div class="table-responsive" style="padding-right: 1px; overflow: auto;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
				  <th>No</th>	
                  <th>ID Reg</th>
                  <th>Name Patient</th>
                  <th>Company</th>
                  <th>Charge Rule</th>
                  <th>Package Medical</th>
                  <th>Services</th>
				  <th>Entry User</th>
				  <th>Created Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>	
                  <th>ID Reg</th>
                  <th>Name Patient</th>
                  <th>Company</th>
                  <th>Charge Rule</th>
                  <th>Package Medical</th>
                  <th>Services</th>
				  <th>Entry User</th>
				  <th>Created Date</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php
			  $i=1;
			  foreach($filex->result() as $row){
			  ?>
                <tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $row->id_reg;?></td>
                  <td><?php echo $row->pat_name;?></td>
				  <td><?php echo $row->client_name;?></td>
				  <td><?php echo $row->price_type;?></td>
				  <td><?php echo $row->quot_name;?></td>
				  <td>-</td>
				  <td><?php echo $row->fullname;?></td>
				  <td><?php echo $row->create_date;?></td>
                </tr>
			  <?php
			  }
			  ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>