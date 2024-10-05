<?php
  include 'backend/authentication.php';
  
if(isset($_REQUEST['signup']))
{

     if(signup_user($_REQUEST['user_name'],$_REQUEST['email'],$_REQUEST['password'], $_REQUEST['user_type'])){
      if($_SESSION['user_type']=="ShopOwner"){
        header("Location: account-shop-owner.php");
        }
        elseif($_SESSION['user_type']=="Publisher"){
          header("Location: publisher-account.php");
          }
          elseif($_SESSION['user_type']=="Writer"){
            header("Location: writer-account.php");
            }
          else{
        header("Location: index.php");
          }
        exit();
     }

}

if(isset($_REQUEST['login']))
{
  if(authenticate_user($_REQUEST['email'],$_REQUEST['password'])){
    if($_SESSION['user_type']=="ShopOwner"){
    header("Location: account-shop-owner.php");
    }
    elseif($_SESSION['user_type']=="Publisher"){
      header("Location: publisher-account.php");
      }
      elseif($_SESSION['user_type']=="Writer"){
        header("Location: writer-account.php");
        }
      else{
    header("Location: index.php");
      }
    exit();
  }
}

?>