function imgscroll(obj){
	var moving = false;		
	var width = $(obj+" .banner .img img").width();
	var i=0;
	var clone=$(obj+" .banner .img li").first().clone();
	$(obj+" .banner .img").append(clone);	
	var size=$(obj+" .banner .img li").size();	
	for(var j=0;j<size-1;j++){
		$(obj+" .banner .num").append("<li><i></i></li>");
	}
	$(obj+" .banner .num li").first().addClass("on");
	
	/*鼠标划入圆点*/$(obj+" .banner .num li").click(function(){
		var index=$(this).index();
		i=index;
		$(obj+" .banner .img").stop().animate({left:-index*width},1000)	
		$(this).addClass("on").siblings().removeClass("on")		
	})

		
	/*自动轮播*/
	var t=setInterval(function(){
		i++;
		move();
	},2000)
		
	/*对banner定时器的操作*/
	$(obj+" .banner").hover(function(){
		clearInterval(t);
	},function(){
		t=setInterval(function(){
			i++;
			move();
		},2000)
	});
	if ($(obj+" .banner .btn_l")) {
		/*向左的按钮*/
		$(obj+" .banner .btn_l").stop(true).on('click', function(){
			console.log('test');
			if(moving){
				return;
			};
			moving=true;
			i--
			move();	
		});
		
		/*向右的按钮*/
		$(obj+" .banner .btn_r").stop(true).on('click', function(){
			if(moving){
				return;
			}
			moving=true;
			i++
			move()				
		})
	};
	
	function move(){
		
		if(i==size){
			$(obj+" .banner  .img").css({left:0})			
			i=1;
		}
		
		// 修改轮播每屏宽度
		if(i==-1){
			$(obj+" .banner .img").css({left:-(size-1)*width})
			i=size-2;
		}	
		$(obj+" .banner .img").stop(true).delay(200).animate({left:-i*width},1000,function(){
			moving = false;
		})
		
		if(i==size-1){
			$(obj+" .banner .num li").eq(0).addClass("on").siblings().removeClass("on")	
		}else{		
			$(obj+" .banner .num li").eq(i).addClass("on").siblings().removeClass("on")	
		}
	}	
}	