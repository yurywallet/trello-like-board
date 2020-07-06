<?php
require "DBController.php";
class ProjectManagement {
    function getProjectTaskByStatus($statusId, $projectName) {
        $db_handle = new DBController();
        $query = "SELECT * FROM tbl_task WHERE status_id= ? AND project_name = ?";
        $result = $db_handle->runQuery($query, 'is', array($statusId, $projectName));
        return $result;
    }
    
    function getAllStatus($projectName) {
        $db_handle = new DBController();
        $query = "SELECT * FROM tbl_status WHERE project_name ='$projectName'";
        $result = $db_handle->runBaseQuery($query);
        return $result;
    }
    
    function editTaskStatus($status_id, $task_id) {
        $db_handle = new DBController();
        $query = "UPDATE tbl_task SET status_id = ? WHERE id = ?";
        $result = $db_handle->update($query, 'ii', array($status_id, $task_id));
        return $result;
    }
	
	function addTaskItem($title, $projectName,$status_id) {
        $db_handle = new DBController();
		$query = "INSERT INTO tbl_task (title, description, project_name, status_id, created_at) VALUES ('".mysqli_real_escape_string($db_handle,$title)."','',$projectName , $statusId,'".date("Ymd")."')";
        $result = $db_handle->runBaseQuery($query);
        return $result;
    }
}
?>