<H2> Merci <?php echo $donnateur->get('prenomDonnateur') ?>! </H2>
<p> Au total, vous avez aidé l'AMAP de <?php echo $donnateur->get('montantTotal') ?> € ! </p>
<?php $mail= $donnateur->get('mailAddressDonnateur') ?>
<a href="?action=generePDF&controller=nousSoutenir&mail=<?php echo $mail ?>" target="_blank"> télécharger la facture </a>