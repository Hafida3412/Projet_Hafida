<?php
?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TRRV37X3');</script>
<!-- End Google Tag Manager -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/AmauriC/tarteaucitron.js@1.3/tarteaucitron.js"></script>

<script type="text/javascript">
tarteaucitron.init({
  "privacyUrl": "index.php?ctrl=location&action=mentionsLegales", /* URL de la politique de confidentialité */
  "bodyPosition": "bottom", /* Position du bandeau */
  "hashtag": "#tarteaucitron",
  "cookieName": "tarteaucitron",
  "orientation": "middle",
  "groupServices": false,
  "showDetailsOnClick": true,
  "serviceDefaultState": "wait",
  "showAlertSmall": false,
  "cookieslist": true,
  "closePopup": false,
  "showIcon": true,
  "iconPosition": "BottomRight",
  "adblocker": false,
  "DenyAllCta": true,
  "AcceptAllCta": true,
  "highPrivacy": true,
  "alwaysNeedConsent": false,
  "handleBrowserDNTRequest": false,
  "removeCredit": false,
  "moreInfoLink": true,
  "useExternalCss": false,
  "useExternalJs": false,
  "mandatory": true,
  "mandatoryCta": true,
  "googleConsentMode": true,
  "partnersList": false
});

// Ajout des services qui nécessitent un consentement
tarteaucitron.user.gajsId = 'GTM-TRRV37X3';
        tarteaucitron.user.gajsMore = function () { /* add here your optionnal _ga.push() */ };
        (tarteaucitron.job = tarteaucitron.job || []).push('gajs');

tarteaucitron.job.push('gcmfunctionality');  // Google Consent Mode
tarteaucitron.job.push('facebook');  // Facebook

// On peut éventuellement ajouter d'autres scripts ou fonctionnalités nécessitant un consentement ici
</script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRRV37X3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<img src="public/img/chat.png" alt="regard d'un chat" style="width: 100%; height: auto; object-fit: contain;">

<div class="login-container">
<h1>Se connecter</h1>

<form action="index.php?ctrl=security&action=login" method="post">
<label for="email">Email</label>
<input type="email" name="email" id="email" value="lea@gmail.com" required><br>

<label for="password">Mot de passe</label>
<input type="password" name="password" id="password" value="AZERTY12345" required><br>

<div class="g-recaptcha" data-sitekey="6LeUhkYqAAAAALeAYNXSofNNSW3Fw9vzIRzl4Ngw" data-action="LOGIN" required></div>
<br/>
<input type="submit" name="submitLogin" value="Se connecter">
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>

<!-- Lien vers la vue forgotPassword -->
<p><a href="index.php?ctrl=security&action=forgotPassword">Mot de passe oublié ?</a></p>

</form>
</div>

