
<H2 id="donne"> Merci <?php echo htmlspecialchars($prenom); ?> pour votre don! </H2>
<p> Au total, vous avez aidé l'AMAP de <?php echo htmlspecialchars($donnateur->get('montantTotal')); ?> € ! </p>
<?php $mail= $donnateur->get('mailAddressDonnateur'); ?>
<a href="?action=generePDF&controller=nousSoutenir&mail=<?php echo urlencode($mail); ?>&prenom=<?php echo urlencode($prenom);?>&nom=<?php echo urlencode($nom); ?>" target="_blank"> télécharger la facture </a>