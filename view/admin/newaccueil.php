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
                        <select class="mdl-textfield__input" onchange="ActualizeSelectedPage('title','0');" name="id" id="0">
                            <?php foreach ($tabIds as $ids) {?>
                                <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <!--oninput="launchActualize('pagetitlehp', '1')"-->
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('pagetitlehp','1');" name="pagetitle" type="text" id="1">
                        <label class="mdl-textfield__label" id="label1" for="1"><?php echo $pagetitlehp;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('welcomephrase','2');" name="welcomephrase" type="text" id="2">
                        <label class="mdl-textfield__label" id="label2" for="2"><?php echo $welcomephrase;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('descbannerphrase','3');" name="descbannerphrase" type="text" id="3">
                        <label class="mdl-textfield__label" id="label3" for="3"><?php echo $descbannerphrase;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" id="label4" for="4">1ere image de la diapo</label>
                        <select class="mdl-textfield__input" onchange="ActualizeImage('photo1','4')" name="firstimagediapo" id="4">
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

                <div class="previsu" id="previsutitle">
                    <div>
                        <h1 id="pagetitlehp"><?php echo $pagetitlehp;?> (titre de la page)</h1>
                        <h5 id="welcomephrase"> <?php echo $welcomephrase; ?> </h5>

                        <h6 id="descbannerphrase"><?php echo $descbannerphrase; ?></h6>
                    </div>
                    <div class="contener_slideshow">
                        <div class="contener_slide">
                            <?php $i=1; foreach ($tabbanner as $photo) {?>
                                <div class="slid_<?php echo $i;?>"><img id="photo<?php echo $i;?>" src="<?php echo $photo;?>" alt="..."></div>
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
            <div class="page-content">
                <form method="post" action="?action=updatenewshp&controller=admin">
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="100">Page a modifer</label>
                        <select class="mdl-textfield__input" onchange="ActualizeSelectedPage('news','100');" name="id" id="100">
                            <?php foreach ($tabIds as $ids) {?>
                                <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('news','101');" name="news" type="text" id="101">
                        <label class="mdl-textfield__label" id="label101" for="101"><?php echo $news;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('name','102');" name="name" type="text" id="102">
                        <label class="mdl-textfield__label" id="label102" for="102"><?php echo $name;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('text','103');" name="text" type="text" id="103">
                        <label class="mdl-textfield__label" id="label103" for="103"><?php echo $text;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('namearticlelink','104');" name="namearticlelink" type="text" id="104">
                        <label class="mdl-textfield__label" id="label104" for="104"><?php echo $namearticlelink;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" id="label105" for="105">1er Article</label>
                        <select class="mdl-textfield__input" onchange="ActualizeSelectedImage('firstarticledisplayed','105')" name="firstarticledisplayed" id="105">
                            <?php foreach ($tabIdsArt as $idArt) { ?>
                            <option value="<?php echo $idArt;?>" <?php echo ("$idArt" == $firstarticledisplayed) ? 'selected':'';?>> <?php echo ModelArticle::select($idArt)->get('titreArticle');?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" id="label106" for="106">2eme Article</label>
                        <select class="mdl-textfield__input" onchange="ActualizeSelectedImage('secondarticledisplayed','106')" name="secondarticledisplayed" id="106">
                            <?php foreach ($tabIdsArt as $idArt) { ?>
                            <option value="<?php echo $idArt;?>" <?php echo ("$idArt" == $secondarticledisplayed) ? 'selected':'';?>> <?php echo ModelArticle::select($idArt)->get('titreArticle');?>
                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('maptitle','107');" name="maptitle" type="text" id="107">
                        <label class="mdl-textfield__label" id="label107" for="107"><?php echo $maptitle;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="maplink" type="text" id="108">
                        <label class="mdl-textfield__label" for="108"><?php echo $maplink;?></label>
                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                        Enregistrer
                    </button>
                </form>
                <div class="previsu" id="previsunews">
                    <div>
                        <h4 id="news"><?php echo $news; ?></h4>
                        <p id="name"><?php echo $name; ?> </p>
                        <p><a id="text" href="?action=display2nd&controller=laVieAlAMAP"><?php echo $text; ?></a></p> <!--redirection vers la page évenements-->
                        <h4><a id="namearticlelink" href="?action=display1st&controller=laVieAlAMAP"><?php echo $namearticlelink; ?></a></h4>

                    </div>

                    <div id="toinline">
                        <div>
                            <img id="firstarticledisplayed" src="<?php echo ModelArticle::select($firstarticledisplayed)->get('photo');?>" alt="<?php echo $firstarticledisplayed;?>" width="135" height="135"/>
                            <h4><a href="?action=display1st&controller=laVieAlAMAP"> <?php echo ModelArticle::select($firstarticledisplayed)->get('titreArticle'); ?> </a></h4>
                        </div>
                        <div>
                            <img id="secondarticledisplayed" src="<?php echo ModelArticle::select($secondarticledisplayed)->get('photo');?>" alt="<?php echo $secondarticledisplayed;?>" width="135" height="135"/>
                            <h4><a href="?action=display1st&controller=laVieAlAMAP"> <?php echo ModelArticle::select($secondarticledisplayed)->get('titreArticle'); ?> </a></h4>
                        </div>
                    </div>

                    <div>
                        <h3 id="maptitle"><?php echo $maptitle; ?></h3>
                        <iframe id="maplink" src="<?php echo $maplink;?>" width="135" height="135"></iframe>
                    </div>
                </div>
            </div>
        </section>




        <!--******************************************************
           ********************MILIEU****************************
          ******************************************************-->



        <section class="mdl-layout__tab-panel" id="fixed-tab-3">

            <div class="page-content">

                <form method="post" action="?action=updatemiddlehp&controller=admin">


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="19">Page a modifer</label>
                        <select class="mdl-textfield__input" onchange="ActualizeSelectedPage('middle','19');" name="id" id="19">
                            <?php foreach ($tabIds as $ids) {?>
                                <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" oninput="launchActualizeTextInput('firstparagraph','20');" name="firstparagraph" type="text" id="20" cols="4"></textarea>
                        <label class="mdl-textfield__label" id="label20" for="20"><?php echo $firstparagraph;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('firstparagraphlink','21');" name="firstparagraphlink" type="text" id="21">
                        <label class="mdl-textfield__label" id="label21" for="21"><?php echo $firstparagraphlink;?></label>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('firstimagetitle','22');" name="firstimagetitle" type="text" id="22">
                        <label class="mdl-textfield__label" id="label22" for="22"><?php echo $firstimagetitle;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" id="label23" for="23">1ere Image:</label>
                        <select class="mdl-textfield__input" onchange="ActualizeImage('firstimage','23')" name="firstimage" id="23">
                            <?php foreach ($tabimages as $image) { ?>
                            <option value="./images/<?php echo $image;?>" <?php echo ("./images/$image" == $firstimage) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>


                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('firstimagephrase','24');" name="firstimagephrase" type="text" id="24">
                        <label class="mdl-textfield__label" id="label24" for="24"><?php echo $firstimagephrase;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" oninput="launchActualizeTextInput('firstimagelist','25');" type="text" name="firstimagelist" id="25" cols="15" rows="4"><?php echo $firstimagelist; ?></textarea>
                        <label class="mdl-textfield__label" id="label25" for="25">Liste:</label>
                    </div>


                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                        Enregistrer
                    </button>

                </form>

                <div class="previsu" id="previsumiddle">
                    <div id="toinblock">
                        <p id="firstparagraph">   <?php echo $firstparagraph; ?>    </p>
                        <a id="firstparagraphlink" href="?action=display2nd&controller=nousConnaitre"><?php echo $firstparagraphlink ?></a>
                    </div>
                    <div>
                        <h2 id="firstimagetitle"><?php echo $firstimagetitle; ?></h2>
                        <img id="firstimage" class="imagesprevisu" src="<?php echo $firstimage; ?>" alt="AMAP présentation"/>
                    </div>
                    <div>
                        <p id="firstimagephrase"><?php echo $firstimagephrase; ?></p>
                        <ul id="firstimagelist">
                            <?php foreach ($list as $li) {
                                if($li != "") {?>
                                    <li><?php echo $li; ?> </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>

        </section>




        <section class="mdl-layout__tab-panel" id="fixed-tab-4">
            <div class="page-content">
                <form method="post" action="?action=updatebottomhp&controller=admin">
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" for="1000">Page a modifer</label>
                        <select class="mdl-textfield__input" onchange="ActualizeSelectedPage('bottom','1000');" name="id" id="1000">
                            <?php foreach ($tabIds as $ids) {?>
                                <option <?php echo ($ids==$idHomepage) ? 'selected':'';?>><?php echo $ids;?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('secondimagetitle','1001');" name="secondimagetitle" type="text" id="1001">
                        <label class="mdl-textfield__label" id="label1001" for="1001"><?php echo $secondimagetitle;?></label>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <label class="mdl-textfield__label" id="label1002" for="1002">2eme Image:</label>
                        <select class="mdl-textfield__input" onchange="ActualizeImage('secondimage','1002')" name="secondimage" id="1002">
                            <?php foreach ($tabimages as $image) { ?>
                            <option value="./images/<?php echo $image;?>" <?php echo ("./images/$image" == $secondimage) ? 'selected':'';?>> <?php echo $image;?>

                                <?php }?>
                        </select>
                    </div>

                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" oninput="launchActualizeTextInput('secondimageparagraph','1003');" name="secondimageparagraph" type="text" id="1003">
                        <label class="mdl-textfield__label" id="label1003" for="1003"><?php echo $secondimageparagraph;?></label>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                        Enregistrer
                    </button>
                </form>
            </div>
            <div class="previsu" id="previsubottom">
                <h2 id="secondimagetitle"><?php echo $secondimagetitle; ?></h2>
                <img id="secondimage" class="imagesprevisu" src="<?php echo $secondimage; ?>" alt="AMAP biologique"/> <!--width="925" height="335"-->
                <p id="secondimageparagraph"><?php echo $secondimageparagraph; ?></p>
            </div>
        </section>
    </main>
</div>
