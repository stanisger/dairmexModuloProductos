<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <!-- <style> -->
  </head>
  <body>
  <?php 
    $estatusMateriales = array( 0=>'En proceso',1=>'Realizado', 2=>'No realizado' ); 
  ?>
    <span class="preheader"></span>

                  <!--∆∆ tabla general -->
                  <table class="body" bgcolor="#f3f3f3"  style="font-family:helvetica; margin: 0 auto;  background: #f3f3f3 !important; width:  600px ;">
                          <tr>
                          <td class="center" align="center" valign="top">
                          <center data-parsed="">

                              <!-- ∆style -->
                              <style type="text/css" align="center" ></style>

                                <table align="center" class="container float-center">
                                  <tbody>
                                        <tr>
                                            <td>

                                            <table class="spacer"><tbody><tr><td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td></tr></tbody></table> 

                                            <table class="row">
                                                <tbody>
                                                    <tr>
                                                        <th class="small-12 large-12 columns first last">
                                                            <table>
                                                                    <tr>
                                                                          <th>                  


                                                                            <h4>Detalle de Orden</h4>

                                                                            <!-- ∆∆∆  DETALLE DE ORDEN -->

                                                                                <table  style="width: 100% !important;">

                                                                                <!-- ∆∆  folio y fecha -->
                                                                                <p  style="font-weight: 300; ">Folio: <strong style="color: black;"><?php echo $folio; ?></strong> Fecha: <strong style="color: black;"><?php echo $fecha; ?></strong>  </p>
                                                                                <p  style="font-weight: 300; ">Elaboró: <strong style="color: black;"><?php echo $de_email; ?></strong></p>
                                                                                
                                                                                <thead style="background: grey; height: 30px;">


                                                                                  <!-- ∆∆ orden -->
                                                                                    <tr>
                                                                                      <th style="font-size: 11px; height: 40px;">No</th>
                                                                                      <th style="font-size: 11px; height: 40px;">Artículo</th>
                                                                                      <th style="font-size: 11px; height: 40px;">Medida</th>
                                                                                      <th style="font-size: 11px; height: 40px;">
                                                                                      Cantidad</th>
                                                                                      <th style="font-size: 11px; height: 40px;">Proyecto</th>
                                                                                      <th style="font-size: 11px; height: 40px;">Estatus</th>
                                                                                      <th style="font-size: 11px; height: 40px;">Comentarios</th>          
                                                                                    </tr>
                                                                                  </thead>

                                                                                <!-- ∆∆ contenido de orden -->

	                                                                                  <tbody>
	                                                                                  <?php
                                																						    $a = 1;
                                																						    foreach ($elementos_ordenados as $re) {
                                																					  ?>
			                                                                                  <tr style="background: #c6c5c3">
			                                                                                    <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $a; ?></td>
			                                                                                    <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $re[0]; ?></td>
			                                                                                    <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $re[2]; ?></td>
			                                                                                    <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $re[1]; ?></td>
			                                                                                    <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $re[3]; ?></td>
                                                                                          <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $estatusMateriales[$re[5]]; ?></td>
                                                                                          
			                                                                                    <td style="font-size: 12px; font-weight: 300; height: 40px;"><?php echo $re[4]; ?></td>
			                                                                                  </tr>
			                                                                        <?php
                                                                                  $a++;
			                                                                        	} 
			                                                                        ?>          

	                                                                                </tbody>
                                                                              </table>
                                                                            <!-- ∆∆∆  DETALLE DE ORDEN -->

                                                                        </th>
                                                                   </tr>
                                                            </table>
                                                        </th>
                                                    </tr>
                                              </tbody>
                                            </table>
                                              <table class="spacer"><tbody><tr><td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td></tr></tbody></table> 
                                            </td>
                                        </tr>
                                  </tbody>
                              </table>

                          </center>
                          </td>
                      </tr>
                  </table>
                  <!--∆∆ tabla general -->

    <!-- prevent Gmail on iOS font size manipulation -->
   <div style="display:none; white-space:nowrap; font:15px courier; line-height:0;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>