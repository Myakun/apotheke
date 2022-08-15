<?php

use app\models\User;

/**
 * @var User $user
 */

?>

<?php echo $user->id; ?>
<br>
<small class="text-muted">
    Создан
    <?php echo Yii::$app->formatter->asDatetime($user->created_at); ?>
    <?php if (null != $user->created_by) { ?>
        пользователем
        <?php echo $user->createdBy->name; ?>
    <?php } ?>
</small>