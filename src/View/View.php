<?php

declare(strict_types=1);

class View
{

  public function render(): void // method to show functions in class
  {

?>
    <html lang="pl">

    <head>
      <title>class html</title>
      <meta charset="utf-8">
    </head>

    <body class="body">
      <div class="wrapper">

        <div>
          Lista wszystkich osób: <br>
          <?php

          ?>
        </div>
        <br>

        <div>
          Lista wszystkich firm: <br>
          <?php

          ?>
        </div>
        <br>

        <div>
          Lista wszystkich zamówień: <br>

          <?php


          ?>

        </div>
        <br>
        <div>
          Lista wszystkich faktur: <br>

          <?php


          ?>

        </div>

      </div>
    </body>

    </html>

<?php


  }
}
?>