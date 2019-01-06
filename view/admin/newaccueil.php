<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
            mdl-layout--fixed-tabs">
    <header class="mdl-layout__header">


        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Titre et bannière</a>
            <a href="#fixed-tab-2" class="mdl-layout__tab">Actualités, Articles et Map Google</a>
            <a href="#fixed-tab-3" class="mdl-layout__tab">Contenu de milieu a bas de page</a>
        </div>
    </header>
    <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
            <div class="page-content">
                <form method="post" id="formhp" action="?action=updatehp&controller=admin">
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="1">
                        <label class="mdl-textfield__label" for="1"><?php echo $pagetitlehp;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="2">
                        <label class="mdl-textfield__label" for="2"><?php echo $welcomephrase;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="3">
                        <label class="mdl-textfield__label" for="3"><?php echo $descbannerphrase;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="4"><?php echo "1ere image de la diapo";?></label>
                        <select class="mdl-textfield__input"  id="4">
                            <?php foreach ($tabimages as $image) { ?>
                            <option <?php echo ("images/$image" == $tabbanner['0']) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="5"><?php echo "2eme image de la diapo";?></label>
                        <select class="mdl-textfield__input"  id="5">
                            <?php foreach ($tabimages as $image) { ?>
                            <option <?php echo ("images/$image" == $tabbanner['1']) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="6"><?php echo "3eme image de la diapo";?></label>
                        <select class="mdl-textfield__input"  id="6">
                            <?php foreach ($tabimages as $image) { ?>
                            <option <?php echo ("images/$image" == $tabbanner['2']) ? 'selected':'';?>> <?php echo $image;?>

                               <?php }?>
                        </select>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                        Enregistrer
                    </button>
                </form>

                <h5> <?php echo $welcomephrase; ?> </h5>

                        <h6><?php echo $descbannerphrase; ?></h6>
                        <div>
                            <div class="contener_slideshow">
                                <div class="contener_slide">
                                    <?php $i=1; foreach ($tabbanner as $photo) {?>
                                        <div class="slid_<?php echo $i;?>"><img src="<?php echo $photo;?>" alt="..."></div>
                                        <?php $i++; }?>
                                </div>
                            </div>
                        </div>


            </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-2">
            <div class="page-content">
                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="4">
                    <label class="mdl-textfield__label" for="4"><?php echo $newsnameandtext;?></label>
                </div>


                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="5">
                    <label class="mdl-textfield__label" for="5"><?php echo $namearticlelink;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="6">
                    <label class="mdl-textfield__label" for="6"><?php echo $firstarticledisplayed;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="7">
                    <label class="mdl-textfield__label" for="7"><?php echo $secondarticledisplayed;?></label>
                </div>
            </div>

            <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="9">
                <label class="mdl-textfield__label" for="9"><?php echo $maptitle;?></label>
            </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-3">
            <div class="page-content">
                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="8">
                    <label class="mdl-textfield__label" for="8"><?php echo $firstparagraph;?></label>
                </div>



                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="10">
                    <label class="mdl-textfield__label" for="10"><?php echo $firstimagetitle;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="11">
                    <label class="mdl-textfield__label" for="11"><?php echo $firstimage;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="12">
                    <label class="mdl-textfield__label" for="12"><?php echo $firstimagephrase;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="13">
                    <label class="mdl-textfield__label" for="13"><?php echo $secondimagetitle;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="14">
                    <label class="mdl-textfield__label" for="14"><?php echo $secondimage;?></label>
                </div>

                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="15">
                    <label class="mdl-textfield__label" for="15"><?php echo $secondimageparagraph;?></label>
                </div>
            </div>
        </section>
    </main>
</div>