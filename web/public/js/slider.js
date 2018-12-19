$(function(){
	var sliderObj = new slider();
	$('.handle-left').on('click', function(){
		sliderObj.clearTimer();
		sliderObj.pre();
		setTimeout(function(){
			sliderObj.setTimer();
		}, 500);
	});
	$('.handle-right').on('click', function(){
		sliderObj.clearTimer();
		sliderObj.next();
		setTimeout(function(){
			sliderObj.setTimer();
		}, 500);
	});
});
function slider(){
	this.flag = false;
	this.minImg = 146;
	this.maxImg = 226;
	this.maxMargin = 22;
	this.minMargin = 18;
	this.liNum = $('#slider ul li').length;
	this.curIndex = this.liNum;
	this.next = next;
	this.pre = pre;
	this.clearTimer = clearTimer;
	this.setTimer = setTimer;
	this.hasTrans = false;
	this.timer;
	var _this = this;
	var ul = $('#slider ul');
	ul.html(ul.html() + ul.html());
	tipto(this.curIndex);
	setTimer();
	$('#slider ul li').eq(this.curIndex).addClass('cur');
	btns();
	function btns(){
		var os = '';
		for(var i = 0; i < _this.liNum; i++){
			os += '<a href="javascript:;"><b></b></a>';
		}
		$('#slider .con .btns').html(os);
	}
	function next(){
		var rLimit = _this.liNum * 2 - 3;
		if(_this.curIndex >= rLimit){
			removeTrans();
			tipto(rLimit%_this.liNum);
			setTimeout(function(){
				addTrans();
				tipto(_this.curIndex + 1);
			}, 30);
		}else{
			addTrans();
			tipto(this.curIndex + 1);
		}
	}
	function pre(){
		if(_this.curIndex <= 2){
			removeTrans();
			tipto(_this.liNum + _this.curIndex);
			setTimeout(function(){
				addTrans();
				tipto(_this.curIndex - 1);
			}, 30);
		}else{
			addTrans();
			tipto(this.curIndex - 1);
		}
	}
	function setTimer(){
		_this.timer = setInterval(function(){
			_this.next();
		}, 3000);
	}
	function clearTimer(){
		clearInterval(_this.timer);
	}
	function tipto(index){
		var offset = (_this.maxImg - _this.minImg)/2;
		var maxM = _this.maxMargin;
		var minM = _this.minMargin;
		var liW = _this.minImg + _this.minMargin;
		var tf1 = 'translate(-'+ (index - 2) * liW +'px, 0)';
		$('#slider ul').css({transform : tf1, webkitTransform:tf1});
		var tf2 = 'translate(0,-'+offset+'px)';
		$('#slider ul li').eq(index).css({transform: tf2, webkitTransform:tf2,
			marginLeft:maxM, marginRight:maxM - minM});
		$('#slider ul li').eq(index).find('img').css({width:_this.maxImg, height:_this.maxImg});
		if(_this.curIndex != index){
			$('#slider ul li').eq(_this.curIndex).css({transform:'translate(0,0)',  webkitTransform:'translate(0,0)',
				marginLeft:minM, marginRight:0});
			$('#slider ul li').eq(_this.curIndex).find('img').css({width:_this.minImg, height:_this.minImg});
			_this.curIndex = index;
		}
		changeCurBtn(_this.curIndex);
		$('#slider ul li').removeClass('cur');
		if(!_this.flag){
			_this.flag = true
		}else{
			$('#slider ul li').off('transitionend');
		}
		$('#slider ul li').eq(_this.curIndex).on('transitionend', function(){
			$('#slider ul li').eq(_this.curIndex).addClass('cur');
			_this.flag = false;
		})
	}
	function removeTrans(){
		if(_this.hasTrans){
			$('#slider ul li').css({transition:'', webkitTransition:''});
			$('#slider ul li').find('img').css({transition:'',webkitTransition:''});
			$('#slider ul').css({transition:'',webkitTransition:''});
			_this.hasTrans = false;
		}
	}
	function addTrans(){
		if(!_this.hasTrans){
			$('#slider ul li').css({transition:'1s all ease', webkitTransition:'1s all ease'});
			$('#slider ul li').find('img').css({transition:'1s all ease',webkitTransition:'1s all ease'});
			$('#slider ul').css({transition:'1s all ease',webkitTransition:'1s all ease'});
			_this.hasTrans = true;
		}
	}
	function changeCurBtn(){
		$('.btns a').removeClass('cur');
		var index = _this.curIndex%_this.liNum;
		$('.btns a').eq(index).addClass('cur');
	}
	function clickTo(index){
		var maxNum = _this.liNum - 1;
		if(index > maxNum){
			index = index % _this.liNum;
		}
		if(_this.curIndex >= maxNum){
			index = maxNum + index + 1;
		}
		if(index < 2){
			removeTrans();
			tipto(_this.liNum + index + 1);
			index = _this.liNum + index;
		}
		var rLimit = _this.liNum * 2 - 3;
		if(index > rLimit){
			removeTrans();
			tipto(index%_this.liNum-1);
			index = index%_this.liNum;
		}
		setTimeout(function(){
			addTrans();
			tipto(index);
		}, 30);
	}
	$('.btns a').each(function(index, dom){
		dom.index = index;
		$(dom).on('click', function(){
			clickTo(this.index);
		})
	});
}