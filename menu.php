		<ul>
            <li>
                <a href="/golf" class="nav-link">View Scores</a>
            </li>
<?php
	if ($_SESSION['username'] == 'mark@heimberg.net' || $_SESSION['username'] == 'ernie@heimberg.net'):
?>
            <li>
                <a href="/golf/add-scores.php" class="nav-link">Add Scores</a>
            </li>
            <li>
                <a href="/golf/add-course.php" class="nav-link">Add Courses</a>
            </li>
            <li>
                <a href="/golf/add-player.php" class="nav-link">Add Players</a>
            </li>
<?php
	endif;	
?>
        </ul>