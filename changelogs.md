# bookstore-basic
revision 1 update:
  include/bootstrap.php # handle unlink
  include/protect.php   # protect bootstrap process from normal user
  include/token.php     # generate proper token for admin
  edit.php+add.php      # remove check for availability
  login.php             # generate token for amin user
