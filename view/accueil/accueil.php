<?php echo $phrase; ?>
<p><a href="?action=setlang&controller=accueil&lang=English Homepage"> <img src="./images/gb.png" alt=""> </a>  <a href="?action=setlang&controller=accueil&lang=Accueil"> <img src="./images/fr.png" alt=""> </a></p>
<h1> <?php echo $welcomephrase; ?> </h1>

 <section class="usercontent">
  <article>
    <h2><?php echo $descbannerphrase; ?></h2>
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
        <?php echo $firstparagraph; ?>    </p>
    <a href="?action=display2nd&controller=nousConnaitre"><?php echo $firstparagraphlink ?></a></p> <!--redirection vers la page AMAP-->
  </article>
  <aside>
      <div>
          <h4><?php echo $newstab['0']; ?></h4>
          <p><?php echo $newstab['2']; ?> <br/>
              <a href="?action=display2nd&controller=laVieAlAMAP"><?php echo $newstab['3']; ?></a></p> <!--redirection vers la page évenements-->
      </div>

   <div>
    <h4><a href="?action=display1st&controller=laVieAlAMAP"><?php echo $namearticlelink; ?></a></h4>

       <img src="<?php echo $firstarticlephoto;?>" alt="<?php echo $firstarticledisplayed;?>" width="135" height="135"/>
       <h4><a href="?action=display1st&controller=laVieAlAMAP"> <?php echo $firstarticlename ?> </a></h4>

       <img src="<?php echo $secondarticlephoto;?>" alt="<?php echo $secondarticledisplayed;?>" width="135" height="135"/>
       <h4><a href="?action=display1st&controller=laVieAlAMAP"> <?php echo $secondarticlename ?> </a></h4>
  </div>
  
  <div>
    <h3><?php echo $maptitle; ?></h3>
    <iframe src="<?php echo $maplink;?>" width="135" height="135"></iframe>
  </div>
</aside>
<div class="clear"></div>
</section>
  
  <section class="usercontent">
  <article>
    <h2><?php echo $firstimagetitle; ?></h2>
    <img src="<?php echo $firstimage; ?>" alt="AMAP présentation"/> <!--width="925" height="335"-->
    <p>
        <?php echo $firstimagephrase; ?>
      <ul>
          <?php foreach ($list as $li) {
              if($li != "") {?>
          <li><?php echo $li; ?> </li>
          <?php }
          } ?>
      </ul>
    </p>
  </article>

</section>

  <section class="usercontent">
  <article>
    <h2><?php echo $secondimagetitle; ?></h2>
    <img src="<?php echo $secondimage; ?>" alt="AMAP biologique"/> <!--width="925" height="335"-->
    <p><?php echo $secondimageparagraph; ?></p>
  </article>


   </section>



