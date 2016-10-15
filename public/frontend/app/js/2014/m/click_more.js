$(function(){
	var offset = 0;
	var ajaxAbort = null;
	$(".click_more").click(function(){
		var $this = $(this);
		var cid = $this.data("cid");
		var more = $this.attr("more");
		if (more == 1) {
			return ;
		}
		ajaxAbort && ajaxAbort.abort();
		ajaxAbort = $.ajax({
			type: "get",
			url: "./index.php?r=app/default/get-more&cid="+cid+"&offset="+offset,
			data: {},
			beforeSend: function() {
				$this.html('正在加载 ......');
			},
			success: function(data) {
				if (!data) {
					$this.html('没有内容啦！');
					$this.attr("more", 1);
					return ;
				}
				$this.prev("li").append(data);
				offset = offset+10;
				$this.html('点击查看更多');
			}
		});
	});
});
