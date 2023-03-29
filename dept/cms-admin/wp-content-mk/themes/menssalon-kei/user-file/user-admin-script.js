jQuery(function($) {
	// 共通：サイト名ブランク
	$('#wp-admin-bar-site-name a').attr('target', '_blank');

	// 一覧ページ：「表示ボタン」ブランク
	$('.wp-list-table a[rel=permalink]').attr('target', '_blank');
	$('#wp-admin-bar-archive a').attr('target', '_blank');
	$('.wp-list-table .view a').attr('target', '_blank');

	// 編集ページ：「投稿を表示」ブランク
	$('#post-body #view-post-btn a').attr('target', '_blank');
	$('#message.updated a').attr('target', '_blank');
	$('#wp-admin-bar-view a').attr('target', '_blank');
	$('#sample-permalink a, a#sample-permalink').attr('target', '_blank');

	// カテゴリページ：「表示ボタン」ブランク
	$('.tags #the-list .view a').attr('target', '_blank');

	function getQueryPram() {
		var q = {},
			s = location.search.replace("?", ""),
			qs = s.split("&");

		if(!s) return q;

		for( var i = 0, l = qs.length; i < l; i++ ) {
			var e = qs[i].split("=");
			q[decodeURIComponent(e[0])] = decodeURIComponent(e[1]);
		}
		return q;
	}
});


