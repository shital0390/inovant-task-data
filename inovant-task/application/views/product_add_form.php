
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>

<body>

<div class="col-md-2"></div>

    <div class="col-md-8" style="margin-top:20px">
	    <?php
		
		   echo form_open_multipart('product/index');
		   echo validation_errors();
		   if (isset($success))
		   echo '<p>'.$success.'</p>';
        echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':''; 
	    ?>
	</div>
  <div class="col-md-12">
  <p style="margin-top:20px"> <a class="text-center" href="<?php echo base_url('index.php/product/getAllProducts'); ?>" >Goto Product Listing Page </a></p>
<div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Product Form</h3>
            </div>
			
            <form method="post" action="" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="product_name"  class="col-sm-4 control-label">Product Name</label>

                  <div class="col-sm-8">
                    <input type="text" style="margin-to:20px;" class="form-control" id="name" name="name" value=""  placeholder="Name">
                  </div>
                </div>

				        <div class="form-group">
                  <label for="price" style="margin-top:20px" class="col-sm-4 control-label">Price</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" style="margin-top:20px;" id="price" name="price" value=""  placeholder="price">
                  </div>
                </div>

                <div class="form-group">
                  <label for="image" style="margin-top:20px" class="col-sm-4 control-label">Choose Files</label>

                  <div class="col-sm-8">
                    
                    <input type="file" class="form-control" style="margin-top:20px;" id= "image" name="files[]" placeholder="Choose product images" multiple/>
                  </div>
                </div>
				
              <div class="box-footer">
				        <!--<button type="submit" style="margin-top:20px" name="fileSubmit"  class="btn btn-info pull-right">Submit</button>-->
                <input  style="margin-top:20px" type="submit" name="fileSubmit" value="UPLOAD" class="btn btn-info pull-right" />

                
              </div>

              
              <!-- /.box-footer -->
            </form>
          </div>
       
         
          
  </div>
 
  <div class="col-md-6">
    <!-- Display uploaded images -->
    <div class="row">
      <h5>Uploaded product Images</h5>
      <ul class="gallery">
          <?php 
          if(isset($prod_data) && !empty($prod_data)){
            $result  = json_decode($prod_data);
            $prodImgArr = explode(',',$result[0]->product_images);
          }

              if(!empty($prodImgArr)){ foreach($prodImgArr as $prod_imgfile){ 

            ?>
          <li class="item">
          <img src="<?php echo base_url('uploads/product_imgs/'.$prod_imgfile); ?>" width="30px" height="30px">
            
          </li>
          <br/>
          <?php } }else{ ?>
          <p>File(s) not found...</p>
          <?php } ?>
      </ul>
    </div>
 
  </div>
    
</div>

	</body>
</html>