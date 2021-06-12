<html>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
 
<body>
<p style="margin:20px 20px 20px 20px"> <a class="text-center" href="<?php echo base_url(); ?>" >Goto Product Add Page </a></p>

<p style="margin:20px 20px 20px 20px"> <a class="text-center" href="<?php echo base_url('index.php/product/getCartList'); ?>" >Goto Cart Page </a></p>
<div class="row">

        <div class="col-md-1"></div>
       
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Product List</h4>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <?php
               if (isset($success))
               echo '<p>'.$success.'</p>';
              ?>
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>Sr No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Product Images</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                        $i=1;
                        foreach($data as $row)
                        {
                          $imgArr =   explode(',',$row->product_images);
                        ?>
                        <form method="POST" action="<?php echo base_url().'index.php/product/add_to_cart'; ?>">
                        <input type="hidden" name="name" value="<?php echo $row->name;?>">
                        <input type="hidden" name="price" value="<?php echo $row->price;?>">
                        <input type="hidden" name="prod_id" value="<?php echo $row->prod_id;?>">
                        <input type="hidden" name="user_id" value="1">
                        <tr>
                            <td><?php echo $i; ?> </td>
                            <td><?php echo $row->name; ?> </td>
                            <td> <?php echo  $row->price; ?></td>
                            <!--<td><?php echo $row->product_images ?> </td>-->
                            <td>
                            <?php  for($k=0; $k < count($imgArr); $k++){ ?>
                             <img src="<?php echo base_url('uploads/product_imgs/'.$imgArr[$k]); ?>" width="30px" height="30px">&nbsp;
                            <?php }    ?>
                            </td>
                            <td> 
                                <input class="add_cart" type="submit" value="Add to cart">
                                </td>
                         </tr>
                         </form>
                        <?php
                        $i++;
                        }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
       </div>


</body>
</html>