<?php

/*

	Notes :

	- Pour des soucis de comptabilité avec CakePhp2, 
	les noms/champs de la BDD contenant les élèves/notes sont en anglais.
	
	- Student = élève
	- Grades = note
	- Subject = matière
	
*/

	//Import du controller 'GradesController' permettant de récuperer les notes des élèves
	App::import('Controller', 'Grades');
	
	class StudentsController extends AppController {
		
		//Contient les notes des élèves :
		private $GradesCTP;
		
		private $students;
		private $grades;
		
		//Contient l'élève sélectionner (en vue de : modifier/supprimer) :
		private $selected_student;
		
/*
	index() =>
	
	- récupère toutes les données de la BDD 'school' (table 'students', 'grades'), 
	- transmet ces données à la vue 'Students/index.ctp'
	
*/
		public function index() { 
		
			$this->GradesCTP = new GradesController;
			
			//Récupère tout les élèves :
			$this->students = $this->Student->find('all');
			
			$this->grades = NULL;//Contient toutes les notes
			$student_ID  = NULL;//Numéro élève
			
			//Récupère toutes les notes pour chaque élèves (en passant par le controller 'GradesController') :
			foreach($this->students as $row):
			
				$student_ID = $row['Student']['ID'];
				
				//Récupère les notes de l'élève $index :
				$this->GradesCTP->load_grades($student_ID);
				
				$this->grades[$student_ID] = $this->GradesCTP->get_grades();
			
			endforeach;
		
			//Envoi des données à la vue 'Students/index.ctp' :
			$this->set('students', $this->students);
			$this->set('grades', $this->grades);
			
		}
		
// add() => créer un nouvel élève (table : students)

		public function add()
		{
			
			//Si le formulaire a été validé :
			if($this->request->is('post'))
			{
				//Cette fonction est un correctif - cf. déclaration
				$this->request->data = $this->format($this->request->data);
				
				//validation du formulaire
				$this->validate_form($this->Student->save($this->request->data), true, false, array('action' => 'index'), "Le nouvel élève a correctement été ajouté !", "Le nouvel élève n'a pas pu être ajouté.");
				
			}
			
		}
		
//	edit() =>  Modifier un élève ayant pour ID '$student_id' (table : students)

		public function edit($student_id)
		{
			//Envoi des données de l'élève à la vue
			$this->send_to_view($student_id);
			
			//Modification de l'élève :
			if($this->request->is('post'))
			{
				//Préparation des données et séléction de l'entrée à modifier
				$this->request->data = $this->format($this->request->data);
				
				$this->Student->read(null, $student_id);
				$this->Student->set($this->request->data);
				
				//validation du formulaire
				$this->validate_form($this->Student->save(), true, false, array('action' => 'index'), "L'élève ".$student_id." a correctement été modifié.", "Modification de l'élève n° ".$student_id." impossible.");
				
			}
			
		}
		
// delete($student_id) => supprime l'élève n° '$student_id'
		
		public function delete($student_id)
		{
			//Envoi des données de l'élève à la vue
			$this->send_to_view($student_id);
			
			if($this->request->is('post'))
			{
				
				//validation du formulaire
				$this->validate_form($this->Student->delete($student_id), true, false, array('action' => 'index'), "Elève supprimé.", "Impossible de supprimer cet élève.");
				
			}
		
		}
		
/*

	validate($form_var, $ok_redirect_bool, $not_ok_redirect_bool, $ok_action, $ok_msg, $not_ok_msg) =>

		- verifie si les données sont valides
		- modifie la BDD si les données sont valides
		- rafraichie la page
		- a pour unique but de clarifier le code
		
*/

	private function validate_form($form_var, $ok_redirect_bool, $not_ok_redirect_bool, $home_action, $ok_msg, $not_ok_msg)
	{
		
		if($form_var)
		{
			$this->Session->setFlash($ok_msg);
			
			if($ok_redirect_bool)
				$this->redirect($home_action);
		}
		else
		{
			$this->Session->setFlash($not_ok_msg);
			
			if($not_ok_redirect_bool)
				$this->redirect($home_action);
		}
	}

/* 		

	format($data) =>

		- Le date de naissance contenue dans le tableau transmis par le formulaire(contenant les données d'un élève)
		a un format erroné : cette fonction est un correctif.
		
		- Cette fonction est privée.
		
*/
		
		private function format($data)
		{
			
			$month = $data['Student']['Date de naissance']['month'];
			$day = $data['Student']['Date de naissance']['day'];
			$year = $data['Student']['Date de naissance']['year'];
				
			$birthday = $year.'-'.$month.'-'.$day;
			
			$name = $this->request->data['name'];
			$surname = $this->request->data['surname'];
			
			$data = array('name' => $name, 'surname' => $surname, 'birthday' => $birthday);
		
			return $data;
		
		}
		
/*

	send_to_view($student_id) =>
	
		- Permet d'envoyer les informations de l'étudiant séléctionné (n° $student_id) à la vue
		- Cette fonction est privée.
		
*/
		
		private function send_to_view($student_id)
		{
			
			$this->selected_student = $this->Student->read(null, $student_id)['Student'];
			
			//Si l'etudiant n° '$student_id' n'existe pas :
			if($this->selected_student == NULL)
			{
				//Message d'erreur
				$this->Session->setFlash("L'élève n° ".$student_id." n'existe pas.");
				
				//On renvoi sur la page d'accueil :
				$this->redirect(array('action' => 'index'));
			}
			
			//Si l'étudiant existe :
			else
			{
				
				//On envoi les données élève à la vue 'Students/edit.ctp' :
				$this->set('student', $this->selected_student);
					
			}
			
		}
		
	}

?>