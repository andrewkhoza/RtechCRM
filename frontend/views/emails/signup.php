<!DOCTYPE html>
<?php
$url = Yii::$app->params['mainUrl'];
$fullurl = Yii::$app->params['mainUrlFull'];
$subject = str_replace('[[sitename]]', Yii::$app->params['siteName'], $emailtxt->email_subject);
$brief = str_replace('[[sitename]]', Yii::$app->params['siteName'], $emailtxt->email_brief);
?>
<html>
    <head>
        <title><?= $subject ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style type="text/css">
            /* CLIENT-SPECIFIC STYLES */
            body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
            table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
            img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

            /* RESET STYLES */
            img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
            table{border-collapse: collapse !important;}
            body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

            /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* MOBILE STYLES */
            @media screen and (max-width: 525px) {

                /* ALLOWS FOR FLUID TABLES */
                .wrapper {
                    width: 100% !important;
                    max-width: 100% !important;
                }

                /* ADJUSTS LAYOUT OF LOGO IMAGE */
                .logo img {
                    margin: 0 auto !important;
                }

                /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
                .mobile-hide {
                    display: none !important;
                }

                .img-max {
                    max-width: 100% !important;
                    width: 100% !important;
                    height: auto !important;
                }

                /* FULL-WIDTH TABLES */
                .responsive-table {
                    width: 100% !important;
                }

                /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
                .padding {
                    padding: 10px 5% 15px 5% !important;
                }

                .padding-meta {
                    padding: 30px 5% 0px 5% !important;
                    text-align: center;
                }

                .no-padding {
                    padding: 0 !important;
                }

                .section-padding {
                    padding: 50px 15px 50px 15px !important;
                }

                /* ADJUST BUTTONS ON MOBILE */
                .mobile-button-container {
                    margin: 0 auto;
                    width: 100% !important;
                }

                .mobile-button {
                    padding: 15px !important;
                    border: 0 !important;
                    font-size: 16px !important;
                    display: block !important;
                }

            }

            /* ANDROID CENTER FIX */
            div[style*="margin: 16px 0;"] { margin: 0 !important; }
        </style>
    </head>
    <body style="margin: 0 !important; padding: 0 !important;">

        <!-- HIDDEN PREHEADER TEXT -->
        <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
            <?= $brief ?>
        </div>

        <!-- HEADER -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td bgcolor="#FFFFFF" align="center">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                        <tr>
                            <td align="center" valign="top" style="padding: 3px 0;" class="logo">
                                <a href="<?= $fullurl ?>" target="_blank">
                                    <img alt="Logo" src="<?= $fullurl ?>images/logo_email.png" width="197" height="100" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px 15px 70px 15px;" class="section-padding">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td>
                                <!-- HERO IMAGE -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            
                                            <?php 
                                            $content = $emailtxt->text;
                                            $content = str_replace('[[sitename]]', Yii::$app->params['siteName'], $content);
                                            $content = str_replace('../../uploads/emails/uploads', $fullurl.'uploads/emails/uploads', $content);
                                            $content = str_replace('[[email]]', (!empty($user)?$user->email:""), $content);
                                            $content = str_replace('[[pass]]', '******', $content);
                                            $content = str_replace('[[confirmemaillink]]', '<a href="'.$fullurl.'frontend/web/site/confirmation-approve/1'.$user->id.'1?ms='.md5($user->email).'">Click here to confirm your email address</a>', $content);
                                            $content = str_replace('[[sitename]]', Yii::$app->params['siteName'], $content);
                                            echo $content;
                                            ?>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <!-- BULLETPROOF BUTTON -->
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" style="padding-top: 25px;" class="padding">
                                                        <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                            <tr>
                                                                <td align="center" style="border-radius: 3px;" bgcolor="#256F9C">
                                                                    <a href="<?= $fullurl  ?>frontend/web/site/confirmation-approve/1<?= $user->id ?>1?ms=<?= md5($user->email) ?>" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;" class="mobile-button">
                                                                        Confirm Email &rarr;
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php if(!empty($userinfo->anti_phish_code)){ ?>
                                        <tr>
                                            <td align="center">
                                                <!-- BULLETPROOF BUTTON -->
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center" style="padding-top: 25px;" class="padding">
                                                            <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                                                <tr>
                                                                    <td align="center">
                                                                        <br/><br/>
                                                                        Anti-Phishing Code:<br/>
                                                                        <?= $userinfo->anti_phish_code ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            
        </table>
    </body>
</html>
