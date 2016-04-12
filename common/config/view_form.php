<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model['title'];
if($model['status']){
function default_tag($lbl, $ft, $id, $sec, $subs){ ?>
    <div class="more">        
        <input type="text" class="form-control" name="" value="">
    </div>
<?php }
function number_tag($lbl, $ft, $id, $sec, $subs){ ?>
    <div class="more">        
        <input type="number" class="form-control" name="" value="">
    </div>
<?php }
function checkbox_tag($lbl, $ft, $id, $sec, $subs){ ?>
    <div class="more">        
        <input type="checkbox" class="form-control" name="" value=""><br>
    </div>
<?php }

function check_tag($lbl, $ft, $id, $opt, $sec, $subs){ ?>
    <div class="more">
        <label>Multi Checkbox</label><br> 
        <?php
        if(count($opt) >= 1){
            foreach ($opt as $key => $value) {
                echo '<label><input type="checkbox"> '.$value.'</label>';                
            }
        }else{
            echo '<div class="form-group"><input name="section['.$sec.'][subsections]['.$subs.'][fields]['.$id.'][options][]" type="text"></div>';
        }
        ?>
    </div>
<?php }
function select_tag($lbl, $ft, $id, $opt, $sec, $subs){ ?>
    <div class="more">
        <label>Drop Down Options</label><br> 
        <select class="form-control" >
            <?php
            if(count($opt) >= 1){
                foreach ($opt as $key => $value) {                                        
                    echo '<option value="'.$value.'" >'.$value.'</option>';
                }
            }
            ?>
        </select>
    </div>
<?php }
function radio_tag($lbl, $ft, $id, $opt, $sec, $subs){ ?>
    <div class="more">
        <label>Radio Buttons Options</label><br> 
        <div class="form-group">
            <?php
            if(count($opt) >= 1){
                foreach ($opt as $key => $value) {
                    echo '<input type="radio" name="gender" value="'.$value.'"> '.$value.'<br>';
                }
            }
            ?>
        </div>
    </div>
    <?php }

    function get_option_list($lbl, $ft, $id, $opt, $sec, $subs){
        switch ($ft) {
            case "checkboxgroup":
                check_tag($lbl, $ft, $id, $opt, $sec, $subs);
                break;
            case "select":
                select_tag($lbl, $ft, $id, $opt, $sec, $subs);
                break;
            case "radio":
                radio_tag($lbl, $ft, $id, $opt, $sec, $subs);
                break;
        }
    }
    function get_simple_list($lbl, $ft, $id, $sec, $subs){        
        switch ($ft) {
            case "checkbox":
                checkbox_tag($lbl, $ft, $id, $sec, $subs);
                break;
            case "number":
                number_tag($lbl, $ft, $id, $sec, $subs);
                break;
            default:
                default_tag($lbl, $ft, $id, $sec, $subs);
                break;
        }
    }
    ?>
<div class="forms-view col-md-offset-3 col-md-6">        
    <?php
	echo '<h1>'.$model['title'].'<h1>';
    $cc = 1;
    $this_type = Yii::$app->user->identity->user_type;
    $content = json_decode($model->attributes['content']);    
    if (!empty($content)) {
        foreach ($content as $sec => $section) {
            $a1 = $a2 = $b1 = $b2 = '';
            if(isset($section->uacl)){
                if(isset($section->uacl->cc->v)){ $a1 = $section->uacl->cc->v; }
                if(isset($section->uacl->cc->e)){ $a2 = $section->uacl->cc->e; }
                if(isset($section->uacl->cg->v)){ $b1 = $section->uacl->cg->v; }
                if(isset($section->uacl->cg->e)){ $b2 = $section->uacl->cg->e; }                        
            }            
            	$duplicate = $section->duplicate; ?>
	            <section class="section<?= $sec; ?>">
	                <div class="input-group">
	                    <span class="input-group-addon">Section<?= $sec; ?></span>                                    
	                    <input type="text" required class="form-control" value="<?= $section->label ?>" name="section[<?= $sec; ?>][label]" placeholder="<?= $sec; ?>" />
	                    <span class="input-group-addon"><span foo-id="section<?= $sec ?>" class="view_help_u glyphicon glyphicon-question-sign"></span></span>
	                    <?php if($section->duplicate){ ?>
	                        <span class="input-group-addon"><span foo-id="section<?= $sec ?>" class="v_duplicate_u glyphicon glyphicon-duplicate"></span></span>
	                    <?php } ?>
	                </div>
	                
	                <div class="hide_u view_help_u_section<?= $sec ?>">
	                    <input type="text" class="form-control" value="<?php if(isset($section->help)){ echo $section->help; } ?>" placeholder="Help Text" name="section[<?= $sec; ?>][help]">
	                </div>
	                <br>
	                <ul foo-class="<?= $sec; ?>" class="list-group col-md-10 col-md-offset-2">
	                    <?php
	                    if(!empty($section->subsections)){
	                        foreach ($section->subsections as $subs => $subsection) {
	                            $aa1 = $aa2 = $bb1 = $bb2 = '';
	                            if(isset($section->uacl)){                        
	                                if(isset($subsection->uacl->cc->v)){ $aa1 = $subsection->uacl->cc->v; }
	                                if(isset($subsection->uacl->cc->e)){ $aa2 = $subsection->uacl->cc->e; }
	                                if(isset($subsection->uacl->cg->v)){ $bb1 = $subsection->uacl->cg->v; }
	                                if(isset($subsection->uacl->cg->e)){ $bb2 = $subsection->uacl->cg->e; }                        
	                            }
            					
	                            ?>                                
	                            <div class="subsection<?= $subs ?> ">
	                                <div class="input-group">
	                                    <span class="input-group-addon">Subsection<?= $subs ?></span>
	                                    <input required type="text" class="form-control" value="<?= $subsection->label ?>" name="section[<?= $sec; ?>][subsections][<?= $subs ?>][label]" placeholder="<?= $subs ?>" />                            
	                                    <span class="input-group-addon"><span foo-sec="section<?= $sec ?>" foo-sub-sec="subsection<?= $subs ?>" class="view_help_u_sub glyphicon glyphicon-question-sign"></span></span>
	                                    <?php if($subsection->duplicate){ ?>
	                                        <span class="input-group-addon"><span foo-sec="section<?= $sec ?>" foo-sub-sec="subsection<?= $subs ?>" class="v_duplicate_u_sub glyphicon glyphicon-duplicate"></span></span>
	                                    <?php } ?>              
	                                </div>
	                                <div class="hide_u view_help_u_section<?= $sec ?>_subsection<?= $subs; ?>">
	                                    <input type="text" class="form-control" value="<?php if(isset($subsection->help)){ echo $subsection->help; } ?>" placeholder="Help Text" name="section[<?= $sec; ?>][help]">
	                                </div>
	                                <ul subsection="<?= $subs ?>" section="<?= $sec ?>" class="list-group">
	                                    <?php
	                                    if(!empty($subsection->fields)){
	                                        $fields = $subsection->fields;
	                                        foreach ($fields as $fiel => $field) { ?>                                    
	                                            <div class="form-group">
	                                                <label class="control-label col-sm-2" for="<?= $field->label ?>"><?= $field->label ?>:</label>                                            
	                                                <div class="col-sm-10"> 
	                                                    <?php
	                                                    if(!empty($field->options)){
	                                                        get_option_list($field->label, $field->type, $fiel, $field->options, $sec, $subs);
	                                                    }else{
	                                                        get_simple_list($field->label, $field->type, $fiel, $sec, $subs);
	                                                    } ?>
	                                                </div>                                          
	                                            </div>                                      
	                                        <?php }
	                                    }else{ ?>

	                                    <?php } ?>

	                                </ul>
	                            </div>
	                        <?php 
	                    	}
	                    }   //if not empty $section->subsections
	                    ?>                
	                </ul>
	            </section>
	        	<?php
	        	
	        $cc++;
	        } //foreach sections
	    } // if $content
	}
	?>
</div>
