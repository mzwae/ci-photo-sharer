<div class="page-header">
  <h1>Photo Sharer</h1>
</div>

<?php if(isset($result) && $result == true): ?>
  <strong class="text-info">Your image was uploaded successfully. You can share it via the URL below.</strong>
  <br>
  <br>
  <a href="<?=base_url().$result?>"><?=base_url().$result?></a>
  <br>
  <br>
  <img src="<?=base_url().'uploads'.'/'.$img_dir_name.'/'.$file_name?>" alt="uploaded image">
<?php endif; ?>
