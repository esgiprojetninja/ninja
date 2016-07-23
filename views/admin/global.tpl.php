<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-primary2">
            <div class="panel-heading">Users</div>
            <div class="panel-body">
               <h2><a href="#" class="addUser">ADD</a> &nbsp;&nbsp; <a href="#" class="manageUser">MANAGE</a></h2>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">Teams</div>
            <div class="panel-body">
              <h2><a href="#" class="addTeam">ADD</a> &nbsp;&nbsp; <a href="#" class="manageTeam">MANAGE</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-warning">
            <div class="panel-heading">Events</div>
            <div class="panel-body">
              	<h2><a href="#">ADD</a> &nbsp;&nbsp; <a href="#">MANAGE</a></h2>
            </div>
        </div>
    </div>
    <!-- <iframe id="frameAdminGlobal"src="" width="100%" heigth="300"></iframe> -->
</div>

	<div class="col-sm-6" id="iframeAdmin" style="overflow:hidden;width:50%;heigth:400px">
		<iframe scrolling="no" id="frameAdminGlobal"src="" width="100%" style=""></iframe>
	</div>

	<div class="col-sm-6" id="hiddenUsers" style="width:50%;heigth:400px">
		<?php

		if(isset($_GET['page'])){
			echo '<script>$("#hiddenUsers").show();</script>';
		}else{
			echo '<script>$("#hiddenUsers").hide();</script>';
		}
		
		echo '<table>';
		echo '<tr><td>Username</td><td>Active</td><td>Action</td></tr>';
		foreach($users as $user){
		    $user = User::findBy("id",$user['id'],"int",false);
		    
		    echo '<tr><td><a href='.WEBROOT.'user/show/'.$user[0]['id'].'>'.$user[0]['username'].'</a></td><td>';
		    if($user[0]['is_active'] == 0){
		    	echo '<a href="#" class="activateUser" data-user="'.$user[0]['id'].'">Activate</a>';
		    }
		    echo '</td><td>';
		    echo '<a href="#" class="ajax-link editUser" data-user="'.$user[0]['id'].'"">Edit</a> - <a href="#" class="ajax-link deleteUser" data-user="'.$user[0]['id'].'""> Delete </a> - Advert - Bann </td></tr>';
		   
		}
		echo '</table>';

		echo '<p align="center">Page : ';
	    for($i=1; $i<=$nombreDePagesUser; $i++){
	         if($i==$pageActuelleUser){
	             echo ' [ '.$i.' ] '; 
	         }else{
	              echo ' <a href='.WEBROOT.'admin?page='.$i.'>'.$i.'</a> ';
	         }
	    }
	    echo '</p>';
	    ?>
	</div>

	<div class="col-sm-6" id="hiddenTeams" style="width:50%;heigth:400px">
		<?php

		if(isset($_GET['page'])){
			echo '<script>$("#hiddenTeams").show();</script>';
		}else{
			echo '<script>$("#hiddenTeams").hide();</script>';
		}
		
		echo '<table>';
		echo '<tr><td>Team name</td><td>Action</td></tr>';
		foreach($teams as $team){
		    $team = Team::findBy("id",$team['id'],"string",false);
		    
		    echo '<tr><td><a href='.WEBROOT.'team/show/'.$team[0]['id'].'>'.$team[0]['teamName'].'</a></td><td>';
		    echo '<a href="#" class="ajax-link editTeam" data-team="'.$team[0]['id'].'"">Edit</a> - <a href="#" class="ajax-link deleteTeam" data-team="'.$team[0]['id'].'""> Delete </a> - Advert - Bann </td></tr>';
		    
		}
		echo '</table>';

		echo '<p align="center">Page : ';
	    for($i=1; $i<=$nombreDePagesUser; $i++){
	         if($i==$pageActuelleUser){
	             echo ' [ '.$i.' ] '; 
	         }else{
	              echo ' <a href='.WEBROOT.'admin?page='.$i.'>'.$i.'</a> ';
	         }
	    }
	    echo '</p>';
	    ?>
	</div>