<?php
$html  = '<!doctype html>'.PHP_EOL;
$html .= '<html>'.PHP_EOL;
$html .= '<head>'.PHP_EOL;
//$html .= '<link rel="canonical" href="'.$share_url.'">'.PHP_EOL;
$html .= '<meta name="author" content="'.$description.'"/>'.PHP_EOL;
$html .= '<meta property="og:title" content="'.$title.'"/>'.PHP_EOL;
$html .= '<meta property="og:description" content="'.$description.'"/>'.PHP_EOL;
$html .= '<meta property="og:image" content="'.$image.'"/>'.PHP_EOL;
//$html .= '<meta http-equiv="refresh" content="0;url='.$share_url.'">'.PHP_EOL;

$html .= '<meta name="twitter:card" content="summary" />'.PHP_EOL;
//$html .= '<meta name="twitter:url" content="'.$share_url.'" />'.PHP_EOL;
$html .= '<meta name="twitter:title" content="'.$title.'" />'.PHP_EOL;
$html .= '<meta name="twitter:description" content="'.$description.'" />'.PHP_EOL;
$html .= '<meta name="twitter:image" content="'.$image.'" />'.PHP_EOL;
$html .= '<meta name="twitter:site" content="@instaplus" />'.PHP_EOL;

$html .= '</head>'.PHP_EOL;
$html .= '<body></body>'.PHP_EOL;
$html .= '</html>';

echo $html;