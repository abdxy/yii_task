<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model */
/* @var $country_list */
/* @var $city_list */
/* @var $neighborhood_list */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup',
                'enableAjaxValidation'=>true]); ?>

            <?= $form->field($model, 'email') ?>
            <div><input type="text" placeholder = "+962786186081" name="RegForm[phoneNo][]" value=""/>
            <div class="field_wrapper">

                <div>

                    <a href="javascript:void(0);" class="add_button" title="Add field">add one more</a>
                </div>
            </div>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'country')->dropDownList($country_list,
                [ 'prompt'=>'Please select country']); ?>
            <?= $form->field($model, 'city')->dropDownList([],
                ['prompt'=>'Please select city']); ?>
            <?= $form->field($model, 'neighborhood')->dropDownList([],['prompt'=>'Please select neighborhood']); ?>
            <?= $form->field($model, 'birthDate')->widget(DatePicker::className(), [
               'clientOptions' => [
               'language' => 'en',
               'dateFormat' => 'yyyy-MM-dd',
                   ]
                ])?>
            <?= $form->field($model, 'gender')->radioList( ['f'=>'female',  'm' => 'male'] );?>


            <div class="form-group">
                <?= Html::submitButton('signUp', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js=<<<JS
      $("#regform-country").change(function() {
        var element = '#regform-city';
        $(element).empty();
        $(element).append('<option>'+'Please select </option>');
        $(element).attr('selectedIndex', '-1'); 
      });
      $("#regform-city").change(function() {
        var element = '#regform-neighborhood';
        $(element).empty();
        $(element).append('<option>'+'Please select </option>');
        $(element).attr('selectedIndex', '-1'); 
      });
      $("select").change(function() {
         var content = $(this).val();
         if(content=='')
         {
             return false;
         }
         var load;
         var element;
         switch ($(this).attr("id")) {
           case 'regform-country':load = 'load-cities';  
                                  element = '#regform-city';
                                  break;
           case 'regform-city':load = 'load-neighborhood';
                               element = '#regform-neighborhood';
                               break;
         }


         

         $.ajax
            ({
              type: "GET",
              url: "/site/"+load,
              data: {'id':content},
              success: function(response)
              {
                  $.each( response, function( key, value ) {
                  $(element).append('<option value='+key+'>'+value+'</option>');
                });
              }
            });

      });
JS;
$js2=<<<JS
    var maxField = 4; 
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper'); 
    var x = 0; 
    

    $(addButton).click(function(){

        if(x < maxField){ 
            x++;
            $(wrapper).append('<div><input type="text" placeholder = "+962786186081" name="RegForm[phoneNo][]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'); //Add field html
        }
    });
    
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
JS;

$this->registerJs($js);
$this->registerJs($js2);

//$this->registerJsFile();