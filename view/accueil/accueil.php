<?php echo $phrase; ?>
<p><a href="?action=setlang&controller=accueil&lang=English Homepage"> <img src="./images/gb.png" alt=""> </a>  <a href="?action=setlang&controller=accueil&lang=Accueil"> <img src="./images/fr.png" alt=""> </a></p>
<h1> <?php echo htmlspecialchars($welcomephrase); ?> </h1>

 <section class="usercontent">
  <article>
    <h2><?php echo htmlspecialchars($descbannerphrase); ?></h2>
    <div>
      <div class="contener_slideshow">
        <div class="contener_slide">
            <?php $i=1; foreach ($tabbanner as $photo) {?>
            <div class="slid_<?php echo $i;?>"><img src="<?php echo $photo;?>" alt="..."></div>
            <?php $i++; }?>
        </div>
      </div>
    </div>
    <p>
        <?php echo htmlspecialchars($firstparagraph); ?>    </p>
    <a href="?action=AMAPstory&controller=nousConnaitre"><?php echo htmlspecialchars($firstparagraphlink); ?></a></p> <!--redirection vers la page AMAP-->
  </article>
  <aside>
      <div>
          <h4><?php echo htmlspecialchars($newstab['0']); ?></h4>
          <p><?php echo htmlspecialchars($newstab['2']); ?> <br/>
              <a href="?action=readAllevents&controller=laVieAlAMAP"><?php echo htmlspecialchars($newstab['3']); ?></a></p> <!--redirection vers la page évenements-->
      </div>

   <div>
    <h4><a href="?action=readAllart&controller=laVieAlAMAP"><?php echo htmlspecialchars($namearticlelink); ?></a></h4>

       <img src="<?php echo $firstarticlephoto;?>" alt="<?php echo $firstarticledisplayed;?>" width="135" height="135"/>
       <h4><a href="?action=readAllart&controller=laVieAlAMAP"> <?php echo htmlspecialchars($firstarticlename); ?> </a></h4>

       <img src="<?php echo $secondarticlephoto;?>" alt="<?php echo $secondarticledisplayed;?>" width="135" height="135"/>
       <h4><a href="?action=readAllart&controller=laVieAlAMAP"> <?php echo htmlspecialchars($secondarticlename); ?> </a></h4>
  </div>
  
  <div>
    <h3><?php echo htmlspecialchars($maptitle); ?></h3>
    <iframe src="<?php echo htmlspecialchars($maplink);?>" width="135" height="135"></iframe>
  </div>
</aside>
<div class="clear"></div>
</section>
  
  <section class="usercontent">
  <article>
    <h2><?php echo htmlspecialchars($firstimagetitle); ?></h2>
    <img src="<?php echo $firstimage; ?>" alt="AMAP présentation"/> <!--width="925" height="335"-->
    <p>
        <?php echo htmlspecialchars($firstimagephrase); ?>
      <ul>
          <?php foreach ($list as $li) {
              if($li != "") {?>
          <li><?php echo htmlspecialchars($li); ?> </li>
          <?php }
          } ?>
      </ul>
    </p>
  </article>

</section>

  <section class="usercontent">
  <article>
    <h2><?php echo htmlspecialchars($secondimagetitle); ?></h2>
    <img src="<?php echo $secondimage; ?>" alt="AMAP biologique"/> <!--width="925" height="335"-->
    <p><?php echo htmlspecialchars($secondimageparagraph); ?></p>
  </article>


   </section>



