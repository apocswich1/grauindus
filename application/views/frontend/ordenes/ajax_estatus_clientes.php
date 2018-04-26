<?php
//$rut='88528200';  
//echo $rut;
$sql_GRAUSPA="SELECT
                    SUM (MovDebe) AS Debe,
                    SUM (MovHaber) AS Haber,
                    NomAux As Nombre,
                    MovNumDocRef as Referencia,
                    MAX (FecPag) AS Fecha
                FROM
                    GRAUSPA.softland.cwmovim AS GS_cwmovim, GRAUSPA.softland.cwtauxi as cliente
                WHERE
                cliente.RutAux ='".esRut($rut)."'
                AND GS_cwmovim.CodAux=cliente.CodAux
                AND GS_cwmovim.FecPag < GETDATE()
                AND MovTipDocRef = 'OF'
                AND CpbOri <> ''
                GROUP BY
                MovNumDocRef,GS_cwmovim.CodAux,NomAux"; 
$total_deudor=0;	
$total_vencido=0;	



$conn=odbc_connect('sqlserver_grauspa','sa','Softland809');
if (!$conn)
  {exit("Connection Failed: " . $conn);}
$sql=$sql_GRAUSPA;
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}
	while (odbc_fetch_row($rs))
	{
	  $total_vencido=$total_vencido+odbc_result($rs,"Haber");           
	}
odbc_close($conn);
?>



<?php if ($total_vencido==0) { ?>
    <div id="<?php echo $div; ?>">
        <p style="color:green;font-weight:500;"><strong>&nbsp;&nbsp;Cliente Solvente, y sin pagos Vencidos, Monto por Vencer: $ <?php echo number_format($total_por_vencer,0,'','.');?></strong></p>  
    </div>
<?php }     
     elseif ($total_vencido>0) { ?>
    <div id="<?php echo $div; ?>">
        <p style="color:red;font-weight:500;"><strong>&nbsp;&nbsp; Cliente Insolvente, posee un saldo Vencido por una Cantidad de : $ <?php echo number_format($total_vencido,0,'','.');?> </strong></p>  
    </div>
<?php }  ?> 
  

