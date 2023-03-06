<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Removed Categories</title>
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
    <?php 

        $this->load->view("includes/header_view");

    ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Removed Categories</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Categories</a></li>
                            <li class="active">Removed Categories</li>
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
                    <form method="post" action="<?php echo base_url().'Categories_controller/trash_search_category'?>" style="background-color: #f7f7f7;">
                        <input type="text" name="searchstr" id="searchstr" value="<?php echo set_value('searchstr'); ?>" placeholder="Search Category" style="width:400px;height:38px;border:1px solid gray;border-radius:10px;margin-left:10px;" />
                        <button type="submit" name="search" class="btn btn-primary" value="Search" >Search</button>
                        <!-- <button type="submit" name="active" value="active" class="btn btn-success" style="margin-left:300px">Active</button>
                        <button type="submit" name="in_active" value="in_active" class="btn btn-secondary">In-Active</button>
                        <button type="submit" name="delete" value="Delete" class="btn btn-danger">Delete</button> -->
                    </form>
                        <div class="card-header">
                            <strong class="card-title">Removed Categories</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered dataTable no-footer">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Category</th>
                                  <th scope="col">Priority</th>
                                  <th scope="col">Status</th>       
                                  <th scope="col">Created on</th>
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
                            <th scope="row"><?php echo $i;?></th>
                            <td><?php echo $row->category_name ?></td>
                            <td><?php echo $row->category_priority ?></td>
                            <td>
                        <?php 
                            if($row->category_status == 1){
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
                            <td><?php echo $row->created_on ?></td>
                            <td>  
                              <a style="color:red;border-bottom:1px solid;" href="<?php echo base_url().'Categories_controller/delete_category/'.$row->category_id ?>" onclick="return confirm('Are you sure?')">Delete</a>
                              <a style="color:blue;border-bottom:1px solid;" href="<?php echo base_url().'Categories_controller/restore_category/'.$row->category_id ?>">Restore</a>
                              </td>
                          </tr> 
                        <?php 
                        $i++;
                    } 
                }
                else{
                    ?>
                    <tr>
                        <td colspan="7"><p style="color:red;text-align:center">No records found..!</p></td>
                    </tr>

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
            <div>
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div>
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    
    <script src="<?php echo base_url().JS_PATH.'/';?>vendor/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>popper.min.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>plugins.js"></script>
    <script src="<?php echo base_url().JS_PATH.'/';?>main.js"></script>


</body>
</html>
