<pre>- 文字数カウント（html, js削除ver.） -</pre>
<?php
  //文字数をカウントしたいhtml記載（basic認証ページ＆BowNowのiframeはできません）
  $url = "http://192.168.33.10/iris.pas-ta.io/news/";
  $html = file_get_contents($url);//htmlコード取得
  $changeTxt = array('!<script.*?>.*?</script.*?>!mis', '/( |　)/', '/[\t|\s{2,}]/', '!<header.*?>.*?</header.*?>!mis', '!<footer.*?>.*?</footer.*?>!mis');//script,全角半角空白,タブ空白, header, footerを削除対象
  $rmScript = preg_replace($changeTxt, "", $html);//正規表現で$changeTxtを検索＆置換
  $contents = strip_tags($rmScript);//htmlタグを削除

  //metaタグ取得
  $meta = get_meta_tags($url);
  $description = $meta['description'];//keywordも欲しい場合は追加

  echo $contents;
  echo $description;
  echo "<br>-----------<br>";
  //（title + コンテンツ）+descriptionの文字数
  $count = mb_strlen($contents) + mb_strlen($description);
  echo $count . "文字";
?>
