<div class="page-header">
  <h1>Photo Sharer</h1>
</div>

<?php if(isset($result) && $result == true): ?>
  <strong>Encoded URL is:</strong>
  <a href="<?=base_url().$result?>">encoded url</a>
  <br>
  <img src="<?=base_url().'assets'.'/'.'upload'.'/'.$img_dir_name.'/'.$file_name?>" alt="uploaded image">
<?php endif; ?>
