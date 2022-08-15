<?php

use app\models\Customer;

/**
 * @var Customer $customer
 */

?>

<?php echo $customer->name; ?>
<br>
<br>
<?php echo $customer->getAttributeLabel('address'); ?>: <?php echo $customer->address; ?>
<br>
<?php echo $customer->getAttributeLabel('contact_person'); ?>: <?php echo $customer->contact_person; ?>
<br>
<?php echo $customer->getAttributeLabel('phone'); ?>: <?php echo $customer->getPhoneFormatted(); ?>
