<div id='navWrap'>
    <ul>
        <li><a href=".././?action=index" title="Home">Home</a></li>
        <li><a href=".././?action=months" title="View all movies for 2014">Movies</a></li>
        <?php if(!isset($_SESSION['email'])) {
                  echo "<li><a href='.././?action=login' title='Login'>Login</a></li>";}
              elseif(isset($_SESSION['email']) && $_SESSION['admin'] == 'N'){
                    echo "<li><a href='.././?action=changeInfo' title='Edit Account'>Edit Account</a></li>";}
              elseif(isset($_SESSION['email']) && $_SESSION['admin'] == 'Y'){
                  echo "<li><a href='.././?action=changeInfo' title='Edit Users'>Client MS</a></li>";}
              ?>
    </ul>
</div>