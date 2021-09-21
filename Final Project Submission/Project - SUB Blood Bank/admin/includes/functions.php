<?php
$departments = array('CSE', 'Pharmacy');

function department_options(){
	global $departments;
	
	$html = '';
		
	foreach($departments as $department){
		$html .= '<option value="'.$department.'">' . $department . '</option>' . "\n";
	}
	
	echo $html;
}

function batch_options(){
	global $dbh;
	
	$html = '';
	
	$status = 1;
	$sql = "SELECT batch,department FROM batches WHERE status=:status";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':status',$status, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0){
		foreach($results as $result){
			$html .= '<option class="'.$result->department.'" value="'.$result->batch.'">' . $result->batch . '</option>' . "\n";
		}
	}
	
	echo $html;
}

function batch_name($id){
	global $dbh;
	$id = (int) $id;
	
	$sql = "SELECT batch FROM batches WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':id',$id, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0){
		foreach($results as $result){
			$name = $result->batch;
		}
	}
	else $name = 'N/A';
	
	return $name;
}

function department_name($id){
	global $dbh;
	$id = (int) $id;
	
	$sql = "SELECT department FROM batches WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':id',$id, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if($query->rowCount() > 0){
		foreach($results as $result){
			$name = $result->department;
		}
	}
	else $name = 'N/A';
	
	return $name;
}

function total_count($term){ // batches, donors, groups
	global $dbh;
	global $departments;
	
	if($term == 'batches'){
		$table = 'batches';
	}
	else if($term == 'donors'){
		$table = 'tblblooddonars';
	}
	else if($term == 'groups'){
		$table = 'tblbloodgroup';
	}
	else if($term == 'departments'){
		return count($departments); 
	}
	else return "0";
	
	$sql ="SELECT id from $table ";
	$query = $dbh -> prepare($sql);
	$query->execute();

	return $query->rowCount();
}
