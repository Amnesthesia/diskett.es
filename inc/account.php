<?php
// Note to self: Change Account button to dropdown for account specific things
// Note to self: Make rating bar dynamic (ie. animation)
require_once(PATH . 'lib/databaseClass.php');
require_once(PATH . 'lib/userClass.php');

if (!User::isLoggedIn())
    Header('Location: ?');

$user = DatabaseHandler::getInstance()->readToClass('SELECT * FROM `user` WHERE id=?', $_SESSION['uid'], 'User');

echo 'Account: ' . $user[0]->getEmail() . '<br />';
echo ($user[0]->getRoleId() == 1) ? 'Is admin: Yes <br />' : 'Is admin: No <br />';

//select u.show_id, u.is_favorite FROM user_show as u INNER JOIN user ON user.id = u.user_id WHERE id=30;
//select u.show_id, u.is_favorite, s.name FROM user_show as u INNER JOIN user ON user.id = u.user_id INNER JOIN `show` s ON s.id=u.show_id WHERE user.id=30;


$userShows = DatabaseHandler::getInstance()->read('select s.name, s.id, s.poster, u.is_favorite
                                                   FROM user_show as u
                                                   INNER JOIN user ON user.id = u.user_id
                                                   INNER JOIN `show` s on s.id=u.show_id
                                                   WHERE user.id=?', $_SESSION['uid']);

echo "<br />Watching:<br />";

foreach ($userShows as $show)
{
   $fav = ($show['is_favorite']) ? 'Favorite' : 'Not favorite';
   echo '<a href="?page=details&id=' . $show['id'] . '"> . <img height="350" width="150" title="' . $fav . '" src="media/posters/' . $show['poster'] . '"/></a> ';
}

?>