<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <?php
$path = '../include/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

$page_title = 'アクセス';
$page_description = 'メンズサロンkeiへのアクセス【〒064-0914北海道札幌市中央区南14条西7丁目2-3（市電行啓通駅すぐ近く)TEL：011-512-7472】札幌市中央区のはずれにある理容室『メンズサロンkei』へ。薄毛に悩む男性におすすめの街の床屋さんです。';
$page_keywords = '札幌,理容室,床屋';
include_once "meta.html";
?>

    <!-- local -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="js/map.js"></script>
    <!-- /local -->

</head>

<body>
    <?php include_once "head.html"; ?>

    <div id="pageTitle">
        <h1><img src="images/page_title.png" width="120" height="40" alt="アクセス" /></h1>
        <p><a href="<?php echo $abs_root;?>">HOME</a> &gt; アクセス</p>
        <!-- / #pageTitle -->
    </div>

    <div id="contentsContainer">
        <div id="contentsArea">

            <div id="accessMap"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2916.0000246896075!2d141.34823141547795!3d43.04143097914709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f0b2a220a4c3c37%3A0x47aa573484d213bc!2z44Oh44Oz44K644K144Ot44Oz77yr772F772J!5e0!3m2!1sja!2sjp!4v1569817407194!5m2!1sja!2sjp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>

            <div id="accessContents">
                <p class="large_map_link"><a href="http://maps.google.co.jp/maps?q=%E5%8C%97%E6%B5%B7%E9%81%93%E6%9C%AD%E5%B9%8C%E5%B8%82%E4%B8%AD%E5%A4%AE%E5%8C%BA%E5%8D%9714%E6%9D%A1%E8%A5%BF7%E4%B8%81%E7%9B%AE2-3&ie=UTF8&ll=43.041936,141.352952&spn=0.009974,0.01899&hnear=%E5%8C%97%E6%B5%B7%E9%81%93%E6%9C%AD%E5%B9%8C%E5%B8%82%E4%B8%AD%E5%A4%AE%E5%8C%BA%E5%8D%97%EF%BC%91%EF%BC%94%E6%9D%A1%E8%A5%BF%EF%BC%97%E4%B8%81%E7%9B%AE%EF%BC%92%E2%88%92%EF%BC%93&gl=jp&t=m&z=16&brcurrent=3,0x5f0b2a1c1d232461:0x72e2ab41f7fbfd4,0">大きい地図を見る</a></p>

                <div class="map_area">
                    <p class="map"><img src="images/map.png" width="289" height="208" alt="地図" /></p>
                    <p>市電「行啓通」より徒歩15秒<br />
                        地下鉄南北線「幌平橋」より行啓通方面に徒歩5分</p>
                    <!-- / .map_area -->
                </div>

                <div class="shop_area">
                    <h2><img src="images/shop_name.png" width="113" height="32" alt="メンズサロン kei" /></h2>
                    <p><img src="images/shop_tel.png" width="198" height="53" alt="ご予約・お問い合わせはコチラ TEL:011-512-7472" /></p>
                    <address>〒064-0914<br />
                        北海道札幌市中央区南14条西7丁目2-3</address>
                    <dl>
                        <dt>営業時間</dt>
                        <dd>
                            <dl>
                                <dt>平日</dt>
                                <dd>9:00～19:00</dd>
                                <dt>日曜・祝日</dt>
                                <dd>8:30～18:30</dd>
                            </dl>
                        </dd>
                        <dt></dt>
                        <dd></dd>
                        <dt>定休日</dt>
                        <dd>毎週火曜日、第3月曜日</dd>
                        <dt>※駐車場はございません。<br>近隣のコインパーキングをご利用ください。</dt>
                    </dl>
                    <!-- / .shop_area -->
                </div>
                <!-- / #accessContents -->
            </div>

            <!-- / #contentsArea -->
        </div>

        <div id="sideArea">
            <div id="sideNavi">
                <dl>
                    <dt><img src="images/side_title.png" width="225" height="46" alt="アクセス" /></dt>
                    <dd>
                        <ul>
                            <li><strong><a href="./">アクセス</a></strong></li>
                        </ul>
                    </dd>
                </dl>
                <!-- / #sideNavi -->
            </div>
            <?php include_once "side.html"; ?>
            <!-- / #sideArea -->
        </div>
        <!-- / #contentsContainer -->
    </div>

    <?php include_once "foot.html"; ?>

</body>

</html>
