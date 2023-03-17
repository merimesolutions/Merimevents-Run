<?php if(isset($_SESSION['added'])){
    echo '<script>$(document).ready(function (){save_success();});</script>';
    unset($_SESSION['added']);
    echo '<div class="alert alert-success alert-autocloseable-add" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Successfully Added !
</div>';
} ?>

<?php if(isset($_SESSION['edit'])){
    echo '<script>$(document).ready(function (){editsuccess();});</script>';
    unset($_SESSION['edit']);
    
echo '<div class="alert alert-success alert-autocloseable-editsuccess" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Changes saved successfully!
</div>';
} ?>

<?php if(isset($_SESSION['delete'])){
    echo '<script>$(document).ready(function (){deleted();});</script>';
    unset($_SESSION['delete']);
    
echo '<div class="alert alert-danger alert-autocloseable-danger" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Deleted Successfully !
</div>';
} ?>

<?php if(isset($_SESSION['duplicate'])){
    echo '<script>$(document).ready(function (){duplicate();});</script>';
    unset($_SESSION['duplicate']);
    
echo '<div class="alert alert-danger alert-autocloseable-duplicate" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Duplicate Entry
</div>'; }?>






