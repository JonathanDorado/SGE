<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="<?php echo base_url("resources/img/ccs.png");?>" alt="" width="80" class="img-responsive">
            <small class="pull-right"><?php echo date('Y-m-d H:i:s');?></small>
            <div class="row">
                <div class="col md-12">
                
                </div>
            </div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Entidad
          <address>
            <strong>Consejo colombiano de seguridad.</strong><br>
            Cra. 20 No. 39 - 52<br>
            Bogotá D.C, Bogotá D.C<br>
            Phone: (57-1) 288 6355<br>
            Email: webmaster@ccs.org.co
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Cliente
          <address>
            <strong><?php echo $client[0]->name . " ". $client[0]->lastname ?></strong><br>
            <?php echo $client[0]->address?><br>
            <?php
                if (!empty($client[0]->phone)){
                    echo "Telefono:" . $client[0]->phone . "<br>";
                }else {
                    if (!empty($client[0]->cellphone)){
                        echo "Telefono" . $client[0]->cellphone . "<br>";
                    }
                }
            ?>
            Email: <?php echo $client[0]->email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
                
          <p>codigo de control:<br>
          <img src="<?php echo  base_url() . 'invoice-code-' . $payment[0]->invoice_code . ".png"; ?>" height="100px"/>
          <br>
          <b>Payment Due:</b> <?php echo $payment[0]->created_at?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Product</th>
              <th>Fecha de inicio</th>
              <th>Horas del curso</th>
              <th>Monto Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?php echo $event[0]->name?></td>
              <td><?php echo $event[0]->date_from?></td>
              <td><?php echo $event[0]->total_hours?></td>
              <td><?php echo $payment[0]->price?></td>
            </tr>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
                
        <!-- /.col -->
        <div class="col-xs-6">

          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="window.print()">
            <i class="fa fa-print"></i> Imprimir comprobante
          </button>
</body>
        </div>
      </div>
    </section>