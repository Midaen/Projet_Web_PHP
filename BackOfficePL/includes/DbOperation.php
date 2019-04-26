<?php

class DbOperation
{
    private $conn;

    //Constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '/Config.php';
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    //Function to create a new user
    public function createStudent($username, $firstname, $lastname, $email, $group_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO users(username, firstname, lastname, email, password, role_id, group_id) values('$username', '$firstname', '$lastname', '$email', '$2y$10$fVahmJ.4KkmGu7qp4tamC.bfn76O/DHDEcx1CW7tCIdLwBdU99hC.', 2, '$group_id')");
	$result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //Function to set a user's group
    public function setStudentGroup($student_id, $group_id)
    {
        $stmt = $this->conn->prepare("UPDATE users SET group_id='$group_id' WHERE id = '$student_id'");
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //Function to verify that a user exists
    public function verifyStudent($username)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS mycount FROM users WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_array(MYSQLI_NUM);

	$count = $row[0];
	$stmt->close();
	if ($count > 0) {
	    return true;
        } else {
            return false;
        }
    }


    //Function to get students under a group
    public function getStudentsUnderGroup($group_id)
    {
//        $stmt = $this->conn->prepare("select users.id, users.firstname, users.lastname, users.group_id from users where role_id = '2' and id NOT IN (select users.id from users where role_id = '2' and users.group_id NOT IN (select id from (select id, parent_id from groups order by parent_id, id) groups_sorted, (select @pv := ?) initialisation where  find_in_set(parent_id, @pv) and length(@pv := concat(@pv, ',', id))    )    )   order by lastname");

     $stmt = $this->conn->prepare("select users.id, users.firstname, users.lastname, users.group_id from users where role_id = '2' and group_id = ?");
      $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $result = $stmt->get_result();

//        $row = $result->fetch_all(MYSQLI_NUM);

        //$row = $result->fetch_array(MYSQLI_NUM);

        //$count = $row[0];

        $stmt->close();
        return $result;
    }


    //Function to count Students
    public function countStudents()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM users WHERE role_id = 2");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countStudentsNeverConnected()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM users WHERE role_id = 2 AND remember_token IS NULL");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to count Trophies
    public function countTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM trophies");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to count Modules
    public function countModules()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM modules");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to count Copies
    public function countCopies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM trophy_user");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to clean Trophies
    public function cleanTrophies()
    {
        $result = $this->conn->query("DELETE IGNORE FROM trophies WHERE state = -1");
        $res = 'Success';
        $result->free();
        return $res;
    }

    //Function to clean trophies from zombies Modules
    public function cleanTrophiesModules()
    {
        $result = $this->conn->query("DELETE IGNORE FROM trophies WHERE trophies.module_id IN (SELECT modules.id FROM modules WHERE modules.state = -1)");
        $res = 'Success';
     //   $result->free();
        return $res;
    }

    //Function to clean Modules
    public function cleanModules()
    {
        $result = $this->conn->query("DELETE IGNORE FROM modules WHERE state = -1");
        $res = 'Success';
  //        $result->free();
        return $res;
    }

    //Function to count Students without trophy
    public function countStudentsWithoutTrophy()
    {
        $result = $this->conn->query("SELECT COUNT(users.username) AS c FROM `users` LEFT JOIN trophy_user ON users.id = trophy_user.user_id WHERE trophy_user.user_id IS NULL AND users.role_id = 2");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to count trophies that have not been delivered
    public function countUndeliveredTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM `trophies` LEFT JOIN trophy_user ON trophies.id = trophy_user.trophy_id WHERE trophy_user.user_id IS NULL");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to return all Groups except root
    public function getGroups()
    {
        $result = $this->conn->query("SELECT id, name, parent_id FROM groups WHERE parent_id IS NOT NULL");
	      //print_r($result);
        //$result->free();
        return $result;
    }

    //Function to return all inactive trophies
    public function countInactiveTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM trophies WHERE trophies.state = 0");
	$count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to return all ghost trophies
    public function countGhostTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM trophies WHERE trophies.state = -1");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countCleanableTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM trophies LEFT JOIN trophy_user on trophy_user.trophy_id = trophies.id WHERE trophies.state = -1 AND trophy_user.trophy_id IS NULL");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countActiveModuleWithTrophies()
    {
        $result = $this->conn->query("SELECT COUNT( DISTINCT modules.id) AS c FROM modules JOIN trophies ON trophies.module_id = modules.id WHERE modules.state = 1 AND trophies.module_id IS NOT NULL");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countActiveModuleWithoutTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM modules LEFT JOIN trophies ON trophies.module_id = modules.id WHERE modules.state = 1 AND trophies.module_id IS NULL");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countInactiveModule()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM modules WHERE modules.state = 0");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countGhostModules()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS c FROM modules WHERE modules.state = -1");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countCleanableModule()
    {
        $result = $this->conn->query("SELECT COUNT(modules.id) AS c FROM modules LEFT JOIN trophies ON trophies.module_id = modules.id WHERE modules.state = -1 AND (trophies.id IS NULL OR trophies.id NOT IN (SELECT DISTINCT trophy_user.trophy_id FROM trophy_user))");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    //Function to return all Groups with students
    public function getGroupsWithStudents()
    {
       $result = $this->conn->query("SELECT DISTINCT groups.id, name, COUNT(*) FROM groups JOIN users ON groups.id = users.group_id AND users.role_id = '2' GROUP BY groups.id");
       //$result = $this->conn->query("SELECT id, name, parent_id FROM groups WHERE parent_id IS NOT NULL");
       //print_r($result);
       //$result->free();
       return $result;
    }

    public function countDeliveredTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(DISTINCT trophy_id) AS c FROM trophy_user");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function countStudentsWithTrophies()
    {
        $result = $this->conn->query("SELECT COUNT(DISTINCT user_id) AS c FROM trophy_user");
        $count = $result->fetch_object()->c;
        $result->free();
        return $count;
    }

    public function deleteStudent($student_id)
    {
  //      $this->conn->beginTransaction(MYSQLI_TRANS_START_READ_WRITE);
        $stmt = $this->conn->prepare("delete FROM trophy_user WHERE user_id = '$student_id'");
	$stmt->execute();
	$stmt = $this->conn->prepare("delete from notifications where notifiable_id = '$student_id' and notifiable_type = \"App\\Models\\User\"");
	$stmt->execute();
	$stmt = $this->conn->prepare("delete from user_ranking where user_id = '$student_id'");
	$stmt->execute();
	$stmt = $this->conn->prepare("delete from module_user_ranking where user_id = '$student_id'");
        $stmt->execute();
	$stmt = $this->conn->prepare("delete from users where id = '$student_id'");
	$stmt->execute();
//       $this->conn->commit();
	return true;
    }

    function showGroups(){
      $result = $this->conn->query("SELECT DISTINCT groups.id, name, COUNT(*) FROM groups JOIN users ON groups.id = users.group_id AND users.role_id = '2' GROUP BY groups.id");
    echo "<table>\n";
    echo "<tbody>\n";

    foreach($result as $ligne) {
      echo "<tr>\n";
      echo "<td><a href='gestionEtudiants.php?id=".$ligne['id']."'class='black-text'>".$ligne["name"]."</a></td>";
      echo "<td class='pink-text'>(".$ligne["COUNT(*)"]." étudiants)</td>";
      echo "</tr>\n";
    }
    echo "<tbody>\n";
    echo "</table>\n";


}
function showStudents($id){
  $result = $this->conn->query("select users.id, users.firstname, users.lastname, users.group_id from users where role_id = '2' and group_id = ".$id);

echo "<table>\n";
echo "<tbody>\n";

foreach($result as $ligne) {
  echo "<tr>\n";
  echo "<td><a href="."Home.php"." class="."black-text".">".$ligne["firstname"]."      ".$ligne["lastname"]."</a></td>";
  echo "<td> <form name='del' action='...\BackOfficePL\api\deleteStudent.php' method='post' style='invisible'>\n";
  echo "<input type='hidden' name='student_id' value='".$ligne['id']."'>";
  echo "<input type='submit' value='Delete'>";
  echo "</form> </td>";
  echo "</tr>\n";
}
echo "<tbody>\n";
echo "</table>\n";


}

}
