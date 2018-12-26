<h1> Bienvenue sur le site de l'AMAP de la région Occitanie </h1>


<!-- aside sur le coté gauche -->



<!-- article pour l'essentiel de la page -->

 
 <section class="usercontent">
  <article>
    <h2>Présentation de l'AMAP.</h2>
    <img src="./images/section1-accueil.jpg" alt="AMAP partage"/> <!--width="925" height="335"-->
    <p>
    L'AMAP d'O regroupe plusieurs maraîchers et éveleurs de la région Occitanie, qui vous proposent leurs produits BIO. Mauris ante tellus, egestas nec arcu eget, hendrerit laoreet velit. Pellentesque id urna in massa scelerisque fermentum ac vel leo. Curabitur sem sapien, feugiat vel varius sed, condimentum vitae erat. Vestibulum non velit augue. Maecenas pretium in ex sed luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis vel sodales lacus. Phasellus diam massa, tincidunt a dui a, porttitor posuere nisi. Maecenas arcu risus, volutpat sit amet cursus sed, facilisis in nisi.
    </p>
    <a href="?action=display2nd&controller=nousConnaitre">En savoir plus...</a></p> <!--redirection vers la page AMAP-->
  </article>
  <aside>
  <div>
    <h4>Actualités</h4>
    <p>Prochaine rencontre à Saint-Jean-de-Védas. <br/>
      <a href="?action=display2nd&controller=laVieAlAMAP">plus de renseignements ici.</a></p> <!--redirection vers la page évenements-->
  </div>

   <div>
    <h4><a href="?action=display1st&controller=laVieAlAMAP">Derniers articles</a></h4>



   <?php
      foreach($values as $key){ 
        //var_dump($key);
        echo '<img src="' . $key->get('photo') . '" alt="' . $key->get('idArticle') . '" width="135" height="135"/><h4><a href="?action=display1st&controller=laVieAlAMAP">' . $key->get('titreArticle') . '</a></h4>';
        }

     ?>


   <!-- <img src="./images/Article1.jpg" alt="Article 1" width="135" height="135"/>
    <h4>Nouveau producteur à Grabels.</h4> // redirigera vers l'article1 qu'on créera plus tard-->
    <!--<img src="./images/Article2.jpg" alt="Article 2" width="135" height="135"/>
    <h4>Cuisinez votre butternut.</h4> // redirigera vers l'article2 qu'on créera plus tard-->
  </div>
  
  <div>
    <h3>Nous trouver</h3>
    <iframe src="https://www.google.com/maps/d/embed?mid=1jXR-N1Ge3qSqQ48tiTxcWRYDfhcAoGb2" width="135" height="135"></iframe>
  </div>
</aside>
<div class="clear"></div>
</section>
  
  <section class="usercontent">
  <article>
    <h2>Q'est-ce qu'une AMAP ?</h2>
    <img src="./images/section2-accueil.jpg" alt="AMAP présentation"/> <!--width="925" height="335"-->
    <p>
    	À travers notre site, vous pouvez profiter d'une multitude de fonctionnalités :
    <ul>
    	<li>Découvrir les valeurs de l'AMAP</li>
    	<li>Profiter des articles, des recettes et s'informer sur les évenements organisés par les adhérents</li>
    	<li>Consulter les contrats que nos partenaires proposent</li>
    	<li>Adhérer à l'AMAP et choisir son ou ses contrats</li>
    </p>
  </article>
  <aside>
    <h1> ASIDE </h1>
  </aside>
</section>

  <section class="usercontent">
  <article>
    <h2>Notre engagement dans le BI0</h2>
    <img src="./images/section3-accueil.jpg" alt="AMAP biologique"/> <!--width="925" height="335"-->
    <p>Ut hendrerit ex ac libero venenatis, sit amet elementum dolor porttitor. Vivamus semper, erat non facilisis pellentesque, mauris ipsum ullamcorper lacus, ac egestas tortor turpis eu ligula. Nulla lacinia hendrerit libero, nec sollicitudin enim fermentum vitae. Nullam vestibulum, leo gravida luctus vehicula, diam dolor condimentum nulla, in pretium orci massa non erat. Duis gravida est porttitor, efficitur tellus ut, tincidunt est. In hac habitasse platea dictumst. Aliquam semper imperdiet ligula, sed vulputate dolor ultrices ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras feugiat maximus libero, in ultrices diam eleifend nec. Sed ut erat porttitor, vulputate dui quis, volutpat lorem.</p>
  </article>
  <aside>
    <h1> ASIDE </h1>
  </aside>

   </section>



