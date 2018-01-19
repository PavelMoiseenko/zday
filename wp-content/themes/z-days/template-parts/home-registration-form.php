<?php $fields = get_field('registration_form_extra_fields', $event_id); ?>

<form class="wow fadeIn form" data-wow-duration="1.3s" data-wow-delay="0.15s" action="/"
      method="post" novalidate>
    <div class="form-row">
        <div class="form-field">
            <label for="name-field"><?php _e("Имя *", "zdays"); ?></label>
            <input class="name" type="text" id="name-field" name="nameField" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="surname-field"><?php _e("Фамилия *", "zdays"); ?></label>
            <input class="surname" type="text" id="surname-field" name="surnameField" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="email-field"><?php _e("Email *", "zdays"); ?></label>
            <input class="email" type="email" id="email-field" name="emailField" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="specialization-field"><?php _e("Специализация *", "zdays"); ?></label>
            <input class="specialization" type="text" id="specialization-field"
                   name="specializationField" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="tel-field"><?php _e("Телефон", "zdays"); ?></label>
            <input class="telephone" type="tel" id="tel-field" name="telField">
        </div>
    </div>
        
    <?php if( $fields !== null && is_array($fields) ) :
        foreach ($fields as $key=>$field) :
            $n = $key + 1;
            extract($field); ?>
            <div class="form-row">
            <?php if( $text ) : ?><span><?php _e($text, "zdays"); ?></span><?php endif; ?>
            <div class="form-field">
                <label for="question_<?php echo $n; ?>"><?php _e($placeholder, "zdays"); ?></label>
                <input id="question_<?php echo $n; ?>" class="question" type="text" 
                       name="question_<?php echo $n; ?>" <?php echo $required ? 'required' : '';?>>
            </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>   
    
    <input class="event_id" type="hidden" name="event_id" value="<?php echo $event_id; ?>">
    <?php $registration_cta_text = get_field('registration_cta_text');
    if ($registration_cta_text) :
        ?>
        <div class="btn-holder register">
            <button class="button" type="submit"><?php echo $registration_cta_text; ?></button>
        </div>
        <div class="message"></div>
    <?php endif;
    $event_plan = get_field("event_plan", $event_id);
    ?>
</form>
<div class="message-holder success-message"></div>