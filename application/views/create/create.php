<div class="page-header">
  <h1>Photo Sharer</h1>
</div>

<p>Upload your image...</p>

<?php echo validation_errors(); ?>
<?php if (isset($success) && $success == true): ?>
  <div class="alert alert-success">
    <strong>Your image has been successfully uploaded!</strong>
  </div>
<?php endif; ?>

<?php if (isset($fail) && fail == false):?>
  <div class="alert alert-danger">
    <strong>Error uploading image!</strong>
    <?php echo $fail; ?>
  </div>
<?php endif; ?>

<?php echo form_open_multipart('create/do_upload'); ?>
  <input type="file" name="userfile" size="20">
  <br>
  <input type="submit" value="upload">
<?php echo form_close(); ?>
<br>

<?php if(isset($result) && $result == true): ?>
  <div class="alert alert-info">
    <strong>Your image URL: </strong>
    <?php echo anchor($result, $result); ?>
  </div>
<?php endif; ?>
