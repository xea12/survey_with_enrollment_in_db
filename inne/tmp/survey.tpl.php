

<table border="0" width="100%" cellspacing="0" cellpadding="0">

    <!-- Naglowek BOF -->
    <tr>
        <td class="infoBoxHeading" width="100%">Ankieta</td>
    </tr>
</table></td>
</tr>
<tr>
<td>
<table border="0" width="100%" cellspacing="0" cellpadding="5" class="infoBoxContents_Box">

    <tr>
        <td>
            <table border="0" width="90%" cellspacing="1" cellpadding="2" class="" align="center">
                <tr class="infoBoxContents">
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2" >
                            <tr>
                                <td align="center" style="margin-left:20px; margin-right:20px">

                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <br />
                                    <form class="survey-form" method="post" action="">
                                        <h1><i class="far fa-list-alt"></i>Ankieta DrTusz</h1>
<!--                                         <div id="steps2" class="steps">
                                            <div class="step current"></div>
                                            <div class="step"></div>
                                            <div class="step"></div>
                                        </div>-->
                                        <!--<div id="page-info"></div>-->
                                        <div class="step-content asks-step current" data-step="1" id="step-1">
                                            <div class="fields">
                                                <?= $formGenerator->createRateForm($q1, $a1, 'rating') ?>
                                                <?= $formGenerator->createRadioForm($q2, $a2, 'hear_about_us') ?>
                                                <?= $formGenerator->createRateForm($q3, $a3, 'recommend') ?>
                                                <?= $formGenerator->createCheckForm($q4, $a4, 'recommend') ?>

                                            </div>

                                            <div class="fields">
                                                <label for="email">Twój Email</label>
                                                <div class="field">
                                                    <i class="fas fa-envelope"></i>
                                                    <input id="email" type="email" name="email" <?=($email !== '') ? 'value="' .$email .'"' : 'placeholder="Twój Email"'?> required>
                                                </div>
                                                <label for="comments">Dodatkowe uwagi</label>
                                                <div class="field">
                                                    <textarea id="comments" name="comments" placeholder="Wpisz swoje uwagi..."></textarea>
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <input type="submit" class="btn" name="submit" value="Wyślij" style="background:var(--orange);">
                                            </div>
                                        </div>

                                        <!-- page 2 -->
                                        <div class="step-content" data-step="2">
                                            <div class="result"><?=$response?></div>
                                        </div>

                                        </div>
                                    </form>
                                    <br /><br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>




<?

?><?php
