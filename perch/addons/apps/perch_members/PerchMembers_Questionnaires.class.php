<?php

class PerchMembers_Questionnaires extends PerchAPI_Factory
{
    protected $table     = 'questionnaire';
	protected $pk        = 'id';
	protected $singular_classname = 'PerchMembers_Questionnaire';
	public $reorder_questions=[
	"weight"=>"What is your weight?",
	"weight2"=>"inches",
	"weightunit"=>"weight unit",
	"bmi"=>"BMI",
	"side_effects"=>"Have you experienced any side effects whilst taking the medication? ",
	"more_side_effects"=>"Please tell us as much as you can about your side effects",
	"additional-medication"=>"Have you started taking any additional medication?",
	"list_additional_medication"=>"Please tell us as much as you can about your  additional medication",
	"rate_current_experience"=>"Are you happy with your monthly weight loss?",
	"no_happy_reasons"=>"Please tell us as much as you can about the reasons you are not happy with your monthly weight loss.",
	"chat_with_us"=>"Would you like to chat with someone?",
	"email_address"=>"Please enter your  email address",
	 "multiple_answers"=>"Have client alter answers?",
	 "documents"=>"Member Documents",
	];
	public $steps=[
    "age"=>"howold",
    "ethnicity"=>"18to74",
    "ethnicity-more"=>"Mixed",
    "gender"=>"ethnicity",
    "pregnancy"=>"Female",
    "weight"=>"weight",
    "height"=>"height",
    "diabetes"=>"diabetes",
    "conditions"=>"weight2",
    "bariatricoperation"=>"bariatricoperation",
    "more_pancreatitis"=>"more_pancreatitis",
    "thyroidoperation"=>"thyroidoperation",
    "more_conditions"=>"more",
    "conditions2"=>"conditions",
    "medical_conditions"=>"medical_conditions",
    "medications"=>"medications",
    "weight-wegovy"=>"starting_wegovy",
    "dose-wegovy"=>"dose_wegovy",
    "recently-dose-wegovy"=>"recently_wegovy",
    "continue-dose-wegovy"=>"continue_with_wegovy",
    "effects_with_wegovy"=>"effects_with_wegovy",
    "medication_allergies"=>"medication_allergies",
    "other_medical_conditions"=>"list_any",
    "wegovy_side_effects"=>"wegovy_side_effects",
    "gp_informed"=>"gp_informed",
    "GP_email_address"=>"gp_address",
    "Get access to special offers"=>"access_special_offers"
    ];
		public $questions=[
	"consultation"=>"agree-consultation",
    "age"=>"How old are you?",
    "ethnicity"=>"Which ethnicity are you?",
    "ethnicity-more"=>"Please tell us which ethnicities",
    "gender"=>"What sex were you assigned at birth?",
    "pregnancy"=>"Are you currently pregnant, trying to get pregnant, or breastfeeding?",
    "weight"=>"What is your weight?",
      //"weight2"=>"",
    "weightunit"=>"weight unit",
    "height"=>"What is your height?",
    // "height2"=>"",
    "heightunit"=>"height unit",
    "diabetes"=>"Have you been diagnosed with diabetes?",
    "conditions"=>"Do any of the following statements apply to you?",
    "bariatricoperation"=>"Was your bariatric operation in the last 6 months? ",
    "more_pancreatitis"=>"Please tell us more about your mental health condition and how you manage it",
    "thyroidoperation"=>"Please tell us further details on the thyroid surgery you had, the outcome of the surgery and any ongoing monitoring",
    "more_conditions"=>"Please tell us more about your mental health condition and how you manage it",
    "conditions2"=>"Do any of the following statements apply to you?",
    "medical_conditions"=>"Do you have any other medical conditions?",
    "medications"=>"Have you ever taken any of the following medications to help you lose weight?",
    "weight-wegovy"=>"What was your weight in kg before starting the weight loss medication?",
    "dose-wegovy"=>"When was your last dose of the weight loss medication?",
    "recently-dose-wegovy"=>"What dose of the weight loss medication were you prescribed most recently?",
    "continue-dose-wegovy"=>"If you want to continue with the weight loss medication, what dose would you like to continue with?",
    "effects_with_wegovy"=>"Have you experienced any side effects with the weight loss medication?",
    "medication_allergies"=>"Do you currently take any other medication or have any allergies?",
    "other_medical_conditions"=>"Please list any other medical conditions you have. ",
    "wegovy_side_effects"=>"Please tell us as much as you can about your side effects - the type, duration, severity and whether they have resolved",
    "gp_informed"=>"Would you like your GP to be informed of this consultation?",
    "email_address"=>"Please enter your GP's email address",
    "Get access to special offers"=>"email_address",
    "multiple_answers"=>"Have client alter answers?",
    "documents"=>"Member Documents",
    "bmi"=>"BMI",
    ];
public $doses = [
    '25mg' => '0.25mg/2.5mg',
    '05mg' => '0.5mg/5mg',
    '1mg'  => '1mg/7.5mg',
    '17mg' => '1.7mg/12.5mg',
    '24mg' => '2.4mg/15mg',
    'other'=> 'Other'
];


   /* protected $required_answers=[
    "age"=>["18to74"],
     "ethnicity"=>["asian","African"],

    ]*/

	protected $default_sort_column = 'created_at';
	public $static_fields = array('version','question_text', 'question_slug', 'question_slug', 'answer', 'answer_text','member_id');
	public function get_questions($type='first-order')
    {
    if($type=="re-order"){
     return $this->reorder_questions;
    }
    return $this->questions;
    }
	public function get_for_member($memberID,$type="first-order")
    {
        $sql = 'SELECT d.*
                FROM  '.PERCH_DB_PREFIX.'questionnaire d
                WHERE d.member_id='.$this->db->pdb((int)$memberID).' and type="'.$type.'" order by created_at desc';

        return $this->return_instances($this->db->get_rows($sql));
    }

function displayUserAnswerHistoryUI(string $userId, string $logDir = 'logs') {
    $filePath = "/var/www/html/{$logDir}/{$userId}_raw_log.json";

    if (!file_exists($filePath)) {
        echo "<p style='color:red;'>❌ Log file not found for user ID: {$userId}</p>";
        return;
    }

    $data = json_decode(file_get_contents($filePath), true);

    if (!$data || !isset($data['log'])) {
        echo "<p style='color:red;'>⚠️ Log file is invalid or missing log entries.</p>";
        return;
    }

    $logEntries = $data['log'];
return $logEntries;
}
  function requireNextStep($step,$value) {
  /*echo "requireNextStep";
  echo $step;
  echo "--";
  print_r( $value);*/

   if($step=="pregnancy"){
           if($value=="yes"){
           return true;

              }
       }

       if($step=="medical_conditions"){
           if($value=="yes"){
             return true;
              // document.getElementById("nextstep").value="list_any";
           }

       }
           if ($step=="medications" ){
           if (is_array($value) &&!empty(array_intersect(['wegovy','ozempic','saxenda','rybelsus','mounjaro','alli','mysimba','other'], $value))) {
            return true;
           }
           }

              if ($step=="starting_wegovy" || $step=="unit-wegovy" || $step=="weight2-wegovy" ||  $step=="weight-wegovy"){

                     return true;
                     }

                     if ($step==="dose-wegovy" || $step=="recently-dose-wegovy") {

                         return true;
                     }

                     if ($step=="recently_wegovy") {

                        return true;
                     }

                     if ($step==="continue_with_wegovy" || $step=="continue-dose-wegovy") {

                           return true;
                     }


       if($step=="more_side_effects"){

           if($value=="yes"){
               return true;
           }
       }


       if($step=="gp_informed"){

           if($value=="yes"){
               return true;
           }
       }
       if($step=="bariatricoperation"){

           if($value=="yes"){
               return true;
           }
       }
       if($step=="ethnicity"){

            if($value=="Mixed" || $value=="Other"){
               return true;
           }
       }
       return false;

  }
  function validateQuestionnaire(array $data): array {
      $errors = [];

      // 1. Age must be provided
      if (empty($data['age'])) {
          $errors[] = 'Please select your age group.';
      }

      // 2. Check if user is between 18–74
      if ($data['age'] === '18to74') {
          // Ethnicity required
          if (empty($data['ethnicity'])) {
              $errors[] = 'Please select your ethnicity.';
          }

          // If ethnicity is Mixed or Other, require ethnicity-more
          if (in_array($data['ethnicity'], ['Mixed', 'Other'])) {
              if (empty($data['ethnicity-more'])) {
                  $errors[] = 'Please specify your ethnicity in the text field.';
              }
          }

          // Gender required
          if (empty($data['gender'])) {
              $errors[] = 'Please select the sex assigned at birth.';
          }

          // If Female, check pregnancy status
          if ($data['gender'] === 'Female' && empty($data['pregnancy'])) {
              $errors[] = 'Please indicate if you are pregnant, trying to get pregnant, or breastfeeding.';
          }

          // Weight and height required
          if (empty($data['weight']) || empty($data['weightunit'])) {
              $errors[] = 'Please provide your weight and select a unit.';
          }

          if (empty($data['height']) || empty($data['heightunit'])) {
              $errors[] = 'Please provide your height and select a unit.';
          }

          // Diabetes required
          if (empty($data['diabetes'])) {
              $errors[] = 'Please select your diabetes status.';
          }

          // Conditions (first set) required
          if (empty($data['conditions']) || !is_array($data['conditions'])) {
              $errors[] = 'Please select at least one condition (or "None").';
          } else {
              // If 'bariatricoperation' selected, check follow-up question
              if (in_array('bariatricoperation', $data['conditions']) && empty($data['bariatricoperation'])) {
                  $errors[] = 'Please confirm if your bariatric operation was within 6 months.';
              }

              // If 'thyroidoperation' selected, require details
              if (in_array('thyroidoperation', $data['conditions']) && empty($data['thyroidoperation'])) {
                  $errors[] = 'Please provide more details on your thyroid operation.';
              }

              // If 'pancreatitishistory' selected, require more_pancreatitis info
              if (in_array('pancreatitishistory', $data['conditions']) && empty($data['more_pancreatitis'])) {
                  $errors[] = 'Please tell us more about your pancreatitis history.';
              }

              // If 'eatingdisorder' selected, require more_conditions
              if (in_array('eatingdisorder', $data['conditions']) && empty($data['more_conditions'])) {
                  $errors[] = 'Please tell us more about your eating disorder history.';
              }
          }

          // Second conditions block is optional but requires at least one checkbox
          if (empty($data['conditions2']) || !is_array($data['conditions2'])) {
              $errors[] = 'Please select at least one second-level condition (or "None").';
          }

          // Medical conditions yes/no
          if (empty($data['medical_conditions'])) {
              $errors[] = 'Please indicate if you have other medical conditions.';
          }

          // If yes, require details
          if ($data['medical_conditions'] === 'yes' && empty($data['other_medical_conditions'])) {
              $errors[] = 'Please list your other medical conditions.';
          }

          // Medications question
          if (empty($data['medications']) || !is_array($data['medications'])) {
              $errors[] = 'Please select any medications you’ve taken (or "None").';
          }

          // If 'wegovy' selected, check extra info
          if (in_array('wegovy', $data['medications'])) {
              if (empty($data['weight-wegovy'])) {
                  $errors[] = 'Please provide your weight before starting Wegovy.';
              }

              if (empty($data['dose-wegovy'])) {
                  $errors[] = 'Please indicate your last dose of Wegovy.';
              }

              if (empty($data['recently-dose-wegovy'])) {
                  $errors[] = 'Please provide the most recent dose prescribed.';
              }

              if (empty($data['continue-dose-wegovy'])) {
                  $errors[] = 'Please select your preferred continuation dose.';
              }

              if (empty($data['effects_with_wegovy'])) {
                  $errors[] = 'Please indicate if you’ve had any side effects.';
              }

              if ($data['effects_with_wegovy'] === 'yes' && empty($data['wegovy_side_effects'])) {
                  $errors[] = 'Please describe your side effects with Wegovy.';
              }
          }

          // Medication allergies check
          if (empty($data['medication_allergies']) || !is_array($data['medication_allergies'])) {
              $errors[] = 'Please tell us about any medications or allergies.';
          }

          // GP informed
          if (empty($data['gp_informed'])) {
              $errors[] = 'Please tell us if you want your GP to be informed.';
          }

          if ($data['gp_informed'] === 'yes' && empty($data['GP_email_address'])) {
              $errors[] = 'Please enter your GP’s email address.';
          }
      }else{
         $errors[] = 'No permitted age!';
      }

      return $errors;
  }

  function calculateBMIAdvanced($weight, $weightUnit, $height1, $weight2=0, $height2 = 0, $heightUnit = 'cm') {
      // Convert weight to kilograms if needed
      if ($weightUnit === 'st-lbs') {
         $totalPounds = ($weight * 14) + $weight2;
          $weightKg = $totalPounds * 0.453592;

      } elseif ($weightUnit === 'kg') {
          $weightKg = $weight;
      } else {
          return "Invalid weight unit. Use 'kg' or 'lbs'.";
      }

      // Convert height to meters based on unit
      if ($heightUnit === 'cm') {
          $heightM = $height1 / 100;
      } elseif ($heightUnit === 'in') {
          $heightM = $height1 * 0.0254;
      } elseif ($heightUnit === 'ft-in') {

          $totalInches = ($height1 * 12) + $height2;
          $heightM = $totalInches * 0.0254;
      } else {
          return "Invalid height unit. Use 'cm', 'in', or 'ft_in'.";
      }

      if ($heightM <= 0) {
          return "Height must be greater than zero.";
      }

      $bmi = $weightKg / ($heightM * $heightM);
      $bmi = round($bmi, 2);

      // Determine category
      if ($bmi < 18.5) {
          $category = "Underweight";
      } elseif ($bmi < 24.9) {
          $category = "Normal weight";
      } elseif ($bmi < 29.9) {
          $category = "Overweight";
      } else {
          $category = "Obese";
      }

      return [
          'bmi' => $bmi,
          'category' => $category
      ];
  }
function parseHeight($input) {
    // Remove all spaces
    $input = str_replace(' ', '', $input);

    // Validate the format: digits + 'ft' + digits + 'in'
    if (!preg_match('/^\d+ft\d+in$/', $input)) {
        return false;
    }

    // Extract digits before 'ft' and 'in'
    preg_match('/(\d+)ft/', $input, $ftMatch);
    preg_match('/(\d+)in/', $input, $inMatch);

    return [
        'feet' => (int)$ftMatch[1],
        'inches' => (int)$inMatch[1]
    ];
}


    public function add_to_member($memberID,$data,$type)
     { // echo "add_to_member";

// print_r($memberID);print_r($type); echo PerchUtil::count($this->get_for_member($memberID));
       //     if(!PerchUtil::count($this->get_for_member($memberID)) ){
// echo "add_to_member inn";
$Members = new PerchMembers_Members;
			$Member = $Members->find($memberID);
			  $memberdetails = $Member->to_array();
 $insert_query ="";
   // print_r($data);
     if( isset($data)){
     $weight2=0;
     $height2=0;
     if(isset($data["weight2"])){
      $weight2=$data["weight2"];
     }
     if(isset($data["height2"])){
           $height2=$data["height2"];
          }
      if($type=="first-order"){
      $result = $this->calculateBMIAdvanced($data["weight"], $data["weightunit"], $data["height"],$weight2, $height2, $data["heightunit"]);
 //$props = json_decode($memberdetails['memberProperties'], true);
     	$props = PerchUtil::json_safe_decode($Member->memberProperties(), true);

        if (!is_array($props)) $props = [];


$props["height"]=$data["height"];
$props["height2"]=$height2;
 $props["heightunit"]= $data["heightunit"];
$out=[];
 	$out['memberProperties'] = PerchUtil::json_safe_encode($props);

    	$Member->update($out);
    	}else{
    	$heightcheck=$this->parseHeight($memberdetails["height"]);
    	if($heightcheck){
    	$memberdetails["height"]=$heightcheck["feet"];
    	$memberdetails["height2"]=$heightcheck["inches"];
    	}
    	if(!isset($memberdetails["heightunit"])){
    	$memberdetails["heightunit"]=$memberdetails["heightunit-radio"];
    	}

    	      $result = $this->calculateBMIAdvanced($data["weight"], $data["weightunit"], $memberdetails["height"],$data["weight2"], $memberdetails["height2"], $memberdetails["heightunit"]);


    	}
 $data['bmi']=$result;
      foreach ($data as $key => $value) {
       $qdata = array();
        $qdata['type'] = $type;
      $qdata['question_slug']=$key;




      if($type=="first-order"){
          $weightradiounit=$data["weightunit"];
           $heightunitradio=$data["heightunit"];
           if(isset($data["unit-wegovy"])){
           $unitwegovyradio=$data["unit-wegovy"];
           }

      if (array_key_exists($key, $this->questions)) {

      $qdata['question_text']=$this->questions[$key];
       if(is_array($value)){
                  $qdata['answer_text']=implode(", ", $value);

                }else{
                   $qdata['answer_text']=$value;

                }
      }
      }else{
       if (array_key_exists($key, $this->reorder_questions)) {
       $qdata['question_text']=$this->reorder_questions[$key];
        if(is_array($value)){
                   $qdata['answer_text']=implode(", ", $value);

                 }else{
                    $qdata['answer_text']=$value;

                 }
       }
      }
         if($type=="first-order"){
  if($key=="weight"){

        $weightunit=explode("-",$weightradiounit);
        if(count($weightunit)>1){
         $qdata['answer_text'].= " ".$weightunit[0];
          if(isset($data["weight2"]) ){
                 $qdata['answer_text'].= " ".$data["weight2"]."  ".$weightunit[1];

            }
            }
        }
        if($key=="weight-wegovy"){
            $weightwegovyunit=explode("-",$unitwegovyradio);
                if(count($weightwegovyunit)>1){
                 $qdata['answer_text'].= " ".$weightwegovyunit[0];
                  if(isset($data["weight2-wegovy"]) ){
                         $qdata['answer_text'].= " ".$data["weight2-wegovy"]."  ".$weightwegovyunit[1];

                    }
                    }
        }
           if($key=="weight-wegovy"){

            $qdata['answer_text']=$doses[$value];
        }

         if($key=="height"){

             $heightunit=explode("-",$heightunitradio);
              if(count($heightunit)>1){
                 $qdata['answer_text'].= " ".$heightunit[0];
                   if(isset($data["height2"])){
                                     $qdata['answer_text'].= " ".$data["height2"]."  ".$heightunit[1];

                                }
                                }

       }

}

          if(isset($_SESSION['step_data'])){
           $qdata['uuid']=$_SESSION['step_data']['user_id'];
          }

                $qdata['member_id']=$memberID;
                $qdata['version']="v1";
           $columns = implode(", ", array_keys($qdata)); // Columns as a string
                        $values = "'" . implode("', '", array_map('addslashes', array_values($qdata))) . "'";
           $insert_query .="INSERT INTO ".PERCH_DB_PREFIX."questionnaire (".$columns.") VALUES (".$values."); ";

      }

     // }

//echo  $insert_query;

try{

    	$this->db->execute($insert_query);

}catch (Exception $e) {
          echo $e->getMessage();
         }

        // $this->db->insert(PERCH_DB_PREFIX.'questionnaire', $data);
        }
     }

     }
