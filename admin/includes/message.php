<?php if( isset($message_errors) && $message_errors!= "") : ?>
    <div class='alert alert-danger' role="alert">
        <?php echo $message_errors; ?>
    <div>   
<?php endif; ?>
<?php if (isset($message_success) && $message_success!= "") : ?>
    <div class='alert alert-success' role="alert">
        <?php echo $message_success; ?>
    <div>   
<?php endif; ?>