<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <?php
$path = './include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_description = '札幌市中央区のはずれにある理容室『メンズサロンkei』へ。カット・カラー・パーマメニュー以外に、植毛相談・赤ちゃん筆なども。薄毛に悩む男性におすすめの街の床屋さんです';
$page_keywords = '札幌,理容室,床屋';
include_once "meta.html";
?>

    <link rel="stylesheet" href="common/css/index.css" type="text/css" media="all" />
    <script type="text/javascript" src="common/js/jquery.maximage.js"></script>
    <script type="text/javascript" src="common/js/index.js"></script>

</head>

<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>

    <div id="background">
        <p><img src="images/bg01.jpg" width="1198" height="868" alt="" /></p>
        <p><img src="images/bg02.jpg" width="1198" height="868" alt="" /></p>
        <p><img src="images/bg03.jpg" width="1198" height="868" alt="" /></p>
    </div>

    <div id="headContainer">
        <h1><a href="<?php echo $abs_root;?>"><img src="common/images/head/logo.png" width="156" height="100" alt="札幌 理容室 メンズサロン kei" /></a></h1>
        <ul>
            <li><a href="about/"><img src="common/images/head/navi_about_off.png" width="130" height="36" alt="keiについて" /></a></li>
            <li><a href="menu/"><img src="common/images/head/navi_menu_off.png" width="138" height="36" alt="メニューリスト" /></a></li>
            <li><a href="fude/"><img src="common/images/head/navi_fude_off.png" width="138" height="36" alt="赤ちゃん筆" /></a></li>
            <li><a href="consult/"><img src="common/images/head/navi_consultation_off.png" width="130" height="36" alt="植毛相談" /></a></li>
            <li><a href="access/"><img src="common/images/head/navi_access_off.png" width="138" height="36" alt="アクセス" /></a></li>
            <li><a href="inquiry/"><img src="common/images/head/navi_inquiry_off.png" width="138" height="36" alt="お問い合わせ" /></a></li>
        </ul>

        <p class="text01"><img src="images/bg01_text.png" width="277" height="249" alt="日常の喧噪から離れた癒しの空間でお客様のお好みやお悩みを共有し、お一人おひとりにあったスタイルをご提案していきます。" /></p>
        <p class="text02"><img src="images/bg02_text.png" width="125" height="260" alt="これまで100人以上の赤ちゃんとご父母の方に喜ばれています。" /></p>
        <p class="text03"><img src="images/bg03_text.png" width="125" height="286" alt="相談出来ない髪の悩み。経験しているからお話できることがあります。" /></p>
        <!-- / #headContainer -->
    </div>

    <hr />



    <div id="contentsContainer">
        <div id="topArea">

            <!-- / #topArea -->
        </div>

        <div id="leftArea">
            <div id="menuArea" class="margin_b30">
                <h2><a href="menu/"><img src="images/menu_title_op.png" width="130" height="34" alt="メニューリスト" /></a></h2>
                <p><a href="menu/"><img src="images/menu_img.png" width="114" height="118" alt="メニューリスト" /></a></p>
                <dl>
                    <dt>調髪</dt>
                    <dd>4,100円</dd>
                    <dt>カット</dt>
                    <dd>3,300円</dd>
                    <dt>頭皮のさび取り</dt>
                    <dd>500円～</dd>
                    <dt>男のエステ</dt>
                    <dd class="last">1,000円</dd>
                </dl>
                <!-- / #menuArea -->
            </div>


            <div id="rivilegeArea">
                <h2><img src="images/privilege_title.png" width="204" height="38" alt="WEB特典 初回限定" /></h2>
                <p><img src="images/privilege01.png" width="313" height="39" alt="ご予約時に「ホームページ見た」で、豊富なレギュラーオプションから無料で一つお試しいただけます。" /></p>
                <p><a href="menu/#option"><img src="images/privilege02_op.png" width="313" height="50" alt="頭皮のサビ取り／男前シェーブ／イヤーエステ" /></a></p>
                <p><img src="images/privilege03.png" width="272" height="22" alt="その他オプションも多数ご用意しております。" /></p>
                <p><a href="menu/#recommend"><img src="images/oyako_op.png" width="293" height="90" alt="親子割　お父さんと一緒だからお子様も安心。そのうえ、オトク。" /></a></p>
                <!-- / #rivilegeArea -->
            </div>

            <div id="aboutArea">
                <h2><a href="about/"><img src="images/about_title_op.png" width="130" height="34" alt="keiについて" /></a></h2>
                <p class="img"><a href="about/"><img src="images/about_img.png" width="114" height="118" alt="keiについて" /></a></p>
                <p><img src="images/about_text.png" width="148" height="140" alt="あなたのための癒しの空間とお席をご用意してお待ちしております。マスター 刀根 禎津啓" /></p>
                <!-- / #aboutArea -->
            </div>

            <div id="accessArea">
                <h2><a href="access/"><img src="images/access_title_op.png" width="79" height="34" alt="アクセス" /></a></h2>
                <p><img src="images/access_img.png" width="299" height="218" alt="メンズサロン kei" /></p>
                <ul>
                    <li>市電「行啓通」より徒歩15秒</li>
                    <li>地下鉄南北線「幌平橋」より行啓通方面に徒歩5分</li>
                    <li>※駐車場はございません。<br>近隣のコインパーキングをご利用ください。</li>
                    <li><img src="images/wi_fi.png" width="213" height="45" alt="店内でWi-Fiが使えます" /></li>
                </ul>
                <!-- / #accessArea -->
            </div>

            <dl>
                <dt><img src="common/images/head/inquiry_title.png" width="156" height="22" alt="ご予約・お問い合わせはコチラ" /></dt>
                <dd><img src="common/images/head/inquiry_tel.png" width="210" height="30" alt="TEL：011-512-7472" /></dd>
                <dd><img src="common/images/head/inquiry_time.png" width="196" height="41" alt="営業時間：平日 9:00～19:30／日曜・祝日 8:30～19:00" /></dd>
            </dl>

            <div id="bottomBnrArea">
                <ul>
                    <li><a href="http://www.kuleba.jp/"><img src="images/bnr_kuleba_op.png" width="146" height="45" alt="北海道商店街情報サイト　KuLeBa" /></a></li>
                    <li><a href="http://www.011.or.jp/"><img src="images/bnr_011_op.png" width="146" height="45" alt="さっぽろわくわく商店街" /></a></li>
                    <li><a href="http://www.fighters.co.jp/company/effort/supporters/"><img src="images/bnr_fighters_op.png" width="146" height="45" alt="北海道日本ハムファイターズを応援する会" /></a></li>
                    <li><a href="http://www.kazapi.com/KAZAPi/"><img src="images/bnr_kazapi_op.png" width="146" height="45" alt="KAZAPi" /></a></li>
                    <li><a href="http://www.akachanfude.co.jp/"><img src="images/bnr_akachanfude_op.png" width="146" height="45" alt="赤ちゃん筆センター" /></a></li>
                    <li><a href="http://www.koubundo.co.jp/"><img src="images/bnr_koubundo_op.png" width="146" height="45" alt="株式会社 光文堂" /></a></li>
                    <li><a href="http://www.sapporo-itcl.com/"><img src="images/bnr_sapporo-itcl_op.png" width="146" height="45" alt="アイランド札幌クリニック" /></a></li>
                    <li><a href="http://www.ryuuseikan.jp/"><img src="images/bnr_ryu-seikan_op.png" width="146" height="45" alt="流星館治療院" /></a></li>
                </ul>
                <!-- / #bottomBnrArea -->
            </div>
            <!-- / #leftArea -->
        </div>

        <div id="rightArea">
            <div id="facebook">
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/%E3%83%A1%E3%83%B3%E3%82%BA%E3%82%B5%E3%83%AD%E3%83%B3kei/544580495655570" data-width="292" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false"></div>
            </div>

            <div id="messageArea" class="margin_b30">
                <h2><a href="message/"><img src="images/message_title_op.png" width="165" height="34" alt="kei's Message" /></a></h2>
                <dl>
                    <?php
include('fude/results/xml.php');
if(file_exists('message/data/list.xml')) {
	$xml = file_get_contents('message/data/list.xml');
	$xml = XML_unserialize($xml);
	$all_data = $xml['datas']['data'];
	if(count($all_data['link']) > 0) $all_data = array($all_data);
	foreach($all_data as $k => $v) : ?>
                    <dt><?php echo $v['date']; ?></dt>
                    <dd><a href="<?php echo $v['link']; ?>"><?php echo $v['title']; ?></a></dd>
                    <?php
	endforeach;
}
?>
                </dl>
                <!-- / #messageArea -->
            </div>

            <div id="fudeArea">
                <h2><a href="fude/"><img src="images/fude_title_op.png" width="110" height="34" alt="赤ちゃん筆" /></a></h2>
                <ul>
                    <li><a href="fude/about/"><img src="images/fude_navi01_op.png" width="98" height="134" alt="赤ちゃん筆について" /></a></li>
                    <li><a href="fude/flow/"><img src="images/fude_navi02_op.png" width="108" height="134" alt="筆ができるまで" /></a></li>
                    <li><a href="fude/results/"><img src="images/fude_navi03_op.png" width="98" height="119" alt="実績紹介" /></a></li>
                    <li><a href="fude/qa/"><img src="images/fude_navi04_op.png" width="108" height="119" alt="Q&A" /></a></li>
                </ul>
                <!-- / #fudeArea -->
            </div>

            <div id="consultArea">
                <h2><a href="consult/"><img src="images/consult_title_op.png" width="98" height="34" alt="植毛相談" /></a></h2>
                <ul>
                    <li><a href="consult/about/"><img src="images/consult_navi01_op.png" width="98" height="134" alt="植毛について" /></a></li>
                    <li><a href="consult/flow/"><img src="images/consult_navi02_op.png" width="108" height="134" alt="クリニック来院までの流れ" /></a></li>
                    <li><a href="consult/experience/"><img src="images/consult_navi03_op.png" width="98" height="119" alt="体験談" /></a></li>
                    <li><a href="consult/qa/"><img src="images/consult_navi04_op.png" width="108" height="119" alt="Q&A" /></a></li>
                </ul>
                <!-- / #consultArea -->
            </div>
            <!-- / #rightArea -->
        </div>

        <!-- / #contentsContainer -->
    </div>

    <?php include_once "foot.html"; ?>

</body>

</html>
