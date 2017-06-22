<?php

//Règles de validations pour le formulaire de la vue 'Grades/index.ctp'

	class Grade extends AppModel
	{
		
		public $useTable = 'grades';
		
		 public $validate = array(
		 
			//Champ 'subject'(matière) =>
			'subject' => array(
			
			//ne peut être vide :
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notBlank',
					'on' => array('create')
				),
				
			//ne peut contenir de chiffre :
				'alphaNumeric' => array(
					'rule' => array('custom', '/^[a-zA-ZZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]*$/i'),
					'on' => array('create')
				)
			),
			
		 
			//Champ 'value'(note) =>
			'value' => array(
			
			//ne peut être vide :
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notBlank',
					'on' => array('create', 'updtate')
				),
				
			//contient uniquement des chiffres
				'alphaNumeric' => array(
					'rule' => array('custom', '/^[0-9]*$/i'),
					'on' => array('create')
				),
				
			//de 0 à 20 :
				'inList' => array(
					'rule' => array('inList', array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20))
				)
			)
		);
		
/*

			Note :

				La date de naissance étant directement proposé sous forme de liste déroulante 
				il n'est pas necessaire de créer une règle pour celle-ci.
					
*/		
			
	};


?>