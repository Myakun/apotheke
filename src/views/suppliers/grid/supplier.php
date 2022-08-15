<?php

use app\models\Supplier;

/**
 * @var Supplier $supplier
 */

?>

<?php echo $supplier->name; ?>
<br>
<br>
<?php echo $supplier->getAttributeLabel('address'); ?>: <?php echo $supplier->address; ?>
<br>
<?php echo $supplier->getAttributeLabel('contact_person'); ?>: <?php echo $supplier->contact_person; ?>
<br>
<?php echo $supplier->getAttributeLabel('phone'); ?>: <?php echo $supplier->getPhoneFormatted(); ?>
