
<div class="comments-view-helpful js-block-couple-slider" >
  <div class="accordeon-comments information-comments-view">
    <?php
    krsort($typesComments);
    ?>
    <?foreach ($typesComments as $type => $comments):
      $subClass = 'parent';
      if($type != 'Комментарии родителей'){
        $subClass = 'expert';
      }
      $key = current($comments);
      $key = $key['ID'];
      ?>
      <?if(sizeof($comments)>0):?>
        <div class="comment comment--<?=$subClass;?> "><a href="" data-slider="<?=$anchor.'-'.$key;?>"><?=$type?></a></div>
      <?endif;?>
    <?endforeach;?>
  </div>

  <?foreach ($typesComments as $type => $comments):
    $key = current($comments);
    $key = $key['ID'];
    $is_slider = sizeof($comments)>1; ?>
  <div class="wrapper-silider " id="<?=$anchor.'-'.$key;?>">

    <div class="swiper-container swiper-container--expert-comment <?=($is_slider?'js-slider-comm':'');?>" data-key="<?=($is_slider?$anchor.'-'.$key:'');?>">
      <div class="swiper-wrapper">
        <?foreach ($comments as $id =>$comment):?>

          <div class="swiper-slide">
            <div class="item-view-helpful">
              <div class="name"><?=$comment['~NAME'];?></div>
              <div class="text"><?=$comment['~DETAIL_TEXT'];?></div>
            </div>
          </div>
        <?endforeach;?>
      </div>
    </div> <!--/swiper-container-expert--comment-->
    <?if($is_slider):?>
      <div class="swiper-button-next sl-next-black js-sl-expert-comment-next-<?=$anchor.'-'.$key;?>"></div>
      <div class="swiper-button-prev sl-prev-black js-sl-expert-comment-prev-<?=$anchor.'-'.$key;?>"></div>
    <?endif;?>
  </div>
  <?endforeach;?>
</div> <!--/comments-view-helpful-->