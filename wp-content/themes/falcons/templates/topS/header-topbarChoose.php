<?php $falcons_option_data =get_option('falcons_option_data');  ?>


 <?php if(isset($falcons_option_data['falcons-top-bar-switch']) && ($falcons_option_data['falcons-top-bar-switch']==1)){?>

      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==1)){?>
        <?php get_template_part('templates/topS/header','top1'); ?>
      <?php } ?>

      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==2)){?>
        <?php get_template_part('templates/topS/header','top2'); ?>
      <?php } ?>

      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'] ) && ($falcons_option_data['falcons-multi-topBar-image'])==3){?>
        <?php get_template_part('templates/topS/header','top3'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==4)){?>
        <?php get_template_part('templates/topS/header','top4'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==5)){?>
        <?php get_template_part('templates/topS/header','top5'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==6)){?>
        <?php get_template_part('templates/topS/header','top6'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==7)){?>
        <?php get_template_part('templates/topS/header','top7'); ?>
      <?php } ?>

      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==8)){?>
        <?php get_template_part('templates/topS/header','top8'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==9)){?>
        <?php get_template_part('templates/topS/header','top9'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==10)){?>
        <?php get_template_part('templates/topS/header','top10'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==11)){?>
        <?php get_template_part('templates/topS/header','top11'); ?>
      <?php } ?>
      
      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==12)){?>
        <?php get_template_part('templates/topS/header','top12'); ?>
      <?php } ?>

      <?php if(isset($falcons_option_data['falcons-multi-topBar-image'])&&($falcons_option_data['falcons-multi-topBar-image']==13)){?>
        <?php get_template_part('templates/topS/header','top13'); ?>
      <?php } ?>

<?php } ?>



