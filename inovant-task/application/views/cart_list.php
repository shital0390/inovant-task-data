<html>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
 
<body>

<div class="row">
        <div class="col-md-1"></div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Cart List</h4>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
            
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>Sr No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>User Id</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                        $i=1;
                        foreach($data as $row)
                        {
                        ?>
                        <tr>
                            <td><?php echo $i; ?> </td>
                            <td><?php echo $row->name; ?> </td>
                            <td> <?php echo  $row->price; ?></td>
                            <td> <?php echo  $row->user_id; ?></td>
                         </tr>
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