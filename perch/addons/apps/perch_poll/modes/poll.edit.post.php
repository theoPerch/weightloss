<?php

    # Title panel
    if (is_object($Poll)) {
        $heading = $Lang->get('Editing ‘%s’ Poll', $HTML->encode($details['pollTitle']));
    }else{
        $heading = $Lang->get('Creating a New Poll');
    }

    echo $HTML->title_panel([
        'heading' => $heading,
    ], $CurrentUser);


    if ($message) echo $message;


    $template_help_html = $Template->find_help();
    if ($template_help_html) {
        echo $HTML->heading2('Help');
        echo '<div class="template-help">' . $template_help_html . '</div>';
    }


    echo $HTML->heading2('Poll details');



    echo $Form->form_start();

        echo $Form->text_field('pollTitle', 'Title', (isset($details['pollTitle']) ? $details['pollTitle'] : ''));


        $opts = array();
        $vals = array();

        if($Poll){
         $vals = $Poll->find_questions();
        }

       if (PerchUtil::count($questions)) {

        foreach($questions as $Question) {

            $opts[] = array('label'=>$Question->question(), 'value'=>$Question->questionID());
        }

        echo $Form->checkbox_set('questions', 'Check question for Poll', $opts, $vals, $class='', $limit=false);
        }else{

         echo  $Alert->set('warning', PerchLang::get('Set %s in order to select them for the Poll ','<code><a href="'.$API->app_path().'/questions'.'"> Questions</a></code>'));
                  echo $Alert->output();

        }

        $status_opts = array();
        $status_opts[] = array('label'=>$Lang->get('Draft'), 'value'=>'Draft');
         $status_opts[] = array('label'=>$Lang->get('Published'), 'value'=>'Published');
        echo $Form->select_field('pollStatus', 'Status', $status_opts, isset($details['pollStatus'])?$details['pollStatus']:'Draft');


        echo $Form->fields_from_template($Template, $details, $Polls->static_fields);


        echo $Form->submit_field('btnSubmit', 'Save', $API->app_path().'/polls/');


    echo $Form->form_end();



        echo $HTML->heading2('Responses');
?>

        <table class="responses">
            <thead>
                <tr>

                    <th> Question</th>

                </tr>
            </thead>
            <tbody>

        <?php

        $Polls = new PerchPolls_Polls();
         $Poll=$Polls->find($pollID);

               $questions=$Poll->get_questions();


               foreach($questions as $question) {
                $responses =   $Responses->get_responses_rating($pollID,$question->questionID());

         echo '<tr>';
         echo '<td class="action">'.PerchUtil::html($question->question()).'</td>';
            if (PerchUtil::count($responses)) {

                foreach($responses as $Response) {

                        echo '<td class="action">'.PerchUtil::html($Response->answer()).'</td>';

                        echo '<td><span class="answer-count">'.PerchUtil::html($Response->AnswerPercentage()).'%</span></td>';

                }
            }
             echo '</tr>';
}

        ?>

            </tbody>
        </table>
    </div>
