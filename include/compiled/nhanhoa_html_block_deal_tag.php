<div class="current-path">
<h1 class="labelResult">
            Tìm thấy <b><?php echo $countCate; ?></b> 
                kết quả cho từ khoá "<b class="lblKeyword"><?php echo $tagP; ?></b>"
        </h1>
</div>
<?php if(!$countCate){?>	
<div class="no-deal">Hiện tại chưa có sản phẩm nào trong mục này, quý khách vui lòng trở lại sau.</div>	
<?php }?>
<div class="ls_deal_of_category">
    <div class="ls_cate_product2">
        <?php if(is_array($teams)){foreach($teams AS $index=>$one) { ?>
        <div class="cate_product_item2" <?php echo ($index+1)%4?'':'style="margin-right:0px"'; ?>>
            <div class="cate_product_item_img2">
                <a href="<?php echo rewrite_team_id($one['id']); ?>">
                    <img alt="<?php echo $one['product']; ?>, <?php echo $INI['system']['keywordseo']; ?>" src="<?php echo team_image($one['picture']); ?>" />
                </a>
                <div class="cate_product_delivery">
                    <span class="cate_product_damua">&nbsp;Đã mua <span><?php echo $one['now_number']; ?></span></span>
                    <span class="cate_product_giaohang">
                        <span class="giao_<?php echo $one['delivery_type']; ?>"></span>
                        <?php echo $option_giaohang[$one['delivery_type']]; ?>
                    </span>
                </div>
            </div>
            <div class="cate_product_item_title2">
                <h1><a href="<?php echo rewrite_team_id($one['id']); ?>"><?php echo $one['product']; ?></a></h1>
            </div>
            <div class="cate_product_item_info2 hrteam">
                <span class="deal_common_info2 sale_prc2">
				<span class="icon_price"></span>
				<span class="price-offer"><?php echo formatMoney($one['team_price']); ?><sup>đ</sup></span>
				<span class="space">|</span>
				<span class="del"><del><?php echo formatMoney($one['market_price']); ?></del><sup>đ</sup></span>
				</span> 
                
                <span class="deal_common_info deal_cmny" style="display: none;">
                    <span><?php echo $one['bonus']; ?></span>
                </span>
                
            </div>
        </div>
        <?php }}?>
		<script language="javascript">
            var sec = {};
            function getInitTime(){
              $('span.deal_timer2').each(function(){
                 var jobj = $(this);
                 var SysSecond = parseInt(jobj.attr('diff'));
                 var theid = parseInt((jobj.attr('id')).replace(/tg-/,''));
                 sec[theid]= SysSecond;
              });
            }
            getInitTime();
            function SetRemainTime() {
                for(var i in sec){
                    setRemainTimeSite(i,sec[i]);
                }
            }
            
            function setRemainTimeSite(theid,SysSecond){
            
              if (SysSecond > 0) {
                    SysSecond = SysSecond - 1;
                    var second = Math.floor(SysSecond % 60).toString();
                    var minute = Math.floor((SysSecond / 60) % 60).toString();
                    /*var hour = Math.floor((SysSecond / 3600) % 24).toString();*/
                    var hour = Math.floor(SysSecond / 3600).toString();
                    /*var day = Math.floor((SysSecond / 3600) / 24).toString();*/
                    if(hour<10) {hour = '0'+hour}
                    else{ if(hour<100) {hour = ''+hour;}}
                    if(minute<10) {minute = '0'+minute};
                    if(second<10) {second = '0'+second};
                    /*if(day>=1) $("#thoigiands-"+theid).html(""+day+" ngày");*/
                    /*else $("#thoigiands-"+theid).html(""+hour+":"+minute+":"+second);*/
                    $("#timer-"+theid).html(""+hour+":"+minute+":"+second);
                    
                    sec[theid]--;
              }else{
                    return;
              }
            }
            window.setInterval(SetRemainTime,1000);
        </script>
    </div>
    <div class="clear"></div>
    <?php echo $pagestring; ?>
</div>

