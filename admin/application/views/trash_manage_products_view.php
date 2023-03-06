
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Removed Products</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>normalize.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url().CSS_PATH.'/';?>bootstrap-select.less"> -->
    <link rel="stylesheet" href="<?php echo base_url().SCSS_PATH.'/';?>style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<style>
th,td{
    text-align: left;
    
}
</style>
</head>
<body>
        <!-- Left Panel -->
<?php
		$this->load->view('includes/sidebar_view');
?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php 
            $this->load->view('includes/header_view');
        ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Removed Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Products</a></li>
                            <li class="active">Removed Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
					<form method="post" action="<?php echo base_url().'Products_controller/trash_search_products'?>" style="background-color: #f7f7f7;">
						<input type="text" value="<?php echo set_value('searchstr')?>" name="searchstr" id="searchstr" placeholder="Search Products" style="width:400px;height:38px;border:1px solid gray;border-radius:10px;margin-left:10px;" />
						<button type="submit" name="search" class="btn btn-primary" value="Search" >Search</button>
					</form>
					
                        <div class="card-header">
                            <strong class="card-title">Removed Products</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered dataTable no-footer">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col" >Product Code</th>
                                  <th scope="col">Product Name</th>
								  <th scope="col">Product Image</th>
                                  <th scope="col">Brand</th>		
								  <th scope="col">MRP</th>
								  <th scope="col">SP</th>
								  <th scope="col">Ship Charge</th>
								  <th scope="col">Stock</th>
								  <th scope="col">Added On</th>
								  <th scope="col">Status</th>
								  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
					<?php
                    if($flag == 1){
                    $i = 1;
						  foreach ($result_set->result() as $row) {
					?>
                            <tr>
								<th scope="row"><?php echo $i; ?></th>
								<td><?php echo $row->prod_code;?> </td>
								<td><?php echo $row->prod_name;?></td>
								<td>
									<img src="<?php echo base_url()."uploads/".$row->prod_image;?>" border="1px solid" height="50px" width="90px" style="border-radius:10px; box-shadow: 0 0 5px black;">
								</td>
								<td><?php echo $row->prod_brand;?> </td>
								<td><?php echo $row->prod_mrp;?> </td>
								<td><?php echo $row->prod_sp;?> </td>
								<td><?php echo $row->prod_shipping_charge;?> </td>
								<td><?php echo $row->prod_stock;?> </td>
								<td><?php echo $row->added_on;?> </td>
                              <td>
                        <?php 
                            if($row->prod_status == 1){
                                ?>
                                <span style="color:green">Active</span> 
                            <?php 
                        }
                        else{?>
                            <span style="color:red">Inactive</span> 
                            <?php
                        } 
                        ?>
                        </td>
							  
                               <td>
								  <a style="color:red; border-bottom:1px solid;" href="<?php echo base_url().'Products_controller/delete_product/'.$row->prod_id ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
								  <a style="color:blue; border-bottom:1px solid;" href="<?php echo base_url().'Products_controller/restore_product/'.$row->prod_id ?>" onclick="return confirm('Are you sure to Re-store?')">Re-store</a>
							   </td>
                          </tr>
						  <?php
                          $i++;
						 }
                        }
                        else{
                          ?>
							<tr>
							<td colspan="12"><p style="color:red;text-align:center">No records found..!</p></td></tr>
							  <?php
						  }
						  ?>
                      </tbody>
                  </table>
                        </div>
                    </div>
                </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="<?php echo base_url().JS_PATH.'/';?>vendor/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>popper.min.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>plugins.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>main.js"></script>


</body>
</html>
