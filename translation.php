<pre>- 文字の取得（html,scriptタグ削除） -</pre>
<?php
  //文字数をカウントしたいhtml記載（basic認証ページ＆BowNowのiframeはできません）
  $url = "http://192.168.33.10/iris.pas-ta.io/";
  $html = file_get_contents($url);//htmlコード取得
  $changeTxt = array('!<script.*?>.*?</script.*?>!mis', '/( |　)/');//script,全角半角空白を削除対象
  $rmScript = preg_replace($changeTxt, "", $html);//正規表現で$changeTxtを検索＆置換（上記指定を削除）
  $contents = strip_tags($rmScript);//htmlタグを削除

  $brContents = nl2br($contents);//タブスペースをbrに変換
  $words = preg_replace('#(<br */?>\s*)+#i', '<br />', $brContents);//2回以上の<br>を1回にする

  //metaタグ取得
  $meta = get_meta_tags($url);
  $description = $meta['description'];//keywordも欲しい場合は追加

  echo $description;
  echo $words;
?>
