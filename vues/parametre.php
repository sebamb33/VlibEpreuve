<div class="container">
    <div class="header">
        <?php include 'haut.php' ;?>
    </div>
    <div class="contentParametre">
        <div class="partieInfoUserParametre">
            <?php print($infoUser);?>
        </div>
        <div class="partieModificationParametre">
            <?php $formModif->afficherFormulaire();?>
        </div>
        <div class ="partieModifiAbonPay">
            <div class="sommePayParam">
                <?php $formPayement->afficherFormulaire();?>
            </div>
            <div class="changeAbonParam">
                <?php $formChoixAbonn->afficherFormulaire();?>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include 'bas.php' ;?>
    </div>
</div>