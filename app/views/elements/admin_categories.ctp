<?php $categories = $this->requestAction('categories/index'); ?>
<div id = "categories">
   <h2>Categories</h2>
   <?php if(isset($this->params['ids'])) { $ids = $this->params['ids']; } else { $ids = array(); }?>
   <ul>
      <?php foreach($categories as $category): ?>
         <?php if(!empty($ids) && $category['Category']['id'] == $ids[count($ids)-1]): ?>
            <li><strong><?php echo $category['Category']['name']; ?></strong>
         <?php else: ?>
            <li><?php echo $url->admin_catlink($category); ?>
         <?php endif; ?>
            <?php if(in_array($category['Category']['id'], $ids) &&  isset($category['SubCategory'])): ?>
               <?php echo showLevel($category['SubCategory'], $url, $ids ); ?>
            <?php endif; ?>
            </li>
      <?php endforeach; ?>
   </ul>
   <?php   
      function showLevel($cats, $url, $ids) {
         $form = '<ul>';
         $count = 0;
         foreach($cats as $key => $cat):
            $class = '';
            if($count == count($cats)-1) $class = ' class = "last" ';
            if($cat['Category']['id'] == $ids[count($ids)-1]):
               $form .= '<li' . $class .'><strong>' . $cat['Category']['name'] . '</strong>';
            else:
               $form .= '<li' . $class . '>' .  $url->admin_catlink($cat);
            endif;
            if(in_array($cat['Category']['id'], $ids) && isset($cat['SubCategory']))
               $form .= showLevel($cat['SubCategory'], $url, $ids );
            $form .= '</li>';
            $count++;
         endforeach;
         $form .= '</ul>';
         return $form;
      }
   ?>
</div>