<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Category</title>
    <meta name="description" content="Add Category">
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

</head>
<body>
    <!-- Left Panel -->
    <?php
	$this->load->view("includes/sidebar_view");
	?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
<?php $this->load->view("includes/header_view");	?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Category</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Category</a></li>
                            <li class="active">Add Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
				<div class="row">
                    <div class="col-lg-2">
                    </div>
					<div class="col-lg-8">
						<div class="card">
							<div class="card-header">
								<strong>Add Category</strong>
							</div>
							<div class="card-body card-block">
							
							<?php if($msg == 'Success'){ ?>	 
							  <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                            <span class="badge badge-pill badge-primary">Success</span>&nbsp<?php echo $msg_2; ?>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                            <?php if($msg == 'Failed'){ ?>	 
								<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Failed</span>&nbsp<?php echo $msg_2; ?>
													
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                         <?php } ?>
								<form action="<?php echo base_url().'Categories_controller/add' ?>" method="post" class="form-horizontal">
							
							<div class="row form-group">
                            <div class="col col-md-3"><label for="cname" class=" form-control-label">Category Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="cname" name="cname" placeholder="Enter Category..." class="form-control" value="<?php echo set_value('cname'); ?>"/><span class="help-block" id="c_err"><?php echo form_error('cname'); ?></span>
                            </div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-3"><label for="priority" class=" form-control-label">Priority</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="priority" name="priority" placeholder="Enter Priority..." class="form-control" value="<?php echo set_value('priority'); ?>"/><span class="help-block" id="p_err"><?php echo form_error('priority'); ?></span></div>
                          </div>
  						  <div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Status</label></div>
							<div class="col-12 col-md-9">
							  <select name="cstatus" id="cstatus" class="form-control">
								<option value="1">Active</option>
								<option value="0">In-Active</option>
							  </select>
							</div>
						  </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" name="add" value="Add now">
                          <i class="fa fa-dot-circle-o" ></i> Add now
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
						</form>
                      </div>
                      
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
<!-- Client Side validation-->
<!-- <script>
function validate_category_form(){
	var str=true;
	var cname=document.getElementById('cname').value;
	var priority=document.getElementById('priority').value;
	if(cname==""){
		str=false;
		document.getElementById('c_err').innerHTML="Please enter category";
		document.getElementById('cname').style.border="1px solid red";
	}
	else{
		document.getElementById('c_err').innerHTML="";
		document.getElementById('cname').style.border="";
	}
	if(priority=="")
	{
		str=false;
		document.getElementById('p_err').innerHTML="Please enter priority";
		document.getElementById('priority').style.border="1px solid red";
	}
	else{
		document.getElementById('p_err').innerHTML="";
		document.getElementById('priority').style.border="";
	}
	return str;
	
}
</script> -->
