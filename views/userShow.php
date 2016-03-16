<!DOCTYPE html>
<html>
<head>
 <title>Show User</title>
 <meta charset="UTF-8" />
</head>
<body>
    <?php 
  if($users == false){
echo "<h3>User not found</h3>";
  }else{?>
 <h1>Liste des Users</h1>
 <table>
  <tr>
   <th>Login</th>
   <th>Password</th>
  </tr>
  <?php 
  foreach($users as $user){ ?>
   <tr>
    <td><?php echo $user->email ?></td>
    <td><?php echo $user->password ?></td>
   </tr>
  <?php }}?>
 </table>
</body>
</html>
