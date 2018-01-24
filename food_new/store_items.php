<?php
error_reporting(0);
  session_start();

  if(isset($_POST['total_cart_items']))
  {
	echo count($_SESSION['name']);
	exit();
  }

  if(isset($_POST['item_name']))
  {
    $_SESSION['name'][]=$_POST['item_name'];
    $_SESSION['price'][]=$_POST['item_price'];
    $_SESSION['pid'][]=$_POST['item_id'];
    //$_SESSION['src'][]=$_POST['item_src'];
    echo count($_SESSION['name']);
    exit();
  }

  if(isset($_POST['showcart']))
  {
    for($i=0;$i<count($_SESSION['name']);$i++)
    {
    //echo "<div class='cart_items'>";
    echo '<tr>
            <td>
              <a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> '.$_SESSION['name'][$i].'
            </td>
            <td>
              <strong class="pull-right">Rs. '.$_SESSION['price'][$i].'</strong>
            </td>
          </tr>';
    echo '<input type="hidden" value='.$_SESSION['price'][$i].'>';
    echo '<input type="hidden" value='.$_SESSION['pid'][$i].' id="pid">';
    //echo "</div>";
    }
    exit();	
  }
?>