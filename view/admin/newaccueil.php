<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
            mdl-layout--fixed-tabs">
    <header class="mdl-layout__header">


        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Titre et bannière</a>
            <a href="#fixed-tab-2" class="mdl-layout__tab">Actualités, Articles et Map Google</a>
            <a href="#fixed-tab-3" class="mdl-layout__tab">Contenu du milieu de la page</a>
            <a href="#fixed-tab-4" class="mdl-layout__tab">Contenu du bas de la page</a>
        </div>
    </header>
    <main class="mdl-layout__content">



        <!--******************************************************
           ********************TITRE*****************************
          ******************************************************-->
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
            <div class="page-content">
                <form method="post" id="formhp" action="?action=updatetitlehp&controller=admin">
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="0">Page a modifer</label>
                        <select class="mdl-textfield__input" name="id" id="0">
                            <?php foreach ($tabIds as $ids) {?>
                                <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="pagetitle" type="text" id="1">
                        <label class="mdl-textfield__label" for="1"><?php echo $pagetitlehp;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="welcomephrase" type="text" id="2">
                        <label class="mdl-textfield__label" for="2"><?php echo $welcomephrase;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="descbannerphrase" type="text" id="3">
                        <label class="mdl-textfield__label" for="3"><?php echo $descbannerphrase;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="4">1ere image de la diapo</label>
                        <select class="mdl-textfield__input" name="firstimagediapo" id="4">
                            <?php foreach ($tabimages as $image) { ?>
                            <option <?php echo ("images/$image" == $tabbanner['0']) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="5">2eme image de la diapo</label>
                        <select class="mdl-textfield__input" name="secondimagediapo" id="5">
                            <?php foreach ($tabimages as $image) { ?>
                            <option <?php echo ("images/$image" == $tabbanner['1']) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="6">3eme image de la diapo</label>
                        <select class="mdl-textfield__input" name="thirdimagediapo" id="6">
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



        <!--******************************************************
           ********************Articles**************************
          ******************************************************-->


        <section class="mdl-layout__tab-panel" id="fixed-tab-2">
            <form method="post" action="?action=updatenewshp&controller=admin">
                <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <label class="mdl-textfield__label" for="100">Page a modifer</label>
                    <select class="mdl-textfield__input" name="id" id="100">
                        <?php foreach ($tabIds as $ids) {?>
                            <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="page-content">
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="news" type="text" id="101">
                        <label class="mdl-textfield__label" for="101"><?php echo $news;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="name" type="text" id="102">
                        <label class="mdl-textfield__label" for="102"><?php echo $name;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="text" type="text" id="103">
                        <label class="mdl-textfield__label" for="103"><?php echo $text;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="namearticlelink" type="text" id="104">
                        <label class="mdl-textfield__label" for="104"><?php echo $namearticlelink;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="105">1er Article</label>
                        <select class="mdl-textfield__input" name="firstarticledisplayed" id="105">
                            <?php foreach ($tabIdsArt as $idArt) { ?>
                            <option value="<?php echo $idArt;?>" <?php echo ("$idArt" == $firstarticledisplayed) ? 'selected':'';?>> <?php echo ModelArticle::select($idArt)->get('titreArticle');?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="106">2eme Article</label>
                        <select class="mdl-textfield__input" name="secondarticledisplayed" id="106">
                            <?php foreach ($tabIdsArt as $idArt) { ?>
                            <option value="<?php echo $idArt;?>" <?php echo ("$idArt" == $secondarticledisplayed) ? 'selected':'';?>> <?php echo ModelArticle::select($idArt)->get('titreArticle');?>
                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="maptitle" type="text" id="107">
                        <label class="mdl-textfield__label" for="107"><?php echo $maptitle;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="maplink" type="text" id="108">
                        <label class="mdl-textfield__label" for="108"><?php echo $maplink;?></label>
                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                        Enregistrer
                    </button>
            </form>

            <div>
                <h4><?php echo $news; ?></h4>
                <p><?php echo $name; ?> <br/>
                    <a href="?action=display2nd&controller=laVieAlAMAP"><?php echo $text; ?></a></p> <!--redirection vers la page évenements-->
            </div>

            <div>
                <h4><a href="?action=display1st&controller=laVieAlAMAP"><?php echo $namearticlelink; ?></a></h4>

                <img src="<?php echo ModelArticle::select($firstarticledisplayed)->get('photo');?>" alt="<?php echo $firstarticledisplayed;?>" width="135" height="135"/>
                <h4><a href="?action=display1st&controller=laVieAlAMAP"> <?php echo ModelArticle::select($firstarticledisplayed)->get('titreArticle'); ?> </a></h4>

                <img src="<?php echo ModelArticle::select($secondarticledisplayed)->get('photo');?>" alt="<?php echo $secondarticledisplayed;?>" width="135" height="135"/>
                <h4><a href="?action=display1st&controller=laVieAlAMAP"> <?php echo ModelArticle::select($secondarticledisplayed)->get('titreArticle'); ?> </a></h4>
            </div>

            <div>
                <h3><?php echo $maptitle; ?></h3>
                <iframe src="<?php echo $maplink;?>" width="135" height="135"></iframe>
            </div>


        </section>




        <!--******************************************************
           ********************MILIEU****************************
          ******************************************************-->



        <section class="mdl-layout__tab-panel" id="fixed-tab-3">

            <form method="post" action="?action=updatemiddlehp&controller=admin">

                <div class="page-content">

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="19">Page a modifer</label>
                        <select class="mdl-textfield__input" name="id" id="19">
                            <?php foreach ($tabIds as $ids) {?>
                                <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" name="firstparagraph" type="text" id="20" cols="4"></textarea>
                        <label class="mdl-textfield__label" for="20"><?php echo $firstparagraph;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="firstparagraphlink" type="text" id="21">
                        <label class="mdl-textfield__label" for="21"><?php echo $firstparagraphlink;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="firstimagetitle" type="text" id="21">
                        <label class="mdl-textfield__label" for="21"><?php echo $firstimagetitle;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="22">1ere Image:</label>
                        <select class="mdl-textfield__input" name="firstimage" id="22">
                            <?php foreach ($tabimages as $image) { ?>
                            <option value="./images/<?php echo $image;?>" <?php echo ("./images/$image" == $firstimage) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="firstimagephrase" type="text" id="23">
                        <label class="mdl-textfield__label" for="23"><?php echo $firstimagephrase;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" type="text" name="firstimagelist" id="20" cols="15" rows="4"><?php echo $firstimagelist; ?></textarea>
                        <label class="mdl-textfield__label" for="20">Liste:</label>
                    </div>


                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                        Enregistrer
                    </button>

            </form>

            <div>
                </p>
                <p>
                    <?php echo $firstparagraph; ?>    </p>
                <a href="?action=display2nd&controller=nousConnaitre"><?php echo $firstparagraphlink ?></a>

                <h2><?php echo $firstimagetitle; ?></h2>
                <img class="imagesprevisu" src="<?php echo $firstimage; ?>" alt="AMAP présentation"/>
                <p>
                    <?php echo $firstimagephrase; ?>
                <ul>
                    <?php foreach ($list as $li) {
                        if($li != "") {?>
                            <li><?php echo $li; ?> </li>
                        <?php }
                    } ?>
                </ul>

                </div>
            </div>

        </section>




<section class="mdl-layout__tab-panel" id="fixed-tab-4">
    <div class="page-content">
        <form method="post" action="?action=updatebottomhp&controller=admin">
        <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="1000">Page a modifer</label>
            <select class="mdl-textfield__input" name="id" id="1000">
                <?php foreach ($tabIds as $ids) {?>
                    <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                <?php }?>
            </select>
        </div>

        <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" name="secondimagetitle" type="text" id="1001">
            <label class="mdl-textfield__label" for="1001"><?php echo $secondimagetitle;?></label>
        </div>

        <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-textfield__label" for="1002">2eme Image:</label>
            <select class="mdl-textfield__input" name="secondimage" id="1002">
                <?php foreach ($tabimages as $image) { ?>
                <option value="./images/<?php echo $image;?>" <?php echo ("./images/$image" == $secondimage) ? 'selected':'';?>> <?php echo $image;?>

                    <?php }?>
            </select>
        </div>

        <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" name="secondimageparagraph" type="text" id="1003">
            <label class="mdl-textfield__label" for="1003"><?php echo $secondimageparagraph;?></label>
        </div>
        <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
            Enregistrer
        </button>
        </form>
    </div>

    <h2><?php echo $secondimagetitle; ?></h2>
    <img  class="imagesprevisu" src="<?php echo $secondimage; ?>" alt="AMAP biologique"/> <!--width="925" height="335"-->
    <p><?php echo $secondimageparagraph; ?></p>

</section>

</main>
</div>