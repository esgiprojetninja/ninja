<div class="row" xmlns="http://www.w3.org/1999/html">

    <script type="text/javascript"> var page = "user";</script>

    <div align="center">
        <h3 class="center header-li ">Trouver un utilisateur :</h3>
        <input type="text" id="search-content">
        <select id="select-criteria">
            <option value="1" selected>By name</option>
            <option value="2">By Country</option>
            <option value="3">By City</option>
        </select>
    </div>
    <div id="search-content-results""></div>

<div class="col-sm-12" id="all-content">

        

    <?php
    $users = $this->data["users"];
    if(!empty($users)) {
        foreach ($users as $user) {
            //$members = TeamHasUser::findBy("idTeam",$team->getId(),"int",false);
            echo '
                <div class="col-sm-6">
                    <div class="panel panel-primary2">
                        <div class="panel-heading"><h3 class="center header-li "><a href="'.WEBROOT.'user/show/'.$user->getId().'"> User '.$user->getUserName().'</a></h3></div>
                        <div class="panel-body">
                            <ul class="header-ul">
                                <li class="li-list">
                                    <span class="form-info">Email : </span>
                                    <span class="form-content">'.$user->getEmail().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Country : </span>
                                    <span class="form-content">'.$user->getCountry().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">City : </span>
                                    <span class="form-content">'.$user->getCity().'</span>
                                </li>
                                <li class="li-list">
                                    <span class="form-info">Birthday : </span>
                                    <span class="form-content">'.$user->getBirthday().'</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            ';
        }
    }
    ?>
</div>
<?php
echo '<p align="center" id="pages">Page : ';
for($i=1; $i<=$nombreDePages; $i++){
    if($i==$pageActuelle){
        echo ' [ '.$i.' ] ';
    }else{
        echo ' <a href='.WEBROOT.'user/list?page='.$i.'>'.$i.'</a>';
    }
}
echo '</p>';
?>
</div>


