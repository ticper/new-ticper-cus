<?php
  // エラーを出力しない
  error_reporting(0);
  $db_host = 'db.ticper.com';
  $db_user = 'ticper';
  $db_pass = 'ticp-37648';
  $db_name = 'ticper';

  $db_link = new mysqli($db_host, $db_user, $db_pass, $db_name);
  mysqli_set_charset($db_link, 'utf8');

  $img_link = ('https://ticper-2-yakiniki.c9users.io/new-ticper-booth/img/');

  if (mysqli_connect_errno()) {
    print('<!DOCTYPE HTML>');
    print('<html charset="UTF-8">');
    print('<head>');
    print('<meta name="viewport" content="width=device-width,initial-scale=1.0">');
    print('<title>サーバーに問題が発生しました。</title>');
    print('<style>.midashi {position: fixed; width: 100%; height: 100%; top: 0%; left: 0%;}</style>');
    print('</head>');
    print('<body>');
    print('<div class="midashi">');
    print('<div align="center"><br><h1><b>サーバに問題が発生しました。</b></h1></div></div></body></html>');
    exit();
  }
?>
