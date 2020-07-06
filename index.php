<html>
<head>
<title>Trello Like Drag and Drop Cards for Project Management Software</title>
<META NAME="Description" CONTENT="Trello Like Drag and Drop Cards for Project Management Software">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="Sortable.js"></script>


	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300&subset=cyrillic" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Jura:400,500&amp;subset=cyrillic-ext" rel="stylesheet">
	
	
<style>
	html {
		height:100%;
		width:100%;
		//overflow-y: scroll;
		background: rgba(44,124,188,0.05);
	}
	a {text-decoration: none;}
	
	body {
		font-family: arial;
		background: rgba(44,124,188,0.05);
	}
	.task-board {
		background: #fff;
		display: inline-block;
		padding: 12px;
		border-radius: 3px;
		width: 98%;
		height:95%;
		white-space: nowrap;
		overflow-x: scroll;
		min-height: 300px;
		
	}

	.status-card {
		width: 250px;
		margin-right: 8px;
		border-radius: 3px;
		display: inline-block;
		vertical-align: top;
		font-size: 0.9em;
		background-color:  #fff; 
		border:1px solid rgba(19, 35, 47, 0.9);
		border-radius: 4px;
		box-shadow: 0 2px 4px 2px rgba(19, 35, 47, 0.3);
	}



	.card-header {
		width: 100%;
		padding: 10px 10px 0px 10px;
		box-sizing: border-box;
		border-radius: 3px;
		display: block;
		font-weight: bold;
	}
	
	.add_item_button{
		width: 100%;
		padding: 10px 10px 0px 10px;
		box-sizing: border-box;
		border-radius: 3px;
		display: block;
		font-weight: bold;
		background: #2c7cbc;
		background-color: rgb(100, 92, 165);
		font-family: Arial, Helvetica, sans-serif;
	}

	.card-header-text {
		display: block;
		width:100%;
	}
	.card-header-act {
		display: block;
		float:right;
	}

	ul.sortable {
		padding-bottom: 10px;
	}

	ul.sortable li:last-child {
		margin-bottom: 0px;
	}

	ul {
		list-style: none;
		margin: 0;
		padding: 0px;
	}

	.text-row {
		padding: 15px 10px;
		margin: 10px;
		box-sizing: border-box;
		cursor: pointer;
		font-size: 0.8rem;
		white-space: normal;
		line-height: 20px;
		background-color:  #fff; 
		border:1px solid rgba(44,124,188,0.5);
		border-radius: 3px;
		box-shadow: 0 1px 1px 1px rgba(19, 35, 47, 0.1);
	}

	.text-row:hover {
		border:1px solid rgba(26,177,136,0.5);
	}
	.text-row:focus {
		border:1px solid rgba(26,177,136,0.5);
	}	
	
	.ui-sortable-placeholder {
		visibility: inherit !important;
		background: transparent;
		border: #777 2px dashed;
	}
	
	/*form*/
	.add_form
		{
			width: 240;
			background: rgba(19, 35, 47, 0.9); 
			padding: 4px;

			margin: 0;
			margin-left:auto;
			margin-right:auto;
			border-radius: 4px;
			box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
			
		}

	
	input, textarea {
					  color: #1ab188;
					  width:100%;
					  padding: 5px 5px;
					  background: none;
					  background-image: none;
					  border: 1px solid #a0b3b0;
					  color: #ffffff;
					  border-radius: 1px;
					  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
					  transition: border-color .25s ease, box-shadow .25s ease;
	
						
				}
				
		input:focus {
						  outline: 0;
						  border-color: #1ab188;
						  }
		input:hover {
						border-color:#93c25d;
						}
		
		.button {
		  border: 0;
		  outline: none;
		  border-radius: 0;
		  padding: 5px 0;
		  font-size: 1rem;
		  font-weight: 500;
		  text-transform: uppercase;
		  letter-spacing: .1em;
		  background: #1ab188;
		  color: #ffffff;
		  -webkit-transition: all 0.5s ease;
		  transition: all 0.5s ease;
		  -webkit-appearance: none;
		}
		
		.button_card {
		  background: rgba(44,124,188,0.3);
		}
		
		.button:hover{
		  background: #179b77;
		  }
		
		.button:focus{
		  background: #179b77;
		  }
		

		.button-block {
		  display: block;
		  width: 100%;
		}
			
		.delete{
			color:rgba(44,124,188,0.3);
			font-size: 0.9rem;
		}
		.delete:hover{
			color:rgba(19, 35, 47, 0.9);
		}
		
		.material-icons{
			font-size: 0.9rem;
		}
			
</style>
</head>

<body>

<script type="text/javascript">
let	opt = {
	group: 'shared', 
	animation:150,
/*onStart: (evt) => {console.log(evt.oldIndex)},*/
onEnd: (evt) => {
	//console.log(evt.item.getAttribute('data-task-id'),  evt.to.id)
	var url = 'edit-status.php';
	var status_id = evt.to.getAttribute('data-status-id');
    var task_id = evt.item.getAttribute('data-task-id');
    console.log(status_id,  task_id)
	$.ajax({
                 url: url+'?status_id='+status_id+'&task_id='+task_id,
                 success: function(response){
                     }
             });
	}
}
</script>

<?
include "ProjectManagement.php";
$projectName='test';
$projectManagement = new ProjectManagement();
$statusResult = $projectManagement->getAllStatus($projectName);

?>

<div class="task-board">
            <?php
            foreach ($statusResult as $statusRow) {

                $taskResult = $projectManagement->getProjectTaskByStatus($statusRow["id"], $projectName);
                
				?>
                <div class="status-card" >
                    <div class="card-header">
                        <span class="card-header-text">
							<?php echo $statusRow["status_name"]; ?>
						</span>
                    </div>
					<? echo '<div class="list" id="c_'.$statusRow["id"].'" data-status-id="'.$statusRow["id"].'" >'; 
					?>
						<script type="text/javascript">
							new Sortable.create(document.getElementById(<? echo '"c_'.$statusRow["id"].'"'; ?> ), opt);
						</script>
						
					<?	
					if (! empty($taskResult)) {
						foreach ($taskResult as $taskRow) {
							?>
						 <div class="text-row ui-sortable-handle"  data-task-id="<?php echo $taskRow["id"]; ?>">
							<?php echo $taskRow["title"]; ?>
						 </div>
						
					<?
						}
					}
					// end cards
					?>
					</div>
				
				
				<div class="add_form">
				
				<form  action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
				<input type="hidden" name="action" value="submit">	
				
				<? 
					//echo '<input type="hidden" name="form" value="'.$taskRow["status_id"].'">'; 
					echo '<input type="hidden" name="form" value="'.$statusRow["id"].'">'; 
					
				?>
				<div class="table_view">
					<div class="table_row">
						<div class="table_cell_70 input-row">
												
							<?
								Echo '<input name="title" type="text" required size=200 value="" autocomplete="off" />';

							?>

						</div>
						<div class="table_cell_action"> 
						<?		
						echo '<input class="button button-block" type="submit" name="save" value="Add item"/>' ;
						?>
						</div>
					
					</div>
				</div>
				</form>
	</div>
				
				
				
				</div>
                <?php
			// all boards	
            }
            ?>	

		
	
</div>





</body>
</html>