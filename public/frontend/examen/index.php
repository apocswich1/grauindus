 <html>

  <head>
   <title>Test</title>
  </head>

  <body bgcolor="white">

  <?php
  $link=pg_connect("host=localhost user=postgres password='123456' dbname=prueba port=5432");
  $result = pg_exec($link, "select * from estudiantes");
  $numrows = pg_numrows($result);
  echo "<p>link = $link<br>
  result = $result<br>
  numrows = $numrows</p>
  ";
  ?>

  <table border="1">
  <tr>
  <form action="/action_page.php">
   <th>Nombre:<input type="text" name="nombre"></th>
   <th>Apellido:<input type="text" name="apellido"></th>
   <th><input onclick="alert('hola');" value="Guardar"></th>
  </form>    
  </tr>
  <tr>
   <th>Nombre</th>
   <th>Apellido</th>
   <th></th>
  </tr>
  <?php

   // Loop on rows in the result set.

   for($ri = 0; $ri < $numrows; $ri++) 
   {
        echo "<tr>\n";
        $row = pg_fetch_array($result, $ri);
        echo " <td>".$row["nombre"]."</td>";
        echo "<td>".$row["apellido"]."</td>";
        echo "<td>".$row["id"]."</td>";
        "</tr>";
   }
   pg_close($link);
  ?>
  </table>

  </body>

  </html>