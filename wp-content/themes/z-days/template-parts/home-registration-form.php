<form class="wow fadeIn form" data-wow-duration="1.3s" data-wow-delay="0.15s" action="/"
      method="post" novalidate>
    <div class="form-row">
        <div class="form-field">
            <label for="name-field"><?php _e("Имя *", "zdays"); ?></label>
            <input class="name" type="text" id="name-field" name="nameField" required>
            <!--                                        <span class="name-err"></span>-->
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="surname-field"><?php _e("Фамилия *", "zdays"); ?></label>
            <input class="surname" type="text" id="surname-field" name="surnameField" required>
            <!--                                        <span class="surname-err"></span>-->
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="email-field"><?php _e("Email *", "zdays"); ?></label>
            <input class="email" type="email" id="email-field" name="emailField" required>
            <!--                                        <span class="email-err"></span>-->
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="specialization-field"><?php _e("Специализация *", "zdays"); ?></label>
            <input class="specialization" type="text" id="specialization-field"
                   name="specializationField" required>
            <!--                                        <span class="specialization-err"></span>-->
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="tel-field"><?php _e("Телефон", "zdays"); ?></label>
            <input class="telephone" type="tel" id="tel-field" name="telField">
            <!--                                        <span class="telephone-err"></span>-->
        </div>
    </div>
    
    <!-- // Question fields //-->
    <div class="form-row">
        <div class="form-field">
            <span><?php _e("Расставьте самые дорогие валюты по капитализации в порядке убывания: Ethereum; BitcoinCash; Bitcoin; Ripple."); ?></span>
            <input class="question" type="text" name="question_1" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <span><?php _e("Какой самый популярный язык программирования для написания контрактов Ethereum: NET; Java; JavaScript; PHP; C++ ?"); ?></span>
            <input class="question" type="text" name="question_2" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <span><?php _e("Какая из валют не имеет контрактов: NEO; Ripple; Ethereum; Dash?"); ?></span>
            <input class="question" type="text" name="question_3" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <span><?php _e("Выберите самую бессмысленную валюту: IOTA; NEO; Ripple; Doge?"); ?></span>
            <input class="question" type="text" name="question_4" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <span><?php _e("Продлите смысловой ряд: BlockChain, Torrent, ... ?"); ?></span>
            <input class="question" type="text" name="question_5" required>
        </div>
    </div>
    
    
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