<?php



	PerchUI::set_subnav([


			[
				'page' => [
						'perch_poll/polls',
						'perch_poll/polls/edit',
						'perch_poll/polls/delete'
				],
				'label'  => 'Polls',
				'priv'   => 'perch_poll.polls.manage',
				'runway' => true
			],
						[
            				'page' => [
            						'perch_poll/questions',
            						'perch_poll/questions/edit',
            						'perch_poll/questions/delete'
            				],
            				'label' => 'Questions',
            				'priv'  => 'perch_poll.questions.manage'
            			],
	], $CurrentUser);
